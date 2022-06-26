<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Alarm extends Model
{
    use HasFactory;

    protected $table = 'alarms';

    public function belongsUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
