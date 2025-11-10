<?php

// app/Models/Discussion.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'content'];

    // Relasi: Satu diskusi dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}