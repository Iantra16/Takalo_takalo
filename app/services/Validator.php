<?php

namespace app\services;

use app\repositories\UserRepository;

class Validator {

  public static function normalizeTelephone($tel) {
    return preg_replace('/\s+/', '', trim((string)$tel));
  }

  // ===== LOGIN =====
  public static function validateLogin(array $input) {
    $errors = [
      'email' => '', 'password' => ''
    ];

    $values = [
      'email' => trim((string)($input['email'] ?? '')),
    ];

    $password = (string)($input['password'] ?? '');

    if ($values['email'] === '') $errors['email'] = "L'email est obligatoire.";
    elseif (!filter_var($values['email'], FILTER_VALIDATE_EMAIL))
      $errors['email'] = "L'email n'est pas valide (ex: nom@domaine.com).";

    if (strlen($password) < 8) $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères.";

    $ok = true;
    foreach ($errors as $m) { if ($m !== '') { $ok = false; break; } }

    return ['ok' => $ok, 'errors' => $errors, 'values' => $values];
  }

  // ===== COMPLETE PROFILE =====
  public static function validateCompleteProfile(array $input) {
    $errors = [
      'nom' => '', 'prenom' => '', 'telephone' => ''
    ];

    $values = [
      'nom' => trim((string)($input['nom'] ?? '')),
      'prenom' => trim((string)($input['prenom'] ?? '')),
      'telephone' => self::normalizeTelephone($input['telephone'] ?? ''),
    ];

    if (mb_strlen($values['nom']) < 2) $errors['nom'] = "Le nom doit contenir au moins 2 caractères.";
    if (mb_strlen($values['prenom']) < 2) $errors['prenom'] = "Le prénom doit contenir au moins 2 caractères.";

    $tel = $values['telephone'];
    if (strlen($tel) < 8 || strlen($tel) > 15) $errors['telephone'] = "Le téléphone doit contenir entre 8 et 15 chiffres.";
    elseif (!preg_match('/^[0-9]+$/', $tel)) $errors['telephone'] = "Le téléphone ne doit contenir que des chiffres.";

    $ok = true;
    foreach ($errors as $m) { if ($m !== '') { $ok = false; break; } }

    return ['ok' => $ok, 'errors' => $errors, 'values' => $values];
  }

  
}

