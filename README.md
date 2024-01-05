# API Agenda

## 1 Primeiros passos:

#### Realizar o clone da api
` 
 https://github.com/leonardo403/api-agenda.git
` 

#### Composer Install
`
composer install
`

#### Configurar Swagger JWT Authentication

`
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
`
#### Criar JWT secret key
`
php artisan jwt:secret
`

#### Configurar Swagger
`
php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
`
#### Gerando Swagger

`
php artisan l5-swagger:generate
`
#### Acessar documentasção
`
URL: http://127.0.0.1:8000/api/documentation
`
