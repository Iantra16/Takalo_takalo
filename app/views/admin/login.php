<!DOCTYPE html>
<html lang="fr" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion Admin - Metis</title>
  
  <!-- Preconnect -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Styles -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/css/auth.css">
  
  <!-- Scripts -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="d-flex align-items-center" style="min-height: 100vh;">
  <div class="container-fluid p-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-center align-items-center mb-4">
      <div class="text-center">
        <h1 class="h3 mb-0">
          <i class="bi bi-shield-lock-fill text-danger me-2"></i>
          Connexion Administrateur
        </h1>
        <p class="text-muted mb-0">Accès réservé aux administrateurs</p>
      </div>

      <!-- Theme Toggle -->
      <div class="position-absolute top-0 end-0 m-3" x-data="{ theme: localStorage.getItem('theme') || 'light' }">
        <button class="btn btn-outline-secondary"
          type="button"
          @click="theme = theme === 'light' ? 'dark' : 'light'; localStorage.setItem('theme', theme); document.documentElement.setAttribute('data-bs-theme', theme)">
          <i class="bi bi-sun-fill" x-show="theme === 'light'"></i>
          <i class="bi bi-moon-fill" x-show="theme === 'dark'" style="display: none;"></i>
        </button>
      </div>
    </div>

    <!-- Login Form -->
    <div class="row g-4 justify-content-center">
      <div class="col-lg-5 col-md-6">
        <div class="card border-danger">
          <div class="card-header bg-danger text-white">
            <h5 class="card-title mb-0">
              <i class="bi bi-person-badge me-2"></i>
              Authentification Admin
            </h5>
          </div>
          <div class="card-body">
            <?php if (!empty($errorMsg)): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>
                <?= e($errorMsg) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            <?php endif; ?>

            <form method="post" action="/admin/login">
              <div class="mb-3">
                <label class="form-label">Nom d'utilisateur</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                  <input
                    name="username"
                    type="text"
                    class="form-control"
                    value="<?= e($values['username'] ?? '') ?>"
                    placeholder="admin"
                    required>
                </div>
              </div>

              <div class="mb-4">
                <label class="form-label">Mot de passe</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                  <input
                    name="password"
                    type="password"
                    class="form-control"
                    placeholder="Votre mot de passe admin"
                    required>
                </div>
              </div>

              <button class="btn btn-danger w-100" type="submit">
                <i class="bi bi-shield-check me-2"></i>Connexion Admin
              </button>
            </form>

            <hr class="my-4">
            
            <div class="text-center">
              <a href="/login" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Retour à la connexion utilisateur
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Initialize theme on page load
    document.addEventListener('DOMContentLoaded', () => {
      const savedTheme = localStorage.getItem('theme') || 'light';
      document.documentElement.setAttribute('data-bs-theme', savedTheme);
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
