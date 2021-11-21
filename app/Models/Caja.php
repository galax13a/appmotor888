<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'cajas';

    protected $fillable = ['name','fecha','valor','status','gastos_id','empresa_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function empresa()
    {
        return $this->hasOne('App\Models\Empresa', 'id', 'empresa_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function gasto()
    {
        return $this->hasOne('App\Models\Gasto', 'id', 'gastos_id');
    }
    
}
