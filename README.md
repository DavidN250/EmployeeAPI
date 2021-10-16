# EmployeeAPI
 
It is a Restful API for an employee management system. The API should allows the following operations:
Create, Update, Read, Delete, Search, Authenticate, Send notification email

It is deloped using Laravel 8, PHP Framework and MYSQL as database.

## Installation

### Preriquisite
- Have xampp installed in your system (If you don't have it don't worry you can use dockerized environment)
- Have a mailtrap account for email testing
- Connect your PC to the internet to send and receive emails
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
		DB_USERNAME= << Your apache username (eg:root) >>
		DB_PASSWORD= << Your apache password, if none leave it blank >>

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

### Create account for manager
-In your API tester send POST request at this url with  data like these:

		http://127.0.0.1:8000/api/register

		KEY 						VALUE
		name 						John Doe
		email 						john@testing.com
		password 					12345678
		password_confirmation 				12345678
		nationalID 					1199012990900025
		phone_number 					+257800000222
		dob 						15-07-1990

- Employee with MANAGER position  will be created and his login account will be created automatically
- He/She will receive two emails, one to confirm email in order to login to his/her account and another to welcome him/her to the company. (Check MailTrap inbox)
- He must verify his/her email imediately before it is too late. (Refer to the Authentication section of this documentation [below])

### Registering an employee (NOT A MANAGER)
-In your API tester send POST request at this url with  data like these:

		http://127.0.0.1:8000/api/employees

		KEY 						VALUE
		name 						Kamille Doe
		email 						kamille@testing.com
		nationalID 					1199812990900025
		phone_number	 				+257888888222
		dob 						15-07-1990
		position 					WEBDESIGNER

- Employee with specified position  will be created
- He/She will receive an email to welcome him/her to the company.(Check MailTrap inbox)

## Read

### Get all employees
-In your API tester send GET request at this url:

		http://127.0.0.1:8000/api/employees/kami

### Get one employee
-In your API tester send GET request at this url:

		http://127.0.0.1:8000/api/employees/1


## Update
-In your API tester send PUT request at this url:

		http://127.0.0.1:8000/api/employees/2

		KEY 						VALUE
		phone_number 				+250799999222

-This will update phone number of the employee with ID 2 with a new value

## Delete

-In your API tester send DELETE request at this url:

		http://127.0.0.1:8000/api/employees/2

-This will delete the employee with ID 2 

## Search

-In your API tester send GET request at this url:

		http://127.0.0.1:8000/api/employees/john

-This will show the employee with  "kami" either in name or email 

## Activate or Deactivate

-In your API tester send GET request at this url:

		http://127.0.0.1:8000/api/employees/1

-This will change the status of employee with ID 1 to 'ACTIVE' if was 'INACTIVE' and vice versa 

## Authentication

### Confirm email

-At the time of account creation there is an email which automatically sent to your registered email address. Check that email and click on "Verify Email" button

### Login

-In your API tester send POST request at this url with  data like these:

		http://127.0.0.1:8000/api/employees

		KEY 						VALUE
		email 						kamille@testing.com
		password 					1199812990900025

- This will return the information of the logged in user and his/his given token that you will copy and use it at whatever action they will ask you to be authenticated first.

### Forgot password

- In case the password has been forgotten there is a way of changing it
- In your API tester send POST request at this url with email:

		http://127.0.0.1:8000/api/employees 

		KEY 						VALUE
		email 						kamille@testing.com

- Check mailtrap inbox and you will see the reset password link sent to the email provided.

## DOCKERIZE ENVIRONMENT

- Start docker on your machine
- In downloaded code there is a file called **docker-compose.yml**
- In your command prompt or terminal(MacOS) run this command at root directory of the project:

		./vendor/bin/sail up

- This will create a container **employeeAPI** with necessary images. 
- Run this command to see all created images:

		docker image list
