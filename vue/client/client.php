<?php
require_once("../../modele/bdd/connectBDD.php");
require_once("../../modele/client/client.php");
require_once("../../controleur/client/ajouter.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investee Group - Gestion des Clients</title>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> Admin
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Paramètres</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Déconnexion</a></li>
                        </ul>
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
                            <a class="nav-link active" href="../../vue/client/client.php">
                                <i class="fas fa-users"></i> Gestion des clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../vue/produit/produit.php">
                                <i class="fas fa-boxes"></i> Gestion des produits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../vue/transaction/transaction.php">
                                <i class="fas fa-exchange-alt"></i> Gestion des transactions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../vue/transaction/transaction.php">
                                <i class="fas fa-exchange-alt"></i> Gestion des utilisateur
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-lg-10 col-md-9 ms-sm-auto px-md-4 content">
                <!-- Clients Section -->
                <div class="section-content" id="clients-section">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Gestion des clients</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClientModal">
                                <i class="fas fa-plus me-1"></i> Nouveau client
                            </button>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body stats-card">
                                    <i class="fas fa-users"></i>
                                    <div class="number"><?= NombreClientTotal() ?></div>
                                    <div class="label">Cliens totaux</div>
                                </div>
                            </div>
                        </div>
                       
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Liste des clients</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Téléphone</th>
                                            <th>Adresse</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                       $client = ToutUtilisateur();
                                       while($afficher = $client->fetch()) {
                                        ?>
                                        <tr>
                                            <td> <?= $afficher["idClient"] ?> </td>
                                            <td> <?= $afficher["nom"] ?> </td>
                                            <td> <?= $afficher["postnom"] ?> </td>
                                            <td> <?= $afficher["numero_telephone"] ?> </td>
                                            <td> <?= $afficher["adresse"] ?> </td>
                                            <td>
                                                <a class="btn btn-outline-danger" href="../../controleur/client/supprimer.php?id=<?= $afficher["idClient"] ?>">Supprimer</a>
                                                <a class="btn btn-outline-success" href="">Modifier</a>
                                            </td>
                                        </tr>
                                        <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add Client Modal -->
    <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">Ajouter un nouveau client</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="clientFirstName" class="form-label">Nom</label>
                                    <input name="nom" type="text" class="form-control" id="clientFirstName" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="clientLastName" class="form-label">Post-nom</label>
                                    <input name="postnom" type="text" class="form-control" id="clientLastName" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="clientPhone" class="form-label">Téléphone</label>
                            <input name="telephone" type="tel" class="form-control" id="clientPhone">
                        </div>
                        <div class="mb-3">
                            <label for="clientAddress" class="form-label">Adresse</label>
                            <textarea name="adresse" class="form-control" id="clientAddress" rows="3"></textarea>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" name="valider" class="btn btn-primary">Enregistrer le client</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Client Modal -->
    <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClientModalLabel">Modifier les informations du client</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editClientFirstName" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="editClientFirstName" value="Martin" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editClientLastName" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="editClientLastName" value="Dubois" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editClientEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editClientEmail" value="martin.dubois@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="editClientPhone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" id="editClientPhone" value="01 23 45 67 89">
                        </div>
                        <div class="mb-3">
                            <label for="editClientAddress" class="form-label">Adresse</label>
                            <textarea class="form-control" id="editClientAddress" rows="3">123 Avenue des Champs-Élysées</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editClientCity" class="form-label">Ville</label>
                                    <input type="text" class="form-control" id="editClientCity" value="Paris">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editClientPostalCode" class="form-label">Code postal</label>
                                    <input type="text" class="form-control" id="editClientPostalCode" value="75008">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editClientCompany" class="form-label">Entreprise (optionnel)</label>
                            <input type="text" class="form-control" id="editClientCompany" value="Dubois Technologies">
                        </div>
                        <div class="mb-3">
                            <label for="editClientStatus" class="form-label">Statut</label>
                            <select class="form-select" id="editClientStatus">
                                <option value="active" selected>Actif</option>
                                <option value="inactive">Inactif</option>
                                <option value="pending">En attente</option>
                            </select>
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
