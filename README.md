## Finixio Laravel/PHP tech test 

The scope of this test was to write a command that retrieves the prices of the top 10 crypto coins. 
The coin data is being stored in Redis. For that i am using a hashmap, where the key is the coin ID 
and the value is the actual coin data serialized to json. 

Two endpoints are available. One that allows you to retrieve a coin by id. 
The other endpoint returns all the coins (top 10) 

- install the libraries

  `composer install`

- fetch the coins using Laravel command

    `php artisan crypto:fetch`
    
- Run the server 

    `php artisan serve`

- test the endpoint
    
    `curl --request GET 'http://127.0.0.1:8000/crypto'`
    
    `curl --request GET 'http://127.0.0.1:8000/crypto/{ID}'`

- run the tests
    
    `php artisan test`

