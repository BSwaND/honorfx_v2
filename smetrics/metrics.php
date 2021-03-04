<?php
const SMVERSION = 'v4.7.2pr';
require 'functions.php';

$domain_key = 'Bhc6VWj1xW59EKymHGpp6Gnjq0T1K3lh'; // key domain in CRM
$dev_mail = 'front1.sofona@gmail.com';   
$api_path = 'http://api.honorfx.com/requests/set-form-data';
$domain_name = $_SERVER['SERVER_NAME'];
// HTTP_HOST

$domain_name = getPrefix() . '://' . $domain_name;
// DEV TEST
if(isset($_GET['dev']) && $_GET['dev'] == 'dev' . substr($domain_name, 0, 3)){
    $lp = new LocalProcessing($api_path, $domain_key);
    $requests = $lp->getSavedRequests();
    try{
        $requests = json_decode($requests, true);
    }
    catch(Exception $e){
        $requests = [];
    }

    xd($requests);
}

// incoming local metrics data (from local JS)
if(isset($_POST['metrics-data'])){

    sendNewRequest($_POST['metrics-data'], $api_path, $domain_key, $dev_mail);

    unset($_POST['metrics-data']);
    die;
}
// incoming metrics action and data (from CRM)
elseif(isset($_POST['dkey']) && isset($_POST['action'])){

    $fcontroller =  metricsControllerInit($_POST['dkey'], $domain_name, $domain_key);

    if($fcontroller != false){
        // metrics action from CRM (create, update, delete metrics. Get saved requests)
        $result = metricsController($fcontroller, $_POST['action'], $api_path, $domain_key);
        echo $result;
    }
    else{
        die('Error access... ');
    }
}



//die('ERROR DATA INPUT... ');

/*  json
 array(2) {

  ["/forms"]=> array(1) {
        ["NDz8Ft1NOPYmU3zHTWPwQfUkW4xZAH7k"] => "#contact-form"
      }

  ["NDz8Ft1NOPYmU3zHTWPwQfUkW4xZAH7k"] => "/forms"

}
 */

/* xd($_POST,1);
array(4) {
  ["action"]=>
  string(9) "form_info"
  ["fkey"]=>
  string(32) "NDz8Ft1NOPYmU3zHTWPwQfUkW4xZAH7k"
  ["fselector"]=>
  string(13) "#contact-form"
  ["furl"]=>
  string(6) "/forms"
}
 */



//file_put_contents('api.json', 'test');

// echo 654;
// var_dump($_POST);
