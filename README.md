# Thunder_Store
## Initialisation du projet

-   Cloner le projet;
-   Créer une base de donnée appelée "thunder_store".
-   Dupliquer le .env.example en .env et le configurer. (APP_URL, DB_DATABASE, DB_USERNAME, DB_PASSWORD)
-   Lancer `composer update` dans la console;
-   Lancer `php artisan key:generate` dans la console;
-   Lancer `php artisan migrate:fresh --seed` dans la console;
        (Donne une erreur de temps en temps, il faut juste relancer la commande)
-   Lancer `npm install` dans la console.

Voilà le projet est initialisé et la base de donnée est migrée avec les fakers.

## Lancement du projet

-   Lancer [Largon] pour le serveur de données "Sur Windows";
-   Dans votre terminal tapez `npm run dev` pour lancer la compilation des fichiers .vue().

### Packages utilisés pour le site

- Breeze : https://laravel.com/docs/9.x/starter-kits#laravel-breeze
- Laravel Shopping Cart: https://github.com/darryldecode/laravelshoppingcart
- Systeme de notification: https://github.com/MeForma/vue-toaster
- Laravel Sanctum: https://laravel.com/docs/9.x/sanctum#installation
- https://www.npmjs.com/package/tiny-emitter
- Stripe paiement: https://stripe.com/docs/payments/quickstart

#### N.S:
- ( La tribu de "setup" qui va nous permettre d'éviter tout un bleaur blade avec l'api composition ce qui va faire qu'on va avoir accès directement à nos varables d'une façon réactive et sans avoir de return à faire dans notre composants.)

