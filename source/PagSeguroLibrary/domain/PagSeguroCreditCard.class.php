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
 * CreditCard Holder information
 */
class PagSeguroCreditCard
{

    /***
     * Card Number
     */
    private $number;

    /***
     * Card CVV
     */
    private $cvv;

    /***
     * Card Expiration Month
     */
    private $expirationMonth;

    /***
     * Card Expiration Year
     */
    private $expirationYear;

    /***
     * Card brand
     */
    private $brand;

    /***
     * Card Token
     */
    private $token;

    /***
     * PagSeguroCreditCardHolder
     */
    private $holder;

    /***
     * PagSeguroInstallment
     */
    private $installment;

    /***
     * PagSeguroBilling
     */
    private $billing;

    /***
     * Initializes a new instance of the PagSeguroCreditCard class
     * @param array $data
     */
    public function __construct(array $data = null)
    {

        if ($data) {
            if (isset($data['number'])) {
                $this->number = $data['number'];
            }
            if (isset($data['cvv'])) {
                $this->cvv = $data['cvv'];
            }
            if (isset($data['expirationMonth'])) {
                $this->expirationMonth = $data['expirationMonth'];
            }
            if (isset($data['expirationYear'])) {
                $this->expirationYear = $data['expirationYear'];
            }
            if (isset($data['token'])) {
                $this->token = $data['token'];
            }
            if (isset($data['holder'])) {
                $this->holder = $data['holder'];
            }
            if (isset($data['installment'])) {
                $this->installment = $data['installment'];
            }
            if (isset($data['billing'])) {
                $this->billing = $data['billing'];
            }
        }
        
    }

    /***
     * Sets the card number
     * @param Int $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /***
     * @return Int the card number
     */
    public function getNumber()
    {
        return $this->number;
    }

    /***
     * Sets the card cvv
     * @param Int $cvv
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
    }

    /***
     * @return Int the card cvv
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /***
     * Sets the card expirationMonth
     * @param Int $expirationMonth
     */
    public function setExpirationMonth($expirationMonth)
    {
        $this->expirationMonth = $expirationMonth;
    }

    /***
     * @return Int the card expirationMonth
     */
    public function getExpirationMonth()
    {
        return $this->expirationMonth;
    }

    /***
     * Sets the card expirationYear
     * @param Int $expirationYear
     */
    public function setExpirationYear($expirationYear)
    {
        $this->expirationYear = $expirationYear;
    }

    /***
     * @return Int the card expirationYear
     */
    public function getExpirationYear()
    {
        return $this->expirationYear;
    }

    /***
     * Sets the card brand
     * @param String $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /***
     * @return Int the card number
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /***
     * Sets the card token
     * @param Int $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /***
     * @return Int the card token
     */
    public function getToken()
    {
        return $this->token;
    }

    /***
     * Sets the PagSeguroCreditCardHolder
     * @param intanceof PagSeguroCreditCardHolder $holder
     */
    public function setHolder($holder)
    {
        $this->holder = $holder;
    }

    /***
     * @return object PagSeguroCreditCardHolder
     * @see PagSeguroCreditCardHolder
     */
    public function getHolder()
    {
        return $this->holder;
    }

    /***
     * Sets the PagSeguroInstallment
     * @param intanceof PagSeguroInstallment $installment
     */
    public function setInstallment($installment)
    {
        $this->installment = $installment;
    }

    /***
     * @return object PagSeguroInstallment
     * @see PagSeguroInstallment
     */
    public function getInstallment()
    {
        return $this->installment;
    }

    /***
     * Sets the PagSeguroBilling
     * @param intanceof PagSeguroBilling $billing
     */
    public function setBilling($billing)
    {
        $this->billing = $billing;
    }

    /***
     * @return object PagSeguroBilling
     * @see PagSeguroBilling
     */
    public function getBilling()
    {
        return $this->billing;
    }
}