FROM nginx:latest

ADD ./docker/nginx/ease.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /app/public
ADD ./public/ /app/public/
