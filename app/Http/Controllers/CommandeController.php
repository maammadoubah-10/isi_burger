<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Burger;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommandePreteMail;
//use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Notifications\NouvelleCommandeNotification;
use App\Notifications\CommandePreteNotification;
class CommandeController extends Controller
{
    // ✅ Afficher les commandes du client connecté
    public function index()
    {
        $commandes = Commande::where('user_id', Auth::id())->get();
        return view('commandes.client_index', compact('commandes'));
    }

    // ✅ Afficher les commandes pour le gestionnaire
    public function indexGestionnaire()
    {
        $commandes = Commande::with('client')->get(); // Charger le client associé
        return view('commandes.gestionnaire_index', compact('commandes'));
    }

    // ✅ Page de création de commande
    public function create()
    {
        $burgers = Burger::where('stock', '>', 0)->get();
        return view('commandes.create', compact('burgers'));
    }

    // ✅ Enregistrement d'une commande
    public function store(Request $request)
    {
        $request->validate([
            'burgers' => 'required|array',
            'burgers.*' => 'exists:burgers,id',
            'quantites' => 'required|array',
            'quantites.*' => 'integer|min:1',
        ]);

        $montant_total = 0;
        $commande = new Commande([
            'user_id' => Auth::id(),
            'montant_total' => 0,
            'statut' => 'en_attente'
        ]);
        $commande->save();

        foreach ($request->burgers as $burger_id) {
            $burger = Burger::findOrFail($burger_id);
            $quantite = $request->quantites[$burger_id];

            if ($burger->stock < $quantite) {
                return redirect()->back()->with('error', "Stock insuffisant pour {$burger->nom}.");
            }

            $montant_total += $burger->prix * $quantite;
            $commande->burgers()->attach($burger->id, ['quantite' => $quantite]);

            // Réserve le stock
            $burger->stock -= $quantite;
            $burger->save();
        }

        $commande->update(['montant_total' => $montant_total]);

        // ✅ Notifier le gestionnaire
        $gestionnaire = User::where('role', 'gestionnaire')->first();
        if ($gestionnaire) {
            $gestionnaire->notify(new NouvelleCommandeNotification($commande));
        }

        return redirect()->route('commandes.index')->with('success', 'Commande passée avec succès.');
    }

    // ✅ Affichage d'une commande
    public function show(Commande $commande)
    {
        $commande->load('client', 'burgers');
        return view('commandes.show', compact('commande'));
    }

    // ✅ Annulation d'une commande
    public function annuler(Commande $commande)
    {
        if ($commande->statut === 'payee') {
            return redirect()->back()->with('error', 'Impossible d\'annuler une commande déjà payée.');
        }

        // Restaurer le stock des produits
        foreach ($commande->burgers as $burger) {
            $burger->stock += $burger->pivot->quantite;
            $burger->save();
        }

        $commande->update(['statut' => 'annulee']);

        return redirect()->route('gestionnaire.commandes.index')->with('success', 'Commande annulée avec succès.');
    }

    // ✅ Mise à jour du statut d'une commande
    public function updateStatut(Request $request, Commande $commande)
    {
        $commande->update(['statut' => $request->statut]);
    
        if ($request->statut === 'prete') {
            // ✅ Envoi de la facture par e-mail
            Mail::to($commande->client->email)->send(new CommandePreteMail($commande));
    
            // ✅ Notifier le client dans l'interface
            $commande->client->notify(new CommandePreteNotification($commande));
        }
    
        return redirect()->route('gestionnaire.commandes.index')->with('success', 'Commande mise à jour.');
    }
    

    // ✅ Marquer une commande comme payée (une seule fois)
    public function payerCommande(Commande $commande)
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

    // ✅ Générer une facture PDF pour une commande
    public function downloadFacture(Commande $commande)
    {
        if ($commande->statut !== 'prete') {
            return redirect()->back()->with('error', 'Cette facture n’est pas encore disponible.');
        }
    
        // Vérifie si la vue existe
        if (!view()->exists('commandes.facture')) {
            return redirect()->back()->with('error', 'Le fichier de la facture est introuvable.');
        }
    
        // Générer le PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('commandes.facture', compact('commande'));
    
        return $pdf->download("facture_{$commande->id}.pdf");
    }
    


    public function showFacture(Commande $commande)
{
    if (Auth::id() !== $commande->user_id) {
        abort(403, "Vous n'avez pas accès à cette facture.");
    }

    return view('commandes.facture', compact('commande'));
}

    
}
