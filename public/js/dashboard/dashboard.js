var Dashboard = function(){

    this.__construct = function(){
	console.log('Dashboard Created');
	Template = new DataTemplate();
	Event = new Event();
	Result = new EvtResult();
	load_todo();
	load_note();
    };

    var load_todo = function(){
	$.get('api/get_todo', function(o){
	    var output = '';
	    for(var i = 0; i < o.length; i++){
		output += Template.todo(o[i]);
	    }
	    $("#list-todos").html(output+'');
	}, 'json');

    };

    var load_note = function(){
	$.get('api/get_note', function(o){
	    var output = '';
	    for(var i = 0; i < o.length; i++){
		output += Template.note(o[i]);
	    }
	    $("#list-notes").html(output + '');
	}, 'json');
    };

   
    this.__construct();


};
