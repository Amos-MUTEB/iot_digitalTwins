<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Bluerhinos\phpMQTT;

class IndexController extends AbstractController
{

    
    /**
    * @Route("/", name="index")
    */
    public function index()
    {
        
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    /**
     * @Route("/home", name="home")
     */
    public function home()
    {
        // $server = '1nygvs.messaging.internetofthings.ibmcloud.com';     // change if necessary
        // $port = 1883;                     // change if necessary
        // $username = 'use-token-auth';                   // set your username
        // $password = 'AkaneTest';                   // set your password
        // $client_id = 'd:1nygvs:DTC:Akane'; // make sure this is unique for connecting to sever - you could use uniqid()
        

        $server = '1nygvs.messaging.internetofthings.ibmcloud.com';     // change if necessary
        $port = 1883;                     // change if necessary
        $username = 'a-1nygvs-avu0otj3wv';                   // set your username
        $password = 'sfT02PH1sJn0lsSZcL';                   // set your password
        $client_id = 'a:1nygvs:avu0otj3wv'; // make sure this is unique for connecting to sever - you could use uniqid()
        
        $mqtt = new phpMQTT($server, $port, $client_id);
        
        $temp=["temp" => 100];

        if ($mqtt->connect(true, NULL, $username, $password)) {
            //$mqtt->publish('iot-2/evt/temp/fmt/json', json_encode($temp), 0, false);
            $mqtt->publish('iot-2/type/DTC/id/Akane/evt/temp/fmt/json', json_encode($temp), 0, false);

            $mqtt->close();
            $message ="good";
        } else {
            $message= "Time out!";
        }

        return $this->render('index/home.html.twig', [
            'controller_name' => 'IndexController',
            'message' => $message,
            'temp' => json_encode($temp),
        ]);
    }


    /**
     * @Route("/subscribe", name="subscribe")
     */
    public function subscribe()
    {
        $server = '1nygvs.messaging.internetofthings.ibmcloud.com';     // change if necessary
        $port = 1883;                     // change if necessary
        $username = 'a-1nygvs-avu0otj3wv';                   // set your username
        $password = 'sfT02PH1sJn0lsSZcL';                   // set your password
        $client_id = 'a:1nygvs:avu0otj3wv'; // make sure this is unique for connecting to sever - you could use uniqid()
        
        $mqtt = new phpMQTT($server, $port, $client_id);
        if(!$mqtt->connect(true, NULL, $username, $password)) {
            exit(1);
        }
        
        echo $mqtt->subscribeAndWaitForMessage('iot-2/type/DTC/id/Akane/evt/temp/fmt/json', 0);
        
        $mqtt->close();

        return $this->render('index/home.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    
}
