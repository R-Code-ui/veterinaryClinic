<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id', 'vet_id', 'appointment_date', 'reason', 'status', 'notes'
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function vet()
    {
        return $this->belongsTo(User::class, 'vet_id');
    }

    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class);
    }
}
