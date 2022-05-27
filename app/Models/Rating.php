<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'ticket_id', 'rating'
    ];
    public function ticket()
    {
        return $this->hasOne(Ticket::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
