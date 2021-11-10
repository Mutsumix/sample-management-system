<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    public $primaryKey = "employee_id";

    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Below all method are creating Eloquent's One to Many (inverse) Relationships.
     * for example, many clients can have the same category.
     */

    /**
     * @return object
     */
    public function empStatus()
    {
        /**
         * return status which belongs to a employee.
         * first parameter is the model and second is a foreign key.
         */
        return $this->belongsTo('App\Status', 'status_id');
    }

    /**
     * @return object
     */
    public function empGender()
    {
        return $this->belongsTo('App\Gender', 'gender_id');
    }

    /**
     * @return object
     */
    public function empDep1Gender()
    {
        return $this->belongsTo('App\Gender', 'dep1_gender_id');
    }

    /**
     * @return object
     */
    public function empDep2Gender()
    {
        return $this->belongsTo('App\Gender', 'dep2_gender_id');
    }

    /**
     * @return object
     */
    public function empDep3Gender()
    {
        return $this->belongsTo('App\Gender', 'dep3_gender_id');
    }

    /**
     * @return object
     */
    public function empDep4Gender()
    {
        return $this->belongsTo('App\Gender', 'dep4_gender_id');
    }
}
