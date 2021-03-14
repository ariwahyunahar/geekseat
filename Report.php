<?php
require_once 'App/Saga.php';
use App\Saga;

class Report {
    var $pars;
    public function __construct($people = [])
    {
        $this->pars = $people;
    }
    /*
     * $pars = [ ['age' => 10, 'year' => 12], ['age' => 13, 'year' => 17],];
     */
    public function getAveragePeople(){
        $pars = $this->pars;
        $total_born = 0;
        foreach ($pars as $isi){
            $age = $isi['age'];
            $year = $isi['year'];
            // validation
            if($age >= $year) return false;
            if($age <= 0 || $year <= 0) return false;

            $born = $year - $age;
            $total_born += Saga::dieByYear($born);
        }

        return $total_born / count($pars);
    }
}
