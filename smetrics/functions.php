<?php

function xd($val, $die = false, $body = false)
{
    echo "<pre class='pre'>";
    var_dump($val);
    echo "</pre>";

    if($body){
        $str = <<<'EOD'
        <script>
            pre = document.getElementsByClassName('pre');
            //console.log(pre.length);
            for(var i = 0; i < pre.length; i++){
                document.body.insertBefore(pre[i], document.body.firstChild);
                console.log(pre[i]);
            }
        </script>
EOD;
        echo $str;
    }
    if($die) die;
}

spl_autoload_register(function ($class_name) {
    include dirname(__FILE__) . '/classes/' . $class_name . '.php';
});

function getPrefix()
{
    $prefix = (
        (isset($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https') ||
        (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ||
        (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443') ||
        (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
    ) ? "https" : "http";

    return $prefix;
}

function metricsControllerInit($post_dkey, $domain_name, $domain_key)
{
    $fi = new MetricsInspector($domain_name, $domain_key);
    if($fi->statusAccess($post_dkey)){
        return $fi;
    }
    else{
        return false;
    }
}

function metricsController(MetricsInspector $fcontroller, $action, $api_path, $domain_key)
{
    if($fcontroller->getAccess() == false){
        die('Access error!');
    }

    switch($action)
    {
        case 'get_requests':
            $lp = new LocalProcessing($api_path, $domain_key);
            $saveRequests = $lp->getSavedRequests();
            return $saveRequests;
            break;

        case 'erase_requests':
            if(isset($_POST['requests_erases']) && is_array($_POST['requests_erases'])){

                $lp = new LocalProcessing($api_path, $domain_key);
                $statusErasedRequests = $lp->eraseSavedRequests($_POST['requests_erases']);
                return $statusErasedRequests;
            }
            break;

        case 'metrics_update':
        case 'metrics_create':
            if (!isset($_POST['fkey']) || !isset($_POST['furl']) || !isset($_POST['fselector'])) {
                die('Error data input... ');
            }

            $isJs = (isset($_POST['isJs']) && $_POST['isJs'])? true : false;
            $result = $fcontroller->metricsNewInfo(['fkey' => $_POST['fkey'], 'furl' => $_POST['furl'], 'fselector' => $_POST['fselector'], 'isJs' => $isJs]);

            return $result;
            break;

        case 'metrics_delete':
            if (!isset($_POST['fkey'])) {
                die('Error data input... ');
            }
            $result = $fcontroller->metricsDelete($_POST['fkey']);
            return $result;
            break;
    }
}

function sendNewRequest($metrics_data, $api_path, $domain_key, $dev_mail = '')
{
    try {
        $metrics_data = json_decode($metrics_data, true);
    }
    catch(Exception $e){
        die('Error data input... ');
    }

    $metrics_data['info']['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
    $metrics_data['info']['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
    $metrics_data['info']['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
    $metrics_data['info']['SERVER_DATETIME'] = date('d.m.Y H:i:s');
    $metrics_data['info']['SERVER_UTC'] = date('O');
    $metrics_data['info']['SMVERSION'] = defined('SMVERSION')? SMVERSION : 'version not specified';


    $lp = new LocalProcessing($api_path, $domain_key);

    $answer_json = $lp->sendRequest($metrics_data);

    if(is_array($answer_json)){
        $answer_status = 'failed';
        $answer_data = null;
        $answer_json = '{"status":"failed", "type":"'.$answer_json[0].'"}';
    }
    elseif(!empty($answer_json)) {
        try {
            $answer = json_decode($answer_json, true);

            $answer_status = $answer['status'];
            $answer_data = $answer['data'];
        } catch (Exception $e) {
            $answer_status = 'failed';
            $answer_data = null;
        }
    }
    else{
        $answer_status = 'failed';
        $answer_data = null;
        $answer_json = '{"status":"failed", "type":"answerEmpty"}';
    }
/** @var string $dev_mail It must be defined either in the file where it is connected */
    switch($answer_status)
    {
        case 'done':
            break;

        case 'failed':
            if(!empty($metrics_data)){
                $metrics_data['status'] = 'saved';
                $lp->saveRequest($metrics_data);
            }
            else{
                // send or save error logs
                ob_start();
                var_dump($metrics_data);
                $str = ob_get_clean();
                if($dev_mail != ''){
                    mail($dev_mail, 'CRM request error', 'Empty $metrics_data for save ' . PHP_EOL . 'data: ' . $str);
                }
                else{
                    file_put_contents('error_request.log', date('d.m.Y H:i:s') . ' Empty $metrics_data for save ' . PHP_EOL . 'data: ' . $str . PHP_EOL . PHP_EOL, FILE_APPEND | LOCK_EX);
                }
            }
            break;

        case 'error':
        default:
            // send or save error logs
            ob_start();
            var_dump($metrics_data);
            $str = ob_get_clean();
            if($dev_mail != ''){
                mail($dev_mail, 'CRM request error', 'Answer from CRM is "error" ' . PHP_EOL . 'data: ' . $str);
            }
            else{
                file_put_contents('error_request.log', date('d.m.Y H:i:s') . ' Answer from CRM is "error' . PHP_EOL . 'data: ' . $str . PHP_EOL . PHP_EOL, FILE_APPEND | LOCK_EX);
            }
    }

    echo $answer_json;
}
