# mailerlite-test

##### Installation:

1. Download Virtualbox https://www.virtualbox.org/wiki/Downloads

2. Download Vagrant https://www.vagrantup.com/downloads.html

3. Clone the repository

4. Open Homestead.yaml in your editor and change line 10 to the location of mailerlite-test

5. `cd mailerlite-test`

6. Copy in the .env supplied in the email

7. `vagrant up`

8. `vagrant ssh`

9. `cd code/mailerlite-test/`

10. `cp .env.example .env`

11. Set these values in .env

- DB_DATABASE=homestead

- DB_USERNAME=homestead

- DB_PASSWORD=secret

12. `php artisan key:generate`

13. `composer install`

14. `php artisan migrate`

15. Navigate to http://homestead.test in your browser

##### Run Tests:
`php artisan test`
