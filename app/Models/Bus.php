<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Bus extends Model
{
    use HasFactory;

    protected $table = 'buses';

    /**
     * Get the user that owns the Bus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function belongsUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
