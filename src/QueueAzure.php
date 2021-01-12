<?php

namespace Etapa\QueueAzure;

use MicrosoftAzureEtapa\Storage\Queue\QueueRestProxy;
use MicrosoftAzureEtapa\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzureEtapa\Storage\Queue\Models\CreateQueueOptions;

class QueueAzure
{
    public function sendQueue($data){
        try    {
        if(!$data || $data == null){
            throw new \Exception("Error Processing Request", 1);
        }

        $connectionString = env('CONNECTION_STRING', '');
        $queueClient = QueueRestProxy::createQueueService($connectionString);
        $createQueueOptions = new CreateQueueOptions();

        foreach ($data as $key => $value) {
            $createQueueOptions->addMetaData($key, $value);
        }

            $queueClient->createMessage('log01',  base64_encode(json_encode($data)));

            return json_encode(['status' => true]);
        }
        catch(ServiceException $e){

            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code.": ".$error_message."<br />";
        }
    }

}
