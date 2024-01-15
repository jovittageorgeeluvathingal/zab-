<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class TermsAndConditions extends Model
{
    use HasFactory;
    protected $table = 'terms_and_conditions';
    protected $fillable = [
        'id',
        'version_name',
        'version_details',
        'user_type',
    ];
    public function staff(){
        return $this->hasMany(Staff::class);
    }
    public function client(){
        return $this->hasMany(Client::class);
    }
}

