# L1 Challenge Devbox

## Summary

- Dockerfile & Docker-compose setup with PHP8.1 and MySQL
- Symfony 5.4 installation with a /healthz endpoint and a test for it
- After the image is started the app will run on port 9002 on localhost. You can try the existing
  endpoint: http://localhost:9002/healthz
- The default database is called `database` and the username and password are `root` and `root`
  respectively
- Makefile with some basic commands

## Installation

```
  make run && make install
```

## Run commands inside the container

```
  make enter
```

## Run tests

```
  make test
```

## Technologies

- PHP 8.1
- Symfony
- Mysql or Postgresql or Sqlite


## Log Parser
 - Run the command for the parser `php bin\console app:parse-logs`

## Counter
  - Provide all params included in the for counter
 ```
    {
      "serviceNames": {
          "FaceBook",
          "Legal One"
      },
      "startDate": "11-02-2022",
      "endDate": "11-07-2022",
      "statusCode": 201
  }
```

- Api Route: Url: `http://localhost:9002/count` Method: GET
## Tests
 `php bin/console doctrine:fixtures:load --env=test`
