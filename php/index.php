<?php
require_once(__DIR__.'/vendor/autoload.php');
use karpy47\PhpMqttClient\MQTTClient;
use Bluerhinos\phpMQTT;


$server = '1nygvs.messaging.internetofthings.ibmcloud.com';     // change if necessary
$port = 1883;                     // change if necessary
$username = 'a-1nygvs-avu0otj3wv';                   // set your username
$password = 'sfT02PH1sJn0lsSZcL';                   // set your password
$client_id = 'a:1nygvs:avu0otj3wv'; // make sure this is unique for connecting to sever - you could use uniqid()

$mqtt = new phpMQTT($server, $port, $client_id);

$temp=["temp" => 50];

if ($mqtt->connect(true, NULL, $username, $password)) {
    //$mqtt->publish('iot-2/evt/temp/fmt/json', json_encode($temp), 0, false);
    $mqtt->publish('iot-2/type/DTC/id/Akane/evt/temp/fmt/json', json_encode($temp), 0, false);

    $mqtt->close();
    echo "good";
} else {
    echo "Time out!";
}

$mqtt = new phpMQTT($server, $port, $client_id);
if(!$mqtt->connect(true, NULL, $username, $password)) {
    exit(1);
}

echo $mqtt->subscribeAndWaitForMessage('iot-2/type/DTC/id/Akane/evt/temp/fmt/json', 0);

$mqtt->close();
        ?>