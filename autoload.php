<?php
function controller_autoload($class) {
    include 'controllers/' . $class . '.php';
}

/* spl_autoload_register() = Utiliza la función controller_autoload para 
   buscar todas las clases que hay en el directorio que se indica
   e incluir los include. 
   Tambíen encuentra de forma automática los nameSpaces*/
spl_autoload_register('controller_autoload');