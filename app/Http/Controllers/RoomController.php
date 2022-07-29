<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index(){
        return view('room.index');
    }

    public function store(Request $request){
        try{
            $request->validate([
                'matriz'    => 'required'
            ]);

            //Clean matriz
            $this->clean_Txt();

            $matriz = $request->file('matriz')->store('public');
            $url    = Storage::url($matriz);
            $file      = fopen(public_path($url), 'r');

            while(!feof($file)){
                $line = fgets($file);

                //Update Matriz
                $this->update_Matriz($line);
            }

            // Delete file.txt
            Storage::delete($url);

            return redirect()->route('room.index')->with('alert', 'Se han modificado la habitación');

        }catch(Exception $e){
            abort(500, $e->getMessage());
        }
    }   

    private function clean_Txt(){

        try{
            $file = fopen(public_path('files/room.txt'), "w+");
            fwrite($file, '');
            fclose($file);

            return;
        }catch(Exception $e){
            abort(500, $e->getMessage());
        }
    }

    private function update_Matriz($line){
        
        try{
            
            $file = fopen(public_path('files/room.txt'), "a+");
            fwrite($file, $line);
            fclose($file);

            return;

        }catch(Exception $e){
            abort(500, $e->getMessage());
        }

    }
}
