<?php
namespace App\Util;


class Logger
{

    public function info($data){
        file_put_contents(__DIR__ . '/../../logs/dds_log.log', $data.PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}