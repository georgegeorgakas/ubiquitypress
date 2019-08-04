## Mathematical Expression Api

This is the API documentation for Ubiquity press.

If you download it from Github please run the commands below.

- composer install
- php artisan make:migration create_expressions_table
- php artisan serve

You can find the Database on the zip folder so you probably do not need to run the second command.
Please notice that you can set up your database preferences on .env file.

### API

Once you have set up the environment you can use Postman(or the application you prefer) and start using the api.

- (GET)  localhost/ubiquitypress/public/api/expression
- (GET)  localhost/ubiquitypress/public/api/expression/{id}
- (POST) localhost/ubiquitypress/public/api/expression (XML body request)
- (PUT)  localhost/ubiquitypress/public/api/expression/{id}
    use a single expression xml to update by ID
- (DELETE) localhost/ubiquitypress/public/api/expression/{id}

### Links

I would like to share my Github account

- **[Github Account](https://github.com/georgegeorgakas/ubiquitypress)**

