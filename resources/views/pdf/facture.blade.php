<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture Commande #{{ $commande->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; font-size: 18px; font-weight: bold; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <div class="header">
        Facture ISI Burger 🍔 <br>
        Commande #{{ $commande->id }}
    </div>

    <p><strong>Client :</strong> {{ $commande->client->name }}</p>
    <p><strong>Date :</strong> {{ now()->format('d/m/Y') }}</p>
    <p><strong>Total :</strong> {{ number_format($commande->montant_total, 2) }} €</p>

    <h4>Produits commandés :</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commande->burgers as $burger)
                <tr>
                    <td>{{ $burger->nom }}</td>
                    <td>{{ $burger->pivot->quantite }}</td>
                    <td>{{ number_format($burger->prix, 2) }} €</td>
                    <td>{{ number_format($burger->prix * $burger->pivot->quantite, 2) }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total à payer :</strong> {{ number_format($commande->montant_total, 2) }} €</p>
</body>
</html>
