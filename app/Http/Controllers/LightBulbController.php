<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LightBulbController extends Controller
{
    public function index(){
        
        $rooms = [];
        $rooms = $this->getRooms();

        return view('lightbulb.index', compact('rooms'));
    }

    private function getRooms(){

        try{
            $matriz = [];
            $file   = fopen(public_path('files/room.txt'), "r");

            while(!feof($file)){
                
                $line = fgets($file);
                $line = explode(',', $line);
                
                for($a = 0; $a < count($line); $a++){

                    if($line[$a] === "0\n" || $line[$a] === "1\n"){
                        $temp       = explode("\n", $line[$a]);
                        $line[$a]   = $temp[0];
                    }

                }

                if($line[0] != ""){
                    $matriz [] = $line;
                }
            }

            $matriz = $this->set_LightBulb($matriz);

            return $matriz;

        }catch(Exception $e){
            abort(500, $e->getMessage());
        }
    }

    private function set_LightBulb($rooms){
        try{

            $column = array();
            $rows   = array();

            for ($a = 0; $a < count($rooms); $a++) {
                for ($b = 0; $b < count($rooms[$a]); $b++) {

                    if($rooms[$a][$b] === '0'){
                        
                        $row    = $rooms[$a];
                        if($this->checkColumn(array_column($rooms, $b), $b) == true){
                            $rooms[$a][$b] = "0-L";
                        }

                    }
                }
            }

            return $rooms;

        }catch(Exception $e){
            abort(500, $e->getMessage());
        }
    }

    private function checkColumn($rooms, $index){

        try{
            $existLight = false;
            $setLigth   = false;
            $wall       = 0;

            for($a = 0; $a < count($rooms); $a++){

                if($rooms[$a] === '0-L'){
                    $existLight = true;
                }

                if($rooms[$a] == "1"){

                    if($index <= $a){

                        if($existLight == false){
                            $setLigth   = true;    
                        }else{
                            $wall = $a;
                        }

                    }

                }

                // if($index > $wall){
                //     $setLigth   = true;
                //     $wall = 0;
                // }
            }

            return $setLigth;

        }catch(Exception $e){
            abort(500, $e->getMessage());
        }
    }
}
