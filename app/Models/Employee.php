<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_id',
        'name',
        'country_code',
        'country_name',
    ];

    protected $primaryKey = 'employee_id';

    public function employee_schedule()
    {
        return $this->hasMany(EmployeeSchedule::class, 'employee_id', 'employee_id');
    }
}
