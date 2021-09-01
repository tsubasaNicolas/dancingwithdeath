<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Appointment
 *
 * @property $id
 * @property $name
 * @property $email
 * @property $startTime
 * @property $endTime
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Appointment extends Model
{
    
    static $rules = [
		'name' => 'required',
		'email' => 'required',
		'startTime' => 'required',
		'endTime' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','email','startTime','endTime'];



}
