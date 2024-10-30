<?php
class Productos {
    private $apiUrl = 'http://localhost:8080/api/products';
    private $apiKey = 'UNA6UXU3Y5INTEXDFZ8IEAGD1ZJR2MKU'; 

    public function __construct() {
        
        $this->products = $this->getProducts();
    }

    public function getProducts() {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERPWD => $this->apiKey . ':', 
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_TIMEOUT => 30,
        ));

        $response = curl_exec($curl);

        
        if ($response === false) {
            echo 'Error: ' . curl_error($curl);
            return null; 
        }

        curl_close($curl);

        
        echo "<pre>";
        echo "Raw Response: \n"; 
        print_r($response); 
        echo "</pre>";

        
        return $this->processResponse($response);
    }

    private function processResponse($response) {
        $products = [];
        $xml = simplexml_load_string($response);

        if ($xml === false) {
            echo "Failed loading XML: ";
            foreach(libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
            return null; 
        }

        if (isset($xml->products->product)) {
            foreach ($xml->products->product as $product) {
              
                $products[] = [
                    'id' => (string)$product['id'],
                    'name' => (string)$product->name, 
                    'price' => (string)$product->price, 
                    'link' => (string)$product['xlink:href']
                ];
            }
        }

        return $products; 
    }
}






