<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
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

    /**
     * RELACIONAMENTO COM UPLOADS - É ISSO QUE ESTAVA FALTANDO!
     * Um cartão pode ter vários uploads (foto, assinatura, digital)
     */
    public function uploads()
    {
        return $this->hasMany(Upload::class, 'card_id');
    }

    /**
     * Helper para pegar a foto
     */
    public function getImagePathAttribute()
    {
        $upload = $this->uploads()->where('type', 'image')->first();
        return $upload ? $upload->path : null;
    }

    /**
     * Helper para pegar a assinatura
     */
    public function getSignaturePathAttribute()
    {
        $upload = $this->uploads()->where('type', 'signature')->first();
        return $upload ? $upload->path : null;
    }

    /**
     * Helper para pegar a digital
     */
    public function getFingerprintPathAttribute()
    {
        $upload = $this->uploads()->where('type', 'fingerprint')->first();
        return $upload ? $upload->path : null;
    }
}