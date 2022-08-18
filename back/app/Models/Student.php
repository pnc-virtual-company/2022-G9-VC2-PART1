<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'leave_type',
        'date_start',
        'end_date',
        'start_time',
        'end_time',
        'reason',
        'duration',
        'status',
    ];

    protected $casts =  [
        'status' => 'boolean',
        'created_at'  => 'datetime:d D M Y H:i:s A',
        'updated_at' => 'datetime:d D M Y H:i:s A'
    ];
}
