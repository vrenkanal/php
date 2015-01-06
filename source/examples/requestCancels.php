<?php //

/*
 * ***********************************************************************
 Copyright [2014] [PagSeguro Internet Ltda.]

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
 * ***********************************************************************
 */

require_once "../PagSeguroLibrary/PagSeguroLibrary.php";

/**
 * Class with a main method to illustrate the usage of the service PagSeguroCancelsService
 */
class RequestCancels
{

    public static function main()
    {

        $transactionCode = "33373E4564B94A58A0E764F07B49715C";

        try {
                
            /**
             * @todo
             * #### Credentials #####
             * Replace the parameters below with your credentials (e-mail and token)
             * You can also get your credentials from a config file. See an example:
             * $credentials = PagSeguroConfig::getAccountCredentials();
             */
            $credentials = new PagSeguroAccountCredentials("vendedor@lojamodelo.com.br",
                "E231B2C9BCC8474DA2E260B6C8CF60D3");

            $cancels = PagSeguroCancelsService::createRequest($credentials, $transactionCode);

            self::printCancels($cancels);

        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    } 

    public static function printCancels($cancels)
    {

        if ($cancels) {
            echo utf8_decode("<h2>Cancels Status:</h2>");
            echo "<p>".$cancels ."</p> ";
        }

      echo "<pre>";
    }
}

RequestCancels::main();
