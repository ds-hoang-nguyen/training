FROM public.ecr.aws/nginx/nginx:1.19.6

ADD ./docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf

ADD  ./public /code/public

RUN apt-get update && apt-get -y install apache2-utils
