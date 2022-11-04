# Symfony Docker test job for NewGMedia


## Getting Started

1. Run `docker compose build --pull --no-cache` to build fresh images
2. Run `docker compose up` (the logs will be displayed in the current shell)
3. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334), or you can test without SSL
4. If you wish you can load the fixtures by using `symfony console doctrine:fixtures:load` command

## API usage examples 

1. `https://localhost/user` send GET request to this endpoint to get the list of the users
2. `https://localhost/user/` send POST request with body params (email, username, password) to this endpoint to create the user
3. `http://localhost/user/1/username/pont/email/alvera.boehm@sawayn.org/password/1234/` send PUT request to this endpoint to update the user. First parameter id is used as a search criteria
4. Visit `https://localhost/` in your browser to browse the user list
