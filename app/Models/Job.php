<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    protected $fillable = [
        'title',
        'type',
        'location',
        'description',
        'salary',
        'company_name',
        'company_description',
        'company_email',
        'company_phone',
    ];
}
