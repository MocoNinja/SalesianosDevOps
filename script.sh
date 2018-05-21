#! /bin/bash

echo "Comprobando la existencia de la red..."
resultado=$(sudo docker network ls | grep "salesianos") 
# echo $resultado

if [ "$resultado" == "" ]; then
	echo "Red NO encontrada. Creándola..."
	sudo docker network create salesianos
else
	echo "Red encontrada. Pues pasando..."
fi

echo "Construyendo la imagen del mysql personalizado..."

cd ./DATA

sh build.sh


echo "Iniciando contenedor de la base de datos..."

sh runMYSQL.sh

echo "Iniciando contenedor del PHPMYADMIN..."

sh runADMN.sh

cd ..

echo "Ale. A darle..."

echo "\"Si no sabes leer un Dockerfile, recuerda que las credenciales del phpmyadmin son root / javier ;) \""

