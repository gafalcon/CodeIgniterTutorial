var Event = function(){

    // -------------------------------------------------------------------

    this.__construct = function(){
	Result = new EvtResult();
	Template = new DataTemplate();
	create_todo();
	create_note();
	update_note();
	update_todo();
	delete_note();
	delete_todo();
    };

    // -------------------------------------------------------------------

    var create_todo = function(){
	$("#create_todo").submit(function(evt){
	    
	    evt.preventDefault();
	    var url = $(this).attr('action'); // this refers to the form
	    var postData = $(this).serialize();
	    
	    $.post(url, postData, function(o){
		if(o.result == 1){
		    Result.success('Todo item was created');
		    $("#list-todos").prepend(Template.todo(o.data));

		}else{
		    Result.error(o.error);
		}
	    }, 'json');
	    return false;
	});
    };
    
    // -------------------------------------------------------------------
    
    var create_note = function(){
	$("#create_note").submit(function(evt){
	    evt.preventDefault();
	    var url = $(this).attr('action'); // this refers to the form
	    var postData = $(this).serialize();
	    
	    $.post(url, postData, function(o){
		if(o.result == 1){
		    Result.success('Note item was created');
		    $("#list-notes").prepend(Template.note(o.data));

		}else{
		    Result.error(o.error);
		}
	    }, 'json');
	    return false;

	});
    };
    
    var update_todo = function(){
	$("body").on('change', '.update_todo', function(evt){
	    evt.preventDefault();
	    var text = $(this).next('span');
	    var url = "api/update_todo";
	    var completed = 0;
	    if(this.checked){
		completed = 1;
		$(text).addClass('crossed');
	    }else{
		$(text).removeClass('crossed');
	    }
	    var postData = {
	    	'todo_id' : $(this).attr('data-id'),
	    	'completed': completed 
	    };

	    $.post(url,postData, function(o){
		if(o.result == 1){
		    Result.success('Todo item updated');
		}else{
		    Result.error(o.msg);
		}

	    }, 'json');
	});
    };
    
    var update_note = function(){
	
    };
    
    var delete_todo = function(){
	$("body").on('click', '.delete_todo', function(evt){
	    evt.preventDefault();
	    var self = $(this).parent('div');
	    var url = $(this).attr('href');
	    var postData = {
		'todo_id' : $(this).attr('data-id')
	    };
	    $.post(url,postData, function(o){
		if(o.result == 1){
		    Result.success('Todo item deleted');
		    self.remove();
		}else{
		    Result.error(o.msg);
		}

	    }, 'json');
	});
    };
    
    var delete_note = function(){
	$("body").on('click', '.delete_note', function(evt){
	    evt.preventDefault();
	    var self = $(this).parent('div');
	    var url = $(this).attr('href');
	    var postData = {
		'note_id' : $(this).attr('data-id')
	    };
	    $.post(url,postData, function(o){
		if(o.result == 1){
		    Result.success('Note item deleted');
		    self.remove();
		}else{
		    Result.error(o.msg);
		}

	    }, 'json');
	});

    };
    
    this.__construct();
    
    
};
