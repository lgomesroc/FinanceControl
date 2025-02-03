#!/bin/bash

# Parar todos os containers do Docker Compose
docker-compose down

# Remover todos os containers parados
docker container prune -f

# Remover todas as redes não usadas
docker network prune -f

# Para executar, digite esse comando abaixo no terminal na raiz do projeto
./reset_containers.sh
