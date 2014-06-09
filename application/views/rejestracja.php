<div class="container">
  <div class="row">
  	<div class="col-md-12">
      
      <div class="panel panel-default">
      	<div class="panel-body">
 		<h3>Rejestracja</h3><br>

 		<?php if(isset($validation_errors)): ?>
		<div class="alert alert-danger"><?=$validation_errors?></div>
		<?php endif; ?>

 		  <form action="/rejestracja" method="post" class="form-horizontal">
 		  	
 		  	<div class="form-group">
 		  	  <label for="login" class="col-sm-2 control-label">Login: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="text" id="login" class="form-control" name="login" value="<?=$this->input->post('login')?>">
 		  	  </div>
 		  	  <div class="col-sm-4" id="login_info">

 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="pass" class="col-sm-2 control-label">Hasło: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="password" class="form-control" name="pass">
 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="passconf" class="col-sm-2 control-label">Powtórz hasło: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="password" class="form-control" name="passconf">
 		  	  </div>
 		  	</div>
 		  
 		  	<div class="form-group">
 		  	  <label for="nick" class="col-sm-2 control-label">Nick: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="text" class="form-control" name="nick" value="<?=$this->input->post('nick')?>">
 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="instrument" class="col-sm-2 control-label">Instrument: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="text" class="form-control" name="instrument" value="<?=$this->input->post('instrument')?>">
 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="province" class="col-sm-2 control-label">Województwo: </label>
 		  	  <div class="col-sm-4">
 		  	  	<select class="form-control" name="province" id="provinces">
 		  	  	<option value="" disabled selected>wybierz województwo...</option>
 		  	  	<?php foreach($provinces as $prov): ?>
 		  	  		<option value="<?=$prov->province_id?>" 
 		  	  			<?=($this->input->post('province')==$prov->province_id ? 'selected' : '')?>>
 		  	  			<?=$prov->province_name?>
 		  	  		</option>
 		  	  	<?php endforeach; ?>
 		  	  	</select>
 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="place" class="col-sm-2 control-label">Miejscowość: </label>
 		  	  <div class="col-sm-4">
 		  	  	<select class="form-control" name="place" id="places">
 		  	  	<?php if($this->input->post('place')): ?>
 		  	  		<option value="<?=$selected_place->place_id?>"><?=$selected_place->place_name?></option>
 		  	  	<?php else: ?>
 		  	  		<option value="" disabled selected>wybierz województwo...</option>
 		  	  	<?php endif; ?>
 		  	  	</select>
 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="bio" class="col-sm-2 control-label">Biografia: </label>
 		  	  <div class="col-sm-4">
 		  	  	<textarea class="form-control" name="bio" rows="7"><?=$this->input->post('bio')?></textarea>
 		  	  </div>
 		  	</div>

 		  	<div class="col-sm-6 text-right">
 		  		<button type="submit" class="btn btn-success">Dalej</button>
 		  	</div>
 		  	
 		  </form>

 		</div>
 	  </div>

  	</div>
  </div>
</div>

<script>
$(document).ready(function() {

	$('#login').change(function() {
	  $.post('/rejestracja/logincheck', { login: $('#login').val() }, function(data) {

	    if(data.login_exists) {
	    	$('#login_info').html('<span class="label label-danger">Podany login jest zajęty</span>');
	    }
	    else {
	    	$('#login_info').html('<span class="label label-success">Podany login jest dostępny</span>');
	    }

	 }, 'JSON');
	});

	$('#provinces').change(function() {
		$.get('/rejestracja/get_places', { province_id: $('#provinces').val() }, function(data) {
			if(data) {

				$('#places').html(data);
			
			}
		});
	});

});
</script>