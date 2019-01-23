<?php

namespace Logger;

use Storage\StorageFabric;

class LoggerClass
{

    public static function log_info($info, $errorCode, $additional, $destination)
    {

        $storage = (new StorageFabric)->defineStorage($destination);
        $storage->insertLogInfo($info, $errorCode, $additional);
    }
}