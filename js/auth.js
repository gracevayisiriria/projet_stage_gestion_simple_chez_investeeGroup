// Gestion de l'authentification
class AuthManager {
    constructor() {
        this.isAuthenticated = false;
        this.currentUser = null;
        this.init();
    }

    init() {
        // Vérifier si l'utilisateur est déjà connecté
        const savedAuth = localStorage.getItem('investee_auth');
        if (savedAuth) {
            const authData = JSON.parse(savedAuth);
            this.isAuthenticated = true;
            this.currentUser = authData.user;
            this.showAppInterface();
        }
    }

    login(email, password) {
        // Simulation d'authentification
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                if (email && password) {
                    this.isAuthenticated = true;
                    this.currentUser = {
                        email: email,
                        name: 'Administrateur',
                        role: 'admin'
                    };
                    
                    // Sauvegarder dans le localStorage
                    localStorage.setItem('investee_auth', JSON.stringify({
                        user: this.currentUser,
                        timestamp: new Date().getTime()
                    }));
                    
                    this.showAppInterface();
                    resolve(this.currentUser);
                } else {
                    reject(new Error('Email ou mot de passe incorrect'));
                }
            }, 1000);
        });
    }

    logout() {
        this.isAuthenticated = false;
        this.currentUser = null;
        localStorage.removeItem('investee_auth');
        this.showPublicInterface();
    }

    showAppInterface() {
        document.getElementById('app-sidebar').classList.remove('d-none');
        document.getElementById('main-content').classList.add('col-md-9', 'col-lg-10');
        document.getElementById('main-content').classList.remove('col-12');
        
        // Cacher le bouton de connexion dans la navbar
        const loginBtn = document.querySelector('.navbar .btn-outline-primary');
        if (loginBtn) {
            loginBtn.style.display = 'none';
        }
        
        // Afficher le tableau de bord par défaut
        showSection('dashboard-section');
    }

    showPublicInterface() {
        document.getElementById('app-sidebar').classList.add('d-none');
        document.getElementById('main-content').classList.remove('col-md-9', 'col-lg-10');
        document.getElementById('main-content').classList.add('col-12');
        
        // Afficher le bouton de connexion
        const loginBtn = document.querySelector('.navbar .btn-outline-primary');
        if (loginBtn) {
            loginBtn.style.display = 'block';
        }
        
        // Afficher la page d'accueil
        showSection('home-section');
    }
}

// Initialiser le gestionnaire d'authentification
const authManager = new AuthManager();

// Gestion du formulaire de connexion
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            const submitBtn = loginForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Afficher le loading
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Connexion...';
            submitBtn.disabled = true;
            
            try {
                await authManager.login(email, password);
                
                // Fermer le modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
                modal.hide();
                
                // Réinitialiser le formulaire
                loginForm.reset();
                
            } catch (error) {
                alert(error.message);
            } finally {
                // Restaurer le bouton
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
    }
});

function logout() {
    authManager.logout();
}