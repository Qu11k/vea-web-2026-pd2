<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fight extends Model
{
    protected $fillable = [
        'fighter_id',
        'opponent',
        'result',
        'method',
        'fight_date',
        'event',
    ];
    
    public function fighter(): BelongsTo
    {
        return $this->belongsTo(Fighter::class);
    }
}
