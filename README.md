# HerokuSymfony4

(https://guarded-river-94915.herokuapp.com/)[https://guarded-river-94915.herokuapp.com/]

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
docker run -p 80:80 -v $PWD/webapp:/var/www heroku
```

### Heroku deployement

- Add mysql DB add on for Heroku in your application settings
- Update your DATABASE_URL value in webapp/.env
- Follow heroku git deployement instructions: https://devcenter.heroku.com/articles/git 

### Usage

- Go to http://localhost:80

## Authors

- **Lange Julien**
- **Dacruz David**

## License

This project is licensed under the WTFPL License - see the [LICENSE.md](LICENSE.md) file for details
