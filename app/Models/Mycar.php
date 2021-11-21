<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mycar extends Model
{
    use HasFactory;
	
    public $timestamps = true;

    protected $table = 'mycars';

    protected $fillable = ['name','cliente_id','carstypes_id'];

    //relacion uno a muchos inversa clientes 

    public function cliente(){
        return $this->hasOne('App\Models\Cliente', 'id', 'cliente_id');
    }


}

