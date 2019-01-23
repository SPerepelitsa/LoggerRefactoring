<?php

namespace Database;

use \PDO;
use LoggerInterfaces\LogInfoService;

class DB implements LogInfoService
{
    private $host = 'localhost';
    private $db = 'db';
    private $user = 'root';
    private $pass = '';

    private function сonnect()
    {
        return new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
    }

    public function insertLogInfo($info, $errorCode, $additional)
    {
        $db = $this->сonnect();
        $sql = $db->prepare("INSERT INTO logs (info, error_code, additional) VALUES (:info, :error_code, :additional)");
        $sql->execute(['info' => $info, 'error_code' => $errorCode, 'additional' => $additional]);
    }
}
