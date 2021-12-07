# Carga de paginas para Edicion Impresa

Se generaran imagenes en caso de ser pdf o renombra si es una imagen con la nomencratura que usa en la edicion impresa.
Si son varias archivos ordenara por el nombre del archivo para ir asignandole el numero de pagina

### PDF

se puede subir un pdf con todas las paginas del diario(es lo recomendable) o varios pdf con una pagina cada uno. Si se sube un pdf con varias paginas la asignacion de numero de pagina lo ir asiendo correlativo a la paginas del pdf

### ZIP

en el archivo zip puede ir pdf o imagen y lo trabajara como se especifico antes

## Requrrimientos

- PHP 7.4 o superior
- Tener instalado en window [ Imagick](https://www.php.net/manual/en/imagick.setresolution.php) and [Ghostscript](https://www.ghostscript.com/) installed.

## Uso

llamar por POST al uploadFile.php pasandole los siguientes parametros( pasarlos en multipart/form-data):

- type: Tipo de archivo que subiras. tipos admitidos pdf,image,zip
- date: fecha de la cual pertenece las paginas(formato de fecha dddmmyy)
- product: seccion de la cuar pertenece las paginas( cantidad de caracteres 3)
- file: array de los archivos que se queren subir
  el endpoint devolvera code 204 en caso de subida correcta o code 400 si hubo errores
