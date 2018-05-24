#!/bin/bash

sudo docker run --name myapp --rm -d --network salesianos -p 8069:80 salesianos-app

