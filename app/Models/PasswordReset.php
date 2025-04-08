<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = 'email';

    public function getKeyName()
    {
        return null;
    }
}
