<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'montant_total', 'statut'];

    public function client()
{
    return $this->belongsTo(User::class, 'user_id');
}


    public function burgers()
{
    return $this->belongsToMany(Burger::class, 'commande_burger')->withPivot('quantite');
}


    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
}
