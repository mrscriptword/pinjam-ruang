# Anomali Laravel
Vel… vel… vel… Laravel. Suara gaib yang cuma muncul saat kamu mengerjakan tugas **PBO** di tengah malam. Konon, bila ada yang menggunakan framework gajah jahat ini, Gajah jahat akan datang menusuk-nusuk akal dan kewarasan kalian satu per satu. hunusan pedangnya terdengar seperti kompilasi blade yang gagal: “Vel… vel… Laravel… iiii takunyooooo!”
Bagikan ke temanmu yang suka main laravel, sebelum mereka didatangi anomali ini!
## Preview
<img src="anomali laravel.png" style="max-width:100%">

## Requirement
- PHP
- Composer
- Laravel
- MySql

## Features
-  Admin
-  Authentication
-  Login (Admin/User)
-  Reserve Room
-  etc

## Instalation
1. Download or clone this project.
   ```git
   https://github.com/mrscriptword/pinjam-ruang.git
   ```
2. Navigate to the `app-pinjam-ruang` folder.
   ```sh
   cd pinjam-ruang
   ```
3. Install the required components using Composer.
   ```sh
   composer install
   ```
4. Copy the `.env.example` file to `.env`.
   ```sh
   cp .env.example .env
   ```
5. Generate the `APP_KEY`.
   ```sh
   php artisan key:generate
   ```
6. Install Storage.
   ```sh
   php artisan storage:link
   ```
7. Perform the database migration.
   ```sh
   php artisan migrate:fresh --seed
   ```
8. After successful migration, run the application.
   ```sh
   php artisan serve
   ```
9. Open your browser and go to `127.0.0.1:8000` to use the application.
   
10. Login:
- **User**
```
email: user@untirta.ac.id password: user
```
- **Admin**
```
email: admin@untirta.ac.id password: admin
```
