<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Couple extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'event_id',
        'male_gid',
        'male_invite',
        'female_gid',
        'female_invite',
        'is_matched'
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function male(): BelongsTo
    {
        return $this->belongsTo(Guest::class, 'male_gid', 'id');
    }

    public function female(): BelongsTo
    {
        return $this->belongsTo(Guest::class, 'female_gid', 'id');
    }
}
