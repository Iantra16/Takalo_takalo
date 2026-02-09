<?php
// Configuration du menu (à définir avant d'inclure le sidebar)
// $currentPage - Nom de la page active (pour highlight du menu)

$currentPage = $currentPage ?? '';
?>
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="admin-sidebar">
            <div class="sidebar-content">
                <nav class="sidebar-nav">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActive('dashboard', $currentPage); ?>" href="/metis/index">
                                <i class="bi bi-speedometer2"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActive('analytics', $currentPage); ?>" href="/metis/analytics">
                                <i class="bi bi-graph-up"></i>
                                <span>Analytics</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActive('users', $currentPage); ?>" href="/metis/users">
                                <i class="bi bi-people"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActive('products', $currentPage); ?>" href="/metis/products">
                                <i class="bi bi-box"></i>
                                <span>Products</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActive('orders', $currentPage); ?>" href="/metis/orders">
                                <i class="bi bi-bag-check"></i>
                                <span>Orders</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActive('forms', $currentPage); ?>" href="/metis/forms">
                                <i class="bi bi-ui-checks"></i>
                                <span>Forms</span>
                                <span class="badge bg-success rounded-pill ms-auto">New</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#elementsSubmenu" aria-expanded="false">
                                <i class="bi bi-puzzle"></i>
                                <span>Elements</span>
                                <span class="badge bg-primary rounded-pill ms-2 me-2">New</span>
                                <i class="bi bi-chevron-down ms-auto"></i>
                            </a>
                            <div class="collapse" id="elementsSubmenu">
                                <ul class="nav nav-submenu">
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo isActive('elements', $currentPage); ?>" href="/metis/elements">
                                            <i class="bi bi-grid"></i>
                                            <span>Overview</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo isActive('elements-buttons', $currentPage); ?>" href="/metis/elements-buttons">
                                            <i class="bi bi-square"></i>
                                            <span>Buttons</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo isActive('elements-alerts', $currentPage); ?>" href="/metis/elements-alerts">
                                            <i class="bi bi-exclamation-triangle"></i>
                                            <span>Alerts</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo isActive('elements-badges', $currentPage); ?>" href="/metis/elements-badges">
                                            <i class="bi bi-award"></i>
                                            <span>Badges</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo isActive('elements-cards', $currentPage); ?>" href="/metis/elements-cards">
                                            <i class="bi bi-card-text"></i>
                                            <span>Cards</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo isActive('elements-modals', $currentPage); ?>" href="/metis/elements-modals">
                                            <i class="bi bi-window"></i>
                                            <span>Modals</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo isActive('elements-forms', $currentPage); ?>" href="/metis/elements-forms">
                                            <i class="bi bi-ui-checks"></i>
                                            <span>Forms</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo isActive('elements-tables', $currentPage); ?>" href="/metis/elements-tables">
                                            <i class="bi bi-table"></i>
                                            <span>Tables</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActive('reports', $currentPage); ?>" href="/metis/reports">
                                <i class="bi bi-file-earmark-text"></i>
                                <span>Reports</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActive('messages', $currentPage); ?>" href="/metis/messages">
                                <i class="bi bi-chat-dots"></i>
                                <span>Messages</span>
                                <?php if ($currentPage === 'messages'): ?>
                                <span class="badge bg-primary rounded-pill ms-auto">Active</span>
                                <?php else: ?>
                                <span class="badge bg-danger rounded-pill ms-auto">3</span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActive('calendar', $currentPage); ?>" href="/metis/calendar">
                                <i class="bi bi-calendar-event"></i>
                                <span>Calendar</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActive('files', $currentPage); ?>" href="/metis/files">
                                <i class="bi bi-folder2-open"></i>
                                <span>Files</span>
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <small class="text-muted px-3 text-uppercase fw-bold">Admin</small>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActive('settings', $currentPage); ?>" href="/metis/settings">
                                <i class="bi bi-gear"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActive('security', $currentPage); ?>" href="/metis/security">
                                <i class="bi bi-shield-check"></i>
                                <span>Security</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActive('help', $currentPage); ?>" href="/metis/help">
                                <i class="bi bi-question-circle"></i>
                                <span>Help & Support</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Floating Hamburger Menu -->
        <button class="hamburger-menu" 
                type="button" 
                data-sidebar-toggle
                aria-label="Toggle sidebar">
            <i class="bi bi-list"></i>
        </button>

        <!-- Main Content -->
        <main class="admin-main">
