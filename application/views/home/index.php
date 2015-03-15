<div class="container">
<div class="row">
    <div class="col-md-6 col-md-offset-2">
	
        <div class="page-header">
	    <h2>Login</h2>
	</div>
	<form action="<?= site_url('api/login') ?>" class="form-horizontal" method="post" id="login_form">
	    <div class="form-group">
		<label class="control-label" for="login">Username</label>
		<div class="controls">
		    <input class="form-control" name="login" type="text" value=""/>
		</div>
	    </div>
	    <div class="form-group">
		<label class="control-label" for="password">Password</label>
		<div class="controls">
		    <input class="form-control" name="password" type="password" value=""/>
		</div>
	    </div>
	    </br>
	    <div class="form-group">
		<div class="controls">
		    <input class="btn btn-primary" type="submit" value="Login"/>
		    <a class="btn btn-default" href="<?= site_url('home/register') ?>">Register</a>
		</div>
	    </div>


	</form>


    </div>
</div>
</div>

<script>
 $(function(){
     $("#login_form").submit(function(evt){
	 evt.preventDefault(); 
	 var url = $(this).attr('action');
	 var postData = $(this).serialize();

	 $.post(url,postData, function(o){
	     if(o.result == 1)
		 window.location.href = '<?= site_url('/dashboard') ?>';
	     else
		 alert('invalid login');
	 }, 'json');
     });
 });
 
</script>
