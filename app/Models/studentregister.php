<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\support\Facades\DB;
use Illuminate\Http\Request;



class studentregister extends Model
{
    use HasFactory;

    protected $connection='mysql';
    protected $table='studentregisters';

   
}