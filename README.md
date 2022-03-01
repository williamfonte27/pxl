<p align="center">>> PHP Challenge <<</p>

# Installation
- Clone the repository to its location: `git clone https://github.com/williamfonte27/pxl.git`;
- Run the command `composer install` and `npm install` in the root folder of the project, to install all Laravel dependencies;
- Configure the `.env` file based on the variables from the file [.env.example](https://github.com/williamfonte27/pxl/blob/master/.env.example);
- Run the `php artisan key:generate` command to generate the application key;
- Run the `php artisan migrate` command inside the project's root folder to run migrations;
- If you ran the previous command, run the following command to run the queued jobs: `php artisan queue:work`
-


## Project Execution
- Run the `php artisan migrate:fresh` command inside the project's root folder to run migrations;
- To leave the queue running and running the application's jobs run the command: `php artisan queue:work`
- Run the `php artisan serve` command to run the internal server;
- Import a file in `.json` format

Enjoy yourself! ✌
