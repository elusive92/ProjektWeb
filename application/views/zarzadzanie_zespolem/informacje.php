<div class="container">
  <div class="row">
  	<div class="col-md-12">
      
 	  <h3>Informacje</h3>
 	  <br>

 	  <?php if(isset($validation_errors)): ?>
			<div class="alert alert-danger"><?=$validation_errors?></div>
		<?php endif; ?>

		<?php if(isset($success)): ?>
			<div class="alert alert-success">Informacje zostały zaktualizowane</div>
		<?php endif; ?>

 		  <form action="/zarzadzanie-zespolem/<?=$band->band_id?>/informacje" method="post" class="form-horizontal">
 		  <input type="hidden" name="informacje" value="true">
 		  	
 		  	<div class="form-group">
 		  	  <label for="name" class="col-sm-2 control-label">Nazwa zespołu: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="text" class="form-control" name="name" value="<?=$band->name?>">
 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="genre" class="col-sm-2 control-label">Gatunek: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="text" class="form-control" name="genre" value="<?=$band->genre?>">
 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="province" class="col-sm-2 control-label">Województwo: </label>
 		  	  <div class="col-sm-4">
 		  	  	<select class="form-control" name="province" id="provinces">
 		  	  	<option value="" disabled selected>wybierz województwo...</option>
 		  	  	<?php foreach($provinces as $prov): ?>
 		  	  		<option value="<?=$prov->province_id?>" 
 		  	  			<?=($band->province_id==$prov->province_id ? 'selected' : '')?>>
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
 		  	  		<option value="<?=$band->place_id?>"><?=$band->place_name?></option>
 		  	  	</select>
 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="bio" class="col-sm-2 control-label">Biografia: </label>
 		  	  <div class="col-sm-4">
 		  	  	<textarea class="form-control" name="bio" rows="5"><?=$band->bio?></textarea>
 		  	  </div>
 		  	</div>

 		  	<div class="col-sm-6 text-right">
 		  		<button type="submit" class="btn btn-success">Aktualizuj</button>
 		  	</div>
 		  	
 		  </form><div style="clear:both"></div><br><br>

 		  <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
 		  	<input type="hidden" name="zdjecie" value="true">

 		  	<div class="form-group">
 		  	  <label for="image" class="col-sm-2 control-label" style="margin-top:30px;">Zdjęcie: </label>
 		  	  <div class="col-sm-2">
 		  	  	<p class="form-control-static">
 		  	  		<img src="<?=get_thumb($band->photo)?>">
 		  	  	</p>
 		  	  </div>
 		  	  <div class="col-sm-2 text-right" style="margin-top:20px;">
 		  	  	<p class="form-control-static">
 		  	  		<a href="/zarzadzanie-zespolem/<?=$band->band_id?>/usun-zdjecie" class="btn btn-danger">
 		  	  			usuń zdjęcie
 		  	  		</a>
 		  	  	</p>
 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="image" class="col-sm-2 control-label">Nowe zdjęcie: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="file" class="form-control" name="image">
 		  	  </div>
 		  	</div>

 		  	<div class="col-sm-6 text-right">
 		  		<button type="submit" class="btn btn-success">Zmień zdjęcie</button>
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

