<?php
namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function store(Request $request, Commande $commande)
    {
        if ($commande->statut === 'payee') {
            return redirect()->back()->with('error', 'Cette commande est déjà payée.');
        }
    
        $paiement = new Paiement([
            'commande_id' => $commande->id,
            'montant' => $commande->montant_total,
            'methode' => 'especes',
            'date_paiement' => now(),
        ]);
        $paiement->save();
    
        $commande->update(['statut' => 'payee']);
    
        return redirect()->route('gestionnaire.commandes.index')->with('success', 'Paiement enregistré avec succès.');
    }
    
}
