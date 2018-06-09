#! /bin/bash

hashes=$(sudo docker ps | sed '1d' | cut -c  1-12)
for hash in $hashes; do
	sudo docker stop $hash
done
