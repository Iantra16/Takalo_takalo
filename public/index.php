<?php

/**********************************************
 *         Takalo-takalo - Template System    *
 **********************************************
 * Router avec système de templates PHP
 **********************************************/

// Simple router pour les pages avec templates
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);

// Routes vers les pages avec templates PHP
switch ($path) {
    case '/':
    case '/index':
    case '/home':
        include __DIR__ . '/pages/home.php';
        break;
        
    case '/login':
    case '/connexion':
        include __DIR__ . '/pages/login-selector.php';
        break;
        
    case '/login/user':
    case '/user-login':
    case '/auth/login':
        include __DIR__ . '/pages/user-login.php';
        break;
        
    case '/login/admin':
    case '/admin-login':
    case '/admin/login':
        readfile(__DIR__ . '/admin-login.html');
        break;
        
    case '/register':
    case '/auth/register':
        readfile(__DIR__ . '/register.html');
        break;
        
    case '/objects':
    case '/catalogue':
        readfile(__DIR__ . '/objects.html');
        break;
        
    case '/dashboard':
    case '/mon-compte':
        readfile(__DIR__ . '/dashboard.html');
        break;
        
    case '/admin':
    case '/admin/dashboard':
        readfile(__DIR__ . '/admin-dashboard.html');
        break;
        
    default:
        // Vérifier si le fichier demandé existe
        $file_path = __DIR__ . $path;
        if (file_exists($file_path) && is_file($file_path)) {
            // Servir le fichier directement (CSS, JS, images, etc.)
            $mime_type = mime_content_type($file_path);
            header('Content-Type: ' . $mime_type);
            readfile($file_path);
        } else {
            // Page 404
            http_response_code(404);
            echo '<h1>404 - Page non trouvée</h1>';
            echo '<p><a href="/">Retour à l\'accueil</a></p>';
        }
        break;
}
