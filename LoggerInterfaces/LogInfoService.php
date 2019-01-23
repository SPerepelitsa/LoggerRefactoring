<?php

namespace LoggerInterfaces;

interface LogInfoService
{
    public function insertLogInfo($info, $errorCode, $additional);
}

