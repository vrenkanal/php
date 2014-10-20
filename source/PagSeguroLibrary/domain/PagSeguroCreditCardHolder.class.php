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
class PagSeguroCreditCardHolder
{

    /***
     * holder name
     */
    private $name;

    /***
     * holder cpf
     */
    private $documents;

    /***
     * holder birth date
     */
    private $birthDate;

    /***
     * holder phone
     */
    private $phone;

    /***
     * Initializes a new instance of the PagSeguroCreditCardHolder class
     * @param array $data
     */
    public function __construct(array $data = null)
    {

        if ($data) {
            if (isset($data['name'])) {
                $this->name = $data['name'];
            }
            if (isset($data['documents']) && is_array($data['documents'])) {
                $this->setDocuments($data['documents']);
            } else if (isset($data['documents']) && $data['documents'] instanceof PagSeguroDocument) {
                $this->documents = $data['documents'];
            }
            if (isset($data['birthDate'])) {
                $this->birthDate = $data['birthDate'];
            }
            if (isset($data['phone']) && $data['phone'] instanceof PagSeguroPhone) {
                $this->phone = $data['phone'];
            } else {
                if (isset($data['areaCode']) && isset($data['number'])) {
                    $phone = new PagSeguroPhone($data['areaCode'], $data['number']);
                    $this->phone = $phone;
                }
            }
        }    
    }

    /***
     * Set card holder name
     * @param $name string
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /***
     * @return string the card holder name
     */
    public function getName()
    {
        return $this->name;
    }

    /***
     * Set PagSeguro documents
     * @param array $documents
     * @see PagSeguroDocument
     */
    public function setDocuments(array $documents)
    {
        if ($documents instanceof PagSeguroDocument) {
            $this->documents = $documents;
        } else {
            if (is_array($documents)) {
                $this->addDocument($documents['type'], $documents['value']);
            }
        }
    }

    /***
     * Add a document for Sender object
     * @param String $type
     * @param String $value
     */
    public function addDocument($type, $value)
    {
        if ($type && $value) {
            if (count($this->documents) == 0) {
                $data = array(
                    'type' => $type, 
                    'value' => $value
                );
                $document = new PagSeguroDocument($data);
                $this->documents = $document;
            }
        }
    }

    /***
     * Get Sender documents
     * @return array PagSeguroDocument List of PagSeguroDocument
     * @see PagSeguroDocument
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /***
     * Set card holder birth date
     * @param $birthDate date
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /***
     * @return date the card holder birth date
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /***
     * Sets the sender phone
     * @param String $areaCode
     * @param String $number
     */
    public function setPhone($areaCode, $number = null)
    {
        $param = $areaCode;
        if ($param instanceof PagSeguroPhone) {
            $this->phone = $param;
        } elseif ($number) {
            $phone = new PagSeguroPhone();
            $phone->setAreaCode($areaCode);
            $phone->setNumber($number);
            $this->phone = $phone;
        }
    }

    /***
     * @return PagSeguroPhone the sender phone
     * @see PagSeguroPhone
     */
    public function getPhone()
    {
        return $this->phone;
    }

}
