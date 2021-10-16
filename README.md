# EmployeeAPI
 
It is a Restful API for an employee management system. The API should allows the following operations:
Create, Update, Read, Delete, Search, Authenticate, Send notification email

It is deloped using Laravel 8, PHP Framework and MYSQL as database.

## Installation

### Preriquisite
- Have xampp installed in your system (If you don't have it don't worry you can use dockerized environment)
- Have a mailtrap account for email testing
- Connect your PC to the internet

### Process
- Download this source code by clicking on Code (green button) and select Download ZIP
- Extract the source code on your machine
- Open code with your favourite code editor
- Find the file called ".env.example" and save it as ".env"
- in ".env" file change DB variables as:

		DB_CONNECTION=mysql
		DB_HOST=localhost
		DB_PORT=3306
		DB_DATABASE=employeeapi
		DB_USERNAME= << Your mysql username (eg:root) >>
		DB_PASSWORD= << Your mysql password, if none leave it blank >>

- Open your xampp control panel and start Apache and MySQL
- Open command prompt or powershell if you are using windows OS
- Open terminal if you are using MacOS
- create new database call it : "employeeapi"
- Navigate to the directory where these codes are extracted
- Make migration of tables in database by running: 

		php artisan migrate

- Run this command to start server: 

		php artisan serve

- The server should be now start running probably at:

		http://127.0.0.1:8000/

- Open your API tester (for me was Postman)
- Open new tab in your API tester and send GET request at:

		http://127.0.0.1:8000/api/employees

- And you should get a response of an empty array because no employee is registered yet.

## Create

## Create account for manager
-In your API tester send POST request at
## Read
## Update
## Delete
## Search
## Activate or Deactivate
## Authentication
