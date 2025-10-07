# Application Symfony - Localisation Bus
##  Description
Système complet de suivi des bus en temps réel avec gestion des arrêts, passages et interface administrateur et conçus avec Symfony 6.4.
##  Fonctionnalités
- **Gestion des arrêts** : Création, modification, suppression d'arrêts avec coordonnées GPS
-  **Gestion des passages** : Planification des horaires par ligne de bus
-  **CRUD complet** : Interfaces complètes pour toutes les opérations
-  **Filtrage intelligent** : Filtrage des passages par ligne de bus
-  **Interface responsive** : Design moderne avec Bootstrap 5
-  **Base de données** : Modèle relationnel avec Doctrine ORM
##  Stack Technique
- **Backend** : Symfony 6.4, PHP 8.1+
- **Base de données** : MySQL 5.7+
- **Frontend** : Bootstrap 5, Twig, JavaScript
- **Outils** : Composer, Doctrine, Migrations
##  Installation Rapide
### Prérequis Obligatoires
- **PHP 8.1** ou supérieur
- **MySQL 5.7** ou supérieur  
- **Composer** (gestionnaire de dépendances PHP)
- **Git** (pour cloner le projet)
### Méthode 1 : Avec Laragon (Recommandé pour Windows)
#### 1. Installer Laragon
```bash
# Télécharger depuis https://laragon.org/download/
# Installer avec Apache, MySQL, PHP 8.1+
```
### 2.Cloner et configurer le projet
```bash
# Cloner le projet
git clone https://github.com/sonia1707/Projet-d-examen-Symfony.git
cd Projet-d-examen-Symfony
# Installer les dépendances
composer install
```
### 3. Configuration base de données
Créez un fichier .env.local à la racine :
```bash
DATABASE_URL="mysql://root:@127.0.0.1:3306/localisation_bus?serverVersion=8.0&charset=utf8mb4"
```
### 4. Initialisation base de données
```bash
# Créer la base
php bin/console doctrine:database:create
# Créer les tables
php bin/console doctrine:migrations:migrate
# Charger les données de test
php bin/console doctrine:fixtures:load
```
### 5. Lancer l'application
```bash
# Démarrer le serveur Symfony
php bin/console server:start
```
### Méthode 2 : Avec XAMPP
1. Installer XAMPP
```bash
# Télécharger depuis https://www.apachefriends.org/
# Installer avec Apache, MySQL, PHP
```
2. Configuration
```bash
# Placer le projet dans : C:\xampp\htdocs\localisation-bus
cd C:\xampp\htdocs\localisation-bus
# Suivre les étapes 2 à 5 de la méthode Laragon
```
### Méthode 3 : Ligne de commande pure
1. Installer les composants
```bash
# Sur Ubuntu/Debian
sudo apt install php8.1 php8.1-mysql mysql-server composer
# Sur Windows, télécharger PHP depuis https://windows.php.net/download/
```
2. Suivre les étapes 2 à 5 de la méthode Laragon

### Accès à l'Application
Une fois lancée, accédez à :
-page d'accueil : http://localhost:8000
-gestion des arrêts : http://localhost:8000/arret/
-gestion des passages : http://localhost:8000/passage/
###  Structure des Données
## Entité Arret
Champ	              Type	                    Description
id	                Integer	                Identifiant unique
nom	               String (255)	              Nom de l'arrêt
latitude	           Float	                Coordonnée GPS latitude
longitude	           Float	                Coordonnée GPS longitude
## Entité Passage

Champ	               Type	                     Description
id	                 Integer	               Identifiant unique
ligne	              String (10)	           Ligne de bus (A, B, C, D)
heureEstimee	       DateTime	              Heure de passage estimée
arret	               Relation	              Arrêt associé (ManyToOne)
### Utilisation de l'Application:
## Pour les administrateurs:
1.Créer des arrêts : Cliquer sur "Nouvel arrêt" et renseigner nom + coordonnées GPS
2.Planifier des passages : Ajouter des horaires par ligne pour chaque arrêt
3.Consulter : Voir tous les arrêts avec leurs passages associés
4.Filtrer : Utiliser le filtre par ligne pour voir les passages spécifiques
## Données de démonstration:
.Le projet inclut automatiquement :
 1- 5 arrêts : Gare Centrale, Place Ville Marie, Université, Hôpital, Stade
 2- 15 passages avec lignes A, B, C, D et horaires variés
### Commandes Utiles
-Gestion du projet:
```bash
# Installer les dépendances
composer install
# Mettre à jour les dépendances
composer update
```
-Base de données:
```bash
# Créer une nouvelle migration
php bin/console make:migration
# Appliquer les migrations
php bin/console doctrine:migrations:migrate
# Vérifier l'état de la base
php bin/console doctrine:schema:validate
# Vider et recharger les données
php bin/console doctrine:fixtures:load
```
-Développement:
```bash
# Vider le cache
php bin/console cache:clear
# Voir toutes les routes
php bin/console debug:router
# Voir les services
php bin/console debug:autowiring
```
### Dépannage Complet:
 1- Problème : "The requested resource was not found"
 ```bash
# Vider le cache et relancer
php bin/console cache:clear
php bin/console server:start
```
2- Problème : Erreur de base de données
 ```bash
# Recréer complètement la base
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
 ```
3- Problème : "Class not found" ou dépendances manquantes
```bash
# Réinstaller les dépendances
rm -rf vendor
composer install
```
4- Problème : Port 8000 déjà utilisé
```bash
# Utiliser un autre port
php bin/console server:start --port=8001
# OU
php -S localhost:8080 -t public
```
5- Problème : Accès refusé à MySQL:
-vérifier que MySQL est démarré
-vérifier les identifiants dans .env.local
-tester la connexion :
```bash
mysql -u root -p
```



