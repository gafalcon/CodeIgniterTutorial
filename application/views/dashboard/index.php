<div class="container">
	<div id="error" class="alert alert-danger hide-alert"></div>
	<div id="success" class="alert alert-success hide-alert"></div>

    <div class="row" id="dashboard container">
	<div class="col-md-4">
	    <div id="dashboard-side">
		<form action="/ci/api/create_todo" id="create_todo">
		    <input name="content" type="text" value="" placeholder="Create New Todo item"/>
		    <input name="" type="submit" value="Create"/>
		</form>
		<div id="list-todos" class="list-group"></div>
	    </div>
        </div>
	
	<div class="col-md-8 ">
	    <div id="dashboard-main">
		<form action="/ci/api/create_note" id="create_note" class="form-inline">
		    <input name="title" type="text" value="" placeholder="Note Title"/>
		    <textarea class="form-control" cols="30" id="" name="content" rows="2"></textarea>
		    <input name="" type="submit" value="Create"/>
		</form>

		<div id="list-notes" class="list-group"></div>
		
	    </div>
	</div>
    </div>
    
</div>
