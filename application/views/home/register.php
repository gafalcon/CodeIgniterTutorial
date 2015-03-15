<div class="container">
<div class="row">
    <div class="col-md-6 col-md-offset-2">
	<div class="alert alert-danger" id="register_form_error">
	   <!-- Dynamic -->
	</div>
        <div class="page-header"><h2>Register</h2></div>  
	<form action="<?= site_url('api/register') ?>" class="form-horizontal" method="post" id="register_form">

	    <div class="form-group">
		<label class="control-label" for="login">Login</label>
		<div class="controls">
		    <input class="form-control" name="login" type="text" value=""/>
		</div>
	    </div>

	    <div class="form-group">
		<label class="control-label" for="email">Email</label>
		<div class="controls">
		    <input class="form-control" name="email" type="text" value=""/>
		</div>
	    </div>

	    <div class="form-group">
		<label class="control-label" for="password">Password</label>
		<div class="controls">
		    <input class="form-control" name="password" type="password" value=""/>
		</div>
	    </div>
	    <div class="form-group">
		<label class="control-label" for="passconf">Password Confirmation</label>
		<div class="controls">
		    <input class="form-control" name="passconf" type="password" value=""/>
		</div>
	    </div>
	    <div class="form-group">
		<div class="controls">
		    <input class="btn btn-primary" type="submit" value="Register"/>
	<a class="btn btn-default"href="<?= site_url('') ?>">Back</a>
		</div>
	    </div>


	</form>


    </div>
</div>
</div>

<script>
 $(function(){
     $("#register_form_error").hide();
     $("#register_form").submit(function(evt){
	 evt.preventDefault(); 
	 var url = $(this).attr('action');
	 var postData = $(this).serialize();

	 $.post(url,postData, function(o){
	     if(o.result == 1)
		 window.location.href = '<?= site_url('/dashboard') ?>';
	     else{
		 $("#register_form_error").show();
		 var output = '<ul>';
		 for(var key in o.error_array){
		     var value = o.error_array[key];
		     output +='<li>'+key+': '+value+'</li>'; 
		 }
		 output += '</ul>';
		 $("#register_form_error").html(output);
	     }
	 }, 'json');
     });
 });
 
</script>
