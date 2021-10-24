<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
    use Notifiable;

    protected $fillable = [
      'name',
      'email',
      'logo',
      'website'
    ];

    public function Employees()
    {
        return $this->hasMany('App\Employee', 'company_id');
    }
}
