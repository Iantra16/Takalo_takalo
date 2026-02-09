<?php

namespace app\controllers;

use flight\Engine;
use app\services\Validator;
use app\repositories\UserRepository;

class AuthController {

  protected Engine $app;

  public function __construct(Engine $app) {
      $this->app = $app;
  }

  // ===== LOGIN (EMAIL + MDP) =====
  
  public function showLogin() {
    // Si déjà connecté, rediriger vers home
    if (isset($_SESSION['user_id'])) {
      $this->app->redirect('/home');
      return;
    }

    $this->app->render('auth/login', [
      'values' => ['email' => ''],
      'errors' => ['email' => '', 'password' => ''],
      'errorMsg' => ''
    ]);
  }

  public function postLogin() {
    // Si déjà connecté, rediriger vers home
    if (isset($_SESSION['user_id'])) {
      $this->app->redirect('/home');
      return;
    }

    $pdo  = $this->app->db();
    $repo = new UserRepository($pdo);
    $req  = $this->app->request();

    $input = [
      'email' => $req->data->email ?? '',
      'password' => $req->data->password ?? '',
    ];

    // Validation
    $res = Validator::validateLogin($input);

    if (!$res['ok']) {
      $this->app->render('auth/login', [
        'values' => $res['values'],
        'errors' => $res['errors'],
        'errorMsg' => ''
      ]);
      return;
    }

    // Vérifier si l'email existe
    $user = $repo->findByEmailWithPassword($res['values']['email']);

    if ($user) {
      // User existe - vérifier le mdp
      if (password_verify($input['password'], $user['password_hash'])) {
        // Mdp correct - connexion
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_prenom'] = $user['prenom'];
        $_SESSION['user_email'] = $user['email'];
        
        $this->app->redirect('/home');
        return;
      } else {
        // Mdp incorrect
        $this->app->render('auth/login', [
          'values' => $res['values'],
          'errors' => ['email' => '', 'password' => ''],
          'errorMsg' => 'Mot de passe incorrect.'
        ]);
        return;
      }
    } else {
      // User n'existe pas - sauvegarder en session temporaire et rediriger vers complete-profile
      $_SESSION['temp_email'] = $res['values']['email'];
      $_SESSION['temp_password_hash'] = password_hash($input['password'], PASSWORD_DEFAULT);
      
      $this->app->redirect('/complete-profile');
      return;
    }
  }

  // ===== COMPLETE PROFILE (NOM, PRENOM, TELEPHONE) =====

  public function showCompleteProfile() {
    // Si déjà connecté, rediriger vers home
    if (isset($_SESSION['user_id'])) {
      $this->app->redirect('/home');
      return;
    }

    // Si pas de session temp (email/mdp du login), rediriger vers login
    if (!isset($_SESSION['temp_email']) || !isset($_SESSION['temp_password_hash'])) {
      $this->app->redirect('/login');
      return;
    }

    $this->app->render('auth/complete-profile', [
      'values' => ['email' => $_SESSION['temp_email'], 'nom' => '', 'prenom' => '', 'telephone' => ''],
      'errors' => ['nom' => '', 'prenom' => '', 'telephone' => '']
    ]);
  }

  public function postCompleteProfile() {
    // Si déjà connecté, rediriger vers home
    if (isset($_SESSION['user_id'])) {
      $this->app->redirect('/home');
      return;
    }

    // Si pas de session temp, rediriger vers login
    if (!isset($_SESSION['temp_email']) || !isset($_SESSION['temp_password_hash'])) {
      $this->app->redirect('/login');
      return;
    }

    $pdo  = $this->app->db();
    $repo = new UserRepository($pdo);
    $req  = $this->app->request();

    $input = [
      'nom' => $req->data->nom ?? '',
      'prenom' => $req->data->prenom ?? '',
      'telephone' => $req->data->telephone ?? '',
    ];

    // Validation
    $res = Validator::validateCompleteProfile($input);

    if (!$res['ok']) {
      $this->app->render('auth/complete-profile', [
        'values' => array_merge(['email' => $_SESSION['temp_email']], $res['values']),
        'errors' => $res['errors']
      ]);
      return;
    }

    // Créer le user avec email/mdp de session + nouvelles données
    $userId = $repo->create(
      $res['values']['nom'],
      $res['values']['prenom'],
      $_SESSION['temp_email'],
      $_SESSION['temp_password_hash'],
      $res['values']['telephone']
    );

    // Connecter automatiquement
    session_regenerate_id(true);
    $_SESSION['user_id'] = $userId;
    $_SESSION['user_nom'] = $res['values']['nom'];
    $_SESSION['user_prenom'] = $res['values']['prenom'];
    $_SESSION['user_email'] = $_SESSION['temp_email'];

    // Nettoyer session temporaire
    unset($_SESSION['temp_email']);
    unset($_SESSION['temp_password_hash']);

    $this->app->redirect('/home');
  }

  // ===== LOGOUT =====
  
  public function logout() {
    session_destroy();
    $this->app->redirect('/login');
  }

  // ===== AJAX VALIDATORS =====

  public function validateLoginAjax() {
    header('Content-Type: application/json; charset=utf-8');

    try {
      $req = $this->app->request();

      $input = [
        'email' => $req->data->email ?? '',
        'password' => $req->data->password ?? '',
      ];

      $res = Validator::validateLogin($input);

      $this->app->json([
        'ok' => $res['ok'],
        'errors' => $res['errors'],
        'values' => $res['values'],
      ]);
    } catch (\Throwable $e) {
      http_response_code(500);
      $this->app->json([
        'ok' => false,
        'errors' => ['_global' => 'Erreur serveur lors de la validation.'],
        'values' => []
      ]);
    }
  }

  public function validateCompleteProfileAjax() {
    header('Content-Type: application/json; charset=utf-8');

    try {
      $req = $this->app->request();

      $input = [
        'nom' => $req->data->nom ?? '',
        'prenom' => $req->data->prenom ?? '',
        'telephone' => $req->data->telephone ?? '',
      ];

      $res = Validator::validateCompleteProfile($input);

      $this->app->json([
        'ok' => $res['ok'],
        'errors' => $res['errors'],
        'values' => $res['values'],
      ]);
    } catch (\Throwable $e) {
      http_response_code(500);
      $this->app->json([
        'ok' => false,
        'errors' => ['_global' => 'Erreur serveur lors de la validation.'],
        'values' => []
      ]);
    }
  }
}
