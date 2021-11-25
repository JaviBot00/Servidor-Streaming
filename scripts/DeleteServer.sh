#!/bin/bash

#Variables
nserver=$1

#Borrar Server
for ((i = 1 ; i <= $nserver ; i++)); do
  echo "Borrando Servidor de Stream" $i
  docker container stop server$i
  docker container rm server$i
done

#Borrando Nginx Proxy Inverso
echo "Borrando Nginx Proxy Inverso"
docker container stop pstream
docker container rm pstream

docker container stop pweb
docker container rm pweb

#Borra Volumenes no Usados
echo "Borra Volumenes no Usados"
docker volume prune -f

#Borra la Red Creada
echo "Borra la Red Creada"
docker network prune -f
