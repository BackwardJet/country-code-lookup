<?php
 

    function set_headers() {
        // required headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    } 

    function get_post_data() {

        // get posted data
        $data = json_decode(file_get_contents("php://input"));
        // make sure data is not empty
        echo $data;
        if(
            !empty($data->ANI)
        ){
            
         
            // set response code - 200 SUCCESS
            http_response_code(200);
            echo json_encode($data);
         
        }
         
        // tell the user data is incomplete
        else{
         
            // set response code - 400 bad request
            http_response_code(400);
         
            // tell the user
            echo json_encode(array("message" => "Unable to process request. Data is incomplete."));
        }
    }

    function main() {
        $COMPOSER_VENDOR_DIR = '/home/ubuntu/8x8/vendor/autoload.php';
        require $COMPOSER_VENDOR_DIR;

        set_headers();
        get_post_data();
    }

    if ($_POST) {
        main();
    }
    else { // run via command line
        echo "Please call using POST Request.";
    }

?>
