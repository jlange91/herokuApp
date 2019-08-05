# HerokuSymfony4

## Description

A boilerplate for Symfony4 Vuejs development with Docker environment / Heroku deployement.

## Getting Started

### Prerequisites

- Install docker client.

  https://docs.docker.com/install/


### Build docker image

```
docker build --tag=heroku .
```

### Run docker image

```
docker run -p 80:80 -v $PWD/webapp:/var/www
```

### Usage

- Go to http://localhost:80

## Authors

- **Lange Julien**
- **Dacruz David**

## License

This project is licensed under the WTFPL License - see the [LICENSE.md](LICENSE.md) file for details
