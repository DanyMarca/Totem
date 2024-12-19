<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    protected $hiden = [
        'password'
    ];

    public function artifacts()
    {
        return $this->hasMany(Artifact::class);
    }
    
    public function logs()
    {
        return $this->hasMany(Log::class, 'user_id');
    }
}

