# projet_symfony

_ creer un controller:
- php bin/console make:controller 

_ creer un controller sans template:
- php bin/console make:controller --no-template

_ Installer Doctrine:
- composer require symfony/orm-pack

_ Créer une entité:
- php bin/console make:entity  // Nom de l'entité en PascalCase

_ Création de la base de donnée, par rapport au .env
- php bin/console doctrine:database:create

_ Connaitre les routes disponibles sur l'application:
- php bin/console debug:router