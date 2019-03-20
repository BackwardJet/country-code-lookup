<?php

    function get_query_string() {

        $queries = array();
        parse_str($_SERVER['QUERY_STRING'], $queries);
        
        $ANI = $queries['ANI'];
        
        return $ANI;
    } 

    function post_request_api($ANI) {

        $client2 = new GuzzleHttp\Client();
        $response = $client2->request('POST', 'http://ec2-54-67-86-85.us-west-1.compute.amazonaws.com/api/create.php',
            [
                GuzzleHttp\RequestOptions::JSON => ['ANI' => $ANI],
                'http_errors' => false
            ]
        );

        $body = $response->getBody();
        $json = json_decode($response->getBody(), true);
        $ANI = $json['ANI'];

        return $ANI;
    }

    function get_country_code_from_messagebird($ANI) {

        $url = 'https://rest.messagebird.com/lookup/' . $ANI;
        $api_key = 'Nu2XPGzfY4JrsfWT3miSLH0C0';


        // Create a POST request
        try {
            $url = 'https://rest.messagebird.com/lookup/' . $ANI;
            $api_key = 'Nu2XPGzfY4JrsfWT3miSLH0C0';

            // Initialize Guzzle client
            $client = new GuzzleHttp\Client();
            $response = $client->request('GET', $url, [
                'headers' => [
                    'Authorization' => 'AccessKey ' . $api_key
                ],
                'http_errors' => false
            ]
            );
            // Parse the response object, e.g. read the headers, body, etc.
            $status = $response->getStatusCode();                
            $body = $response->getBody();
            $json = json_decode($response->getBody(), true);

            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Max-Age: 3600");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

            http_response_code(200);
            echo json_encode($json);

        } catch (Exception $e) {
            echo $e;
        }
    }

    function main() {
        $COMPOSER_VENDOR_DIR = '/home/ubuntu/8x8/vendor/autoload.php';
        require $COMPOSER_VENDOR_DIR;

        $ANI = get_query_string();
        $ANI = post_request_api($ANI);
        get_country_code_from_messagebird($ANI);
    }

    if ($_GET) {
        main();
    }
    else { // run via command line
        echo "Please call using GET Request.";
    }
?>
