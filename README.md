# About HaloTICK

## Description 
HaloTICK is a management ticketing system that offers bunch of features. You can open new tickets, assign people, edit tickets, users, etc. It is built with CodeIgniter 4 framework and AdminLTE Bootstrap Template. For more information, please visits https://codeigniter.com/ and https://adminlte.io/

## Features
1. Dashboard
2. Create ticket 
3. Tickets list
4. Multi user (admin and client)
5. Email (send email on edit or open new ticket)
6. Frequently Asked Question (FAQ)
7. Website Management (this menu is only for admin)

## Server Requirements (From CodeIgniter 4)

PHP version 7.3 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)

## User Manual 

### Setting Up Database
1. Upload the database file 'tiketdb' into your phpmyadmin or mysql. 
2. Open config > Database.php to change the database information as you want.

### Setting Up Email
1. Open app > config > email.php and change the SMTP user into your email. I use SMTP to send email from gmail. The setting may be different for another Host. 
2. Open app > controller > Tiket.php and change the email's setting there. The email is sent when someone create a new ticket or edit ticket by adding a comment. 

## Demo
Visit https://halotickdemo.000webhostapp.com/ 

Login as admin
Username : admin
Password : admin123

Login as client
Username : client
Password : 123456


