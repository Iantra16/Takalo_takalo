<?php
// Configuration de la page
$pageTitle = 'Dashboard - Modern Bootstrap Admin';
$pageDescription = 'Modern Bootstrap 5 Admin Template - Clean, responsive dashboard';
$pageKeywords = 'bootstrap, admin, dashboard, template, modern, responsive';
$pageName = 'dashboard';
$currentPage = 'index';
$bodyClass = 'admin-layout';
$additionalScripts = '';

// Inclure le header
include __DIR__ . '/../inc/header.php';

// Inclure le sidebar
include __DIR__ . '/../inc/sidebar.php';
?>

<div class="container-fluid p-4 p-lg-5">
                <!-- Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-0">
                            <?php 
                            if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
                                echo '<i class="bi bi-shield-check text-danger me-2"></i>Tableau de bord Administrateur';
                            } else {
                                echo '<i class="bi bi-speedometer2 me-2"></i>Tableau de bord';
                            }
                            ?>
                        </h1>
                        <p class="text-muted mb-0">
                            Bienvenue ! Voici vos informations.
                        </p>
                    </div>
                </div>

                <!-- User Profile Information Card -->
                <div class="row g-4 mb-4">
                    <div class="col-xl-6 col-lg-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-person-circle me-2"></i>
                                    <?php 
                                    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
                                        echo 'Profil Administrateur';
                                    } else {
                                        echo 'Profil Utilisateur';
                                    }
                                    ?>
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                                    <!-- Admin Profile -->
                                    <div class="mb-3 d-flex align-items-center">
                                        <i class="bi bi-shield-lock-fill text-danger fs-4 me-3"></i>
                                        <div>
                                            <small class="text-muted d-block">Type de compte</small>
                                            <strong class="text-danger">Administrateur</strong>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex align-items-center">
                                        <i class="bi bi-person-badge-fill text-primary fs-4 me-3"></i>
                                        <div>
                                            <small class="text-muted d-block">Nom d'utilisateur</small>
                                            <strong><?= htmlspecialchars($_SESSION['admin_username'] ?? 'N/A') ?></strong>
                                        </div>
                                    </div>
                                    <div class="alert alert-info mt-3">
                                        <i class="bi bi-info-circle me-2"></i>
                                        Vous êtes connecté en tant qu'administrateur avec des privilèges étendus.
                                    </div>
                                <?php else: ?>
                                    <!-- User Profile -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-person-fill text-primary fs-4 me-3"></i>
                                                <div>
                                                    <small class="text-muted d-block">Nom</small>
                                                    <strong><?= htmlspecialchars($_SESSION['user_nom'] ?? 'N/A') ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-person-fill text-primary fs-4 me-3"></i>
                                                <div>
                                                    <small class="text-muted d-block">Prénom</small>
                                                    <strong><?= htmlspecialchars($_SESSION['user_prenom'] ?? 'N/A') ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-envelope-fill text-success fs-4 me-3"></i>
                                                <div>
                                                    <small class="text-muted d-block">Email</small>
                                                    <strong><?= htmlspecialchars($_SESSION['user_email'] ?? 'N/A') ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-telephone-fill text-warning fs-4 me-3"></i>
                                                <div>
                                                    <small class="text-muted d-block">Téléphone</small>
                                                    <strong>
                                                        <?php 
                                                        // Récupérer le téléphone depuis la base de données
                                                        if (isset($_SESSION['user_id'])) {
                                                            try {
                                                                $pdo = Flight::db();
                                                                $stmt = $pdo->prepare("SELECT telephone FROM users WHERE id = ?");
                                                                $stmt->execute([$_SESSION['user_id']]);
                                                                $userData = $stmt->fetch(PDO::FETCH_ASSOC);
                                                                echo htmlspecialchars($userData['telephone'] ?? 'Non renseigné');
                                                            } catch (Exception $e) {
                                                                echo 'Non disponible';
                                                            }
                                                        } else {
                                                            echo 'Non disponible';
                                                        }
                                                        ?>
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="alert alert-success mt-3">
                                        <i class="bi bi-check-circle me-2"></i>
                                        Votre compte est actif et vérifié.
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-footer bg-light">
                                <div class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil me-1"></i>Modifier le profil
                                    </a>
                                    <a href="/logout" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-box-arrow-right me-1"></i>Déconnexion
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions Card -->
                    <div class="col-xl-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-success text-white">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-lightning-charge me-2"></i>Actions rapides
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                                        <a href="/metis/users" class="btn btn-outline-primary">
                                            <i class="bi bi-people me-2"></i>Gérer les utilisateurs
                                        </a>
                                        <a href="/metis/settings" class="btn btn-outline-secondary">
                                            <i class="bi bi-gear me-2"></i>Paramètres système
                                        </a>
                                        <a href="/metis/reports" class="btn btn-outline-info">
                                            <i class="bi bi-bar-chart me-2"></i>Rapports
                                        </a>
                                    <?php else: ?>
                                        <a href="/metis/messages" class="btn btn-outline-primary">
                                            <i class="bi bi-envelope me-2"></i>Mes messages
                                        </a>
                                        <a href="/metis/settings" class="btn btn-outline-secondary">
                                            <i class="bi bi-gear me-2"></i>Paramètres
                                        </a>
                                        <a href="/metis/help" class="btn btn-outline-info">
                                            <i class="bi bi-question-circle me-2"></i>Aide
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards with Alpine.js -->
                <div class="row g-4 mb-4">
                    <div class="col-xl-3 col-lg-6" x-data="statsCounter(12426, 5)">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="stats-icon bg-primary bg-opacity-10 text-primary">
                                            <i class="bi bi-people"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 text-muted">Total Users</h6>
                                        <h3 class="mb-0" x-text="value.toLocaleString()" data-stat-value>12,426</h3>
                                        <small class="text-success">
                                            <i class="bi bi-arrow-up"></i> +12.5%
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="stats-icon bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-graph-up"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 text-muted">Revenue</h6>
                                        <h3 class="mb-0">$54,320</h3>
                                        <small class="text-success">
                                            <i class="bi bi-arrow-up"></i> +8.2%
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="stats-icon bg-warning bg-opacity-10 text-warning">
                                            <i class="bi bi-bag-check"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 text-muted">Orders</h6>
                                        <h3 class="mb-0">1,852</h3>
                                        <small class="text-danger">
                                            <i class="bi bi-arrow-down"></i> -2.1%
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="stats-icon bg-info bg-opacity-10 text-info">
                                            <i class="bi bi-clock-history"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 text-muted">Avg. Response</h6>
                                        <h3 class="mb-0">2.3s</h3>
                                        <small class="text-success">
                                            <i class="bi bi-arrow-up"></i> +5.4%
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="row g-4 mb-4">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Revenue Overview</h5>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn-outline-primary active" data-chart-period="7d">7D</button>
                                    <button type="button" class="btn btn-outline-primary" data-chart-period="30d">30D</button>
                                    <button type="button" class="btn btn-outline-primary" data-chart-period="90d">90D</button>
                                    <button type="button" class="btn btn-outline-primary" data-chart-period="1y">1Y</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="revenueChart" height="250"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Recent Activity</h5>
                            </div>
                            <div class="card-body">
                                <div class="activity-feed">
                                    <div class="activity-item">
                                        <div class="activity-icon bg-primary bg-opacity-10 text-primary">
                                            <i class="bi bi-person-plus"></i>
                                        </div>
                                        <div class="activity-content">
                                            <p class="mb-1">New user registered</p>
                                            <small class="text-muted">2 minutes ago</small>
                                        </div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="activity-icon bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-bag-check"></i>
                                        </div>
                                        <div class="activity-content">
                                            <p class="mb-1">Order #1234 completed</p>
                                            <small class="text-muted">5 minutes ago</small>
                                        </div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="activity-icon bg-warning bg-opacity-10 text-warning">
                                            <i class="bi bi-exclamation-triangle"></i>
                                        </div>
                                        <div class="activity-content">
                                            <p class="mb-1">Server maintenance scheduled</p>
                                            <small class="text-muted">1 hour ago</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Charts Row -->
                <div class="row g-4 mb-4">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">User Growth (Last 7 Days)</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="userGrowthChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Order Status Distribution</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="orderStatusChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- New Widgets Row -->
                <div class="row g-4 mb-4">
                    <!-- Recent Orders -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Recent Orders</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Customer</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="recent-orders-table">
                                            <!-- Orders will be injected here by dashboard.js -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Storage Status -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Storage Status</h5>
                            </div>
                            <div class="card-body">
                                <div id="storageStatusChart"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sales by Location -->
                <div class="row g-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Sales by Location</h5>
                            </div>
                            <div class="card-body">
                                <div id="salesByLocationChart" style="min-height: 400px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

<?php
// Inclure le footer
include __DIR__ . '/../inc/footer.php';
?>