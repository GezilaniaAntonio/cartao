<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    use SoftDeletes;

    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'uploads';

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'card_id',
        'type',    // 'image', 'signature', 'fingerprint'
        'path'     // Caminho do arquivo no storage
    ];

    /**
     * Os atributos que devem ser convertidos para datas.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Relacionamento: Um upload pertence a um cartão
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id');
    }

    /**
     * Escopo para filtrar por tipo de upload
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Verifica se o upload é uma imagem (foto)
     *
     * @return bool
     */
    public function isImage()
    {
        return $this->type === 'image';
    }

    /**
     * Verifica se o upload é uma assinatura
     *
     * @return bool
     */
    public function isSignature()
    {
        return $this->type === 'signature';
    }

    /**
     * Verifica se o upload é uma impressão digital
     *
     * @return bool
     */
    public function isFingerprint()
    {
        return $this->type === 'fingerprint';
    }

    /**
     * Retorna a URL completa do arquivo
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }

    /**
     * Retorna o caminho absoluto do arquivo no servidor
     *
     * @return string
     */
    public function getFullPathAttribute()
    {
        return storage_path('app/public/' . $this->path);
    }

    /**
     * Verifica se o arquivo existe no storage
     *
     * @return bool
     */
    public function fileExists()
    {
        return file_exists($this->full_path);
    }

    /**
     * Retorna o nome original do arquivo (se disponível)
     * Você pode adicionar uma coluna 'original_name' na migration se quiser
     *
     * @return string|null
     */
    // public function getOriginalNameAttribute()
    // {
    //     return $this->attributes['original_name'] ?? null;
    // }

    /**
     * Boot do modelo
     */
    protected static function booted()
    {
        // Quando for deletado, pode apagar o arquivo físico se quiser
        static::deleting(function ($upload) {
            // Opcional: apagar arquivo físico quando registro for deletado
            // if ($upload->fileExists()) {
            //     unlink($upload->full_path);
            // }
        });
    }
}