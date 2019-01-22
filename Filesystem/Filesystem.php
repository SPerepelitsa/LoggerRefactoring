<?php

namespace Filesystem;

class Filesystem
{

    public function insertLogInfo($info, $errorCode, $additional)
    {
        $data = $info . ' ' . $errorCode . ' ' . $additional . PHP_EOL;
        $logContents = file_get_contents('log.txt');
        $logContents .= $data;

        file_put_contents('log.txt', $logContents);
    }
}