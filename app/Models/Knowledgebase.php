<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Knowledgebase extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
