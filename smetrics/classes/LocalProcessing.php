<?php

class LocalProcessing
{
    public $pathSaveRequests;
    private $api_path;
    private $domain_key;

    function __construct($api_path, $domain_key)
    {
        $this->api_path = $api_path;
        $this->domain_key = $domain_key;
        $this->pathSaveRequests = dirname(__DIR__) . '/metrics.json';
    }

    protected function myxor($text)
    {
        //if(self::$log) return $text;

        $key = $this->domain_key;
        $outText = '';

        $ntext = strlen($text);
        $nkey = strlen($key);

        for($i = 0; $i < $ntext; )
        {
            for($j = 0; $j < $nkey && $i < $ntext; $j++, $i++)
            {
                $outText .= $text{$i} ^ $key{$j};
            }
        }
        return $outText;
    }


    public function sendRequest($data)
    {
        if(empty($data)){
            return ['emptyData'];
        }
        if(empty($this->api_path)){
            return ['emptyApiPath'];
        }

        $data['status'] = 'new';

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/json',
                'content' => json_encode($data, JSON_UNESCAPED_UNICODE),
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($this->api_path, false, $context);

        return ($response === false)? ['failedSend'] : $response;
    }

    public function saveRequest($request)
    {
        if(empty($request)){
            return false;
        }

        $tmp = file_get_contents($this->pathSaveRequests);
        $tmp = $this->myxor($tmp);

        try{
            $tmp = json_decode($tmp, true);
        }
        catch(Exception $e){
            $tmp = [];
        }
        $tmp[uniqid()] = $request;

        $requests = $this->myxor(json_encode($tmp));
        $result = file_put_contents($this->pathSaveRequests, $requests, LOCK_EX);

        return $result;
    }

    public function getSavedRequests()
    {
        $file_data = file_get_contents($this->pathSaveRequests);
        $requests = $this->myxor($file_data);

        return $requests;
    }
    
    public function eraseSavedRequests($requestsErases)
    {
        $status = 'there is nothing to delete';
        $file_data = file_get_contents($this->pathSaveRequests);
        $requests = $this->myxor($file_data);

        try{
            $requests = json_decode($requests, true);
        }
        catch(Exception $e){
            return 'error json';
        }

        $n = 0;
        if(!empty($requests)) {
            foreach ($requestsErases as $request) {
                if (isset($requests[$request])) {
                    unset($requests[$request]);
                    $status = 'requests erased: ' . ++$n;
                }
            }
        }
        else{
            return 'empty saved requests';
        }

        if($n > 0){
            if(!empty($requests)) {
                $requests = json_encode($requests);
                $requests = $this->myxor($requests);
            }
            else{
                $requests = '';
            }
            $result = file_put_contents($this->pathSaveRequests, $requests);

            if($result === false){
                return 'error write bck file';
            }
        }

        return $status;
    }
}