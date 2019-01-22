<?php

class LoggerClass
{

    public static function log_info($info, $errorCode, $additional, $destination)
    {

        if ($destination == 'database') {
            mysql_connect("localhost", "user", "pass");

            mysql_query("INSERT INTO logs (info, error_code, additional) VALUES ('$info', '$errorCode', '$additional')");

        } elseif ($destination == 'filesystem') {

            $data = $info . ' ' . $errorCode . ' ' . $additional . PHP_EOL;
            $logContents = file_get_contents('log.txt');
            $logContents .= $data;

            file_put_contents('log.txt', $logContents);
        }
    }
}