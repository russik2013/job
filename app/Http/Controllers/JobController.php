<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class JobController extends Controller
{
    public function checkTexts(Request $request){

        if (!empty($request -> text) && !empty($request -> text2)){
            $firstLine = explode ("\r",$request -> text);
            $secondLine = explode ("\r",$request -> text2);

            return $this-> checkLines($firstLine, $secondLine);

        }else return 'Ошибка ввода';



       // dd($request);
    }

    public function checkFiles(Request $request){

        $contents1 = File::get($request->file('img'));
        $contents2 = File::get($request->file('img2'));

        if (!empty($contents1) && !empty($contents2)){

            $firstLine = explode ("\r\n",$contents1);
            $secondLine = explode ("\r\n",$contents2);

            return $this-> checkLines($firstLine, $secondLine);

        }else return 'Ошибка ввода';

    }


    public function checkLines($firstLine, $secondLine){

        $flagForFirst = 0;
        $flagForSecond = 0;
        for($i = 0; $i < count($firstLine); $i ++ ){

            for($j = 0; $j < count($secondLine); $j ++ ){

                if($firstLine[$i] == $secondLine[$j]){
                    $flagForFirst = $i;
                    $flagForSecond = $j;
                }

            }

        }

        if( $flagForFirst > $flagForSecond) {

            for ($i = $flagForSecond; $i < count($secondLine); $i++) {
                $newSecondLine[] = $secondLine[$i];
            }

            $j = $flagForFirst - $flagForSecond;
            for ($i = $flagForSecond; $i < $flagForFirst; $i++) {
                // $secondLine = array($j => 0) + $secondLine;
                $secondLine = array_merge(array($j => null), $secondLine);
                $j --;

            }

            for($i = 0; $i < count($newSecondLine); $i++){
                $secondLine[$flagForFirst + $i] = $newSecondLine[$i];
            }

            for($i = 0; $i <= count($secondLine) - count($firstLine); $i++){
                $firstLine[] = null;
            }
            for($i = 0; $i < count($secondLine); $i++){

                if($secondLine[$i] == null) {
                    $Answer [] = '-';
                    $Answer [][] = $firstLine[$i];
                    $finalMass[] = '-';
                }

                if($secondLine[$i] != null ) {
                    if($firstLine[$i] == null) {
                        $Answer [] = '+';
                        $Answer [][] = $secondLine[$i];
                        $finalMass[] = '+';
                    }else
                        if($firstLine[$i] == $secondLine[$i]) {
                            $Answer [] = 'n';
                            $Answer [][] = $secondLine[$i];
                            $finalMass[] = 'ничего';
                        }else {
                            $Answer [] = '*';
                            $Answer [][] = $secondLine[$i];
                            $Answer [][] = $firstLine[$i];
                            $finalMass[] = '*';
                        }
                }

            }

        }else{


            for ($i = $flagForFirst; $i < count($firstLine); $i++) {
                $newFirstLine[] = $firstLine[$i];
            }


            $j = $flagForSecond - $flagForFirst;
            // $j = $flagForFirst - $flagForSecond;
            for ($i = $flagForFirst; $i < $flagForSecond; $i++) {

                $firstLine = array_merge(array($j => null), $firstLine);
                $j --;

            }



            for($i = 0; $i < count($newFirstLine); $i++){
                $firstLine[$flagForSecond + $i] = $newFirstLine[$i];
            }

            for($i = 0; $i <= count($firstLine) - count($secondLine); $i++){
                $secondLine[] = null;
            }
            for($i = 0; $i < count($secondLine); $i++){

                if($secondLine[$i] == null) {
                    $Answer [] = '-';
                    $Answer [][] = $firstLine[$i];
                    $finalMass[] = '-';
                }

                if($secondLine[$i] != null ) {
                    if($firstLine[$i] == null) {
                        $Answer [] = '+';
                        $Answer [][] = $secondLine[$i];
                        $finalMass[] = '+';
                    }else
                        if($firstLine[$i] == $secondLine[$i]) {
                            $Answer [] = 'n';
                            $Answer [][] = $secondLine[$i];
                            $finalMass[] = 'ничего';
                        }else {
                            $Answer [] = '*';
                            $Answer [][] = $secondLine[$i];
                            $Answer [][] = $firstLine[$i];
                            $finalMass[] = '*';
                        }
                }



            }
//

        }

        return $Answer;
    }

}
