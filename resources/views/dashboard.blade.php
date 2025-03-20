@extends('layouts.app')

@section('content')

<div class="container" style="margin-bottom: 5%;">

    <h2 class="main-title">Dashboard</h2>
    <div class="row stat-cards">
        <!-- Commandes en cours de la journée -->
        <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
                <div class="stat-cards-icon primary">
                    <i data-feather="bar-chart-2" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                    <p class="stat-cards-info__num">{{ $commandesEnCours }}</p>
                    <p class="stat-cards-info__title">Commandes en cours</p>
                </div>
            </article>
        </div>

        <!-- Commandes validées de la journée -->
        <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
                <div class="stat-cards-icon warning">
                    <i data-feather="file" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                    <p class="stat-cards-info__num">{{ $commandesValidees }}</p>
                    <p class="stat-cards-info__title">Commandes validées</p>
                </div>
            </article>
        </div>

        <!-- Recettes journalières -->
        <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
                <div class="stat-cards-icon purple">
                    <i data-feather="dollar-sign" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                    <p class="stat-cards-info__num">{{ number_format($recettesJournalieres, 2) }} FCFA</p>
                    <p class="stat-cards-info__title">Recettes journalières</p>
                </div>
            </article>
        </div>
        

        <!-- Placeholder pour une autre statistique -->
        <div class="col-md-6 col-xl-3">
            <article class="stat-cards-item">
                <div class="stat-cards-icon success">
                    <i data-feather="users" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                    <p class="stat-cards-info__num">N/A</p>
                    <p class="stat-cards-info__title">Autre statistique</p>
                </div>
            </article>
        </div>
    </div>

    <div class="row">
        <!-- Graphique des commandes par mois -->
        <div class="col-lg-9">
            <div class="chart">
                <canvas id="commandesChart" aria-label="Commandes par mois" role="img"></canvas>
            </div>
        </div>

        <!-- Graphique des produits par catégorie -->
        <div class="col-lg-3">
            <article class="customers-wrapper">
                <canvas id="produitsChart" aria-label="Produits par catégorie" role="img"></canvas>
            </article>
        </div>
    </div>
</div>

<!-- Script pour les graphiques -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Graphique des commandes par mois
        const commandesCtx = document.getElementById('commandesChart').getContext('2d');
        const commandesChart = new Chart(commandesCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Commandes',
                    data: Object.values(@json($commandesParMois)),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Graphique des produits par catégorie
        const produitsCtx = document.getElementById('produitsChart').getContext('2d');
        const produitsChart = new Chart(produitsCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Produits',
                    data: Object.values(@json($produitsParCategorie)),
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection