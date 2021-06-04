# Project installation

## This guide is written for fresh installation of Ubuntu 20.04.2 LTS

### First install the packages we need
1. sudo apt install git
2. sudo apt install composer
3. sudo apt install npm
4. sudo apt install php-xml
5. sudo apt install php-mysql
6. sudo apt install mysql-server
    * sudo mysql_secure_installation
    * set password all, answer remaining questions - "yes"

### Configure mysql
1. sudo mysql (to connect to mysql)
2. CREATE USER '**[username]**'@'localhost' IDENTIFIED BY '**[password]**';
3. CREATE DATABASE fakebook;
4. GRANT ALL PRIVILEGES ON *.* TO '**[username]**'@'localhost' WITH GRANT OPTION;
5. quit;

### It is time to setup the project
1. cd ~
2. sudo git clone https://github.com/Karolis-Kvatavicius/fakebook.git
3. sudo cp .env.example .env
4. update .env file with credentials of previously created user
    * DB_USERNAME=**[username]**
    * DB_PASSWORD=**[password]**
5. sudo composer install
6. sudo npm install
7. sudo php artisan migrate --seed
8. sudo php artisan storage:link
9. sudo php artisan serve
10. Access localhost in your browser, press generate app key and refresh page

#### That's it, you are good to go!