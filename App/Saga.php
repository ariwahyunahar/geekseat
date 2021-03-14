<?php
namespace App;

class Saga {
    public static function dieByYear($year = 0){
        if(!$year) return false;

        $return = [];
        $a = 0;
        $angka[] = 1;
        if($year==1) return array_sum($angka);
        $angka[] = 1;
        if($year==2) return array_sum($angka);
        for ($x = 2; $x<=$year;$x++){
            $return = array_sum($angka);
            $a = $angka[$x-1] + $angka[$x-2];
            $angka[] = $a;
        }
//        dd($return);
        return $return;
    }
}
