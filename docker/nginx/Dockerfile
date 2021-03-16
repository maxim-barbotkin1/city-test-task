FROM nginx:latest

RUN apt-get update

RUN apt-get install openssl

COPY ssl/nginx-selfsigned.key /etc/ssl/private/nginx-selfsigned.key
COPY ssl/nginx-selfsigned.crt /etc/ssl/certs/nginx-selfsigned.crt
COPY ssl/dhparam.pem /etc/ssl/certs/dhparam.pem
