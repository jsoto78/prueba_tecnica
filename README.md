## About Prueba Técnica symfony 
================================

Instalar
-----
Clone repo
```bash
$ git clone https://github.com/jsoto78/prueba_tecnica
```

ingresar a 
```bash
cd prueba_tecnica
```
Ejecutar docker y las migraciones
```bash
docker-compose up -d --build && docker exec prueba_tecnica-php-1 sh do_migrations.sh
```
Uso
-----
abrir en navegador http://localhost:8001
ingresar con credenciales 
usuario: admin@test.com
password: admin
