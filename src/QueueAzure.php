<?php

namespace Etapa\QueueAzure;

class QueueAzure
{
    public function greet(String $sName = 'teste')
    {
        return 'Hi ' . $sName . '! How are you doing today?';
    }
}
