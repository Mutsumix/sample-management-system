<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesHistory extends Model
{
    use SoftDeletes;

    public $primaryKey = "shistory_id";

    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return object
     */
    public function shWorkplace()
    {
        return $this->belongsTo('App\Workplace', 'workplace_id');
    }

    public function getRemindDate()
    {
        $remind_year = '';
        $remind_month = '';

        if ($this->remind_year) {
            $remind_year = $this->remind_year . '年';
        }
        if ($this->remind_month) {
            $remind_month = $this->remind_month . '月';
        }

        return $remind_year . $remind_month . $this->remind_day;
    }

}
