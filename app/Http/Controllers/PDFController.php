<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Customer;
use App\Check;
use App\CheckFiles;
use App\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\App;
// use App;
// use PDF;
class PDFController extends Controller
{
    function gen($id){
        // $print_check = Check::find($id) ;
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadView('check.PDF', compact('print_check'));
        // return $pdf->stream();
        // $print_check = Check::find($id) ;
        // $pdf = PDF::loadView('check.PDF', compact('print_check'));
        
        // return $pdf->stream();

$print_check = Check::find($id) ;
$customers=Customer::all();
$pdf = APP::make('dompdf.wrapper');
 $pdf->loadView('check.PDF', compact('print_check','customers'));
 return $pdf->download('check.pdf');
    }
   

// function convertNumberToWord($num = false)
// {
//     $num = str_replace(array(',', ' '), '' , trim($num));
//     if(! $num) {
//         return false;
//     }
//     $num = (int) $num;
//     $words = array();
//     $list1 = array('', 'Un', 'Deux', 'Trois', 'Quatre', 'Cinq', 'Six', 'Sept', 'Huit', 'Neuf', 'Dix', 'Onze',
//         'Douze', 'Treize', 'Quatorze', 'Quinze', 'Seize', 'Dix-Sept', 'Dix-Huit', 'Dix-Neuf'
//     );
//     $list2 = array('', 'Dix', 'Vingt', 'Trente', 'Quarante', 'Cinquante', 'Soixante', 'Soixante-dix', 'Quatre-vingts', 'Quatre-vingt-dix', 'Cent');
//     $list3 = array("", "Mille", "millions", "milliards", "trillions", "quadrillions"," quintillions "," sextillions "," septillions",
//     "Octillion", "Nonillion", "decillion", "undecillion", "duodecillion", "tredecillion", "Quattuordecillion",
//     "Quindecillion", "sexdecillion", "septendecillion", "Octodecillion", "novemdecillion", "vigintillion"
// );
//     $num_length = strlen($num);
//     $levels = (int) (($num_length + 2) / 3);
//     $max_length = $levels * 3;
//     $num = substr('00' . $num, -$max_length);
//     $num_levels = str_split($num, 3);
//     for ($i = 0; $i < count($num_levels); $i++) {
//         $levels--;
//         $hundreds = (int) ($num_levels[$i] / 100);
//         $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' Cent' . ' ' : '');
//         $tens = (int) ($num_levels[$i] % 100);
//         $singles = '';
//         if ( $tens < 20 ) {
//             $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
//         } else {
//             $tens = (int)($tens / 10);
//             $tens = ' ' . $list2[$tens] . ' ';
//             $singles = (int) ($num_levels[$i] % 10);
//             $singles = ' ' . $list1[$singles] . ' ';
//         }
//         $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
//     } //end for loop
//     $commas = count($words);
//     if ($commas > 1) {
//         $commas = $commas - 1;
//     }
//     return implode(' ', $words);
//     dd($words);
// }
}
