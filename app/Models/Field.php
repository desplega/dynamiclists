<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = ['dylist_id', 'field', 'value'];

    public function dylist()
    {
        $this->belongsTo(Dylist::class);
    }
}
