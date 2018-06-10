# Banco de trabajo Salesiano

## Introducción

Se desea tener una página web que permita registrar a alumnos en una serie de actividades. Estos alumnos escogerán una **actividad** y especificarán el **horario** del que disponen. Esta información se guardarán en una base de datos para poder realizar uniones entre *demandantes* y *ofertantes* para que puedan ser puestos en contacto.

## Diseño

### Base de datos

En su nivel más fundamental, se contemplan tres tablas principales:

#### Alumnos

Es una tabla que contiene la información que sea necesaria de cada alumno. Para el uso de la aplicación, se identificará mediante un camp *id*.

#### Actividades

En esta tabla se desea tener un registro de las distintas actividades que desean llevarse a cabo mediante este banco de trabajo. Puede involucrar diversos campos, siendo los pensados para la aplicación:

* ***idAlumnoQueImparte***: referencia al alumno que se registrará como *ofertante*
* ***idActividad***: referencia a la actividad que ocupa el registro
* ***fecha***: un string que contenga toda la información requerida
* ***idAlumnoQueDemanda***: referencia al alumno que se registrará como *demandante*. Al principió será *NULL*, hasta que se asigne cuando haya un match

### Uso

Se plantea el uso de un **formulario** *(figura 1)*, el cual registra la actividad y la disponibilidad horaria.

El formulario presenta unas condiciones de validación (mediante **regex**) para asegurar que en los días seleccionados, se han intrducido exclusivamente rangos horarios válidos. Se ha implementado de tal forma que permite la introducción de varios intervalos de la forma **HH:MM-HH:MM**, separados por *;* si se deseara especificar varias disponibilidades.

Al hacer *submit*, esta información se guarda en la base de datos con la estructura anteriormente especificada.

Para el manejo lógico de esta infiormación, se ha implementado una clase que a partir de este string codificado, puede obtener la información deseada. Un ejemplo se ve en la *(figura 2)*

![1. Formulario](./docs/01-formulario.png)

![2. Ejemplo de información](./docs/02-ejemplo_datos.png)