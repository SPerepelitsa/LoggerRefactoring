<?php

namespace Logger;

class LoggerClass
{
    private $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function log_info($info, $errorCode, $additional) {
    }
        $this->storage->insertLogInfo($info, $errorCode, $additional);
    }
}

