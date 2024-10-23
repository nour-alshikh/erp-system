<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treasury extends Model
{
    protected $table = "treasuries";
    protected $guarded = ['id'];


    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
