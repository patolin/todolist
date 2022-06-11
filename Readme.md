# todo-plugin

Plugin para generar un ToDo List, mediante shortcode [todolist]

# Uso

Para usar el plugin se deben seguir los siguientes pasos:

1.- Clonar el repositorio dentro de la carpeta /wp-content/plugins de su instalación de wordpress (o descargar en archivo zip desde github y descomprimirlo el contenod dentro de carpeta de plugins de wordpress)

2.- Activar el plugin desde la consola administrativa de wordpress

3.- Editar la página o post donde se desee colocar la lista de tareas, y usar el shortcode [todolist]

La lista de tareas creadas se puede crear y modificar desde la página o post donde se coloque el shortcode, o desde la consola administrativa en el blocke To Do List.

El plugin usa un custom API Rest, cuyos endpoints se encuentran en el archivo plugin_rest_api.php


# Comentarios

El plugin incluye el archivo plugin_config.php, donde se pueden editar los textos de los elementos html del listado, ademas del tipo de Custom Post Type usado para el efecto.

Los eventos AJAX de completado y borrado de tarea, generan acción de respuesta en caso de respuesta positiva del API.

El plugin se encuentra instalado, y puede ser probado en https://patolin.com/plugin-todo
