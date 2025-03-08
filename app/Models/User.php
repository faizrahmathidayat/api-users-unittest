<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     required={"id", "name", "email", "age"},
 *     @OA\Property(property="id", type="string", format="uuid", example="550e8400-e29b-41d4-a716-446655440000"),
 *     @OA\Property(property="name", type="string", example="Faiz Rahmat"),
 *     @OA\Property(property="email", type="string", format="email", example="faizrahmat.hidayat06@gmail.com"),
 *     @OA\Property(property="age", type="integer", example=30)
 * )
 */

class User extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'email', 'age'];
    public $timestamps = false;
    public $incrementing = false; // Matikan auto-increment karena UUID

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}

