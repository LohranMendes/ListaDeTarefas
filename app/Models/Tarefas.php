<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefas extends Model
{
    use HasFactory;

    protected $table = "tarefas";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'status',
        'tempo',
        'lista_id'
    ];

    public function tarefas(){
        return $this->hasMany(Tarefas::class);
    }

    

}
