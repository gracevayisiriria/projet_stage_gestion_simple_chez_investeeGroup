<?php
require_once("../../modele/bdd/connectBDD.php");
require_once("../../modele/dashboard/dashboard.php");
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Investee Group</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../../style/bootstrap/css/bootstrap.css">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --success: #2ecc71;
            --warning: #f39c12; 
            --danger: #e74c3c;
            --light: #ecf0f1;
            --dark: #2c3e50;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        .sidebar {
            background-color: var(--primary);
            color: white;
            min-height: 100vh;
            padding: 0;
            box-shadow: 3px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .main-content {
            padding: 20px;
            background-color: #f8f9fa;
        }
        
        .stat-card {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
            border: none;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card i {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        .stat-card .number {
            font-size: 2rem;
            font-weight: 700;
            margin: 10px 0;
        }
        
        .stat-card .label {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid #eee;
            font-weight: 600;
            padding: 15px 20px;
            border-radius: 10px 10px 0 0 !important;
        }
        
        .chart-container {
            height: 300px;
            position: relative;
            padding: 15px;
        }
        
        .page-title {
            margin-bottom: 20px;
            color: var(--primary);
            font-weight: 600;
        }
        
        .sidebar-stats {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-stat-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background: rgba(255,255,255,0.05);
            border-radius: 8px;
        }
        
        .sidebar-stat-item i {
            font-size: 1.5rem;
            margin-right: 15px;
            width: 30px;
            text-align: center;
        }
        
        .sidebar-stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0;
        }
        
        .sidebar-stat-label {
            font-size: 0.8rem;
            opacity: 0.8;
            margin-bottom: 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary) !important;
        }
        
        .horizontal-bar-chart {
            height: 200px;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
            }
            
            .main-content {
                padding: 15px;
            }
            
            .stat-card {
                padding: 15px;
            }
            
            .stat-card .number {
                font-size: 1.5rem;
            }
            
            .chart-container {
                height: 250px;
            }
        }
        
        @media (max-width: 576px) {
            .stat-card i {
                font-size: 2rem;
            }
            
            .chart-container {
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar d-flex flex-column">
                <div class="sidebar-stats">
                    <h5 class="text-white text-center mb-4">
                        <i class="fas fa-chart-line me-2"></i>Investee Group
                    </h5>  
                </div>
                
                <!-- Navigation -->
                <div class="flex-grow-1 p-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i> Tableau de Bord
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../client/client.php">
                                <i class="fas fa-users"></i> Gestion des Clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../produit/produit.php">
                                <i class="fas fa-boxes"></i> Gestion des Produits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../transaction/transaction.php">
                                <i class="fas fa-exchange-alt"></i> Transactions
                            </a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" href="../utilisateur/utilisateur.php">
                                <i class="fas fa-exchange-alt"></i> Transactions
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link text-danger" href="#">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="col-md-9 col-lg-10 main-content">
                <h2 class="page-title">Tableau de Bord</h2>
                
                <!-- Cartes de statistiques principales -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="stat-card bg-primary text-white">
                            <i class="fas fa-users"></i>
                            <div class="number"> <?= NombreClientTotal()?>  </div>
                            <div class="label">Clients Totals</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card bg-success text-white">
                            <i class="fas fa-boxes"></i>
                            <div class="number"><?= NombreProduitTotal() ?></div>
                            <div class="label">Produits en Stock</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card bg-warning text-white">
                            <i class="fas fa-exchange-alt"></i>
                            <div class="number"><?= NombreTransactionTotal() ?></div>
                            <div class="label">Transactions</div>
                        </div>
                    </div>
                </div>
                
               
                
                <!-- Section supplémentaire -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                Résumé des Performances
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <div class="p-3">
                                            <div class="h4 text-primary"> <?= ChiffreAffaireJournalier("vente") ?> $ </div>
                                            <div class="text-muted">Chiffre d'Affaires Total journalier </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="p-3">
                                            <div class="h4 text-success"><?=NombreDepotJournalier('depot') ?></div>
                                            <div class="text-muted">Nombre de dépôt journalier</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="p-3">
                                            <div class="h4 text-info"><?=NombreDepotJournalier('vente') ?></div>
                                            <div class="text-muted">Nombre de ventes journalier</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="p-3">
                                            <div class="h4 text-warning"><?= NombreTransactionJournalier() ?></div>
                                            <div class="text-muted">Nombre de transaction journaliere</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../style/bootstrap/js/bootstrap.js"></script>
    
    <script>
        // Initialisation des graphiques
        document.addEventListener('DOMContentLoaded', function() {
            // Graphique principal
            const mainCtx = document.getElementById('mainChart').getContext('2d');
            const mainChart = new Chart(mainCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                    datasets: [{
                        label: 'Ventes',
                        data: [12000, 19000, 15000, 25000, 22000, 30000],
                        backgroundColor: 'rgba(52, 152, 219, 0.7)',
                        borderColor: 'rgba(52, 152, 219, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Dépôts',
                        data: [8000, 12000, 10000, 15000, 18000, 20000],
                        backgroundColor: 'rgba(46, 204, 113, 0.7)',
                        borderColor: 'rgba(46, 204, 113, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            
            // Graphique horizontal
            const horizontalCtx = document.getElementById('horizontalChart').getContext('2d');
            const horizontalChart = new Chart(horizontalCtx, {
                type: 'bar',
                data: {
                    labels: ['Smartphones', 'Laptops', 'Tablettes', 'Accessoires'],
                    datasets: [{
                        label: 'Ventes (unités)',
                        data: [65, 59, 80, 81],
                        backgroundColor: [
                            'rgba(52, 152, 219, 0.8)',
                            'rgba(46, 204, 113, 0.8)',
                            'rgba(155, 89, 182, 0.8)',
                            'rgba(241, 196, 15, 0.8)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
            
            // Graphique de la sidebar
            const sidebarCtx = document.getElementById('sidebarChart').getContext('2d');
            const sidebarChart = new Chart(sidebarCtx, {
                type: 'bar',
                data: {
                    labels: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4'],
                    datasets: [{
                        label: 'Ventes',
                        data: [12000, 19000, 15000, 22000],
                        backgroundColor: 'rgba(255, 255, 255, 0.3)',
                        borderColor: 'rgba(255, 255, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            display: false,
                            beginAtZero: true
                        },
                        y: {
                            ticks: {
                                color: 'white'
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>