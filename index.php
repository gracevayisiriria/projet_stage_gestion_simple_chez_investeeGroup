<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investee Group - Gestion Commerciale</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/bootstrap/css/bootstrap.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/modules/dashboard.css">
    <link rel="stylesheet" href="css/modules/clients.css">
    <link rel="stylesheet" href="css/modules/products.css">
    <link rel="stylesheet" href="css/modules/transactions.css">
</head>
<body>
    <!-- Navigation principale -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-chart-line me-2"></i>Investee Group
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('home-section')">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vue/dashboard/dashboard.html" onclick="showSection('dashboard-section')">Tableau de Bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vue/client/client.html" onclick="showSection('clients-section')">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vue/produit/produit.html" onclick="showSection('products-section')">Produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vue/transaction/transaction.html" onclick="showSection('transactions-section')">Transactions</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="fas fa-sign-in-alt me-1"></i> Connexion
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal de connexion -->
    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-chart-line me-2"></i>Connexion
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="login-form">
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" class="form-control" id="email" placeholder="votre@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" placeholder="Votre mot de passe" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Se souvenir de moi</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">Se connecter</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="#" class="text-decoration-none">Mot de passe oublié?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar (visible après connexion) -->
            <div class="col-md-3 col-lg-2 sidebar d-none" id="app-sidebar">
                <div class="p-3">
                    <h5 class="text-white text-center mb-4">
                        <i class="fas fa-chart-line me-2"></i>Menu
                    </h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="vue/dashboard/dashboard.html" onclick="showSection('dashboard-section')">
                                <i class="fas fa-tachometer-alt"></i> Tableau de Bord
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="vue/client/client.html" onclick="showSection('clients-section')">
                                <i class="fas fa-users"></i> Clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="vue/produit/produit.html" onclick="showSection('products-section')">
                                <i class="fas fa-boxes"></i> Produits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="vue/transaction/transaction.html" onclick="showSection('transactions-section')">
                                <i class="fas fa-exchange-alt"></i> Transactions
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link text-danger" href="#" onclick="logout()">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="col-md-9 col-lg-10 main-content" id="main-content">
                <!-- Section Accueil -->
                <div id="home-section" class="section">
                    <!-- Le contenu de la page d'accueil reste le même -->
                    <div class="home-hero fade-in">
                        <div class="container">
                            <h1 class="display-4 fw-bold mb-4">Gestion Commerciale Simplifiée</h1>
                            <p class="lead mb-4">Optimisez la gestion de vos clients, produits et transactions avec notre solution tout-en-un</p>
                            <button class="btn btn-light btn-lg px-4" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Commencer <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>

                    <div class="container my-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="feature-card card slide-in-left">
                                    <i class="fas fa-users"></i>
                                    <h4>Gestion des Clients</h4>
                                    <p>Gérez facilement votre base de clients avec recherche rapide et informations détaillées.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-card card slide-in-left" style="animation-delay: 0.2s;">
                                    <i class="fas fa-boxes"></i>
                                    <h4>Gestion des Produits</h4>
                                    <p>Suivez votre inventaire avec quantité disponible et informations produits complètes.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-card card slide-in-left" style="animation-delay: 0.4s;">
                                    <i class="fas fa-exchange-alt"></i>
                                    <h4>Transactions</h4>
                                    <p>Enregistrez ventes et dépôts avec historique complet et suivi en temps réel.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Les autres sections (dashboard, clients, produits, transactions) seront chargées dynamiquement -->
                <div id="dashboard-section" class="section d-none"></div>
                <div id="clients-section" class="section d-none"></div>
                <div id="products-section" class="section d-none"></div>
                <div id="transactions-section" class="section d-none"></div>
            </div>
        </div>
    </div>

    <script src="style/bootstrap/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom JS -->
    <script src="js/auth.js"></script>
    <script src="js/navigation.js"></script>
    <script src="js/app.js"></script>
    <script src="js/modules/dashboard.js"></script>
    <script src="js/modules/clients.js"></script>
    <script src="js/modules/products.js"></script>
    <script src="js/modules/transactions.js"></script>
</body>
</html>