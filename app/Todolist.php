<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    protected $fillable = ['list_name'];

    public static function insertData($data){
    	$insertid = DB::table('todolists')->insert($data);
   }
}
