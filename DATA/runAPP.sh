#!/bin/bash

sudo docker run --name app -d -it --rm --network salesianos -p 8069:80 app

