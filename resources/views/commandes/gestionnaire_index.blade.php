@extends('layouts.app')

@section('content')
<div class="users-table table-wrapper"  style="margin: 4%;">
    <h4 class="sign-up__title">Liste des Commandes</h4>

    @if ($commandes->isEmpty())
        <p class="sign-up__subtitle">Aucune commande disponible.</p>
    @else
        <table class="posts-table">
            <thead>
                <tr class="users-table-info">
                    <th>N°</th>
                    <th>Client</th>
                    <th>Montant Total</th>
                    <th>Statut</th>
                    <th>Produits</th>
                    <th>Image</th>

                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commandes as $commande)
                <tr>
                    <!-- Numéro de commande -->
                    <td>{{ $commande->id }}</td>

                    <!-- Client -->
                    <td>{{ $commande->client ? $commande->client->name : 'Inconnu' }}</td>

                    <!-- Montant total -->
                    <td>{{ $commande->montant_total }} FCFA</td>
 
                    <!-- Statut de la commande -->
                    <td>
                        @if ($commande->statut === 'en_attente')
                            <span class="badge-pending">En attente</span>
                        @elseif ($commande->statut === 'en_preparation')
                            <span class="badge-primary">En préparation</span>
                        @elseif ($commande->statut === 'prete')
                            <span class="badge-active">Prête</span>
                        @elseif ($commande->statut === 'payee')
                            <span class="badge-success">Payée</span>
                        @elseif ($commande->statut === 'annulee')
                            <span class="badge-danger">Annulée</span>
                        @else
                            <span class="badge-secondary">{{ ucfirst($commande->statut) }}</span>
                        @endif
                    </td>

                    <!-- Produits de la commande -->
                    <td>
                        @foreach($commande->burgers as $burger)
                            <div class="product-item">
                                {{ $burger->nom }} (x{{ $burger->pivot->quantite }})
                            </div>
                        @endforeach
                    </td>
                    <td>
                    <div class="categories-table-img">
                        <picture>
                            <source srcset="{{ asset('storage/'.$burger->image) }}" type="image/webp">
                            <img src="{{ asset('storage/'.$burger->image) }}" alt="Burger Image" width="80" style="border-radius: 5px;">
                        </picture>
                    </div>
                </td>
                    <!-- Actions -->
                    <td>
                        
                        <span class="p-relative">
                            <button class="dropdown-btn transparent-btn" type="button" title="More info">
                                <div class="sr-only">More info</div>
                                <i data-feather="more-horizontal" aria-hidden="true"></i>
                            </button>
                            <ul class="users-item-dropdown dropdown">
                                <!-- Détails -->
                                <li>
                                    <a href="{{ route('commandes.show', $commande) }}">Détails</a>
                                </li>

                                <!-- Sélection du statut -->
                                <li>
                                    <form action="{{ route('commandes.updateStatut', $commande) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="statut" onchange="this.form.submit()">
                                            <option value="en_attente" {{ $commande->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                            <option value="en_preparation" {{ $commande->statut == 'en_preparation' ? 'selected' : '' }}>En préparation</option>
                                            <option value="prete" {{ $commande->statut == 'prete' ? 'selected' : '' }}>Prête</option>
                                            <option value="payee" {{ $commande->statut == 'payee' ? 'selected' : '' }}>Payée</option>
                                            <option value="annulee" {{ $commande->statut == 'annulee' ? 'selected' : '' }}>Annulée</option>
                                        </select>
                                    </form>
                                </li>

                                <!-- Marquer comme Prête -->
                                @if ($commande->statut !== 'prete' && $commande->statut !== 'payee')
                                    <li>
                                        <form action="{{ route('commandes.updateStatut', $commande) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="statut" value="prete">
                                            <button type="submit">Marquer Prête</button>
                                        </form>
                                    </li>
                                @endif

                                <!-- Marquer comme Payée -->
                                @if ($commande->statut === 'prete')
                                    <li>
                                        <form action="{{ route('paiements.store', $commande) }}" method="POST">
                                            @csrf
                                            <button type="submit">Marquer comme Payée</button>
                                        </form>
                                    </li>
                                @elseif ($commande->statut === 'payee')
                                    <li>
                                        <button disabled>Déjà Payée</button>
                                    </li>
                                @endif

                                <!-- Annuler -->
                                @if ($commande->statut !== 'payee')
                                    <li>
                                        <form action="{{ route('commandes.annuler', $commande) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment annuler cette commande ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Annuler</button>
                                        </form>
                                    </li>
                                @endif
                            </ul>
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection