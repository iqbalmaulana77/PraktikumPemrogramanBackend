<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    // Define the fields can be fill
    protected $fillable = ['name', 'phone', 'address'];

    /**
     * Get the history of patient.
     */
    public function patientRegistrations()
    {
        return $this->hasMany('App\PatientRegistration');
    }
}
