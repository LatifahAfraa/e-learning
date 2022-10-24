<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable=[
            'id',
            'nip',
            'mapel',
            'jabatan',
            'status_kepegawaian',
            'ttd',
            'foto',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
