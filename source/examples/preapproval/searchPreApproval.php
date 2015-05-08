<?php
/*
 * ***********************************************************************
 Copyright [2015] [PagSeguro Internet Ltda.]

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

require_once "../../PagSeguroLibrary/PagSeguroLibrary.php";

/**
 * Class with a main method to illustrate the usage of the service PagSeguroPreApprovalService
 */
class SearchPreApprovalByCode
{

    public static function searchByCode()
    {

        // Substitute the code below with a valid pre-approval code for your account
        $preApprovalCode = "0FEBE545C6C657A77402DF878C539E56";

        try {

            /**
             * @todo
             * #### Credentials #####
             * Replace the parameters below with your credentials (e-mail and token)
             * You can also get your credentials from a config file. See an example:
             * $credentials = PagSeguroConfig::getAccountCredentials();
             */
            $credentials = PagSeguroConfig::getAccountCredentials();

            $result = PagSeguroPreApprovalSearchService::searchByCode($credentials, $preApprovalCode);

            self::printResult($result);

        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    public static function searchByInterval()
    {

        // Substitute the code below
        $days = 20;

        try {

            /**
             * @todo
             * #### Credentials #####
             * Replace the parameters below with your credentials (e-mail and token)
             * You can also get your credentials from a config file. See an example:
             * $credentials = PagSeguroConfig::getAccountCredentials();
             */
            $credentials = PagSeguroConfig::getAccountCredentials();

            $result = PagSeguroPreApprovalSearchService::searchByInterval($credentials, $days);

            self::printResult($result);

        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    public static function searchByDate()
    {

        // Substitute the information below
        $page           = 1;
        $maxPageResults = 1000;
        $initialDate    = "2015-03-10T00:00:00";
        $finalDate      = "2015-04-06T00:00:00";

        try {

            /**
             * @todo
             * #### Credentials #####
             * Replace the parameters below with your credentials (e-mail and token)
             * You can also get your credentials from a config file. See an example:
             * $credentials = PagSeguroConfig::getAccountCredentials();
             */
            $credentials = PagSeguroConfig::getAccountCredentials();

            $result = PagSeguroPreApprovalSearchService::searchByDate(
                $credentials, $page, $maxPageResults, $initialDate, $finalDate);

            self::printResult($result);

        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    public static function searchByReference()
    {

        $reference      = 'REF123';
        $page           = 1;
        $maxPageResults = 1000;
        $initialDate    = "2015-03-10T00:00:00";
        $finalDate      = "2015-04-06T00:00:00";

        try {

            /**
             * @todo
             * #### Credentials #####
             * Replace the parameters below with your credentials (e-mail and token)
             * You can also get your credentials from a config file. See an example:
             * $credentials = PagSeguroConfig::getAccountCredentials();
             */
            $credentials = PagSeguroConfig::getAccountCredentials();

            $result = PagSeguroPreApprovalSearchService::searchByReference(
                $credentials, $page, $maxPageResults, $initialDate, $finalDate, $reference);

            self::printResult($result);

        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    public static function printResult($result, $initialDate = null, $finalDate = null)
    {

        if ($result instanceof PagSeguroPreApprovalSearchResult) {

            echo utf8_decode("<h2>Consulta de Assinatura:</h2>");
            echo "<p><strong> Date: </strong>".$result->getDate() ."</p> ";
            echo "<p><strong> Results in this Page: </strong>".$result->getResultsInThisPage() ."</p> ";
            echo "<p><strong> Total Page: </strong>".$result->getTotalPages() ."</p> ";
            echo "<p><strong> Current Page: </strong>".$result->getCurrentPage() ."</p> ";

            if (is_null($initialDate)) {
                echo "<h2>Assinaturas: </h2> ";
            } else {
                echo "<h2>Assinaturas</h2> ";
                echo "<h3>$initialDate to $finalDate</h3>";
            }
            $i = 1;

            foreach ($result->getPreApprovals() as $preApproval ){

                if (is_array($preApproval)) {
                    $preApproval = new PagSeguroPreApproval($preApproval);
                }

                echo "<p><strong>Assinatura </strong>". $i++ . "</p>";
                echo "<p><strong> Name: </strong>".$preApproval->getName() ."</p> ";
                echo "<p><strong> Date: </strong>".$preApproval->getDate() ."</p> ";
                echo "<p><strong> LastEventDate: </strong>".$preApproval->getLastEventDate() ."</p> ";
                echo "<p><strong> Code: </strong>".$preApproval->getCode() ."</p> ";
                echo "<p><strong> Tracker: </strong>".$preApproval->getTracker() ."</p> ";
                echo "<p><strong> Reference: </strong>".$preApproval->getReference() ."</p> ";
                echo "<p><strong> Status: </strong>".$preApproval->getStatus()->getTypeFromValue() ."</p> ";
                echo "<p><strong> Charge: </strong>".$preApproval->getCharge() ."</p> ";
                echo "<br>";
            }

        } else {
            echo utf8_decode("<h2>Consulta de Assinatura:</h2>");
            echo "<p><strong> Name: </strong>".$result->getName() ."</p> ";
            echo "<p><strong> Date: </strong>".$result->getDate() ."</p> ";
            echo "<p><strong> LastEventDate: </strong>".$result->getLastEventDate() ."</p> ";
            echo "<p><strong> Code: </strong>".$result->getCode() ."</p> ";
            echo "<p><strong> Tracker: </strong>".$result->getTracker() ."</p> ";
            echo "<p><strong> Reference: </strong>".$result->getReference() ."</p> ";
            echo "<p><strong> Status: </strong>".$result->getStatus()->getTypeFromValue() ."</p> ";
            echo "<p><strong> Charge: </strong>".$result->getCharge() ."</p> ";
        }

      echo "<pre>";
    }
}

SearchPreApprovalByCode::searchByCode();
SearchPreApprovalByCode::searchByInterval();
SearchPreApprovalByCode::searchByDate();
SearchPreApprovalByCode::searchByReference();
