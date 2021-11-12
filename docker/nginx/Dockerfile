FROM nginx:1.19.6

ARG SERVER_NAME
ARG PHP_FPM_ADDRESS
ARG PHP_FPM_PORT

ENV SERVER_NAME=$SERVER_NAME
ENV PHP_FPM_ADDRESS=$PHP_FPM_ADDRESS
ENV PHP_FPM_PORT=$PHP_FPM_PORT

RUN mkdir -p /etc/nginx/templates
COPY nginx.conf /etc/nginx/
COPY templates/* /etc/nginx/templates/
RUN envsubst < /etc/nginx/templates/php-upstream.conf.template > /etc/nginx/templates/php-upstream.conf.template

CMD ["nginx"]
EXPOSE 80
EXPOSE 443
