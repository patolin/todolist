# todo-plugin

Plugin para generar un ToDo List, mediante shortcode [todolist]

![alt text](https://github.com/patolin/todolist/raw/main/todo_screenshot.png "Ejemplo de shortcode ejecutado en la página")

# Uso

Para usar el plugin se deben seguir los siguientes pasos:

1.- Clonar el repositorio dentro de la carpeta /wp-content/plugins de su instalación de wordpress (o descargar en archivo zip desde github y descomprimirlo el contenod dentro de carpeta de plugins de wordpress. Asegurarse de cambiar el nombre de la carpeta descomprimida de todolist-main a todolist).

2.- Activar el plugin "ToDo List plugin" desde la consola administrativa de wordpress, en la sección plugins.

3.- Editar la página o post donde se desee colocar la lista de tareas, y usar el shortcode [todolist].

La lista de tareas creadas se puede crear y modificar desde la página o post donde se coloque el shortcode, o desde la consola administrativa en el blocke To Do List.

# Comentarios

- El plugin usa un custom API Rest, cuyos endpoints se encuentran en el archivo plugin_rest_api.php.
- El plugin incluye el archivo plugin_config.php, donde se pueden editar los textos de los elementos html del listado, ademas del tipo de Custom Post Type usado para el efecto.
- Los eventos AJAX de completado y borrado de tarea, generan acción de respuesta en caso de respuesta positiva del API.
- El plugin se encuentra instalado, y puede ser probado en https://patolin.com/plugin-todo
- Se puede personalizar el estilo, modificando el archivo todoplugin.css contenido en la carpeta /css del plugin
