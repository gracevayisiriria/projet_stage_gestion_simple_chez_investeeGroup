<?php
require_once("../../modele/bdd/connectBDD.php");
require_once("../../modele/dashboard/dashboard.php");
require_once("../../modele/transaction/transaction.php");
require_once("../../controleur/transaction/ajouter.php");
require_once("../../controleur/login/session.php");

?>
<!DOCTYPE html>
<html lang="fr">	
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investee Group - Gestion des Transactions</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../style/bootstrap/css/bootstrap.css">
    <style>
        :root {
            --primary-color: #1a3c6e;
            --secondary-color: #2c5aa0;
            --accent-color: #4a7bc8;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .sidebar {
            background-color: white;
            min-height: calc(100vh - 56px);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 56px;
        }
        
        .sidebar .nav-link {
            color: var(--dark-color);
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: var(--accent-color);
            color: white;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .content {
            padding: 20px;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .table th {
            background-color: var(--light-color);
            color: var(--dark-color);
            font-weight: 600;
        }
        
        .badge-success {
            background-color: var(--success-color);
        }
        
        .badge-warning {
            background-color: var(--warning-color);
            color: var(--dark-color);
        }
        
        .badge-danger {
            background-color: var(--danger-color);
        }
        
        .badge-info {
            background-color: var(--accent-color);
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }
        
        .stats-card {
            text-align: center;
            padding: 20px;
        }
        
        .stats-card i {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: var(--primary-color);
        }
        
        .stats-card .number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .stats-card .label {
            color: var(--dark-color);
            font-size: 0.9rem;
        }
        
        .transaction-type-badge {
            font-size: 0.75rem;
        }
        
        .amount-positive {
            color: var(--success-color);
            font-weight: 600;
        }
        
        .amount-negative {
            color: var(--danger-color);
            font-weight: 600;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                position: relative;
                top: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-chart-line me-2"></i>Investee Group
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item ">
                        <a class="nav-link " href="#" id="navbarDropdown" role="button" >
                            <i class="fas fa-user-circle me-1"></i>
                             <?php
                            infoUser();
                             ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-2 col-md-3 d-md-block sidebar collapse" id="sidebarMenu">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="../../vue/dashboard/dashboard.php">
                                <i class="fas fa-tachometer-alt"></i> Tableau de bord
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../vue/client/client.php">
                                <i class="fas fa-users"></i> Gestion des clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../vue/produit/produit.php">
                                <i class="fas fa-boxes"></i> Gestion des produits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../../vue/transaction/transaction.php">
                                <i class="fas fa-exchange-alt"></i> Gestion des transactions
                            </a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" href="../../vue/utilisateur/utilisateur.php">
                                <i class="fas fa-users"></i> Gestion des utilisateurs
                            </a>
                        </li>
                         <li class="nav-item mt-4">
                            <a class="nav-link text-danger" href="../../controleur/login/deconnexion.php">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-lg-10 col-md-9 ms-sm-auto px-md-4 content">
                <!-- Transactions Section -->
                <div class="section-content" id="transactions-section">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Gestion des transactions</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                           
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
                                <i class="fas fa-plus me-1"></i> Nouvelle transaction
                            </button>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body stats-card">
                                    <i class="fas fa-exchange-alt"></i>
                                    <div class="number"><?= NombreTransactionJournalier() ?></div>
                                    <div class="label">Transactions totales d'aujoud'hui</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body stats-card">
                                    <i class="fas fa-shopping-cart"></i>
                                    <div class="number"><?=NombreDepotJournalier('depot') ?></div>
                                    <div class="label">Ventes d'aujoud'hui</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body stats-card">
                                    <i class="fas fa-warehouse"></i>
                                    <div class="number"><?=NombreDepotJournalier('vente') ?></div>
                                    <div class="label">Dépôts d'aujoud'hui</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body stats-card">
                                    <i class="fas fa-euro-sign"></i>
                                    <div class="number"><?= ChiffreAffaireJournalier("vente") ?> $</div>
                                    <div class="label">Chiffre d'affaires d'aujoud'hui</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Liste des transactions</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>N° Transaction</th>
                                            <th>Type</th>
                                            <th>Client/Fournisseur</th>
                                            <th>Produit</th>
                                            <th>Quantité</th>
                                            <th>Prix Unitaire</th>
                                            <th>Prix de vente</th>
                                            <th>Prix total</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $resultReq = ToutTransanction();
                                        while($show=$resultReq->fetch()) {
                                         ?>
                                        <tr>
                                           <td> <?= $show["id"] ?> </td>
                                           <td> <?= $show["typeTransaction"] ?> </td>
                                           <td> <?= $show["nomClient"] ?> </td>
                                           <td> <?= $show["nomProduit"] ?> </td>
                                           <td> <?= $show["quantite"] ?> </td>
                                           <td> <?= $show["prixAchat"] ?> </td>
                                           <td> <?= $show["prixVente"] ?> </td>
                                           <td> <?= $show["quantite"] * $show["prixAchat"]?> </td>
                                           <td> <? $show["dateOperation"]?> </td>
                                            <td>
                                                <a href="../../controleur/transaction/annuler.php?id=<?= $show["id"] ?>" class="btn btn-sm btn-outline-primary me-1" >
                                                    <i class="fas fa-edit"></i> Annuler
                                                </a>
                                            </td>
                                        </tr> 
                                        <?php }  ?>                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add Transaction Modal -->
    <div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransactionModalLabel">Nouvelle transaction</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="transactionType" class="form-label">Type de transaction</label>
                                    <select name="type" class="form-select" id="transactionType" required>
                                        <option desabled selected value="">Sélectionner un type</option>
                                        <option value="vente">Vente</option>
                                        <option value="depot">Dépôt</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="transactionClient" class="form-label">Client / Fournisseur</label>
                            <select name="client" class="form-select" id="transactionClient" required>
                                <option value="client">Sélectionner un client/fournisseur</option>
                                <?php
                                $ResultClient = ToutClient();
                                while($showResult = $ResultClient->fetch()) {
                                ?>
                                   <option value="<?= $showResult["idClient"]?>"> <?= $showResult["nom"]?> </option> 
                                   <?php } ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="transactionProduct" class="form-label">Produit</label>
                            <select name="produit" class="form-select" id="transactionProduct" required>
                                <option selected desabled value="">Sélectionner un produit</option>
                                  <?php
                                $resultClient = AllProduit();
                               while( $Afficher=$resultClient->fetch()){
                                ?>
                                <option value="<?= $Afficher["idproduit"]?>"><?= $Afficher["nomproduit"]?></option>
                                <?php }  ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="transactionQuantity" class="form-label">Quantité</label>
                                    <input type="number" name="quantite" class="form-control" id="transactionQuantity" value="1" min="1" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="transactionUnitPrice" class="form-label">Prix unitaire d'achat ($)</label>
                                    <input name="prixAchat" type="number" class="form-control" id="transactionUnitPrice" step="0.01" required>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="transactionUnitPrice" class="form-label">Prix de vente ($)</label>
                                    <input name="prixVente" type="number" class="form-control" id="transactionUnitPrice" step="0.01" required>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" name="valider" class="btn btn-primary">Enregistrer la transaction</button>
                </div>
            </div>
            </form>
        </div>
    </div>


    <!-- Bootstrap JS -->
     <script src="../../style/bootstrap/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
     
    <script>
        // Simple script to handle sidebar navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Highlight active sidebar item
            const currentPage = window.location.pathname.split('/').pop();
            const sidebarLinks = document.querySelectorAll('.sidebar .nav-link');
            
            sidebarLinks.forEach(link => {
                if (link.getAttribute('href') === currentPage) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });

            // Calculate total amount when quantity or unit price changes
            const quantityInput = document.getElementById('transactionQuantity');
            const unitPriceInput = document.getElementById('transactionUnitPrice');
            const totalInput = document.getElementById('transactionTotal');
            
            if (quantityInput && unitPriceInput && totalInput) {
                const calculateTotal = () => {
                    const quantity = parseInt(quantityInput.value) || 0;
                    const unitPrice = parseFloat(unitPriceInput.value) || 0;
                    const total = quantity * unitPrice;
                    totalInput.value = total.toFixed(2) + '€';
                };
                
                quantityInput.addEventListener('input', calculateTotal);
                unitPriceInput.addEventListener('input', calculateTotal);
                
                calculateTotal();
            }

            const filterButtons = document.querySelectorAll('[data-filter]');
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    console.log('Filter:', this.getAttribute('data-filter'));
                });
            });
        });
    </script>
</body>
</html>
