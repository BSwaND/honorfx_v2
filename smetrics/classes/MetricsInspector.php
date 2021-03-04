<?php

class MetricsInspector
{
    public $fkey;

    private $fconfig;
    private $dname;
    private $dkey;
    private $access;

    public function __construct($dname, $dkey, $file_config = 'config.json')
    {
        $this->dname = $dname;
        $this->dkey = $dkey;
        $this->fconfig = $file_config;
    }

    public function gtedkey()
    {
        return $this->dkey;
    }

    public function getAccess()
    {
        return $this->access;
    }

    public function statusAccess($key)
    {
        $this->access = ($this->dkey == $key) ? true : false;
        return $this->access;
    }

    public function metricsNewInfo($fdata)
    {
        $status = ['result' => false, 'log' => ['begin update/create']];
        if (!isset($fdata['fkey']) || !isset($fdata['furl']) || !isset($fdata['fselector'])) {
            $status['log'][] = 'ERROR DATA INPUT... ';
            return false;
        }
        $fkey = $fdata['fkey'];
        $furl = $fdata['furl'];
        $fselector = $fdata['fselector'];
        $isJs = $fdata['isJs'];

        $saved_metrics = file_get_contents($this->fconfig);
        if ($saved_metrics === false) {
            $tmp = [$furl => [$fkey => ['selector' => $fselector, 'isJs' => $isJs]], $fkey => $furl];

            $hfile = fopen($this->fconfig, 'w');
            $result = fwrite($hfile, json_encode($tmp));
            fclose($hfile);

            if ($result !== FALSE) {
                $status['log'][] = 'CREATE FILE CONFIG: "' . $this->fconfig . '"';
            } else {
                $status['log'][] = 'ERROR CREATING FILE CONFIG: "' . $this->fconfig . '"';
            }

            return ($result === FALSE) ? false : true;
        } else {
            $saved_metrics = json_decode($saved_metrics, true);
//            var_dump($saved_metrics);
            if (isset($saved_metrics[$fkey])) {
                $status['log'][] = 'UPDATING METRICS... ';

// update metrics with url
                $old_url = $saved_metrics[$fkey];
                unset($saved_metrics[$old_url][$fkey]);
                $saved_metrics[$furl][$fkey] = ['selector' => $fselector, 'isJs' => $isJs];

// update metrics with key
                $saved_metrics[$fkey] = $furl;
            } else {
                $status['log'][] = 'CREATING METRICS... ';

// create or update metrics with url
                $saved_metrics[$furl][$fkey] = ['selector' => $fselector, 'isJs' => $isJs];

// create metrics with key
                $saved_metrics[$fkey] = $furl;
            }

//            var_dump($saved_metrics);

            $result = file_put_contents($this->fconfig, json_encode($saved_metrics));

            if ($result !== false) {
                $status['result'] = true;
                $status['log'][] = 'SAVED';
            }
            else {
                $status['log'][] = 'ERROR SAVED';
            }
            return json_encode($status);
        }
    }

    public function metricsDelete($fkey)
    {
        $status = ['result' => false, 'log' => ['begin delete']];

        $saved_metrics = file_get_contents($this->fconfig);
        if ($saved_metrics !== false) {
            $saved_metrics = json_decode($saved_metrics, true);
            if (isset($saved_metrics[$fkey])) {
                $furl = $saved_metrics[$fkey];
                unset($saved_metrics[$furl][$fkey]);
                unset($saved_metrics[$fkey]);

                $result = file_put_contents($this->fconfig, json_encode($saved_metrics));

                if ($result !== false) {
                    $status['result'] = true;
                    $status['log'][] = 'METRICS DELETED';
//                    return true;
                } else {
                    $status['log'][] = 'METRICS REMOVAL ERROR';
//                    return false;
                }
            } else {
                $status['log'][] = 'MISSING ' . $fkey . ' METRICS';
//                return false;
            }
        } else {
            $status['result'] = true;
            $status['log'][] = 'NO ANY METRICS';
//            return false;
        }
        return json_encode($status);
    }
}