var DataTemplate = function(){

    // -------------------------------------------------------------------

    this.__construct = function(){
	console.log('Template Created');

    };

    // -------------------------------------------------------------------

    this.todo = function(obj){
	var checked = '';
	var crossed = '';
	if(obj.completed == 1){
	    crossed = 'class="crossed"';
	    checked = "checked";
	}
	var output = '';
	output += '<div class="list-group-item" id="todo_'+obj.todo_id+'">';
	output += '<input class="update_todo" type="checkbox" data-id="'+obj.todo_id+'" '+checked+'>';
	output += '<span '+crossed+'>'+obj.content+'</span>';
	output += '<a href="api/delete_todo" data-id="'+obj.todo_id+'" class="delete_todo"><span class="badge">delete</span></a>';
	output += '</div>';
	return output;

    };

    // -------------------------------------------------------------------
    this.note = function(obj){
	var output = '';
	output += '<div id="note_'+obj.note_id+'" class="list-group-item">';
	output += '<h4 class="list-group-item-heading"> <strong>'+ obj.title + '</strong></h4>';
	output += '<span class="list-group-item-text">'+ obj.content + '</span>';
	output += '<a href="api/delete_note" class="delete_note" data-id="'+obj.note_id+'"><span class="badge">delete</span></a>';
	output += '</div>';
	return output;

    };


    this.__construct();


};
