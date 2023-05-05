Welcome

After downloading files from github to VS Code via Github desktop
1. Open terminal window in the same folders as the downloaded git-folder
2. Run "composer install" in terminal window
3. Run "cp .env.example .env" to copy the env.example file
4. In the .env file change database name -> DB_DATABASE = "YOUR DATABASE"
5. In phpmyadmin. Create a new database with the same name as 4.
6. In terminal, run "php artisan migrate" to migrate database
7. In terminal, run "php artisan storage:link" to connect the images so they are viewable.
8. In terminal, run "composer require consoletvs/charts" to install Laravel Charts package (Chartsjs)
9. In terminal, run "composer require livewire/livewire" to install livewire
10. To add pictures to book and authors
    10.1. Make och map named book_images in public/storage folder
    10.2. Copy the pictures 1-20 in det folder Bilder till seeden and paste them in to the new book_images folder
    10.3. Make och map named authors in public/storage folder
    10.4. Copy the pictures a1-a20 in det folder Bilder till seeden and paste them in to the new authors folder
11. In terminal, run "php artisan serve" to start your server/environment
12. Open projekt in browser and click refresh to generate new app key

To add pictures to book and authors
1. Make och map named book_images in public/storage folder
2. Copy the pictures 1-20 in det folder Bilder till seeden and paste them in to the new book_images folder
3. Make och map named authors in public/storage folder
4. Copy the pictures a1-a20 in det folder Bilder till seeden and paste them in to the new authors folder

To refresh and seed DB in terminal
1. php artisan migrate:fresh --seed
