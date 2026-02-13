<?php
$pageTitle = "Connexion - Takalo-takalo";
$currentPage = "login";
$customCSS = "
    body {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .login-container {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 30px;
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        padding: 3rem;
    }

    .login-option {
        border: 2px solid #e2e8f0;
        border-radius: 20px;
        padding: 2.5rem 2rem;
        text-align: center;
        transition: all 0.3s ease;
        background: white;
        text-decoration: none;
        color: inherit;
        display: block;
        height: 100%;
    }

    .login-option:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        border-color: var(--primary-color);
        color: inherit;
        text-decoration: none;
    }

    .login-option.admin {
        background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
        color: white;
        border-color: #dc3545;
    }

    .login-option.admin:hover {
        color: white;
        border-color: #dc3545;
        box-shadow: 0 15px 35px rgba(220, 53, 69, 0.3);
    }

    .login-option.user {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        border-color: var(--primary-color);
    }

    .login-option.user:hover {
        color: white;
        border-color: var(--primary-color);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3);
    }

    .icon-wrapper {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 3rem;
        background: rgba(255, 255, 255, 0.2);
        border: 3px solid rgba(255, 255, 255, 0.3);
    }

    .login-option:not(.admin):not(.user) .icon-wrapper {
        background: #f8f9fa;
        color: var(--primary-color);
        border-color: #e9ecef;
    }

    .back-home {
        position: absolute;
        top: 30px;
        left: 30px;
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 50px;
        padding: 10px 20px;
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .back-home:hover {
        background: white;
        color: var(--primary-color);
        transform: translateX(-5px);
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .login-container {
            margin: 1rem;
            padding: 2rem 1.5rem;
        }
        
        .login-option {
            padding: 2rem 1rem;
            margin-bottom: 1rem;
        }
    }
";

include 'templates/header.php';
?>

<a href="/" class="back-home">
    <i class="fas fa-arrow-left me-2"></i>Retour à l'accueil
</a>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="login-container">
                <div class="text-center mb-5">
                    <h1 class="display-5 fw-bold mb-3">
                        <i class="fas fa-exchange-alt text-primary me-3"></i>
                        Takalo-takalo
                    </h1>
                    <h2 class="h3 fw-bold mb-3">Comment souhaitez-vous vous connecter ?</h2>
                    <p class="lead text-muted">Choisissez le type de compte qui correspond à votre profil</p>
                </div>

                <div class="row g-4">
                    <!-- Connexion Utilisateur -->
                    <div class="col-md-6">
                        <a href="/user-login" class="login-option user">
                            <div class="icon-wrapper">
                                <i class="fas fa-user"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Utilisateur</h4>
                            <p class="mb-0">
                                Échangez vos objets avec d'autres utilisateurs, proposez des échanges et gérez votre collection personnelle.
                            </p>
                            <div class="mt-3">
                                <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                    <i class="fas fa-exchange-alt me-1"></i>Échanges
                                </span>
                            </div>
                        </a>
                    </div>

                    <!-- Connexion Administrateur -->
                    <div class="col-md-6">
                        <a href="/admin-login" class="login-option admin">
                            <div class="icon-wrapper">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Administrateur</h4>
                            <p class="mb-0">
                                Gérez la plateforme, modérez les échanges, administrez les utilisateurs et supervisez le système.
                            </p>
                            <div class="mt-3">
                                <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                    <i class="fas fa-cogs me-1"></i>Administration
                                </span>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Section d'aide -->
                <div class="mt-5 pt-4 border-top">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <i class="fas fa-user-plus text-primary fs-3"></i>
                            </div>
                            <h6 class="fw-bold">Nouveau sur Takalo-takalo ?</h6>
                            <a href="/register" class="btn btn-outline-primary btn-sm mt-2">
                                Créer un compte
                            </a>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <i class="fas fa-question-circle text-success fs-3"></i>
                            </div>
                            <h6 class="fw-bold">Besoin d'aide ?</h6>
                            <a href="#" class="btn btn-outline-success btn-sm mt-2">
                                Centre d'aide
                            </a>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <i class="fas fa-lock text-warning fs-3"></i>
                            </div>
                            <h6 class="fw-bold">Mot de passe oublié ?</h6>
                            <a href="#" class="btn btn-outline-warning btn-sm mt-2">
                                Récupérer
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Informations de sécurité -->
                <div class="mt-4 p-3 bg-light rounded-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-shield-alt text-success me-3 fs-4"></i>
                        <div>
                            <h6 class="fw-bold mb-1">Connexion sécurisée</h6>
                            <small class="text-muted">
                                Vos données sont protégées par un chiffrement SSL et nos protocoles de sécurité avancés.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$customJS = "
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation d'entrée pour les options de connexion
        const loginOptions = document.querySelectorAll('.login-option');
        
        loginOptions.forEach((option, index) => {
            option.style.opacity = '0';
            option.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                option.style.transition = 'all 0.6s ease';
                option.style.opacity = '1';
                option.style.transform = 'translateY(0)';
            }, 200 * (index + 1));
        });

        // Effet de hover personnalisé
        loginOptions.forEach(option => {
            option.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            option.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Animation du container principal
        const container = document.querySelector('.login-container');
        container.style.opacity = '0';
        container.style.transform = 'translateY(50px)';
        
        setTimeout(() => {
            container.style.transition = 'all 0.8s ease';
            container.style.opacity = '1';
            container.style.transform = 'translateY(0)';
        }, 100);
    });
</script>
";

include 'templates/footer.php';
?>