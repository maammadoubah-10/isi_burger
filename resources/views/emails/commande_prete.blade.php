<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre commande est prête</title>
</head>
<body>
    <h1>Bonjour {{ $commande->client->name }},</h1>
    <p>Votre commande #{{ $commande->id }} est maintenant prête à être récupérée ! 🎉</p>
    <p><strong>Total :</strong> {{ $commande->montant_total }} €</p>
    <p><strong>Statut :</strong> {{ ucfirst($commande->statut) }}</p>

    <h3>Produits commandés :</h3>
    <ul>
        @foreach($commande->burgers as $burger)
            <li>{{ $burger->nom }} - {{ $burger->pivot->quantite }}x</li>
        @endforeach
    </ul>

    <p>Merci pour votre commande chez ISI Burger !</p>
</body>
</html>
