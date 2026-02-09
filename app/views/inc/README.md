# 📚 Guide d'utilisation des includes

## Structure créée

```
app/views/inc/
├── header.php   - En-tête HTML + navbar
├── sidebar.php  - Menu latéral
└── footer.php   - Footer + scripts
```

## 🎯 Comment utiliser dans vos vues

### 1. Configuration en haut du fichier

```php
<?php
// Variables de configuration (AVANT les includes)
$pageTitle = 'Titre de la page';
$pageDescription = 'Description meta';
$pageKeywords = 'mots, clés, seo';
$pageName = 'nom-page';  // Pour data-page et classes CSS
$currentPage = 'dashboard';  // Pour activer le menu
$bodyClass = 'admin-layout';  // Classe CSS du body (messages-page, analytics-page, etc.)
$additionalScripts = '<script src="/custom.js"></script>';  // Scripts supplémentaires (optionnel)

// Inclure header et sidebar
include __DIR__ . '/../inc/header.php';
include __DIR__ . '/../inc/sidebar.php';
?>
```

### 2. Contenu de votre page

```php
            <div class="container-fluid p-4 p-lg-5">
                <!-- Votre contenu ici -->
                <h1>Mon contenu</h1>
            </div>
```

### 3. Footer à la fin

```php
<?php
include __DIR__ . '/../inc/footer.php';
?>
```

## 📋 Variables disponibles

### header.php
- `$pageTitle` - Titre dans `<title>` et Open Graph
- `$pageDescription` - Meta description
- `$pageKeywords` - Meta keywords
- `$pageName` - Attribut `data-page` sur `<body>`
- `$bodyClass` - Classe CSS du `<body>` (ex: messages-page, analytics-page, admin-layout)
- `$additionalScripts` - Scripts supplémentaires à charger

### sidebar.php
- `$currentPage` - Page active (valeurs possibles: dashboard, analytics, users, products, orders, forms, elements, reports, messages, calendar, files, settings, security, help)

### footer.php
- Aucune variable requise (année dynamique)

## ✅ Avantages

1. **DRY** : Code header/footer écrit une seule fois
2. **Maintenance** : Modifier un fichier met à jour toutes les pages
3. **Cohérence** : Même structure partout
4. **Flexibilité** : Variables pour personnaliser chaque page
5. **Sécurité** : Nom utilisateur affiché automatiquement depuis session
6. **Menu actif** : Gestion automatique du menu actif

## 🔄 Migration des fichiers existants

Pour migrer un fichier existant:

1. Copier les variables de config en haut
2. Remplacer tout le code avant `<main>` par les includes header + sidebar
3. Garder uniquement le contenu de `<main>`
4. Remplacer tout après `</main>` par l'include du footer

## 📝 Exemple complet

Voir `/app/views/metis/index_example.php` pour un exemple complet d'utilisation.

## 🎨 Personnalisation

- **Header** : Modifier `/app/views/inc/header.php`
- **Sidebar** : Modifier `/app/views/inc/sidebar.php`
- **Footer** : Modifier `/app/views/inc/footer.php`

Les changements seront appliqués à toutes les pages automatiquement.
