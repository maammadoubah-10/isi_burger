<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Burger;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
  
public function index()
{
    if (Auth::user()->role !== 'gestionnaire') {
        return redirect()->route('catalogue')->with('error', 'Accès refusé.');
    }

    // Logique pour les gestionnaires uniquement
    $commandesEnCours = Commande::whereDate('created_at', today())
        ->whereIn('statut', ['en_attente', 'en_preparation'])
        ->count();

    $commandesValidees = Commande::whereDate('created_at', today())
        ->where('statut', 'payee')
        ->count();

    $recettesJournalieres = Commande::whereDate('created_at', today())
        ->where('statut', 'payee')
        ->sum('montant_total');

    $commandesParMois = Commande::selectRaw('EXTRACT(MONTH FROM created_at) as mois, COUNT(*) as total')
        ->whereYear('created_at', date('Y'))
        ->groupBy('mois')
        ->pluck('total', 'mois')
        ->toArray();

    $produitsParCategorie = Burger::selectRaw('EXTRACT(MONTH FROM created_at) as mois, COUNT(*) as total')
        ->whereYear('created_at', date('Y'))
        ->groupBy('mois')
        ->pluck('total', 'mois')
        ->toArray();

    return view('dashboard', compact(
        'commandesEnCours',
        'commandesValidees',
        'recettesJournalieres',
        'commandesParMois',
        'produitsParCategorie'
    ));
}
}