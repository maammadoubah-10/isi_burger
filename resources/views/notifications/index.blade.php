@extends('layouts.app')

@section('content')

<style>
    /* ✅ Centrer la boîte des notifications */
    .notification-container {
        max-width: 700px;
        margin: 50px auto; /* ✅ Ajout de marge pour éviter d’être collé en haut */
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ✅ Liste des notifications */
    .notification-item {
        display: flex;
        align-items: center;
        padding: 15px;
        background: #f9f9f9;
        border-radius: 6px;
        transition: all 0.3s ease-in-out;
        margin-bottom: 10px;
        position: relative;
        overflow: hidden;
    }

    .notification-item:hover {
        background: #eef2ff;
        transform: translateY(-3px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* ✅ Icône */
    .notification-icon {
        font-size: 20px;
        color: #007bff;
        margin-right: 12px;
    }

    /* ✅ Contenu */
    .notification-content {
        flex: 1;
    }

    .notification-message {
        font-size: 16px;
        font-weight: bold;
        color: #333;
    }

    /* ✅ Bouton PDF */
    .download-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #dc3545; /* ✅ Couleur rouge pour le PDF */
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
        text-decoration: none;
        transition: background 0.3s;
    }

    .download-btn:hover {
        background: #b02a37;
    }

    /* ✅ Bouton "Tout marquer comme lu" */
    .mark-as-read-btn {
        display: block;
        text-align: center;
        margin-top: 20px;
        background: #28a745;
        color: white;
        padding: 10px 15px;
        border-radius: 6px;
        font-size: 16px;
        text-decoration: none;
        transition: background 0.3s;
    }

    .mark-as-read-btn:hover {
        background: #218838;
    }
</style>

<div class="container">
    <h2 class="text-center mb-4">🔔 Vos Notifications</h2>

    <div class="notification-container">
        @if($notifications->isEmpty())
            <p class="alert alert-info text-center">Aucune nouvelle notification.</p>
        @else
            <div class="list-group">
                @foreach($notifications as $notification)
                    <div class="notification-item">
                        <i class="fa-solid fa-envelope notification-icon"></i>
                        <div class="notification-content">
                            <p class="notification-message">ISI BURGER : {{ $notification->data['message'] }}</p>
                            
                            <a href="{{ route('commandes.showFacture', ['commande' => $notification->data['commande_id']]) }}" class="download-btn">

                                <i class="fa-solid fa-file-pdf"></i> ISI_BURGER.pdf
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <a href="{{ route('notifications.markAsRead') }}" class="mark-as-read-btn">Tout marquer comme lu</a>
        @endif
    </div>
</div>

@endsection
