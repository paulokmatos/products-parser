<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use PDO;

class ApiInfo
{

    public static function checkDatabaseConnection()
    {
        try {
            $connection = DB::connection()->getPdo();

            $connectionStatus = $connection->getAttribute(PDO::ATTR_CONNECTION_STATUS);
        } catch (\Exception $e) {
            $connectionStatus = 'Database connection: Fail';
        }

        return $connectionStatus;
    }

    public static function getMemoryUsage()
    {
        $memoryUsage = memory_get_usage(true);

        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $memory = @round($memoryUsage / pow(1024, ($i = floor(log($memoryUsage, 1024)))), 2) . ' ' . $units[$i];

        return $memory;
    }
}
