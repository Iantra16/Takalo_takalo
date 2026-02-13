<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Takalo-takalo'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #06b6d4;
            --accent-color: #f59e0b;
            --success-color: #10b981;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
        }

        body {
            background: #f8fafc;
        }

        <?php if (isset($customCSS)) echo $customCSS; ?>
    </style>
    <?php if (isset($additionalCSS)) echo $additionalCSS; ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark <?php echo $navbarClass ?? 'fixed-top'; ?>">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-exchange-alt me-2"></i>Takalo-takalo
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage ?? '') === 'home' ? 'active' : ''; ?>" href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage ?? '') === 'objects' ? 'active' : ''; ?>" href="/objects">Objets</a>
                    </li>
                    <?php if (isset($isLoggedIn) && $isLoggedIn): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($currentPage ?? '') === 'dashboard' ? 'active' : ''; ?>" href="/dashboard">Mon compte</a>
                    </li>
                    <?php endif; ?>
                </ul>
                
                <ul class="navbar-nav">
                    <?php if (isset($isLoggedIn) && $isLoggedIn): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i><?php echo $userName ?? 'Utilisateur'; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/dashboard"><i class="fas fa-user me-2"></i>Mon profil</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Paramètres</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="/login"><i class="fas fa-sign-out-alt me-2"></i>Déconnexion</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">
                                <i class="fas fa-sign-in-alt me-1"></i>Connexion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">
                                <i class="fas fa-user-plus me-1"></i>Inscription
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>