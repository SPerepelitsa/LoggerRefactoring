<?php

namespace Database;

use LoggerInterfaces\LogInfoService;

class DB implements LogInfoService
{
    private  $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function insertLogInfo($info, $errorCode, $additional)
    {
        $sql = $this->connection->prepare("INSERT INTO logs (info, error_code, additional) VALUES (:info, :error_code, :additional)");
        $sql->execute(['info' => $info, 'error_code' => $errorCode, 'additional' => $additional]);
    }
}