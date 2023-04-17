Welcome

After downloading files from github to VS Code via Github desktop
1. Open terminal window in the same folders as the downloaded git-folder
2. Run "composer install" in terminal window
3. Run "cp .env.example .env" to copy the env.example file
4. In the .env file change database name -> DB_DATABASE = "YOUR DATABASE"
5. In phpmyadmin. Create a new database with the same name as 4.
6. In terminal, run "php artisan migrate" to migrate database
7. In terminal, run "php artisan storage:link" to connect the images so they are viewable.
8. In terminal, run "php artisan serve" to start your server/environment
9. Open projekt in browser and click refresh to generate new app key


To refresh and seed DB in terminal
1. php artisan migrate:fresh
2. php artisan db:seed    