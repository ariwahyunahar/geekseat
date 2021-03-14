<?php
namespace App;

class Helpme {
    public static function dd($par = []){
        echo '<pre>';
        print_r($par);
        die();
    }
}
