## Getting Started

Follow these steps to set up the project on your local machine.

### Step 1: Clone the Repository

Clone the repository to your local machine with the following command:

```bash
git clone https://github.com/garglatesh/simple-blog-api.git
cd simple-blog-api
```

### Step 2: Install Docker Desktop

Ensure that Docker Desktop is installed and running on your machine.

### Step 3: Install Composer Dependencies

Install the necessary Composer dependencies using Docker:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```


### Step 4: Start Laravel Sail

Start the Laravel Sail environment by running:

```bash
cp .env.example .env
./vendor/bin/sail up 
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan config:clear
```

### Additional Steps

#### Run Migrations

Set up your database schema by running the migrations:

```bash
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed --class=PostSeeder
```

#### Access the Application

Once Sail is up and running, you can access the application at:

[http://localhost](http://localhost)

## Unit Testing with PHPUnit

### Running Unit Tests

```bash
./vendor/bin/sail phpunit
```

This command will execute all the unit tests and provide a report on the outcomes, including the number of tests that passed, failed, or encountered errors.


### Generating Coverage Reports

To generate a code coverage report while running your tests, use the following command:

```bash
./vendor/bin/sail phpunit --coverage-html=public/coverage
```

After running this command, you can view the coverage report by opening the `public/coverage/index.html` file in your browser.

## Future Enhancements

To further improve the project, consider the following enhancements:

1. **Pagination for Blog Posts**: Implement pagination to improve performance and user experience when dealing with large numbers of posts.

2. **API Rate Limiting**: Implement rate limiting for API endpoints to prevent abuse and ensure the system remains responsive under load.

3. **Improved Error Handling**: Enhance error handling across the application to provide more informative error messages and better fault tolerance.

4. **Logging and Monitoring**: Integrate logging and monitoring tools to track application performance and errors in real time.

5. **Continuous Integration**: Set up a Continuous Integration (CI) pipeline to automate testing and ensure code quality across the team.

6. **Internationalization (i18n)**: Implement support for multiple languages to make the blog accessible to a broader audience.

### Conclusion

This project is a solid foundation for a blog application, effectively balancing performance and scalability. 
