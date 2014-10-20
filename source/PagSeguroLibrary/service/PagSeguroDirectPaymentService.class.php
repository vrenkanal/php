<?php
/**
 * 2007-2014 [PagSeguro Internet Ltda.]
 *
 * NOTICE OF LICENSE
 *
 *Licensed under the Apache License, Version 2.0 (the "License");
 *you may not use this file except in compliance with the License.
 *You may obtain a copy of the License at
 *
 *http://www.apache.org/licenses/LICENSE-2.0
 *
 *Unless required by applicable law or agreed to in writing, software
 *distributed under the License is distributed on an "AS IS" BASIS,
 *WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *See the License for the specific language governing permissions and
 *limitations under the License.
 *
 *  @author    PagSeguro Internet Ltda.
 *  @copyright 2007-2014 PagSeguro Internet Ltda.
 *  @license   http://www.apache.org/licenses/LICENSE-2.0
 */

/***
 * Encapsulates web service calls regarding PagSeguro payment requests
 */
class PagSeguroDirectPaymentService
{

    /**
    * @var $session
    */
    private static $session;
    /**
    * @var $creditCard
    */
    private static $creditCard;
    /**
    * @var $token
    */
    private static $token;
    /**
    * @var $installments
    */
    private static $installments;
    /**
    * @var $connectionData
    */
    private static $connectionData;

    /***
     *
     */
    const SERVICE_NAME = 'paymentDirect';

    /***
     * Get from webservice session id for direct payment.
     */
    private static function getSessionId()
    {
        $url = self::$connectionData->getWebserviceUrl() . 
               self::$connectionData->getResource('sessionUrl') . "?" . 
               self::$connectionData->getCredentialsUrlQuery();

        $connection = new PagSeguroHttpConnection();
        $connection->post(
            $url,
            array(),
            self::$connectionData->getServiceTimeout(),
            self::$connectionData->getCharset()
        );

        try {

            $httpStatus = new PagSeguroHttpStatus($connection->getStatus());

            switch ($httpStatus->getType()) {

                case 'OK':
                    
                    $session = json_decode(json_encode(simplexml_load_string($connection->getResponse())), TRUE);
                    self::$session = $session;
                    
                    break;

                case 'BAD_REQUEST':
                    $errors = PagSeguroTransactionParser::readErrors($connection->getResponse());
                    $e = new PagSeguroServiceException($httpStatus, $errors);
                    LogPagSeguro::error(
                        "PagSeguroDirectPaymentService.getSession(" . $e->getOneLineMessage() . ") - error "
                    );
                    throw $e;
                    break;

                default:
                    $e = new PagSeguroServiceException($httpStatus);
                    LogPagSeguro::error(
                        "PagSeguroDirectPaymentService.getSession(" . $e->getOneLineMessage() . ") - error "
                    );
                    throw $e;
                    break;

            }

        } catch (PagSeguroServiceException $e) {
            LogPagSeguro::error("Exception: " . $e->getMessage());
            throw $e;
        }
    }

    /***
     * Get from webservice credit card brand for direct payment.
     */
    private static function getBrand()
    {
        $url = self::$connectionData->getDataFortressUrl() . 
               self::$connectionData->getResource('ccBrandUrl') . 
               "?tk=" . self::$session['id'] . 
               "&creditCard=" . substr(preg_replace("[^0-9]", "", self::$creditCard->getNumber()), 0, 6);

        $connection = new PagSeguroHttpConnection();
        $connection->get(
            $url,
            self::$connectionData->getServiceTimeout(),
            self::$connectionData->getCharset()
        );

        $brand = json_decode($connection->getResponse(), TRUE);
        self::$creditCard->setBrand($brand['bin']['brand']['name']);
    }

    /***
     * Get from webservice the credit card token for direct payment.
     */
    private static function createCardToken()
    {
        $url = self::$connectionData->getDataFortressUrl() . 
               self::$connectionData->getResource('ccTokenUrl');

        $data = array(
            "sessionId" => self::$session['id'],
            "cardNumber" => self::$creditCard->getNumber(),
            "cardBrand" => self::$creditCard->getBrand(),
            "cardCvv" => self::$creditCard->getCvv(),
            "cardExpirationMonth" => self::$creditCard->getExpirationMonth(),
            "cardExpirationYear" => self::$creditCard->getExpirationYear()
            );

        $connection = new PagSeguroHttpConnection();
        $connection->post(
            $url,
            $data,
            self::$connectionData->getServiceTimeout(),
            self::$connectionData->getCharset()
        );

        $creditCardToken = json_decode(json_encode(simplexml_load_string($connection->getResponse())), TRUE);
        self::$token = $creditCardToken['token'];
    }

    /***
     * @return String credit card token
     */
    public static function getCardToken()
    {
        return self::$token;
    }

    /***
     * Get from webservice installments for direct payment.
     * @param int $amount
     */
    private static function getInstallments($amount)
    {
        $url = self::$connectionData->getResource('baseUrl')[self::$connectionData->getEnvironment()] . 
               self::$connectionData->getResource('installmentsUrl') .
               "?sessionId=" .self::$session['id'] .
               "&amount=". $amount .
               "&creditCardBrand=" . self::$creditCard->getBrand();

        $connection = new PagSeguroHttpConnection();
        $connection->get(
            $url,
            self::$connectionData->getServiceTimeout(),
            self::$connectionData->getCharset()
        );

        self::$installments = json_decode($connection->getResponse(), TRUE);
    }

    /***
     * @return array of installments $installments
     */
    public static function getInstallment($installment = null)
    {
        $brand = self::$creditCard->getBrand();
        if ($installment) {
            return self::$installments['installments'][$brand][$installment - 1];
        } else {
            return self::$installments['installments'][$brand];
        }
    }

    /***
     * Consume Webservice's services for direct payment.
     * @param PagSeguroCredentials $credentials
     * @param PagSeguroCreditCard $creditCard
     * @param int $amount
     */
    public static function buildCreditCard($credentials, $creditCard, $amount)
    {

        try {
            self::$connectionData = new PagSeguroConnectionData($credentials, self::SERVICE_NAME);
            self::$creditCard = $creditCard;
            self::getSessionId();
            self::getBrand();
            self::createCardToken();
            self::getInstallments(
                PagSeguroHelper::decimalFormat($amount)
                );
        } catch (Exception $e) {
            throw $e; 
        }
    }

    /***
     * @param PagSeguroConnectionData $connectionData
     * @return string
     */
    private static function buildCheckoutRequestUrl(PagSeguroConnectionData $connectionData)
    {
        return $connectionData->getServiceUrl() . '/?' . $connectionData->getCredentialsUrlQuery();
    }

    /***
     * @param PagSeguroConnectionData $connectionData
     * @param $code
     * @return string
     */
    private static function buildReturnUrl(PagSeguroConnectionData $connectionData, $code)
    {
        return $connectionData->getServiceUrl() . '/' .$code . '/?' . $connectionData->getCredentialsUrlQuery()  ;
    }

    // createCheckoutRequest is the actual implementation of the Register method
    // This separation serves as test hook to validate the Uri
    // against the code returned by the service
    /***
     * @param PagSeguroCredentials $credentials
     * @param PagSeguroPaymentRequest $paymentRequest
     * @return bool|string
     * @throws Exception|PagSeguroServiceException
     * @throws Exception
     */
    public static function createCheckoutRequest(
        PagSeguroCredentials $credentials,
        PagSeguroPaymentRequest $paymentRequest,
        $onlyCheckoutCode
    ) {

        LogPagSeguro::info("PagSeguroDirectPaymentService.Register(" . $paymentRequest->toString() . ") - begin");

        $connectionData = new PagSeguroConnectionData($credentials, self::SERVICE_NAME);

        try {

            $connection = new PagSeguroHttpConnection();
            $connection->post(
                self::buildCheckoutRequestUrl($connectionData),
                PagSeguroPaymentParser::getData($paymentRequest),
                $connectionData->getServiceTimeout(),
                $connectionData->getCharset()
            );

            $httpStatus = new PagSeguroHttpStatus($connection->getStatus());

            switch ($httpStatus->getType()) {

                case 'OK':
                    $PaymentParserData = PagSeguroTransactionParser::readTransaction($connection->getResponse());

                    if ($onlyCheckoutCode) {
                        $paymentReturn = $PaymentParserData->getCode();
                    } else {
                        $paymentReturn = $PaymentParserData;
                    }
                    LogPagSeguro::info(
                        "PagSeguroDirectPaymentService.Register(" . $paymentRequest->toString() . ") - end {1}" .
                        $PaymentParserData->getCode()
                    );
                    break;

                case 'BAD_REQUEST':
                    $errors = PagSeguroTransactionParser::readErrors($connection->getResponse());
                    $e = new PagSeguroServiceException($httpStatus, $errors);
                    LogPagSeguro::error(
                        "PagSeguroDirectPaymentService.Register(" . $paymentRequest->toString() . ") - error " .
                        $e->getOneLineMessage()
                    );
                    throw $e;
                    break;

                default:
                    $e = new PagSeguroServiceException($httpStatus);
                    LogPagSeguro::error(
                        "PagSeguroDirectPaymentService.Register(" . $paymentRequest->toString() . ") - error " .
                        $e->getOneLineMessage()
                    );
                    throw $e;
                    break;

            }
            return (isset($paymentReturn) ? $paymentReturn : false);

        } catch (PagSeguroServiceException $e) {
            throw $e;
        }
        catch (Exception $e) {
            LogPagSeguro::error("Exception: " . $e->getMessage());
            throw $e;
        }

    }
}
