var Event = function(){

    // -------------------------------------------------------------------
    
    this.__construct = function(){
	Result = new EvtResult();
	Template = new DataTemplate();
	create_todo();
	create_note();
	update_note_btn();
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
		    $("#create_todo input[type=text]").val('');

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
		    $("#create_note input[type=text]").val('');
		    $("#create_note textarea").val('');
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
    
    var update_note_btn= function(){
	$("body").on('click', '.update_note_btn', function(evt) {
	    var btn_type = $(this).html();
	    console.log(btn_type);
	    if(btn_type === "Update"){
		$(this).html("Cancel");
		var obj = {
		    note_id: $(this).attr('data-id'),
		    title: $(this).prevAll('h4').first().html(),
		    content: $(this).prevAll('span.list-group-item-text').first().html()
		};
		$(this).after(Template.update_form(obj));

	    }else{
		$(this).html("Update").next().remove();
	    }
	    	    
	});
	
    };

    var update_note = function(){
	$("body").on('submit', '.update_note',function(evt){
	    evt.preventDefault();
	    var url = $(this).attr('action'); // this refers to the form
	    var postData = $(this).serialize();
	    var update_form = $(this);
	    var title = update_form.find('[name=title]').first().val();
	    var content = update_form.find('[name=content]').first().val();
	    $.post(url, postData, function(o){
	    	if(o.result == 1){
	    	    Result.success('Note item was updated');
		    update_form.prevAll('h4').first().html(title);
		    update_form.prevAll('span.list-group-item-text').first().html(content);
		    update_form.remove();
	    	}else{
	    	    Result.error(o.error);
	    	}
	    }, 'json');
	    return false;

	});
    };

    var delete_todo = function(){
	$("body").on('click', '.delete_todo', function(evt){
	    evt.preventDefault();
	    if(confirm("Are you sure you want to delete?") == false) return false;
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

	    return true;
	});
    };
    
    var delete_note = function(){
	$("body").on('click', '.delete_note', function(evt){
	    evt.preventDefault();
	    if(confirm("Are you sure you want to delete?") == false) return false;
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
	    return true;
	});

    };
    
    this.__construct();
    
    
};
