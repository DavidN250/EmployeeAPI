# EmployeeAPI
 
It is a Restful API for an employee management system. The API should allows the following operations:
Create, Update, Read, Delete, Search, Authenticate, Send notification email

It is deloped using Laravel 8, PHP Framework and MYSQL as database.

## Installation

- Download this source code by clicking on Code (green button) and select Download ZIP
- Extract the source code on your machine
- Open code with your favourite code editor
- Find the file called ".env.example" and save it as ".env"
- in ".env" file change DB variables as:

		DB_CONNECTION=mysql
		DB_HOST=localhost
		DB_PORT=3306
		DB_DATABASE=employeeapi
		DB_USERNAME= << Your mysql username >>
		DB_PASSWORD= << Your mysql password >>

- Open your xampp control panel and start Apache and MySQL
- Open command prompt or powershell if you are using windows OS
- Open terminal if you are using MacOS
- Navigate to the directory where these codes are extracted
- Make migration of tables in database by running: 

		php artisan migrate

- Run this command to start server: 

		php artisan serve

- The serve shoul now start running probably at 

		http://127.0.0.1:8000/

- Open your API tester (for me was Postman)
- Open new tab and send GET request at 

		http://127.0.0.1:8000/api/employees

- And you should get a response of an empty array because no employee is registered yet.

### Preriquisite
## Create
## Read
## Update
## Delete
## Search
## Activate or Deactivate
## Authentication
