<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fxrate extends Model
{
    //
    protected $fillable = [
        'rate',
        'fxcounter_id'
    ];

     /**
     * Get the counter that owns the rate.
     */
    public function fxcounter()
    {
        return $this->belongsTo(fxcounter::class);
    }
}
