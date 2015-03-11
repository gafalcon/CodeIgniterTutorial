var EvtResult = function(){

    // -------------------------------------------------------------------

    this.__construct = function(){
	console.log('Result Created');
    };

    this.success = function(msg){
	var dom = $("#success");
	if(typeof(msg) === 'undefined'){
	    dom.html("Success!");
	}
	else{
	    dom.html(msg);
	}
	dom.fadeIn();

	setTimeout(function(){
	    dom.fadeOut();
	}, 5000);
    };

    this.error = function(msg){
	var dom = $("#error");
	if(typeof(msg) === 'undefined')
	    dom.html("Error!");
	else if(typeof(msg) === 'object'){
	    var output = '<ul>';
	    for(var key in msg){
		output += '<li>'+msg[key]+'</li>';
	    }
	    output += '</ul>';
	    dom.html(output);
	}else
	    dom.html(msg);
	dom.fadeIn();

	setTimeout(function(){
	    dom.fadeOut();
	}, 5000);
    };
    
    this.__construct();

};
