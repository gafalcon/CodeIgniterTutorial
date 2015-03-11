<h2>Create a news item</h2>
<?php echo validation_errors(); ?>
<?php echo form_open('news/create') ?>

<label for="title">Title</label>
<input name="title" type="text" value=""/><br/>
<label for="text">Text</label>
<textarea cols="30" id="txtarea" name="text" rows="10"></textarea><br/>

<input name="submit" type="submit" value="create news item"/>

</form>
