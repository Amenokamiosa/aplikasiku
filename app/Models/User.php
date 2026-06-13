<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    // Beri tahu Laravel bahwa primary key-nya adalah id_user
    protected $primaryKey = 'id_user'; 

    // Jika Anda TIDAK menambahkan $table->timestamps() di migration, aktifkan baris di bawah ini:
    // public $timestamps = false;
    
    protected $fillable = [
        'username',
        'password',
        'display_name',
        'header_img',
        'profile_img'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function donations()
    {
    return $this->hasMany(Donation::class, 'id_user', 'id_user');
    }
}
