# Icons Task from team leader

This is the task requested from me after interview

I tried to run it online on openshit but i have a problem on my account

#### The created or edited files :

db migrations folder (creating tables in database)

db seeding folder (intializing some simple required data and test data into database)

routes file (installing routes and authentication middle ware)

models folder (adding models and it's relations)

views folder (adding views for user using blade and laravel collective)

controllers folder (create controller responsible for logic)


## Notice

I have made some advanced code for future use like :

actions are dynamic

roles also are dynamic

I wanted to use resource routes and resource controller 
if some one wish to add more functionality to the system like editing and deleting 


## Time to run application

make sure you have php7 , composer installed , and git

#### 1-clone the repo from github:

git clone https://github.com/mustafaelagamey/crm-task.git

#### 2-go to project folder

cd crm-task

#### 3-update and install composer dependencies

composer update

#### 4-copy .env.example to .env to create .env :

copy .env.example .env


#### 5-generate security key :

php artisan key:generate


#### 6-create mysql database for testing on local host

#### 7-configure .env db name, user , password settings to access the database

#### 8-migrate with seed :

php artisan migrate --seed

#### 9-run artisan server

php artisan serve


#### 10-browse localhost:8000



## Created test users :

admin user : admin@admin.admin ,
pass : adminadmin

employee user 1 : emp1@emp1.emp1 ,
pass : emp1emp1

employee user 2 : emp2@emp2.emp2 ,
pass : emp2emp2

## Requsts :
### Admin

admin add employee

admin add customer

admin can assign customer to employee

### Employee

mployee can add customer

mployee add action and  record result for action

##Used:
models , views , controllers ,routes , some service provider for form building
migration and seeding to intialize test data

laravel relation one to many for user role and action type and association of relations
authentication system for admin and employees







