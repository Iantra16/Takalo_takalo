<!DOCTYPE html>
<html lang="fr" data-bs-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Complétez votre profil - Metis</title>
  
  <!-- Preconnect -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Styles -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  <link rel="stylesheet" crossorigin href="/assets/assets-metis/main-QD_VOj1Y.css">
  
  <!-- Scripts -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="d-flex align-items-center" style="min-height: 100vh;">
<div class="container-fluid p-4">
  <!-- Theme Toggle -->
  <div class="position-absolute top-0 end-0 m-3" x-data="{ theme: localStorage.getItem('theme') || 'light' }">
    <button class="btn btn-outline-secondary" 
            type="button" 
            @click="theme = theme === 'light' ? 'dark' : 'light'; localStorage.setItem('theme', theme); document.documentElement.setAttribute('data-bs-theme', theme)">
      <i class="bi bi-sun-fill" x-show="theme === 'light'"></i>
      <i class="bi bi-moon-fill" x-show="theme === 'dark'" style="display: none;"></i>
    </button>
  </div>

  <!-- Page Header -->
  <div class="d-flex justify-content-center align-items-center mb-4">
    <div>
      <h1 class="h3 mb-0"><i class="bi bi-person-check text-success me-2"></i>Complétez votre profil</h1>
      <p class="text-muted mb-0">Finalisez vos informations pour accéder à votre compte</p>
    </div>
  </div>
  <!-- Profile Completion Form -->
  <div class="row g-4 mb-5 justify-content-center">
    <div class="col-lg-6 col-md-8">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">
            <i class="bi bi-person-plus me-2 text-success"></i>
            Informations Personnelles et Compte
          </h5>
        </div>
        <div class="card-body">
          <form id="completeForm" method="post" action="/complete-profile" novalidate>
            <div id="formStatus" class="alert d-none" role="alert"></div>

            <!-- Email (lecture seule) -->
            <div class="mb-3">
              <label class="form-label">Email</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input 
                  id="email" 
                  name="email" 
                  type="email" 
                  class="form-control" 
                  value="<?= e($values['email'] ?? '') ?>" 
                  readonly>
              </div>
            </div>

            <!-- Nom et Prénom -->
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label">Nom</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-person"></i></span>
                  <input 
                    id="nom" 
                    name="nom" 
                    type="text" 
                    class="form-control <?= cls_invalid($errors,'nom') ?>" 
                    value="<?= e($values['nom'] ?? '') ?>" 
                    placeholder="Votre nom" 
                    required>
                </div>
                <div class="invalid-feedback d-block" id="nomError"><?= e($errors['nom'] ?? '') ?></div>
              </div>

              <div class="col-md-6">
                <label class="form-label">Prénom</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-person"></i></span>
                  <input 
                    id="prenom" 
                    name="prenom" 
                    type="text" 
                    class="form-control <?= cls_invalid($errors,'prenom') ?>" 
                    value="<?= e($values['prenom'] ?? '') ?>" 
                    placeholder="Votre prénom" 
                    required>
                </div>
                <div class="invalid-feedback d-block" id="prenomError"><?= e($errors['prenom'] ?? '') ?></div>
              </div>
            </div>

            <!-- Telephone -->
            <div class="mb-4">
              <label class="form-label">Téléphone</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                <input 
                  id="telephone" 
                  name="telephone" 
                  type="tel" 
                  class="form-control <?= cls_invalid($errors,'telephone') ?>" 
                  value="<?= e($values['telephone'] ?? '') ?>" 
                  placeholder="+33 6 12 34 56 78" 
                  required>
              </div>
              <div class="invalid-feedback d-block" id="telephoneError"><?= e($errors['telephone'] ?? '') ?></div>
            </div>

            <hr class="my-4">

            <!-- Password et Confirm Password -->
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label">Mot de passe</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-lock"></i></span>
                  <input 
                    id="password" 
                    name="password" 
                    type="password" 
                    class="form-control <?= cls_invalid($errors,'password') ?>" 
                    placeholder="Minimum 8 caractères" 
                    required>
                </div>
                <div class="invalid-feedback d-block" id="passwordError"><?= e($errors['password'] ?? '') ?></div>
              </div>

              <div class="col-md-6">
                <label class="form-label">Confirmer le mot de passe</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                  <input 
                    id="confirmPassword" 
                    name="confirmPassword" 
                    type="password" 
                    class="form-control <?= cls_invalid($errors,'confirmPassword') ?>" 
                    placeholder="Confirmez votre mot de passe" 
                    required>
                </div>
                <div class="invalid-feedback d-block" id="confirmPasswordError"><?= e($errors['confirmPassword'] ?? '') ?></div>
              </div>
            </div>

            <div class="mb-4">
              <button type="submit" class="btn btn-success">
                <i class="bi bi-person-plus me-2"></i>Créer mon compte
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <p class="text-center text-muted">
    Déjà connecté ? Retour à la <a href="/login" class="text-primary text-decoration-none">connexion</a>
  </p>
</div>

<script>
  // Initialize theme on page load
  document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-bs-theme', savedTheme);
  });
</script>
<script src="/js/validation-complete-profile.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
