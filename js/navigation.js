// Gestion de la navigation
function showSection(sectionId) {
    // Vérifier l'authentification pour les sections protégées
    const protectedSections = ['dashboard-section', 'clients-section', 'products-section', 'transactions-section'];
    
    if (protectedSections.includes(sectionId) && !authManager.isAuthenticated) {
        // Afficher le modal de connexion
        const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
        return;
    }
    
    // Cacher toutes les sections
    document.querySelectorAll('.section').forEach(section => {
        section.classList.add('d-none');
    });
    
    // Afficher la section demandée
    const targetSection = document.getElementById(sectionId);
    if (targetSection) {
        targetSection.classList.remove('d-none');
        
        // Charger le contenu dynamique si nécessaire
        loadSectionContent(sectionId);
        
        // Mettre à jour la navigation active
        updateActiveNav(sectionId);
    }
}

function loadSectionContent(sectionId) {
    // Charger le contenu des sections dynamiquement
    switch(sectionId) {
        case 'dashboard-section':
            DashboardModule.loadContent();
            break;
        case 'clients-section':
            ClientsModule.loadContent();
            break;
        case 'products-section':
            ProductsModule.loadContent();
            break;
        case 'transactions-section':
            TransactionsModule.loadContent();
            break;
    }
}

function updateActiveNav(sectionId) {
    // Mettre à jour les liens actifs dans la navbar et sidebar
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
    });
    
    const activeLink = document.querySelector(`[onclick="showSection('${sectionId}')"]`);
    if (activeLink) {
        activeLink.classList.add('active');
    }
}

// Navigation initiale
document.addEventListener('DOMContentLoaded', function() {
    showSection('home-section');
});