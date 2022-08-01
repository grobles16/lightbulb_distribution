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

            for ($a = 0; $a < count($rooms); $a++) {
                for ($b = 0; $b < count($rooms[$a]); $b++) {
                    $row = $rooms[$a];
                    if($rooms[$a][$b] === '0'){

                        if($this->validateRoom_Row($row, $b) == true){
                            $rooms[$a][$b] = '0-L';
                        }else{
                            $rooms[$a][$b] = '0-C';
                        }
                    }
                }
            }

            return $rooms;

        }catch(Exception $e){
            abort(500, $e->getMessage());
        }
    }

    private function validateRoom_Row($rooms, $indexRoom){

        try{
            $light      = false;
            $indexLight = 0;
            $wall       = false;
            $indexWall  = 0;
            $after      = 0;
            $before     = 0;

            for ($i = 0; $i < count($rooms); $i++) {

                if($rooms[$i] === '0-L'){
                    $light      = true;
                    $indexLight = $i;
                }

                if($rooms[$i] === '0'){

                    $after      = $i + 1;
                    $before     = $i - 1;

                    if(!$light){
                        if(isset($rooms[$after]) ){
                            if(isset($rooms[$before]) ){
                                if($rooms[$before] === '1'){
                                    return true;
                                }else{
                                    return false;
                                }
                            }

                            if($rooms[$after] === '1'){
                                return false;
                            }
                            if($rooms[$after] === '0'){
                                return true;
                            }
                        }
                    }

                    if($wall && $indexWall + 1 == $indexRoom){
                        return true;
                    }
                }

                if($rooms[$i] === '1'){
                    if($light && $indexLight < $i){
                        $wall       = true;
                        $indexWall  = $i;
                    }
                }
            }

        }catch(Exception $e){
            abort(500, $e->getMessage());
        }
    }
}
