# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/lumen-framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/lumen-framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/lumen)](https://packagist.org/packages/laravel/lumen-framework)

# User routes

* `GET` `{host}/api/users` Lista todos usuários (com veículos, se houver relação)
* `GET` `{host}/api/users/{id}` Lista detalhes do usuário
* `POST` `{host}/api/users`  Cria um novo usuário
* `PUT` `{host}/api/users/{id}`  Atualiza dados do usuário
* `DELETE` `{host}/api/users/{id}` Deleta o usuário e realação com veículos, se houver

# Vehicle routes

* `GET` `{host}/api/vehicles` Lista todos os veículos (com usuário, se houver relação)
* `GET` `{host}/api/vehicles/{id}` Lista detalhes do veículo
* `POST` `{host}/api/vehicles`  Cria um novo veículo
* `PUT` `{host}/api/vehicles/{id}`  Atualiza dados do veículo
* `DELETE` `{host}/api/vehicles/{id}` Deleta o veículo
* `PUT` `{host}/api/vehicles/set_owner/{id}`  Define um novo usuário para o veículo
* `PUT` `{host}/api/vehicles/release/{id}`  Remove a relação entre usário e veículo

***
# Tests
## User
* testShouldReturnAllUsers
* testShouldReturnUsers
* testShouldCreateUsers
* testShouldUpdateUsers
* testShouldDeleteUsers

## Vehicles
* testShouldReturnAllVehicles
* testShouldReturnVehicle
* testShouldCreateVehicle
* testShouldUpdateVehicle
* testShouldDeleteVehicle
***
# Install

* `composer install`
* `php artisan migrate`
* `php artisan db:seed`
