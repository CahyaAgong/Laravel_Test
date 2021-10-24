<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{

  use Notifiable;

  protected $fillable = [
    'first_name',
    'last_name',
    'company_id',
    'email',
    'phone'
  ];

  public function getFullNameAttribute(){
      return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
  }

  public function company()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }
}
