<!DOCTYPE html>
<html>
<head>
  <title>Country Code Lookup</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <span class="glyphicon glyphicon-phone-alt" id="logo"></span>
            <h2>Country Code Lookup</h2>
            
            <form>
<?php

    $COMPOSER_VENDOR_DIR = '/home/ubuntu/8x8/vendor/autoload.php';
    require $COMPOSER_VENDOR_DIR;
    if ($_POST) {
        $ANI = $_POST['ANI'];
        $client2 = new GuzzleHttp\Client();
        $response = $client2->request('GET', 'http://ec2-54-67-86-85.us-west-1.compute.amazonaws.com/api/api.php?ANI=' . $ANI,
            [
                'http_errors' => false
            ]
        );
        
        $status = $response->getStatusCode();
        if ($status == 200) {

            $body = $response->getBody();
            $json = json_decode($response->getBody(), true);
            $country_code = $json['countryCode'];
            echo 'Phone Number: ' . $ANI;
            echo '</br> Country Code: ' . $country_code;
        }
        else {
            $body = $response->getBody();
            $json = json_decode($response->getBody(), true);
            $errors = $json['errors'][0];
            echo 'Error: ' . $errors['description'];
        }
    }
    else {
        echo 'ERROR: No data sent.</br>';
        echo 'Please fill out this form <a href= "/api/index.html">here</a> to lookup a country code.';
    }
?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
<script>
$('.has-clear input[type="text"]').on('input propertychange', function() {
  var $this = $(this);
  var visible = Boolean($this.val());
  $this.siblings('.form-control-clear').toggleClass('hidden', !visible);
}).trigger('propertychange');
$('.form-control-clear').click(function() {
  $(this).siblings('input[type="text"]').val('')
    .trigger('propertychange').focus();
});
</script>

</body>
</html>


