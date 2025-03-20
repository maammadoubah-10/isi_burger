<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\BurgerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ProfileController;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\NotificationController;
// ✅ Route d'accueil
Route::get('/', function () {
    return view('welcome');
});

// ✅ Redirection après connexion
Route::get('/redirect', function () {
    return redirect(RouteServiceProvider::getHomeRoute());
})->middleware(['auth'])->name('redirect');




// ✅ Tableau de bord sécurisé
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'role:gestionnaire']) // Ajout de `role:gestionnaire`
    ->name('dashboard');
// ✅ Routes nécessitant une authentification
Route::middleware(['auth'])->group(function () {

    // ✅ Gestion du profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ Routes CLIENTS
    Route::middleware('role:client')->group(function () {
        Route::get('/catalogue', [BurgerController::class, 'catalogue'])->name('catalogue');

        Route::post('/paiements/{commande}', [PaiementController::class, 'store'])
        ->name('paiements.store')
        ->middleware(['auth', 'role:client']);
        // ✅ Correction : Ajouter `commandes.index`
        Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
        Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commandes.create');
        Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
        Route::get('/commandes/{commande}', [CommandeController::class, 'show'])->name('commandes.show');
        
        Route::get('/factures/{commande}/download', [CommandeController::class, 'downloadFacture'])
    ->middleware(['auth', 'role:client'])
    ->name('factures.download');
       
    Route::get('/commandes/{commande}/facture', [CommandeController::class, 'showFacture'])
    ->middleware(['auth', 'role:client'])
    ->name('commandes.showFacture');




    });

    Route::get('/burgers/{burger}', [BurgerController::class, 'show'])
    //->middleware(['auth'])
    ->name('burgers.show');
    // ✅ Routes GESTIONNAIRES
   Route::middleware('role:gestionnaire')->group(function () {
    Route::resource('burgers', BurgerController::class);
    Route::get('/gestionnaire/commandes', [CommandeController::class, 'indexGestionnaire'])->name('gestionnaire.commandes.index');
    Route::patch('/commandes/{commande}/statut', [CommandeController::class, 'updateStatut'])->name('commandes.updateStatut');
    Route::post('/paiements/{commande}', [PaiementController::class, 'store'])
    ->name('paiements.store');
    Route::delete('/commandes/{commande}/annuler', [CommandeController::class, 'annuler'])
    ->name('commandes.annuler')
    ->middleware('role:gestionnaire');
   
    Route::middleware(['auth'])->group(function () {
        // Marquer toutes les notifications comme lues
        Route::get('/notifications/markAsRead', function () {
            Auth::user()->unreadNotifications->markAsRead();
            return redirect()->back()->with('success', 'Toutes les notifications ont été marquées comme lues.');
        })->name('notifications.markAsRead');
    
        // ✅ Nouvelle route pour voir le détail d'une notification
        Route::get('/notifications/{id}', function ($id) {
            $notification = Auth::user()->notifications()->find($id);
            if ($notification) {
                return view('notifications.show', compact('notification'));
            }
            return redirect()->back()->with('error', 'Notification introuvable.');
        })->name('notifications.show');
    });

});
Route::get('/notifications', [NotificationController::class, 'index'])
    ->middleware(['auth', 'role:client'])
    ->name('notifications.index');

// ✅ Route pour récupérer les notifications non lues en JSON (utilisé pour afficher le badge rouge)
Route::get('/notifications/unread', [NotificationController::class, 'unread'])
    ->middleware(['auth', 'role:client'])
    ->name('notifications.unread');

// ✅ Route pour marquer toutes les notifications comme lues
Route::get('/notifications/markAsRead', [NotificationController::class, 'markAsRead'])
    ->middleware(['auth', 'role:client'])
    ->name('notifications.markAsRead');
    
    

});

// ✅ Inclusion des routes d'authentification
require __DIR__.'/auth.php';
