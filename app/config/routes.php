<?php

use app\controllers\AuthController;
use app\controllers\MessageController;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// Instancier les contrôleurs avec injection de dépendances
$authController = new AuthController($app);
$messageController = new MessageController($app);

// Wrapper pour toutes les routes
$router->group('', function(Router $router) use ($app, $authController, $messageController) {

	// ===== AUTHENTICATION ROUTES =====
	$router->get('/', [$authController, 'showLogin']);
	$router->get('/login', [$authController, 'showLogin']);
	$router->post('/login', [$authController, 'postLogin']);
	$router->post('/api/validate/login', [$authController, 'validateLoginAjax']);

	// Complete Profile (nom, prenom, telephone)
	$router->get('/complete-profile', [$authController, 'showCompleteProfile']);
	$router->post('/complete-profile', [$authController, 'postCompleteProfile']);
	$router->post('/api/validate/complete-profile', [$authController, 'validateCompleteProfileAjax']);

	// Logout
	$router->get('/logout', [$authController, 'logout']);

	// ===== PROTECTED ROUTES =====
	
	// Home (protected)
	$router->get('/home', function() use ($app) {
		if (!isset($_SESSION['user_id'])) {
			$app->redirect('/login');
			return;
		}
		
		$app->render('metis/index', [
			'user' => [
				'nom' => $_SESSION['user_nom'] ?? '',
				'prenom' => $_SESSION['user_prenom'] ?? '',
				'email' => $_SESSION['user_email'] ?? ''
			]
		]);
	});

	// Metis admin template pages
	$router->get('/metis(/@page)', function($page = 'index') use ($app) {
		$page = $page ?? 'index';
		$page = preg_replace('/\.(html|php)$/i', '', $page);
		$safePage = basename($page);
		$file = __DIR__ . '/../views/metis/' . $safePage . '.php';

		if (!is_file($file)) {
			$app->notFound();
			return;
		}

		$app->render('metis/' . $safePage);
	});

	// ===== MESSAGE ROUTES =====
	$router->group('/messages', function(Router $router) use ($messageController) {
		$router->get('/chat', [$messageController, 'chat']);
	});

	// ===== MESSAGE API ROUTES =====
	$router->group('/api/messages', function(Router $router) use ($messageController) {
		$router->get('/conversations', [$messageController, 'getConversations']);
		$router->get('/get', [$messageController, 'getMessages']);
		$router->post('/send', [$messageController, 'sendMessage']);
		$router->post('/create-conversation', [$messageController, 'createConversation']);
		$router->get('/users', [$messageController, 'getAllUsers']);
		$router->get('/available-users', [$messageController, 'getAvailableUsers']);
	});

});
