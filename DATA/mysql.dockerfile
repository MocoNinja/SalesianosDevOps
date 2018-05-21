FROM mysql:5

ENV MYSQL_ROOT_PASSWORD="javier" \
    MYSQL_USER="javier" \
    MYSQL_PASSWORD="javier" \
    MYSQL_DATABASE="bancodetrabajosalesiano" \
    MYSQL_ALLOW_EMPTY_PASSWORD="yes"

ADD ./dump.sql /docker-entrypoint-initdb.d

EXPOSE 3306
