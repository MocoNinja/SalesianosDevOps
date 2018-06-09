#! /bin/bash

echo "Comprobando la existencia del código..."
if [ ! -d ./DATA/BancodeTrabajo ]; then
	echo "No se ha encontrado la carpeta del código fuente."
	echo "Recuerda copiar la carpeta de BancodeTrabajo en ./DATA/!"
	exit 1
else
	echo "Código OK!"
fi

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

sh buildSQL.sh

echo "Construyendo la imagen de la app..."

sh buildAPP.sh

echo "Iniciando contenedor de la base de datos..."

sh runMYSQL.sh

echo "Iniciando contenedor del PHPMYADMIN..."

sh runADMN.sh

echo "Iniciando contenedor de la app..."

sh runAPP.sh

cd ..

echo "Ale. A darle..."

echo "\"Si no sabes leer un Dockerfile, recuerda que las credenciales del phpmyadmin son root / javier ;) \""

