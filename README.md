# Project7_BileMo_Api

## Parcours développeur d'application - PHP/Symfony

### Context

This project was realized as part of my studies of application developer - PHP / Symfony. Project 7 is the development of a REST API for the company "BileMo" offering a selection of high-end mobile phones. using the Symfony framework.

To see the website code on github : https://github.com/HDoumali/Project7_BileMo_Api.

### Installation

For the realization of the site, I used WAMP which you can download at the following address: www.wampserver.com.

Step 1: Clone the Github repository:

- https://github.com/HDoumali/Project7_BileMo_Api.git

Step 2: Open the app / Config / parameters file and insert the following parameters:

- database_name: project6 (project 6 by default, you can choose the name of the database)
- database_user: Enter your username to access the mysql database ("root" by default)
- database_password: Enter your password to access the mysql database ("root" or "null" by default)

Step 3: Create the database and tables using the following commands:

- php bin/console doctrine: database: create
- php bin/console doctrine:schema:update --force

Step 4: Creation of database datas with fixtures using the following command :

- php bin/console doctrine:fixtures:load

Step 5: Create the client using the following command:

- php app/console fos:oauth-server:create-client --redirect-uri="..." --grant-type="password"

The client is now created in database with the information (client_id, client_secret, grant_type) that we need for step 6.

Step 6: Get an access token to authenticate

First, access the URL "ouath / v2 / token" with a "POST" request and enter the following parameters in the body : 

- grant_type = password
- client_id = yourClientId
- client_secret = yourClientSecret
- username = yourUsername (The customer's username)
- password = yourPassword (The password of the customer)

Step 7: Communicate with the API

Insert in the header the key "Authorization" and give it the value "Bearer YourAccessToken"

Step 8: Access API documentation

To access the API documentation online, enter the URL "api/doc". Documentation is also available on the Github repository (Project7_BileMo_Api_Doc.md)


