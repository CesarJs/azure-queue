<?php

namespace Etapa\QueueAzure;

use MicrosoftAzure\Storage\Queue\QueueRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Queue\Models\CreateQueueOptions;

class QueueAzure
{
    public function sendQueue($data){
        if(!$data || $data == null){
            throw new \Exception("Error Processing Request", 1);
        }

        $connectionString = env('CONNECTION_STRING', '');
        $queueClient = QueueRestProxy::createQueueService($connectionString);
        $createQueueOptions = new CreateQueueOptions();

        foreach ($data as $key => $value) {
            $createQueueOptions->addMetaData($key, $value);
        }

        try    {
            $queueClient->createQueue($data['module'], $createQueueOptions);
        }
        catch(ServiceException $e){

            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code.": ".$error_message."<br />";
        }
    }

}
