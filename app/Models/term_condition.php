<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsConditions extends Model
{
    use HasFactory;

    protected $fillable = [
        'version_name',
        'version_details',
        'user_type',
    ];

    protected $primaryKey = 'version_id';

    protected $casts = [
        'user_type' => 'enum:staff,client', // Enum casting for 'user_type'
    ];
}