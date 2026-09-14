# 🛍️ Mini E-commerce — Laravel

Une plateforme e-commerce complète développée avec Laravel, incluant un catalogue produits, un panier dynamique, un tunnel de commande, et un espace d'administration complet.

## 🔗 Démo en ligne

👉 **[Voir le site en ligne](https://mini-ecommerce-09i8.onrender.com)**

⚠️ Le site est hébergé sur un plan gratuit : le premier chargement peut prendre 30 à 60 secondes si le site était inactif.

### Identifiants de test

| Rôle | Email | Mot de passe |
|---|---|---|
| Client | test@example.com | password |
| Admin | admin@example.com | password |

## ✨ Fonctionnalités

**Côté client**
- Catalogue de produits avec catégories
- Panier dynamique (ajout, modification, suppression) sans rechargement de page
- Tunnel de commande complet avec gestion d'adresse
- Historique des commandes personnelles
- Authentification (inscription / connexion)

**Côté administration**
- Dashboard avec statistiques (chiffre d'affaires, commandes, stock)
- Gestion des catégories (CRUD)
- Gestion des produits avec upload d'images (CRUD)
- Gestion des commandes avec changement de statut
- Accès protégé par rôle (client / admin)

## 🛠️ Stack technique

- **Backend** : Laravel 12, PHP 8.2
- **Frontend** : Blade, Alpine.js, Tailwind CSS
- **Base de données** : PostgreSQL (production) / MySQL (développement local)
- **Authentification** : Laravel Breeze
- **Déploiement** : Docker, Render

## 📸 Aperçu

![alt text](image-1.png)
![alt text](image-2.png)
![alt text](image-3.png)
![alt text](image-4.png)

## ⚙️ Installation locale

```bash
git clone https://github.com/zzres/mini-ecommerce-laravel.git
cd mini-ecommerce-laravel

composer install
npm install

cp .env.example .env
php artisan key:generate

# Configurer la base de données dans le fichier .env

php artisan migrate --seed
npm run build

php artisan serve
```

## 👤 Auteur

Développé par SAMINZERE ZERO — [lien vers ton profil Codeur.com ou LinkedIn]