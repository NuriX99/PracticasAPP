<?php
require_once 'config.php';


class Cliente {
    private $apiUrl;
    private $apiKey;

    public function __construct() {
        
        $this->apiUrl = 'http://localhost:8080/api/customers';
        $this->apiKey = 'UNA6UXU3Y5INTEXDFZ8IEAGD1ZJR2MKU'; 
    }

    public function getCliente() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . base64_encode($this->apiKey . ':')
            ),
        ));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        
        if ($httpCode == 200 && $response) {
            
            $xml = simplexml_load_string($response);
            if ($xml === false) {
                echo "<p>Error: Unable to parse XML response.</p>";
                return [];
            }

            
            $customers = [];
            foreach ($xml->customers->customer as $customer) {
                $customers[] = [
                    'id' => (string)$customer['id'],
                    'link' => (string)$customer['xlink:href']
                ];
            }

            return $customers;
        } else {
            echo "<p>Error: Unable to fetch customers. HTTP Code: $httpCode</p>";
            return [];
        }
    }
}


    





