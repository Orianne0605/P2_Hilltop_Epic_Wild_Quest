# Epic Wild Quest

## Steps

1. Clone the repo from Github.
2. Run `composer install`.
3. Create *config/db.php* from *config/db.php.dist* file and add your DB parameters. Don't delete the *.dist* file, it must be kept.
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PWD', 'your_db_password');
```
4. Import all sql files from database/DumpSQL into your database.
5. Run the internal PHP webserver with `php -S localhost:8000 -t public/`. The option `-t` with `public` as parameter means your localhost will target the `/public` folder.
6. Go to `localhost:8000` with your favorite browser.

## Contributors

👤 **Nathan Vanpeene**

- Github: [@Mistery7K](https://github.com/Mistery7K)

👤 **Sophie Fonteneau**

- Github: [@sophie166](https://github.com/sophie166)

👤 **Orianne Tanguy**

- Github: [@Orianne0605](https://github.com/Orianne0605)

👤 **Najat Ciesielczyk**

- Github: [@choco1](https://github.com/choco1)

👤 **Najat Ciesielczyk**

- Github: [@choco1](https://github.com/choco1)

👤 **Valentin Desneaux**

- Github: [@BaazDe](https://github.com/BaazDe)

### Special contributor and thanking:

👤 **Benjamin Beugnet**

- Github: [@benj-san](https://github.com/benj-san)



# P2_Hilltop_Epic_Wild_Quest
