<div class="container">
<div class="row">
    <div class="span6">
	
	<form action="<?= site_url('api/login') ?>" class="form-horizontal" method="post" id="login_form">
	    <div class="control-group">
		<label class="control-label" for="login">Login</label>
		<div class="controls">
		    <input class="input-xlarge" name="login" type="text" value=""/>
		</div>
	    </div>
	    <div class="control-group">
		<label class="control-label" for="password">Password</label>
		<div class="controls">
		    <input class="input-xlarge" name="password" type="password" value=""/>
		</div>
	    </div>
	    <div class="control-group">
		<div class="controls">
		    <input class="btn btn-primary" type="submit" value="Login"/>
		</div>
	    </div>


	</form>

	<a href="<?= site_url('home/register') ?>">Register</a>

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
