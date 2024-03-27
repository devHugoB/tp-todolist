# Environnement de tests - TP todolist

Projet pour le TP : **Mise en Place d'un Pipeline CI/CD avec GitHub Actions et Déploiement d'une Application Todolist avec Docker**.

## Technologies

![PHP 8.3](https://img.shields.io/badge/php%208.2-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)

![Symfony 7.0](https://img.shields.io/badge/symfony%207.0-%23000000.svg?style=for-the-badge&logo=symfony&logoColor=white)

![MySQL 8](https://img.shields.io/badge/mysql%208.0-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)

## Installation

#### Cloner le projet
```bash
git clone https://github.com/devHugoB/tp-todolist
```

#### Installer les dépendances avec composer
```bash
composer install
```

#### Créer la base de données et exécuter les migrations
```bash
# Les accèes à changer si nécessaire sont dans le fichier .env ligne 27

symfony console d:d:c

symfony console d:m:m
```

#### Lancer le projet
```bash
symfony server:start -d
```

---

Créer par la Nuuk Squad
