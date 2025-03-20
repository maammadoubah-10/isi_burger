<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Burger extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prix', 'image', 'description', 'stock'];

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_burger')->withPivot('quantite');
    }
    

    public function enStock()
{
    return $this->stock > 0;
}

}
