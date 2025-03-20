@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Détails de la Notification</h2>
    <div class="card">
        <div class="card-body">
            <h4>{{ $notification->data['message'] }}</h4>
            <p>Date : {{ $notification->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Contenu :</strong></p>
            <p><strong>{{ $notification->data['contenu'] ?? 'Aucun détail disponible.' }}</strong></p>

            <a href="{{ url('/gestionnaire/commandes') }}" class="btn btn-primary">Voir les commandes</a>
            <a href="{{ route('notifications.markAsRead') }}" class="btn btn-secondary">Marquer comme lue</a>
        </div>
    </div>
</div>
@endsection
