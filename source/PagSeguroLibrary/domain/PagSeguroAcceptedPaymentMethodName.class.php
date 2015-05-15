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
 * Represent available name list for payment method
 */
class PagSeguroPaymentMethodName
{

    private static $availableNameList = array(
        'DEBITO_BRADESCO' => 'Débito BradescoPercentual de Desconto',
        'DEBITO_ITAU' => 'Débito Itaú',
        'DEBITO_UNIBANCO' => 'Débito Unibanco',
        'DEBITO_BANCO_BRASIL' => 'Débito Banco do Brasil',
        'DEBITO_BANRISUL' => 'Débito Banrisul',
        'DEBITO_HSBC' => 'Débito Banco HSBC',
        'BOLETO' => 'Boleto',
        'VISA' => 'Bandeira Visa',
        'MASTERCARD' => 'Bandeira MasterCard',
        'AMEX' => 'Bandeira Amex',
        'DINERS' => 'Bandeira Diners',
        'HIPERCARD' => 'Bandeira Hipercard',
        'AURA' => 'Bandeira Aura',
        'ELO' => 'Bandeira ELO',
        'PLENOCARD' => 'Bandeira PlenoCard',
        'PERSONALCARD' => 'Bandeira PersonalCard',
        'JCB' => 'Bandeira JCB',
        'DISCOVER' => 'Bandeira Discover',
        'BRASILCARD' => 'Bandeira BrasilCard',
        'FORTBRASIL' => 'Bandeira FortBrasil',
        'CARDBAN' => 'Bandeira CardBAN',
        'VALECARD' => 'Bandeira ValeCard',
        'CABAL' => 'Bandeira Cabal',
        'MAIS' => 'Bandeira MAIS',
        'AVISTA' => 'Bandeira AVISTA',
        'GRANDCARD' => 'Bandeira GrandCard',
        'SOROCRED' => 'Bandeira Sorocred'
    );


    /***
     * Get available list for accepted payment methods
     * @return array
     */
    public static function getAvailableKeysList()
    {
        return self::$availableNameList;
    }

    /***
     * Check if a name is available for accepted payment methods.
     * @param string $name
     * @return boolean
     */
    public static function isNameAvailable($name)
    {
        $name = strtoupper($name);
        return (isset(self::$availableNameList[$name]));
    }

    /***
     * Gets description by name
     * @param string $keyName
     * @return string
     */
    public static function getDescriptionByName($keyName)
    {
        $keyName = strtoupper($keyName);
        if (isset(self::$availableNameList[$keyName])) {
            return self::$availableNameList[$keyName];
        } else {
            return false;
        }
    }

    /***
     * Gets name key by description
     * @param string $descriptionName
     * @return string
     */
    public static function getKeyByDescription($descriptionName)
    {
        return array_search(strtolower($descriptionName), array_map('strtolower', self::$availableNameList));
    }
}
