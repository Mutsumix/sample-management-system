<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    public $primaryKey = "client_id";

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
    public function cliCategory()
    {
        /**
         * return category which belongs to a client.
         * first parameter is the model and second is a foreign key.
         */
        return $this->belongsTo('App\Category', 'category_id');
    }

    /**
     * @return object
     */
    public function cliClosingDate()
    {
        return $this->belongsTo('App\ClosingDate', 'closingdate_id');
    }

    /**
     * @return object
     */
    public function cliPaymentDate()
    {
        return $this->belongsTo('App\PaymentDate', 'paymentdate_id');
    }
}
