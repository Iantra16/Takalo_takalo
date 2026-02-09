<!DOCTYPE html>
<html lang="fr" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion - Metis</title>
  
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
      <div>
        <h1 class="h3 mb-0"><i class="bi bi-lock-fill text-primary me-2"></i>Connexion</h1>
        <p class="text-muted mb-0">Accédez à votre compte avec vos identifiants</p>
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
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">
              <i class="bi bi-envelope me-2 text-primary"></i>
              Authentification
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

            <form id="loginForm" method="post" action="/login" novalidate>
              <div id="formStatus" class="alert d-none" role="alert"></div>

              <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                  <input
                    id="email"
                    name="email"
                    type="email"
                    class="form-control <?= cls_invalid($errors, 'email') ?>"
                    value="<?= e($values['email'] ?? '') ?>"
                    placeholder="votre.email@exemple.com"
                    required>
                </div>
                <div class="invalid-feedback d-block" id="emailError"><?= e($errors['email'] ?? '') ?></div>
              </div>

              <div class="mb-4">
                <label class="form-label">Mot de passe</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-lock"></i></span>
                  <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control <?= cls_invalid($errors, 'password') ?>"
                    placeholder="Votre mot de passe"
                    required>
                </div>
                <div class="invalid-feedback d-block" id="passwordError"><?= e($errors['password'] ?? '') ?></div>
              </div>

              <button class="btn btn-primary w-100" type="submit">
                <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <p class="text-center text-muted mt-4">
      Première connexion ? Auto-inscription avec complétude du profil
    </p>
  </div>

  <script>
    // Initialize theme on page load
    document.addEventListener('DOMContentLoaded', () => {
      const savedTheme = localStorage.getItem('theme') || 'light';
      document.documentElement.setAttribute('data-bs-theme', savedTheme);
    });
  </script>
  <script src="/js/validation-ajax.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>