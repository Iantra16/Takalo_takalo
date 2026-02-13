<?php
$pageTitle = "Accueil - Takalo-takalo";
$currentPage = "home";
$navbarClass = "fixed-top";
$customCSS = "
    .hero-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .feature-card {
        border: none;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        height: 100%;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
    }

    .btn-custom {
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .stats-section {
        background: linear-gradient(45deg, #f8fafc 0%, #e2e8f0 100%);
    }

    .stat-card {
        text-align: center;
        padding: 2rem;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .object-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .object-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .category-badge {
        background: var(--accent-color);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .price-tag {
        background: var(--success-color);
        color: white;
        padding: 8px 15px;
        border-radius: 25px;
        font-weight: 600;
    }
";

include 'templates/header.php';
?>

<!-- Hero Section -->
<section id="home" class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">
                    Donnez une seconde vie à vos objets
                </h1>
                <p class="lead mb-5">
                    Échangez facilement vos vêtements, livres, DVD et bien plus encore avec d'autres utilisateurs. 
                    Takalo-takalo rend l'échange simple, sécurisé et écologique.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="/register" class="btn btn-warning btn-custom btn-lg">
                        <i class="fas fa-rocket me-2"></i>Commencer maintenant
                    </a>
                    <a href="/objects" class="btn btn-outline-light btn-custom btn-lg">
                        <i class="fas fa-search me-2"></i>Parcourir les objets
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="position-relative">
                    <i class="fas fa-exchange-alt" style="font-size: 15rem; opacity: 0.1;"></i>
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <i class="fas fa-heart text-warning" style="font-size: 4rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Comment ça marche -->
<section id="how-it-works" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Comment ça fonctionne ?</h2>
                <p class="lead text-muted">3 étapes simples pour échanger vos objets</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon bg-primary text-white">
                        <i class="fas fa-upload"></i>
                    </div>
                    <h4 class="fw-bold mb-3">1. Ajoutez vos objets</h4>
                    <p class="text-muted">Publiez facilement vos objets avec photos et descriptions détaillées. Fixez un prix estimatif pour faciliter les échanges équitables.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon bg-success text-white">
                        <i class="fas fa-search"></i>
                    </div>
                    <h4 class="fw-bold mb-3">2. Trouvez ce qui vous plaît</h4>
                    <p class="text-muted">Parcourez notre catalogue d'objets par catégorie ou utilisez notre moteur de recherche pour trouver exactement ce que vous cherchez.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon bg-warning text-white">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h4 class="fw-bold mb-3">3. Échangez en toute sécurité</h4>
                    <p class="text-muted">Proposez un échange et communiquez avec les autres utilisateurs. Une fois l'accord conclu, procédez à l'échange en toute confiance.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Objets en vedette -->
<section id="objects" class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Objets en vedette</h2>
                <p class="lead text-muted">Découvrez quelques-uns des objets disponibles à l'échange</p>
            </div>
        </div>
        
        <div class="row g-4">
            <!-- Objet 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="card object-card">
                    <img src="https://via.placeholder.com/400x250/667eea/ffffff?text=T-shirt+Nike" 
                         class="card-img-top" alt="T-shirt Nike" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title fw-bold">T-shirt Nike Rouge</h5>
                            <span class="category-badge">Vêtements</span>
                        </div>
                        <p class="card-text text-muted">T-shirt de sport Nike, taille M, très bon état. Parfait pour le sport ou le casual.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price-tag">25€ estimé</span>
                            <a href="/objects" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Voir détail
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Objet 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="card object-card">
                    <img src="https://via.placeholder.com/400x250/10b981/ffffff?text=Le+Petit+Prince" 
                         class="card-img-top" alt="Livre Le Petit Prince" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title fw-bold">Le Petit Prince</h5>
                            <span class="category-badge">Livres</span>
                        </div>
                        <p class="card-text text-muted">Livre classique de Saint-Exupéry, édition récente en parfait état.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price-tag">8€ estimé</span>
                            <a href="/objects" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Voir détail
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Objet 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="card object-card">
                    <img src="https://via.placeholder.com/400x250/f59e0b/ffffff?text=Avatar+Blu-ray" 
                         class="card-img-top" alt="Film Avatar" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title fw-bold">Avatar - Blu-ray</h5>
                            <span class="category-badge">DVD/Blu-ray</span>
                        </div>
                        <p class="card-text text-muted">Film Avatar de James Cameron en Blu-ray, édition collector avec bonus.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price-tag">15€ estimé</span>
                            <a href="/objects" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Voir détail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="/objects" class="btn btn-primary btn-lg btn-custom">
                <i class="fas fa-th me-2"></i>Voir tous les objets
            </a>
        </div>
    </div>
</section>

<!-- Statistiques -->
<section class="stats-section py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-number text-primary">
                        <i class="fas fa-users mb-3"></i>
                        <div>2,500+</div>
                    </div>
                    <h5 class="fw-bold">Utilisateurs actifs</h5>
                    <p class="text-muted">Des milliers d'utilisateurs échangent chaque jour</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-number text-success">
                        <i class="fas fa-box mb-3"></i>
                        <div>15,000+</div>
                    </div>
                    <h5 class="fw-bold">Objets disponibles</h5>
                    <p class="text-muted">Un large choix d'objets dans toutes les catégories</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-number text-warning">
                        <i class="fas fa-handshake mb-3"></i>
                        <div>8,200+</div>
                    </div>
                    <h5 class="fw-bold">Échanges réussis</h5>
                    <p class="text-muted">Des milliers d'échanges satisfaisants réalisés</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$customJS = "
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des cartes au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observer tous les éléments avec la classe 'feature-card' et 'object-card'
        document.querySelectorAll('.feature-card, .object-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(50px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });

        // Smooth scrolling pour les liens d'ancrage
        document.querySelectorAll('a[href^=\"#\"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>
";

include 'templates/footer.php';
?>