# DR1FT

This is a laravel project with vanilla JavaScript and Bootstrap5

## Installation

Clone the repository and install Docker Compose, after that, make this commands in the project root folder.

```bash
cd ./docker/
make dev
make console
```

Now in the new terminal, we install de required libraries and update node.

```bash
# Composer Libraries
composer install

# Update node using npm
npm cache clean -f
npm install -g n
n stable

# Restart the terminal

# Node Libraries
npm install gsap
npm install bootstrap

# Then
npm run dev
npm run build

# Setting permissions

```

## Database Setup
Run these commands in the make console terminal
```bash
php artisan migrate
php artisan migrate --seed
```





# Set Up

1. Ir al directorio `cd docker/`
2. Ejecutar `make dev` para buildear el proyecto o ejecutarlo
3. Acceder a la consola con `make console`

## Servidor Apache
Al ejecutar `make dev` desde el directorio `docker/`, el servidor ya está corriendo en `localhost`.

## Phpmyadmin
Para acceder a la BD utilizaremos el puerto 8080, `localhost:8080`.