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
        'Terms_and_conditions_id',
        'Accepted_time',
    ];

    protected $dates = [
        'Accepted_time', // Accepted Time
    ];

    public function termsAndConditions()
    {
        return $this->belongsTo(TermsAndConditions::class, 'Terms_and_conditions_id', 'id');
    }
}
