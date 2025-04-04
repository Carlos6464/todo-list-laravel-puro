<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarefa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'taks';

    protected $fillable = [
        'titulo',
        'categoria',
        'concluida',
    ];


}
