<?php

namespace Filesystem;

use LoggerInterfaces\LogInfoService;

class Filesystem implements LogInfoService
{
    private $filePrefix;
    private $extension = '.log';
    private $path;
    private $filesNumberLimit;

    public function __construct($path, $filePrefix = 'main', $filesNumberLimit = 3)
    {
        $this->path = $path;
        $this->filePrefix = $filePrefix;
        $this->filesNumberLimit = $filesNumberLimit;
    }

    private function generateFileName()
    {
        $today = date("_Y_m_d");
        return $this->filePrefix  . $today . $this->extension;
    }

    private function getFilePath($fileName)
    {
        return $this->path . '/' . $fileName;
    }

    public function insertLogInfo($info, $errorCode, $additional)
    {
        $data = $info . ' ' . $errorCode . ' ' . $additional . PHP_EOL;
        $filePath = $this->getFilePath($this->generateFileName());
        if (!is_writable($filePath)) {
            return false;
        }

        file_put_contents($filePath,  $data, FILE_APPEND | LOCK_EX);
    }

    private function getFilesByPrefix()
    {
        return glob($this->path . '/' . $this->filePrefix . '*' . $this->extension) ?: [];
    }


    public function deleteOldLogFiles()
    {
        $logFilesArray = $this->getFilesByPrefix();
        if (count($logFilesArray) < $this->filesNumberLimit) {
            return;
        }
        natsort($logFilesArray);
        $filesToDelete = count($logFilesArray) - $this->filesNumberLimit;
        foreach (array_slice($logFilesArray, 0, $filesToDelete) as $logFile) {
            $path = $this->getFilePath($logFile);
            if (is_writable($path)) {
                @unlink($path);
            }
        }
    }
}

