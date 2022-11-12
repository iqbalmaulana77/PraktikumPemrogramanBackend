<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientRegistration extends Model
{
    // Define the fields can be fill
    protected $fillable = ['patient_id', 'status', 'in_date_at', 'out_date_at', 'create_by', 'update_by'];

    /**
     * Get the patient that owns the patientRegistration.
     */
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
