<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workplace extends Model
{
    use SoftDeletes;

    public $primaryKey = 'workplace_id';

    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function sHistories()
    {
        return $this->hasMany('App\SalesHistory', 'workplace_id');
    }

    public function wpHistories()
    {
        return $this->hasMany('App\WorkplaceHistory', 'workplace_id');
    }

    /**
     * @return object
     */
    public function wpClient()
    {
        return $this->belongsTo('App\Client', 'client_id');
    }

    /**
     * @return object
     */
    public function wpEmployee()
    {
        return $this->belongsTo('App\Employee', 'employee_id');
    }

}
