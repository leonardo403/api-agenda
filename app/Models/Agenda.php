<?php

namespace App\Models;

use App\Enums\AgendaStatusEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'data_inicio',
        'data_prazo',
        'data_conclusao',
        'status',
        'titulo',
        'tipo',
        'descricao',
        'usuario_responsavel'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'status' => AgendaStatusEnums::class
    ];

}
