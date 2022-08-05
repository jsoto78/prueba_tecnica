##  Prueba Técnica symfony
[![symfony](https://symfony.com/images/logos/header-logo.svg "symfony")](https://symfony.com/)

Instalar
-----
**Clone repo**
```bash
git clone https://github.com/jsoto78/prueba_tecnica
```

**ingresar a:**
```bash
cd prueba_tecnica
composer update
```
Ejecutar docker y las migraciones:
```bash
$ docker-compose up -d --build && docker exec prueba_tecnica-php-1 sh do_migrations.sh
```
Uso
-----
abrir en navegador http://localhost:8001

ingresar con credenciales:
usuario: **admin@test.com**
password: **admin**

Test
-----
```bash
cd prueba_tecnica/
./bin/phpunit
```