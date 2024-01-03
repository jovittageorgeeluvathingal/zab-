<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'Address',
        'Phone',
        'Password',
        'Whatsapp',
        'email',
        'nationality',
        'language_speak',
        'DOB',
        'Highest_education',
        'Documentation',
        'Experience',
        'terms_and_conditions_id',
        'accepted_time',
    ];

    protected $dates = [
        'DOB', // Date of Birth
        'accepted_time', // Accepted Time
    ];

    protected $casts = [
        'Documentation' => 'boolean', // Cast to boolean (Y/N)
    ];

    public function termsAndConditions()
    {
        return $this->belongsTo(TermsAndConditions::class, 'terms_and_conditions_id', 'id');
    }
}