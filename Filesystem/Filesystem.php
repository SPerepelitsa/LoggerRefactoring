<?php

namespace Filesystem;

use LoggerInterfaces\LogInfoService;

class Filesystem implements LogInfoService
{
    private $filePrefix;
    private $extension = '.log';
    private $path;

    public function __construct($path, $filePrefix = 'main')
    {
        $this->path = $path;
        $this->filePrefix = $filePrefix;
    }

    private function filenameGenerate()
    {
        $today = date("_d_m_Y");
        return $this->filePrefix  . $today . $this->extension;
    }

    public function insertLogInfo($info, $errorCode, $additional)
    {
        $data = $info . ' ' . $errorCode . ' ' . $additional . PHP_EOL;
        $filePath = $this->path . $this->filenameGenerate();
        file_put_contents($filePath,  $data, FILE_APPEND | LOCK_EX);
    }
}

