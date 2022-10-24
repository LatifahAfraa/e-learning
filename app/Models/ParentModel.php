<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParentModel extends Model
{
    use HasFactory;
    protected $table = "parents"; //mengambil rujukan tabel parent
    protected $fillable =[
        "id",
        "status_ortu",
        "verifikasi",
        "foto_kk",
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

}
