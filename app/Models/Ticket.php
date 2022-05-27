<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Ticket extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'number',
        'user_id',
        'service_id',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
