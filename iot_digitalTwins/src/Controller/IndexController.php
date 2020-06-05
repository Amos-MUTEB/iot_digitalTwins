<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use karpy47\PhpMqttClient\MQTTClient;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        $client = new MQTTClient('mqtt://1nygvs.messaging.internetofthings.ibmcloud.com', 1883);
        //$client->setAuthentication('a-1nygvs-3bjuxelljp','6&IycaE?t(jerfIC5v');
        $client->setAuthentication('use-token-auth','AkaneTest');
        //$client->setEncryption('cacerts.pem');
        //$success = $client->sendConnect("a:1nygvs:3bjuxelljp");  // set your client ID
        $success = $client->sendConnect("d:1nygvs:DTC:Akane");  // set your client ID
        
        if ($success) {
            $client->sendSubscribe('topic1');
            $client->sendPublish('topic2', 'Message to all subscribers of this topic');
            $messages = $client->getPublishMessages();  // now read and acknowledge all messages waiting
            foreach ($messages as $message) {
                echo $message['topic'] .': '. $message['message'] . PHP_EOL;
                // Other keys in $message array: retain (boolean), duplicate (boolean), qos (0-2), packetId (2-byte integer)
            }
            $client->sendDisconnect();
            $message="bon";    
        }
        else{
            $message="pas bon";
        }
        $client->close();
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'message' => $message
        ]);
    }
}
