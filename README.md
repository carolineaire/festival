# Festival Application

Bienvenue dans l'application Festival, développée avec Symfony. Cette application permet de gérer les événements, les artistes et les participants d'un festival.

## Prérequis

- PHP >= 7.4
- Composer
- Symfony CLI
- MySQL

## Installation

1. Clonez le dépôt :
    ```bash
    git clone https://github.com/votre-utilisateur/festival.git
    cd festival
    ```

2. Installez les dépendances :
    ```bash
    composer install
    ```

3. Configurez la base de données dans le fichier `.env` :
    ```env
    DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
    ```

4. Créez la base de données et exécutez les migrations :
    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```

5. Chargez les fixtures (données de démonstration) :
    ```bash
    php bin/console doctrine:fixtures:load
    ```

## Utilisation

Démarrez le serveur de développement Symfony :
```bash
symfony server:start
```

Accédez à l'application via [http://localhost:8000](http://localhost:8000).

## Tests

Pour exécuter les tests, utilisez la commande suivante :
```bash
php bin/phpunit
```

## Contribuer

Les contributions sont les bienvenues ! Veuillez soumettre une pull request ou ouvrir une issue pour discuter des changements que vous souhaitez apporter.

## Licence

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

## Auteurs

- Caroline Noblet - Développeur principal

Merci d'utiliser l'application Festival !