<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    //
    use SoftDeletes;

    protected $table = 'cards';

    protected $fillable = [
        'name',
        'father_name',
        'mother_name',
        'date_of_birth',
        'birth_place',
        'marital_status',
        'profession',
        'address',
        'entry_date',
        'document_number',
        'place_of_issue',
        'date_of_issue',
        'expiry_date'
    ];
}

