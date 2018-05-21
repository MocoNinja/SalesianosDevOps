#!/bin/bash

sudo docker run --name myadmin --rm -d --network salesianos -e PMA_HOST=database:3306 -p 8080:80 phpmyadmin/phpmyadmin

