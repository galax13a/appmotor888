<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'clientes';

    protected $fillable = ['name','wsp1','wsp2','status','empresa_id','cumple'];

  
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function empresa()
    {
        return $this->hasOne('App\Models\Empresa', 'id', 'empresa_id');
    }

    public function mycar()
    {
      return $this->belongsToMany('App\Models\Mycar');
    }
    
    public function factura(){
      return $this->belongsToMany('App\Models\Factura');
    }
    
}
