function actualizaListaTodo() {
	jQuery('#todoListTasks').html('<p><center>......</center></p>');
	jQuery.ajax({
		url: "/wp-json/todo/lista", 
        type: 'GET',
        dataType: 'json',
        success: function (data) {
        	jQuery('#todoListTasks').html('');
        	if (data.length>0) {
	        	data.forEach(function (todoItem) {
	        		let chkCompleto = todoItem.completado=="si" ? 'checked' : ''; 
	        		let cssCompleto = todoItem.completado=="si" ? 'class="taskComplete"' : ''; 
	        		let listItem = '';
	        		listItem += '<div class="todoListRow" id="todoListRow_'+todoItem.ID+'">';
		        		listItem += '<div class="taskChkBox"><input type="checkbox" class="chkTask" rel='+todoItem.ID+' '+chkCompleto+' /></div>';
		        		listItem += '<div class="taskTitle"><span id="taskTitle_'+todoItem.ID+'" '+cssCompleto+'>'+todoItem.post_title+'</span></div>';
		        		listItem += '<div class="taskBtn"><input type="button" class="btnDelTask" rel='+todoItem.ID+' value="Delete" /></div>';
	        		listItem += '</div>';
	        		jQuery('#todoListTasks').append(listItem);	
	        	});	
	        	jQuery('.chkTask').click(function () {
	        		const checkBox=jQuery(this);
	        		let postId=jQuery(this).attr("rel");
	        		
	        		jQuery.ajax({
	        			url: '/wp-json/todo/cambia-estado',
	        			type: 'POST',
	        			data: { 'post_id' : postId }, 
	        		}).done(function() {
	        			if (checkBox.is(":checked")) {
							jQuery("#taskTitle_"+postId).addClass("taskComplete");
						} else {
							jQuery("#taskTitle_"+postId).removeClass("taskComplete");
						}
	        		});
	        	});
	        	jQuery('.btnDelTask').click(function () {
	        		let postId=jQuery(this).attr("rel");
	        		jQuery.ajax({
	        			url: '/wp-json/todo/borra',
	        			type: 'POST',
	        			data: { 'post_id' : postId, 'completado': 'no' },
	        		}).done(function (data) {
	        			jQuery('#todoListRow_'+postId).hide('slow');
	        		});
	        	});

        	} else {
        		jQuery('#todoListTasks').html('');
        		
        	}
        	
        	
        },
        error: function () {
        	jQuery('#todoListTasks').html('Error');
        	console.log("Error reading data from API");
        }
	});
}


function enviaFormNuevaTarea() {
	jQuery("#formNewTask").submit(function(e) {

	    e.preventDefault(); 

	    var form = jQuery(this);
	    var actionUrl = form.attr('action');
	    
	    jQuery.ajax({
	        type: "POST",
	        url: actionUrl,
	        data: form.serialize(),
	    }).done(function (data) {
	    	jQuery('#txtNewTask').val('');
	    	actualizaListaTodo();
	    });
	    
	});
}


jQuery(document).ready(function () {
	console.log("plugin cargado");
	enviaFormNuevaTarea();
	actualizaListaTodo();
});
