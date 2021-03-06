#!/bin/bash

#Variables
nserver=$1
nIP="El nº de Server en el que se esta creando es: "
confstream='/root/PFC/configuracion/pstream/nginx.conf'
confweb='/root/PFC/configuracion/pweb/nginx.conf'

#Crear Red Docker
echo "Creando la Red Docker"
docker network create my-net --gateway=172.20.0.111 --subnet=172.20.0.0/16

#Configuracion Nginx Proxy Inverso
sed -i '44,$d'  $confstream
sed -i '44,$d'  $confweb

#Crear Server
for ((i = 1 ; i <= $nserver ; i++)); do
  echo $nIP $i
  docker container run -d --restart always --name=server$i --network=my-net --ip=172.20.0.$i -v /root/PFC/fuente/:/mnt/ -v /root/PFC/:/usr/local/nginx/html/ alqutami/rtmp-hls:latest
  echo -e "        server 172.20.0.$i:1935;" >> $confstream
  echo -e "        server 172.20.0.$i:8080;" >> $confweb
done

#Cerrar configuracion Nginx Proxy Inverso
echo -e "    }" >> $confstream
echo -e "}" >> $confstream

echo -e "    }" >> $confweb
echo -e "}" >> $confweb
