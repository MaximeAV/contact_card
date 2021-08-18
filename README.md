# Contact card

# Get Started

1. Clone the repo

2. Go in project directory and execute this command to create database and configure it

```bash
php bin/console doctrine:database:create  
php bin/console make:migration  
php bin/console doctrine:migrations:migrate
 ```

3. Then import data with fixture  

```bash
php bin/console doctrine:fixtures:load  
```
 
 4. Launch app  

```bash
php bin/console server:run
```
