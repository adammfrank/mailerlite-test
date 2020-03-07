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

10. `composer install`

11. `php artisan migrate`

12. Navigate to http://homestead.test in your browser

##### Run Tests:
`php artisan test`
