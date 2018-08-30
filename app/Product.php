<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function orders()
    {
        $this->hasMany('App\Orders');
    }

    public function purchases()
    {
        $this->hasMany("App\Purchase");
    }

    public function user()
    {
        $this->belongsTo('App\User');
    }
}
