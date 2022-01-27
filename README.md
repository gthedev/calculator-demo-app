# Calculator App

## Installation

Pull the repository down to your machine.

Create a `.env` file by copying the `.env.example` file.

### Docker

This project uses Docker and comes with a pre-configured `docker-compose.yml` and a related `Dockerfile` file.

Make sure Docker is installed on your machine.

1. Build the Docker image:
    ```
   docker-compose build
   ```
2. Install composer dependencies:
    ```
   docker-compose run --rm composer install
   ```
3. Launch the PHP server (for simplicity it uses `php artisan serve`):
   ```
   docker-compose up
   ```
   You should see the following message:
   > calculator-app | Starting Laravel development server: http://0.0.0.0:8080

   This means the server is up and running. To avoid network/porting conflicts any other software running on the system,
   the `docker-compose.yml` is configured to expose port `8181`, which means you should be able to access the app in
   your browser via the following URL: `http://localhost:8181/`. Feel free to change the port to suit your local
   machine.

## Using the app

Hopefully you know how a calculator works 👌

## Testing

To run the test suite, run:

```
docker-compose exec app php artisan test
```