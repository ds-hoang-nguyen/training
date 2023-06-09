FROM mysql:5.7

ADD ./docker/db/my.cnf /etc/mysql/conf.d/my.cnf
RUN chmod 644 /etc/mysql/conf.d/my.cnf
RUN mkdir /var/log/mysql
RUN chown mysql:mysql /var/log/mysql
