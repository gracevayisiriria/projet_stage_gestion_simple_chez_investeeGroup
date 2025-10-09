<?php
require_once("../../modele/bdd/connectBDD.php");
require_once("../../modele/produit/produit.php");
require_once("../../controleur/produit/ajouter.php");
require_once("../../controleur/login/session.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investee Group - Gestion des Produits</title>
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
        
        .product-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .category-badge {
            font-size: 0.75rem;
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
                            <a class="nav-link active" href="../../vue/produit/produit.php">
                                <i class="fas fa-boxes"></i> Gestion des produits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../vue/transaction/transaction.php">
                                <i class="fas fa-exchange-alt"></i> Gestion des transactions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../vue/utilisateur/utilisateur.php">
                                <i class="fas fa-users"></i> Gestion des utilisateur
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
                <!-- Products Section -->
                <div class="section-content" id="products-section">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Gestion des produits</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                <i class="fas fa-plus me-1"></i> Nouveau produit
                            </button>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body stats-card">
                                    <i class="fas fa-boxes"></i>
                                    <div class="number"> <?=NombreProduitTotal()  ?> </div>
                                    <div class="label">Produits totaux</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Liste des produits</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Nom</th>
                                            <th>Quantité</th>
                                            <th>Prix d'achat</th>
                                            <th>Prix de vente</th>
                                            <th>Solde</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                       $produit = ToutProduit();
                                       while($afficher = $produit->fetch()) {
                                        ?>
                                        <tr>
                                            <td> <?= $afficher["idproduit"] ?> </td>
                                            <td> <?= $afficher["nomproduit"] ?> </td>
                                            <td> <?= $afficher["quantite"] ?> </td>
                                            <td> <?= $afficher["prixachat"] ?> </td>
                                            <td> <?= $afficher["prixvente"] ?> </td>
                                            <td> <?= $afficher["quantite"] * $afficher["prixachat"]?> </td>
                                            <td>
                                                <a href="modifier.php?id=<?= $afficher["idproduit"] ?>" class="btn btn-sm btn-outline-primary me-1" >
                                                    <i class="fas fa-edit"></i> Modifier
                                                </>
                                                <a href="../../controleur/produit/supprimer.php?id=<?= $afficher["idproduit"] ?>" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i> Supprimer
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Ajouter un nouveau produit</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="productName" class="form-label">Nom du produit</label>
                                            <input type="text" name="nomProduit" class="form-control" id="productName" required>
                                        </div>
                                    </div>
                                    
                                </div>
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" name="valider" class="btn btn-primary">Ajouter le produit</button>
                        </div>
                 </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Modifier le produit</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="editProductName" class="form-label">Nom du produit</label>
                                    <input type="text" class="form-control" id="editProductName" value="Ordinateur Portable Pro" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="editProductReference" class="form-label">Référence</label>
                                    <input type="text" class="form-control" id="editProductReference" value="LP-2023-15" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editProductDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editProductDescription" rows="3">Ordinateur portable professionnel avec processeur Intel i7, 16GB RAM, SSD 512GB, écran 15.6" Full HD.</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editProductCategory" class="form-label">Catégorie</label>
                                    <select class="form-select" id="editProductCategory" required>
                                        <option value="informatique" selected>Informatique</option>
                                        <option value="mobile">Mobile</option>
                                        <option value="accessoires">Accessoires</option>
                                        <option value="reseaux">Réseaux</option>
                                        <option value="logiciels">Logiciels</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editProductBrand" class="form-label">Marque</label>
                                    <input type="text" class="form-control" id="editProductBrand" value="TechPro">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="editProductPrice" class="form-label">Prix (€)</label>
                                    <input type="number" class="form-control" id="editProductPrice" value="1250" step="0.01" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="editProductStock" class="form-label">Stock</label>
                                    <input type="number" class="form-control" id="editProductStock" value="42" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="editProductMinStock" class="form-label">Stock minimum</label>
                                    <input type="number" class="form-control" id="editProductMinStock" value="5">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editProductImage" class="form-label">Image du produit</label>
                            <input class="form-control" type="file" id="editProductImage">
                            <div class="form-text">Image actuelle:</div>
                            <img src="https://via.placeholder.com/100x100/4a7bc8/ffffff?text=LP" class="mt-2 rounded" alt="Produit" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="editProductStatus" checked>
                            <label class="form-check-label" for="editProductStatus">Produit actif</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
     <script src="../../style/bootstrap/js/bootstrap.js"></script>
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
        });
    </script>
</body>
</html>
