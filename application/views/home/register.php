<div class="container">
<div class="row">
    <div class="col-md-6">
	<div class="alert alert-danger" id="register_form_error">
	   <!-- Dynamic -->
	</div>
	
	<form action="<?= site_url('api/register') ?>" class="form-horizontal" method="post" id="register_form">

	    <div class="control-group">
		<label class="control-label" for="login">Login</label>
		<div class="controls">
		    <input class="input-xlarge" name="login" type="text" value=""/>
		</div>
	    </div>

	    <div class="control-group">
		<label class="control-label" for="email">Email</label>
		<div class="controls">
		    <input class="input-xlarge" name="email" type="text" value=""/>
		</div>
	    </div>

	    <div class="control-group">
		<label class="control-label" for="password">Password</label>
		<div class="controls">
		    <input class="input-xlarge" name="password" type="password" value=""/>
		</div>
	    </div>
	    <div class="control-group">
		<label class="control-label" for="passconf">Password Confirmation</label>
		<div class="controls">
		    <input class="input-xlarge" name="passconf" type="password" value=""/>
		</div>
	    </div>
	    <div class="control-group">
		<div class="controls">
		    <input class="btn btn-primary" type="submit" value="Register"/>
		</div>
	    </div>


	</form>

	<a href="<?= site_url('') ?>">Back</a>

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
