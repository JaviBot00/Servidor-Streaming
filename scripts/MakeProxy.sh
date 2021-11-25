#!/bin/bash

#Creacion del Proxy Nginx
echo "Creacion del Proxy Nginx"

echo "Proxy parte Stream"
docker run -d --name=pstream --restart always --network=my-net --ip=172.20.0.100 -p 1935:1935 -v /root/PFC/configuracion/pstream/nginx.conf:/etc/nginx/nginx.conf nginx:latest

echo "Proxy parte Web"
docker run -d --name=pweb --restart always --network=my-net --ip=172.20.0.101 -p 1969:8080 -v /root/PFC/configuracion/pweb/nginx.conf:/etc/nginx/nginx.conf nginx:latest
