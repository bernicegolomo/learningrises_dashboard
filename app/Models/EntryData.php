<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryData extends Model
{
    use HasFactory;
    protected $fillable = ['user_phone', 'scores_id', 'total', 'class_size'];

    public function scores()
    {
        return $this->hasMany(scores::class, 'entry_id', 'id');
    }
    
}
