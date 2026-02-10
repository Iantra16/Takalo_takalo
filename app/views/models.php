<?php
// Configuration de la page
$pageTitle = 'Messages & Communication';
$pageDescription = 'Real-time messaging and communication center with chat interface';
$pageKeywords = 'bootstrap, admin, dashboard, messages, chat, communication';
$pageName = $page;
$currentPage = $page;
$bodyClass = $page . '-page';
$additionalScripts = '<script type="module" crossorigin src="/assets/assets-metis/messages-ByGNYy7N.js"></script>';

// Inclure le header
include __DIR__ . '/inc/header.php';

// Inclure le sidebar
include __DIR__ . '/inc/sidebar.php';


include __DIR__ . '/pages/' . $page . '.php';
 
// Inclure le footer
include __DIR__ . '/inc/footer.php';
?>