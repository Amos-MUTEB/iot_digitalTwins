<?php
require_once(__DIR__.'/vendor/autoload.php');
use PhpMqtt\Client\MQTTClient ;
use Bluerhinos\phpMQTT;
use Workerman\Worker;

$worker = new Worker();
$worker->onWorkerStart = function(){
    $mqtt = new Workerman\Mqtt\Client('mqtt://1nygvs.messaging.internetofthings.ibmcloud.com:1883');
    $mqtt->onConnect = function($mqtt) {
        $mqtt->subscribe('iot-2/type/DTC/id/+/evt/temp/fmt/json');
    };
    $mqtt->onMessage = function($topic, $content){
        var_dump($topic, $content);
    };
    $mqtt->connect();
};
Worker::runAll();
        ?>