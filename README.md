<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Application

 This assignment use Latest laravel version (10.0) and PHP Version (8.1). 
 To install this please clone this repo and run following commands 
  this will install all dependecies that require to run this application 
 - ## composer install

 this is for npm packages 
 - ## npm install && npm run dev 
 after that you have to run following commands . 
 please make sure you have vaild database connection in .env file and then run this command. 
 I have already update .env.example file for you. you just need to rename this from 
 .env.expample to .env 
 
- ## php artisan migrate:fresh --seed 
this will seed the user entry so that you can able to login with api user . 

 - ## php artisan serve 
 this will serve your application   

 By this command you can Create Random Author as it is cli command
 - ## php artisan app:create-author 


 ## Feature of Application 
  - [login page that uses Symfony Skeleton API, retrieve the access token]
  - [list of Authors from the API, and display them in a table layout]
  - [User can able to delete the author if there are no related books for this author]
  - [view page for single authors and their books]
  - [CLI command created add a new author . php artisan app:create-author  ]
  - [single author view, is able to delete books (one by one)  ]
  - [User can add a new Book and select Authors from a dropdown menu  ]
  - [User first name and last name displayed at navbar]
  - [Logout link or button.  ]


.env file have API_URL so that you can changes api URL at any time .

if you change anything in env file please make sure you have to run these command 

## php artisan config:clear
## php artisan cache:clear

By doing this this will pick the latest changes. I have tried to make this application super handy . if you have further question please feel free to connect with me on my handle. thanks

Login Creds will be same as api 

email : ahsoka.tano@q.agency 
password : Kryze4President








 