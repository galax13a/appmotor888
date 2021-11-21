<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carstype extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'carstypes';

    protected $fillable = ['name','status','empresa_id'];

    public function empresa()
        {
            return $this->hasOne('App\Models\Empresa', 'id', 'empresa_id');
        }
	
}
