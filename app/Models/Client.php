<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'Email',
        'Phone',
        'Password',
        'Whatsapp',
        'Occupation',
        'Companyname',
        'terms_and_conditions_id',
        'accepted_time',
    ];

    protected $dates = [
        'accepted_time', // Accepted Time
    ];

    public function termsAndConditions()
    {
        return $this->belongsTo(TermsAndConditions::class, 'terms_and_conditions_id', 'id');
    }
}