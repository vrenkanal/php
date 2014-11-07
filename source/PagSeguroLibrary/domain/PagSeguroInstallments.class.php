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
 * Installments information
 */
class PagSeguroInstallments
{

    /** Credit card brand */
    private $cardBrand;

    /** Quantity of installments */
    private $quantity;

    /** Value of each installment */
    private $installmentAmount;

    /** Total value of installments */
    private $totalAmount;

    /** Indicates if is an interest free transaction */
    private $interestFree;


    /***
     * Initializes a new instance of the PagSeguroInstallments class
     * @param array $data
     */
    public function __construct($cardBrand, 
        $quantity = null, 
        $amount = null, 
        $totalAmount = null, 
        $interestFree = null)
    {   
        $param = $cardBrand;
        if (isset($param) && is_array($param) || is_object($param)) {
            if (isset($param->cardBrand)) {
                $this->cardBrand = $param->cardBrand;
            }
             if (isset($param->quantity)) {
                $this->quantity = $param->quantity;
            }
            if (isset($param->installmentAmount)) {
                $this->installmentAmount = $param->installmentAmount;
            }
            if (isset($param->totalAmount)) {
                $this->totalAmount = $param->totalAmount;
            }
            if (isset($param->interestFree)) {
                $this->interestFree = $param->interestFree;
            }
        } else {
            if (isset($cardBrand)) {
                $this->cardBrand = $cardBrand;
            }
            if (isset($quantity)) {
                $this->quantity = $quantity;
            }
            if (isset($installmentAmount)) {
                $this->installmentAmount = $installmentAmount;
            }
            if (isset($totalAmount)) {
                $this->totalAmount = $totalAmount;
            }
            if (isset($interestFree)) {
                $this->interestFree = $interestFree;
            }
        }  
    }

    /***
     * Set installment card brand
     * @param $cardBrand string
     */
    public function setCardBrand($cardBrand)
    {
        $this->cardBrand = $cardBrand;
    }

    /***
     * @return string installment cardBrand
     */
    public function getCardBrand()
    {
        return $this->cardBrand;
    }

    /***
     * Set installment quantity
     * @param $quantity int
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /***
     * @return int installment quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /***
     * Set installment amount
     * @param $installmentAmount int
     */
    public function setInstallmentAmount($installmentAmount)
    {
        $this->installmentAmount = $installmentAmount;
    }

    /***
     * @return int installment amount
     */
    public function getInstallmentAmount()
    {
        return $this->installmentAmount;
    }

    /***
     * Set installment total amount
     * @param $totalAmount int
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    /***
     * @return int installment total amount
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /***
     * Set installment interest free
     * @param $interestFree string
     */
    public function setInterestFree($interestFree)
    {
        $this->interestFree = $interestFree;
    }

    /***
     * @return string installment interest free
     */
    public function getInterestFree()
    {
        return $this->interestFree;
    }

    /***
     * Set installment value and quantity
     * @param $quantity int
     * @param $value int
     */
    public function setInstallment($cardBrand, 
        $quantity = null, 
        $amount = null, 
        $totalAmount = null, 
        $interestFree = null)
    {
        $param = $quantity;
        $param = $cardBrand;
        if (isset($param) && is_array($param) || is_object($param)) {
            if (isset($param->cardBrand)) {
                $this->cardBrand = $param->cardBrand;
            }
             if (isset($param->quantity)) {
                $this->quantity = $param->quantity;
            }
            if (isset($param->installmentAmount)) {
                $this->installmentAmount = $param->installmentAmount;
            }
            if (isset($param->totalAmount)) {
                $this->totalAmount = $param->totalAmount;
            }
            if (isset($param->interestFree)) {
                $this->interestFree = $param->interestFree;
            }
        } else {
            if (isset($cardBrand)) {
                $this->cardBrand = $cardBrand;
            }
            if (isset($quantity)) {
                $this->quantity = $quantity;
            }
            if (isset($installmentAmount)) {
                $this->installmentAmount = $installmentAmount;
            }
            if (isset($totalAmount)) {
                $this->totalAmount = $totalAmount;
            }
            if (isset($interestFree)) {
                $this->interestFree = $interestFree;
            }
        }  
    }
}
