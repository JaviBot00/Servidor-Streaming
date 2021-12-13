#!/bin/bash

#Creacion del Proxy Nginx
echo "Creacion del Proxy Nginx"

echo "Proxy parte Stream"
docker run -d --name=pstream --restart always --network=my-net --ip=172.20.0.100 -p 1935:1935 -v /root/PFC/configuracion/pstream/nginx.conf:/etc/nginx/nginx.conf nginx:latest

echo "Proxy parte Web"
docker run -d --name=pweb --restart always --network=my-net --ip=172.20.0.101 -p 1969:8080 -v /root/PFC/configuracion/pweb/nginx.conf:/etc/nginx/nginx.conf nginx:latest

echo "Docker Recorder"
docker run -d --name=recorder --restart always --network=my-net --ip=172.20.0.99 -v /home/recorder/grabaciones/:/home/download/ -e streamLink='http://192.168.2.224:1969/hls/test.m3u8' -e streamQuality='best' -e streamName='javibot00' -e uid='0' -e gid='0' lauwarm/streamlink-recorder