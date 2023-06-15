<?php

namespace App\Helpers;

class GzFileProcessor
{
    /**
     * @param string $gzContent
     * @param callable $execute
     * @return void
     */
    public static function process(string $gzContent, callable $execute, int $limit = null): void
    {
        $tempGzFile = self::extractGzFile($gzContent, $execute, $limit);
        unlink($tempGzFile);
    }

    /**
     * @param string $gzContent
     * @param callable $pathToExtractedFiles
     * @return false|string
     */
    public static function extractGzFile(string $gzContent, callable $execute, int $limit = null): string|false
    {
        $tempGzFile = tempnam(sys_get_temp_dir(), 'gz');
        file_put_contents($tempGzFile, $gzContent);

        $fileHandle = gzopen($tempGzFile, 'r');
        $index = 0;

        if ($fileHandle) {
            while (!gzeof($fileHandle)) {
                if(isset($limit) && $index >= $limit) break;

                $line = fgets($fileHandle);

                if(is_null($line)) continue;

                $execute($line, $index);
                $index++;
            }

            gzclose($fileHandle);
        }

        return $tempGzFile;
    }
}
