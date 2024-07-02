# Sender
> Application for sending information
## Technologies
* PHP - version 8.3
* Symfony - version 7.1
* PostgreSQL - version 13.2

## Local Setup
**1. Copy the `docker-compose.yml.dist` file to `docker-compose.yml`:**
```
cp docker-compose.yml.dist docker-compose.yml
```
**2. Replace placeholder values in the docker-compose.yml file with your actual values:**
- `POSTGRES_USER` with your database username
- `POSTGRES_PASSWORD` with your database password
- `APP_SECRET` with your application secret
- `DATABASE_URL` with your actual database connection string
- `MESSENGER_TRANSPORT_DSN` with your transport, suggest: `doctrine://default?auto_setup=0`
- `API` and rest of configuration parameters. 

**3. Start the Docker containers**
```
docker compose up -d
```

## Contact
* [GitHub](https://github.com/JakubSzczerba)
* [LinkedIn](https://www.linkedin.com/in/jakub-szczerba-3492751b4/)