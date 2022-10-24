<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = [ //mengizinkan field dapat di tulis
        "id",
        "status_admin",
    ];

    /**
     * Get the user that owns the Admin
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo //relasi untuk id user dan id admin
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
