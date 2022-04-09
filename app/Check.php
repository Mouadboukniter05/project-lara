<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Check extends Model
{
    // use SoftDeletes;
    protected $fillable = ['customer_id','user_id', 'coment','amount','location','priority','duedate','bank','observation'];
    public function checkfiles() {
        return $this->hasMany('App\CheckFiles') ;
    }
    // protected $casts = [
    //     'coment' => 'array'
    //   ];
    //////////////////////////////////////////////////////////////
    public static function convertNumberToWord($num = false)
    {
        $num = str_replace(array(',', ' '), '' , trim($num));
        if(! $num) {
            return false;
        }
        $num = (int) $num;
        $words = array();
        $list1 = array('', 'Un', 'Deux', 'Trois', 'Quatre', 'Cinq', 'Six', 'Sept', 'Huit', 'Neuf', 'Dix', 'Onze',
            'Douze', 'Treize', 'Quatorze', 'Quinze', 'Seize', 'Dix-Sept', 'Dix-Huit', 'Dix-Neuf'
        );
        $list2 = array('', 'Dix', 'Vingt', 'Trente', 'Quarante', 'Cinquante', 'Soixante', 'Soixante-dix', 'Quatre-vingts', 'Quatre-vingt-dix', 'Cent');
        $list3 = array("", "Mille", "millions", "milliards", "trillions", "quadrillions"," quintillions "," sextillions "," septillions",
        "Octillion", "Nonillion", "decillion", "undecillion", "duodecillion", "tredecillion", "Quattuordecillion",
        "Quindecillion", "sexdecillion", "septendecillion", "Octodecillion", "novemdecillion", "vigintillion"
    );
        $num_length = strlen($num);
        $levels = (int) (($num_length + 2) / 3);
        $max_length = $levels * 3;
        $num = substr('00' . $num, -$max_length);
        $num_levels = str_split($num, 3);
        for ($i = 0; $i < count($num_levels); $i++) {
            $levels--;
            $hundreds = (int) ($num_levels[$i] / 100);
            $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' Cent' . ' ' : '');
            $tens = (int) ($num_levels[$i] % 100);
            $singles = '';
            if ( $tens < 20 ) {
                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
            } else {
                $tens = (int)($tens / 10);
                $tens = ' ' . $list2[$tens] . ' ';
                $singles = (int) ($num_levels[$i] % 10);
                $singles = ' ' . $list1[$singles] . ' ';
            }
            $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
        } //end for loop
        $commas = count($words);
        if ($commas > 1) {
            $commas = $commas - 1;
        }
        return implode(' ', $words);
        // dd($words);
        // return $words;
    }
    
}
