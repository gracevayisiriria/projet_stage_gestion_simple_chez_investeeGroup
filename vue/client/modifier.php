<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Client - Investee Group</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        
        .form-label {
            font-weight: 500;
            color: var(--primary-color);
        }
        
        .client-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: var(--secondary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.8rem;
            margin: 0 auto 20px;
        }
        
        .client-info-sidebar {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
        }
        
        .info-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eaeaea;
        }
        
        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .info-label {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        
        .info-value {
            color: #555;
        }
        
        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eaeaea;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> Admin
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Mon profil</a></li>
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
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="#" class="btn btn-secondary me-2">
                            <i class="fas fa-arrow-left me-2"></i>Retour
                        </a>
                    </div>
                </div>

                <div class="row">
                    <!-- Formulaire de modification -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Modifier les informations du client</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="text-center mb-4">
                                        <div class="client-avatar">AM</div>
                                        <h4>Alain Martin</h4>
                                        <p class="text-muted">ID: CL-001</p>
                                        <div>
                                            <span class="badge badge-status bg-success me-1">Actif</span>
                                            <span class="badge badge-status bg-primary">Entreprise</span>
                                        </div>
                                    </div>

                                    <h6 class="section-title">Informations personnelles</h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="clientFirstName" class="form-label">Prénom</label>
                                            <input type="text" class="form-control" id="clientFirstName" value="Alain" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="clientLastName" class="form-label">Nom</label>
                                            <input type="text" class="form-control" id="clientLastName" value="Martin" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="clientEmail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="clientEmail" value="a.martin@martin-cie.fr" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="clientPhone" class="form-label">Téléphone</label>
                                            <input type="tel" class="form-control" id="clientPhone" value="+33 1 45 67 89 01" required>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="button" class="btn btn-secondary me-2">Annuler</button>
                                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
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
