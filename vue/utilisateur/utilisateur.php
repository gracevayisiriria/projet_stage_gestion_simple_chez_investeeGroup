<?php
require_once("../../modele/bdd/connectBDD.php");
require_once("../../modele/utilisateur/utilisateur.php");
require_once("../../controleur/utilisateur/ajouter.php");
require_once("../../controleur/login/session.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs - Investee Group</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
     <link rel="stylesheet" href="../../style/bootstrap/css/bootstrap.css">
    <style>
        :root {
            --primary-color: #1a3a5f;
            --secondary-color: #2c5aa0;
            --accent-color: #4caf50;
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
        
        .navbar-brand {
            font-weight: 700;
            color: white !important;
        }
        
        .sidebar {
            background-color: var(--primary-color);
            min-height: calc(100vh - 56px);
            color: white;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: var(--secondary-color);
            color: white;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .main-content {
            padding: 20px;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid #eaeaea;
            padding: 15px 20px;
            font-weight: 600;
            color: var(--primary-color);
            border-radius: 10px 10px 0 0 !important;
        }
        
        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-success {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }
        
        .table th {
            background-color: #f1f5f9;
            color: var(--primary-color);
            font-weight: 600;
            border-top: none;
        }
        
        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .action-buttons .btn {
            padding: 5px 10px;
            margin-right: 5px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .stats-card {
            text-align: center;
            padding: 20px;
        }
        
        .stats-card i {
            font-size: 2rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }
        
        .stats-card h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 5px;
        }
        
        .stats-card p {
            color: #6c757d;
            margin-bottom: 0;
        }
        
        .modal-header {
            background-color: var(--primary-color);
            color: white;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--primary-color);
        }
        
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
            }
            
            .table-responsive {
                font-size: 0.875rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--primary-color);">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-chart-line me-2"></i>Investee Group
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
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
            <div class="col-lg-2 col-md-3 d-md-block sidebar collapse">
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
                            <a class="nav-link " href="../../vue/transaction/transaction.php">
                                <i class="fas fa-exchange-alt"></i> Gestion des transactions
                            </a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link active" href="../../vue/utilisateur/utilisateur.php">
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
            <main class="col-lg-10 col-md-9 ms-sm-auto px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Gestion des Utilisateurs</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            <i class="fas fa-plus me-2"></i>Ajouter un utilisateur
                        </button>
                    </div>
                </div>
                <!-- Users Table -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Liste des utilisateurs</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Utilisateur</th>
                                        <th>Rôle</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $users = AllUtilisateur();
                                     while($afficher = $users->fetch()){
                                    ?>
                                    <tr>
                                        <td><?= $afficher["nomutilisateur"]?></td>
                                        <td><?= $afficher["role"]?></td>
                                        <td class="action-buttons">
                                            <a href="modifier.php?id=<?= $afficher["id"]?>" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i> modifier
                                            </a>
                                            <a href="../../controleur/utilisateur/supprimer.php?id=<?= $afficher["id"]?>" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i> supprimer
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Ajouter un nouvel utilisateur</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="lastName" class="form-label">Nom utilisateur</label>
                                <input name="nomUtilisateur" type="text" class="form-control" id="lastName" required>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">Rôle</label>
                                <select class="form-control" name="role" id="">
                                    <option selected desabled    value="">Choisissez</option>
                                    <option value="administrateur">Administrateur</option>
                                    <option value="gestionnaire">Gestionnaire</option>
                                    <option value="pdg">PDG</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input name="password" type="password" class="form-control" id="password" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="confirmPassword" class="form-label">Confirmer le mot de passe</label>
                                <input name="confirmPasword" type="password" class="form-control" id="confirmPassword" required>
                            </div>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" name="valider" class="btn btn-success">Ajouter l'utilisateur</button>
                </div>
                 </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
     <script src="../../style/bootstrap/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Script pour gérer l'affichage responsive du sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const navbarToggler = document.querySelector('.navbar-toggler');
            
            navbarToggler.addEventListener('click', function() {
                sidebar.classList.toggle('d-block');
            });
        });
    </script>
</body>
</html>
