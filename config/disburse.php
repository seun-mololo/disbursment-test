<?php
    require_once('config/database_factory.php');
    class disburse
    {   
        //rest request 
        function restRequest($method, $endpoint, $data, $content_type) 
        {
            
            $ch = curl_init($endpoint);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("Authorization: Bearer sk_test_8df102243d3168ab2436db164e2bec3c47dfa7f4",
                "Content-type: $content_type"));
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            $method = strtoupper($method);
            
            switch ($method) {
                case "GET":
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                    break;
                case "DELETE":
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                    break;
                case "PUT":
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                case "POST":
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    break;
                default:
                    throw new Exception("Error: Invalid HTTP method '$method' $endpoint");
                    return null;
            }
                
            $oRet = new StdClass;
            $oRet->response = json_decode(curl_exec($ch));
            $oRet->status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            return $oRet;
        }

        //authenticate
        function createTransferRecipient($type,$name,$account_number,$bank_code)
        {
            try{
                
                $params = array (
                    "type" => $type,
                    "name" => $name,
                    "account_number" => $account_number,
                    "bank_code" => $bank_code
                );
                
                $params = json_encode($params);
                //return $params;
               
                $endpoint = "https://api.paystack.co/transferrecipient";
                $result = $this->restRequest("POST",  $endpoint, $params, "application/json");
                
                return $result;
                        
            }catch(Exception $ex){
                return array("error" => $ex->getMessage());                        
            }             
        }

        //list all transfer recipient

        function listTransferRecipient()
        {
            //
            try{
                
                $params = array (
                );
                
                $params = json_encode($params);
                //return $params;
               
                $endpoint = "https://api.paystack.co/transferrecipient";
                $result = $this->restRequest("GET",  $endpoint, $params, "application/json");
                
                return $result;
                        
            }catch(Exception $ex){
                return array("error" => $ex->getMessage());                        
            }          

        }

        function updateTransferRecipient($recipient_code_or_id, $name, $email)
        {
            //
            try{
                
                $params = array (
                    "name" => $name,
                    "email" => $email
                );
                
                $params = json_encode($params);
                //return $params;
               
                $endpoint = "https://api.paystack.co/transferrecipient/$recipient_code_or_id";
                
                $result = $this->restRequest("PUT",  $endpoint, $params, "application/json");
                
                return $result;
                        
            }catch(Exception $ex){
                return array("error" => $ex->getMessage());                        
            }          

        }

        function deleteTransferRecipient($recipient_code_or_id)
        {
            //
            try{
                
                $params = array (
                );
                
                $params = json_encode($params);
                //return $params;
                $endpoint = "https://api.paystack.co/transferrecipient/$recipient_code_or_id";
                $result = $this->restRequest("DELETE",  $endpoint, $params, "application/json");
                
                return $result;
                        
            }catch(Exception $ex){
                return array("error" => $ex->getMessage());                        
            }          

        }

        function initiateTransfer($source,$amount,$recipient)
        {
            try{
                
                $params = array (
                    "source" => $source,
                    "amount" => $amount,
                    "recipient" => $recipient
                );
                
                $params = json_encode($params);
               
                $endpoint = "https://api.paystack.co/transfer";
                $result =  $this->restRequest("POST",  $endpoint, $params, "application/json");
                
                return $result;
                        
            }catch(Exception $e){
                return array("error" => $ex->getMessage());                         
            }          
        }

        function storeRecipientCode($accountNumber,$supplierNumber,$id,$recipientCode)
        {
            try
            {
                $db = new database_factory();
                $query = "UPDATE SUPPLIERS 
                            SET recipient_code = ''
                            WHERE supplierNumber = '$supplierNumber'
                            AND accountNumber = '$accountNumber'
                            AND ID = $id";
                $db = new database_factory();
                $res = $db->execute($query);
            }
            catch(Exception $ex)
            {
                return array("error" => $ex->getMessage());                        
            }  
                        
        }

        function getSuppliersDetails()
        {
            try
            {        
                $query = "SELECT * FROM SUPPLIERS";                
                $db = new database_factory();
                $res = $db->fetchResut($query);
                return $res;
                //print_r($res);

            }
            catch(Exception $ex){
                return array("error" => $ex->getMessage());                        
            }  


        }

        function getSuppliersName()
        {
            try
            {        
                $query = "SELECT id, first_name, last_name FROM SUPPLIERS";                
                $db = new database_factory();
                $res = $db->fetchResut($query);
                return $res;
                //print_r($res);

            }
            catch(Exception $ex){
                return array("error" => $ex->getMessage());                        
            }  


        }

        function getSupplierById($id)
        {
            try
            {        
                $query = "SELECT * FROM SUPPLIERS
                            WHERE id = $id";                
                $db = new database_factory();
                $res = $db->fetchResut($query);
                return json_encode($res);
                //print_r($res);

            }
            catch(Exception $ex){
                return array("error" => $ex->getMessage());                        
            }  


        }



    }



?>