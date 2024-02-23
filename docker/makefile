# Construir y levantar los contenedores Docker
dev:
	sudo docker compose up -d --build

# Detener y eliminar los contenedores Docker
stop:
	sudo docker compose down

# Acceder al shell del contenedor de desarrollo
console:
	sudo docker compose exec development bash

# Reiniciar el contenedor de desarrollo
restart:
	sudo docker compose restart development

# Ver los logs de los contenedores Docker
logs:
	sudo docker compose logs -f

# Limpiar los volúmenes Docker (eliminar datos persistentes)
clean-volumes:
	sudo docker compose down -v
