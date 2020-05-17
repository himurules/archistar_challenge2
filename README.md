# Laravel Based API With Authentication
<p align="center">
A laravel based REST API project to maintain Properties and their Analytics.  
</p>

## Dependencies

Following dependencies for the project 

- **[PHP ^7.2.5](https://www.php.net/releases/7_2_5.php)**
- **[Composer](https://getcomposer.org/download/)**
- **[Node.js and npm](https://www.npmjs.com/get-npm)**

## Installation

Checkout the [repository](https://github.com/himurules/archistar_challenge2.git) in the desired root folder.

Run ***composer install*** to install required libraries.


Create .env file ***cp .env.example .env***

Generate the project key with the following command

***php artisan key:generate***

## Configurations

In the .env file in the root directory, specify the following

- Database Connection Configuration
    - DB_CONNECTION=mysql
    - DB_HOST=(db_host)
    - DB_PORT=3306
    - DB_DATABASE=(database name)
    - DB_USERNAME=(username)
    - DB_PASSWORD=(password)

## Run the following command for database migration and seeding

***php artisan setup***

To run migration and seeding manually, see below
 
## Database Migration

Run the following command to set up database tables

***php artisan migrate*** 

## Database Seeder

Run the following command to set up database tables

***php artisan db:seed*** 

## API Documentation

The following are applied throughout the API
````
Host: yourhost eg. localhost:8000
Accept: application/json
Content-Type: application/json
```` 

####Registration
```
POST /api/register HTTP/1.1

Payload: {
    "name": "Himanshu", 
    "email": "himanshu.kotnala@gmail.com", 
    "password": "himanshu", 
    "password_confirmation": "himanshu”
}
```

````
Response 

HTTP/1.1 201 

{
    "data":{
        "name":"Himanshu",
        "email":"himanshu.kotnala@gmail2.com",
        "updated_at":"2020-05-17T04:49:40.000000Z",
        "created_at":"2020-05-17T04:49:40.000000Z",
        "id":3,
        "api_token":"WdGxu7WTFQvcg4AT8ZnmFpIUCo0MfpsdhP4uVSk6qj2xL9Pz1CUFaOXJi6IM"
    }
}
````
####Login
```
POST /api/login HTTP/1.1
Payload: {
    "email": "himanshu.kotnala@gmail2.com",  
    "password": "himanshu"
}
```
````
Response 

HTTP/1.1 200

{
    "data":{
        "name":"Himanshu",
        "email":"himanshu.kotnala@gmail2.com",
        "updated_at":"2020-05-17T04:49:40.000000Z",
        "created_at":"2020-05-17T04:49:40.000000Z",
        "id":3,
        "api_token":"WdGxu7WTFQvcg4AT8ZnmFpIUCo0MfpsdhP4uVSk6qj2xL9Pz1CUFaOXJi6IM"
    }
}
````

####Logout
```
POST /api/logout HTTP/1.1
Authorization: Bearer api_token
OR
Payload: {
    "api_token": "yourapitoken"
}
```

````
Response 

HTTP/1.1 200 

{
    'data' => 'User logged out.'
}
````

####Add new property
```
POST /api/properties HTTP/1.1
Payload: {
    "suburb": "parramatta",  
    "state": "nsw",
    "country": "australia",
    "api_token": "yourapitoken"
}
```

````
Response 

HTTP/1.1 200
````
####Add/Update an analytic to a property
```
POST /api/properties/analytic HTTP/1.1
Payload: {
    "property_id": "1", 
    "analytic_type_id": "1", 
    "value": 35
    "api_token": "yourapitoken"
}
```

````
Response 

HTTP/1.1 200
````

####Get all analytics to a property
```
GET /api/properties/{property_id}/analytics HTTP/1.1
Payload: {
    "api_token": "yourapitoken"
}
```

````
Response 

HTTP/1.1 200
{
    "data":
        [
            {"id":"1","type":"analyticTypes","attributes":{"name":"max_Bld_Height_m","units":"m","is_numeric":1,"num_decimal_places":1}},
            {"id":"2","type":"analyticTypes","attributes":{"name":"min_lot_size_m2","units":"m2","is_numeric":1,"num_decimal_places":0}}
        ]
}
````

####Get all property analytics summary for a suburb/state/country 
```
GET /api/properties/analytics/{type}/{value} HTTP/1.1
Payload: {
    "api_token": "yourapitoken"
}
egs: 
/api/properties/analytics/suburb/parramatta
/api/properties/analytics/state/nsw
```

````
Response 

HTTP/1.1 200
{
    [
        {"id":"1","type":"analyticsSummary","attributes":{"name":"max_Bld_Height_m","minValue":10,"maxValue":39,"medianValue":20.571428571428573,"withValue%":77.77777777777779,"withoutValue%":22.22222222222222}},
        {"id":"2","type":"analyticsSummary","attributes":{"name":"min_lot_size_m2","minValue":35,"maxValue":1101,"medianValue":661,"withValue%":55.55555555555556,"withoutValue%":44.44444444444444}},
        {"id":"3","type":"analyticsSummary","attributes":{"name":"fsr","minValue":1.0745581883243,"maxValue":3.3463876138377,"medianValue":2.449284661629129,"withValue%":38.88888888888889,"withoutValue%":61.111111111111114}}
    ]
}
````
