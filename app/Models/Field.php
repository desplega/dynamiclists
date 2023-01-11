<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = ['dynlist_id', 'field', 'value'];

    public function dynlist()
    {
        $this->belongsTo(dynlist::class);
    }
}
