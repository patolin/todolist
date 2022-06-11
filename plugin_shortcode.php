<?php
// shortcode functions
function viewTodoList() {
    $out='<div class="todoListBox">';
    $out.='<h1>'.$GLOBALS["PLUGIN_TITLE"].'</h1>';
    $out.='<div id="todoNewTask">';
    $out.='<form id="formNewTask" action="/wp-json/todo/nuevo" method="post"><input type="text" class="txtBox" name="txtNewTask" id="txtNewTask" placeholder="'.$GLOBALS["TXT_FIELD_PLACEHOLDER"].'" /><input type="submit" class="btnBox" value="'.$GLOBALS["BTN_ADD_TEXT"].'" /></form>';
    $out.='</div>';    
    $out.='<div class="todoListTasks" id="todoListTasks"></div>';
    $out.='</div>';
    return $out;
}

add_shortcode('todolist', 'viewTodoList'); 

?>