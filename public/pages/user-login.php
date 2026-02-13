<?php
$pageTitle = "Connexion Utilisateur - Takalo-takalo";
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
        border-radius: 25px;
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        padding: 3rem;
        max-width: 450px;
    }

    .login-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .login-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2rem;
    }

    .form-floating {
        margin-bottom: 1rem;
    }

    .form-control {
        border-radius: 15px;
        border: 2px solid #e2e8f0;
        padding: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn-login {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        border: none;
        border-radius: 15px;
        padding: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .divider {
        text-align: center;
        margin: 2rem 0;
        position: relative;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #e2e8f0;
    }

    .divider span {
        background: white;
        padding: 0 1rem;
        color: #64748b;
        font-size: 0.9rem;
    }

    .social-login {
        border: 2px solid #e2e8f0;
        border-radius: 15px;
        padding: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-bottom: 0.5rem;
    }

    .social-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .social-login.google {
        background: #db4437;
        border-color: #db4437;
        color: white;
    }

    .social-login.facebook {
        background: #3b5998;
        border-color: #3b5998;
        color: white;
    }

    .back-btn {
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

    .back-btn:hover {
        background: white;
        color: var(--primary-color);
        transform: translateX(-5px);
        text-decoration: none;
    }

    .forgot-password {
        color: var(--primary-color);
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .forgot-password:hover {
        color: var(--secondary-color);
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .login-container {
            margin: 1rem;
            padding: 2rem 1.5rem;
        }
    }
";

include 'templates/header.php';
?>

<a href="/login" class="back-btn">
    <i class="fas fa-arrow-left me-2"></i>Retour
</a>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="login-container mx-auto">
                <div class="login-header">
                    <div class="login-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <h2 class="fw-bold">Connexion Utilisateur</h2>
                    <p class="text-muted mb-0">Accédez à votre espace personnel</p>
                </div>

                <form id="loginForm">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
                        <label for="email">
                            <i class="fas fa-envelope me-2"></i>Adresse e-mail
                        </label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" placeholder="Mot de passe" required>
                        <label for="password">
                            <i class="fas fa-lock me-2"></i>Mot de passe
                        </label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label" for="remember">
                                Se souvenir de moi
                            </label>
                        </div>
                        <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                    </div>

                    <button type="submit" class="btn btn-login btn-primary w-100 mb-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                    </button>
                </form>

                <div class="divider">
                    <span>ou continuer avec</span>
                </div>

                <div class="row g-2 mb-4">
                    <div class="col-6">
                        <button class="btn social-login google w-100">
                            <i class="fab fa-google me-2"></i>Google
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn social-login facebook w-100">
                            <i class="fab fa-facebook-f me-2"></i>Facebook
                        </button>
                    </div>
                </div>

                <div class="text-center">
                    <p class="mb-0">
                        Vous n'avez pas de compte ?
                        <a href="/register" class="text-primary fw-bold text-decoration-none">
                            Créer un compte
                        </a>
                    </p>
                </div>

                <!-- Informations de sécurité -->
                <div class="mt-4 p-3 bg-light rounded-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-shield-alt text-success me-2"></i>
                        <small class="text-muted">
                            Connexion sécurisée par chiffrement SSL
                        </small>
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
        // Animation d'entrée du container
        const container = document.querySelector('.login-container');
        container.style.opacity = '0';
        container.style.transform = 'translateY(50px)';
        
        setTimeout(() => {
            container.style.transition = 'all 0.8s ease';
            container.style.opacity = '1';
            container.style.transform = 'translateY(0)';
        }, 100);

        // Validation du formulaire
        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        // Validation en temps réel
        emailInput.addEventListener('input', function() {
            validateEmail(this);
        });

        passwordInput.addEventListener('input', function() {
            validatePassword(this);
        });

        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = emailInput.value.trim();
            const password = passwordInput.value.trim();
            
            if (validateForm(email, password)) {
                // Simulation de connexion
                showLoading();
                
                setTimeout(() => {
                    // Redirection vers le dashboard
                    window.location.href = '/dashboard';
                }, 1500);
            }
        });

        function validateEmail(input) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const isValid = emailRegex.test(input.value);
            
            updateFieldValidation(input, isValid);
            return isValid;
        }

        function validatePassword(input) {
            const isValid = input.value.length >= 6;
            
            updateFieldValidation(input, isValid);
            return isValid;
        }

        function updateFieldValidation(input, isValid) {
            if (isValid) {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            } else {
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
            }
        }

        function validateForm(email, password) {
            const emailValid = validateEmail(emailInput);
            const passwordValid = validatePassword(passwordInput);
            
            return emailValid && passwordValid;
        }

        function showLoading() {
            const submitBtn = loginForm.querySelector('button[type=\"submit\"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.innerHTML = '<i class=\"fas fa-spinner fa-spin me-2\"></i>Connexion...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 2000);
        }

        // Animation des boutons sociaux
        document.querySelectorAll('.social-login').forEach(btn => {
            btn.addEventListener('click', function() {
                const platform = this.textContent.trim();
                alert(`Connexion avec ${platform} - Fonctionnalité à venir`);
            });
        });
    });
</script>
";

include 'templates/footer.php';
?>