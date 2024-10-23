<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    //

    protected $table = "stores";
    protected $guarded = ['id'];
    // protected $fillable = [];


    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
