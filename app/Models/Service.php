<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'services';

    protected $fillable = ['name','value','status','cars_id','empresa_id','porcentaje'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function carstype()
    {
        return $this->hasOne('App\Models\Carstype', 'id', 'cars_id');
    }
    
}
