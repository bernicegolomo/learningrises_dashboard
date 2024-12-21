<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class scores extends Model
{
    protected $fillable = ['student', 'subject', 'score', 'year', 'entry_id'];
    use HasFactory;

    public function entryData()
    {
        return $this->belongsTo(EntryData::class, 'entry_id', 'id');
    }
}
