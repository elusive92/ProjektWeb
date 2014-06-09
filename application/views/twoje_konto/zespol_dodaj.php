<div class="container">
  <div class="row">
  	<div class="col-md-12">
      
 	  <h3>Twoje zespoły &raquo; Stwórz zespół</h3>
 	  <br>

 	  <?php if(isset($validation_errors)): ?>
		<div class="alert alert-danger"><?=$validation_errors?></div>
		<?php endif; ?>

 		  <form action="/twoje-konto/zespoly/dodaj" method="post" class="form-horizontal">
 		  	
 		  	<div class="form-group">
 		  	  <label for="name" class="col-sm-2 control-label">Nazwa zespołu: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="text" class="form-control" name="name" value="<?=$this->input->post('name')?>">
 		  	  </div>
 		  	  </div>

 		  	<div class="form-group">
 		  	  <label for="role" class="col-sm-2 control-label">Twoja rola: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="text" class="form-control" name="role" value="<?=$this->input->post('role')?>">
 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="genre" class="col-sm-2 control-label">Gatunek muzyki: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="text" class="form-control" name="genre" value="<?=$this->input->post('genre')?>">
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
 		  	  	<textarea class="form-control" name="bio" rows="5"><?=$this->input->post('bio')?></textarea>
 		  	  </div>
 		  	</div>

 		  	<div class="col-sm-6 text-right">
 		  		<button type="submit" class="btn btn-success">Utwórz</button>
 		  	</div>
 		  	
 		  </form>
 	
  	</div>
  </div>
</div>

<script>
$(document).ready(function() {

	$('#provinces').change(function() {
		$.get('/rejestracja/get_places', { province_id: $('#provinces').val() }, function(data) {
			if(data) {

				$('#places').html(data);
			
			}
		});
	});

});
</script>