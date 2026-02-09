<?php

/**
 * Helpers globaux pour les vues
 */

if (!function_exists('e')) {
    /**
     * Échappe les caractères HTML
     */
    function e($v)
    {
        return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('cls_invalid')) {
    /**
     * Retourne la classe CSS 'is-invalid' si le champ a une erreur
     */
    function cls_invalid($errors, $field)
    {
        return ($errors[$field] ?? '') !== '' ? 'is-invalid' : '';
    }
}

if (!function_exists('isActive')) {
    /**
     * Retourne 'active' si la page est la page actuelle
     */
    function isActive($page, $currentPage) {
        return $page === $currentPage ? 'active' : '';
    }
}
