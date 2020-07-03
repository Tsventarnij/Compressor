<?php
namespace App\Http\Service;


class CompressorService
{
    static private function compFunc(String $char, int $count) : String
    {
        switch ($count) {
            case 1 :
                return $char;
            case 2 :
                return $char . $char;
            default :
                return $char . $count;
        }
    }

    static public function Compress(String $str) : String
    {
        $str = strtolower($str);
        $result = "";
        $sequenceCount = 1;
        for ($i = 1; $i < strlen($str); $i++) {
            if ($str[$i - 1] == $str[$i]) {
                $sequenceCount++;
            } else {
                $result .= self::compFunc($str[$i - 1], $sequenceCount);
                $sequenceCount = 1;
            }
        }
        $result .= self::compFunc($str[$i - 1], $sequenceCount);
        return $result;
    }

    static public function Decompress(String $str) : String
    {
        $result = "";
        $str = strtolower($str);
        $arrString = str_split($str);
        $count = "";
        foreach ($arrString as $char) {
            if(is_numeric($char)) {
                $count .= $char;
            } else {
                if($count === "0") {
                    $result = substr($result, 0, -1);
                }
                if ($count !== "" ) {
                    $result = str_pad($result, strlen($result) + intval($count) - 1, $result[strlen($result)-1]);
                    $count = "";
                }
                $result .= $char;
            }
        }
        if ($count !== "" ) {
            $result = str_pad($result, strlen($result) + intval($count) - 1, $result[strlen($result)-1]);
        }
        if($count === "0") {
            $result = substr($result, 0, -1);
        }
        return $result;
    }
}