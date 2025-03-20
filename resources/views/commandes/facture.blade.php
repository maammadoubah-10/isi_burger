<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture Commande #{{ $commande->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
            background: #f8f9fa;
        }
        .facture-container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .facture-header {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: #007bff;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .facture-info {
            font-size: 16px;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .facture-info strong {
            color: #333;
            font-weight: bold;
        }

        .facture-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .facture-table th, 
        .facture-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .facture-table th {
            background: #007bff;
            color: white;
            font-size: 16px;
        }

        .facture-table td {
            font-size: 15px;
            color: #333;
        }

        .facture-total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 15px;
        }

        .btn-download {
            display: block;
            text-align: center;
            background: #007bff;
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            text-decoration: none;
            margin-top: 20px;
            transition: background 0.3s;
        }

        .btn-download:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

    <div class="facture-container">
        <div class="facture-header">
            🧾 Facture ISI BURGER - Commande #{{ $commande->id }}
        </div>

        <div class="facture-info">
            <p><strong>Client :</strong> {{ $commande->client->name }}</p>
            <p><strong>Email :</strong> {{ $commande->client->email }}</p>
            <p><strong>Montant Total :</strong> {{ number_format($commande->montant_total, 2) }} €</p>
            <p><strong>Statut :</strong> <span style="color: green;">{{ ucfirst($commande->statut) }}</span></p>
        </div>

        <table class="facture-table">
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

        <div class="facture-total">
            Total à payer : {{ number_format($commande->montant_total, 2) }} €
        </div>

        <a href="{{ route('factures.download', ['commande' => $commande->id]) }}" class="btn-download">
            📄 Télécharger Facture (PDF)
        </a>
    </div>

</body>
</html>
