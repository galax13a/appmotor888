<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operario extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'operarios';

    protected $fillable = ['name','dni','wsp','status','empresa_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function empresa()
    {
        return $this->hasOne('App\Models\Empresa', 'id', 'empresa_id');
    }
    
    public function factura(){
        return $this->belongsToMany('App\Models\Factura');
      }
    
}
