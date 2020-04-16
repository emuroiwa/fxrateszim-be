<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fxcounter extends Model
{
    //
    protected $fillable = [
        'quote_currency',
        'base_currency',
        'description'
    ];

    /**
     * Get the rates for the blog counter.
     */
    public function fxrate()
    {
        return $this->hasMany(fxrate::class);
    }
}
