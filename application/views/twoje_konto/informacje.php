<div class="container">
  <div class="row">
  	<div class="col-md-12">
      
 	  <h3>Informacje</h3>
 	  <br>

 	  <?php if(isset($validation_errors)): ?>
		<div class="alert alert-danger"><?=$validation_errors?></div>
		<?php endif; ?>

 		  <form action="/twoje-konto/informacje" method="post" class="form-horizontal">
 		  	<input type="hidden" name="informacje" value="true">
 		  	
 		  	<div class="form-group">
 		  	  <label for="login" class="col-sm-2 control-label">Login: </label>
 		  	  <div class="col-sm-4">
 		  	  	<p class="form-control-static"><?=$account->login?></p>
 		  	  </div>
 		  	  <div class="col-sm-4" id="login_info">

 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="pass" class="col-sm-2 control-label">Hasło: </label>
 		  	  <div class="col-sm-4">
 		  	  	<p class="form-control-static">
 		  	  		<a href="" data-toggle="modal" data-target="#passChange">zmień hasło</a>
 		  	  	</p>
 		  	  </div>
 		  	</div>
 		  
 		  	<div class="form-group">
 		  	  <label for="email" class="col-sm-2 control-label">Nick: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="text" class="form-control" name="nick" value="<?=$account->nick?>">
 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="instrument" class="col-sm-2 control-label">Instrument: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="text" class="form-control" name="instrument" value="<?=$account->instrument?>">
 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="province" class="col-sm-2 control-label">Województwo: </label>
 		  	  <div class="col-sm-4">
 		  	  	<select class="form-control" name="province" id="provinces">
 		  	  	<option value="" disabled selected>wybierz województwo...</option>
 		  	  	<?php foreach($provinces as $prov): ?>
 		  	  		<option value="<?=$prov->province_id?>" 
 		  	  			<?=($account->province_id==$prov->province_id ? 'selected' : '')?>>
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
 		  	  		<option value="<?=$account->place_id?>"><?=$account->place_name?></option>
 		  	  	</select>
 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="bio" class="col-sm-2 control-label">Biografia: </label>
 		  	  <div class="col-sm-4">
 		  	  	<textarea class="form-control" name="bio" rows="5"><?=$account->bio?></textarea>
 		  	  </div>
 		  	</div>

 		  	<div class="col-sm-6 text-right">
 		  		<button type="submit" class="btn btn-success">Aktualizuj</button>
 		  	</div>
 		  	
 		  </form>
 		  <div style="clear:both"></div><br>

 		  <br>

 		  <form method="post" action="/twoje-konto/informacje" class="form-horizontal" enctype="multipart/form-data">
 		  	<input type="hidden" name="zdjecie" value="true">

 		  	<div class="form-group">
 		  	  <label for="image" class="col-sm-2 control-label" style="margin-top:30px;">Zdjęcie: </label>
 		  	  <div class="col-sm-2">
 		  	  	<p class="form-control-static">
 		  	  		<img src="<?=get_thumb($account->photo)?>">
 		  	  	</p>
 		  	  </div>
 		  	  <div class="col-sm-2 text-right" style="margin-top:20px;">
 		  	  	<p class="form-control-static">
 		  	  		<a href="/twoje-konto/usun-zdjecie" class="btn btn-danger">usuń zdjęcie</a>
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

	<!-- password change modal -->
	<form action="" method="post" class="form-horizontal">
	<input type="hidden" name="pass_change" value="1">
		<div class="modal fade" id="passChange" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Zmiana hasła</h4>
		      </div>
		      <div class="modal-body">
		        
		      <?php if(isset($pass_validation_errors)): ?>
					<div class="alert alert-danger"><?=$pass_validation_errors?></div>
					<?php endif; ?>

			 		  	<div class="form-group">
			 		  	  <label for="" class="col-sm-4 control-label">Aktualne hasło: </label>
			 		  	  <div class="col-sm-6">
			 		  	  	<input type="password" class="form-control" name="current_pass">
			 		  	  </div>
			 		  	</div>

			 		  	<div class="form-group">
			 		  	  <label for="" class="col-sm-4 control-label">Nowe hasło: </label>
			 		  	  <div class="col-sm-6">
			 		  	  	<input type="password" class="form-control" name="new_pass">
			 		  	  </div>
			 		  	</div>

			 		  	<div class="form-group">
			 		  	  <label for="" class="col-sm-4 control-label">Potwierdź hasło: </label>
			 		  	  <div class="col-sm-6">
			 		  	  	<input type="password" class="form-control" name="new_pass_confirm">
			 		  	  </div>
			 		  	</div>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
		        <button type="submit" class="btn btn-success">Zmień hasło</button>
		      </div>
		    </div>
		  </div>
		</div>
	</form>
	<!-- end modal -->

<?php if($this->input->post('pass_change')): ?>
	<script type="text/javascript">
    $(window).load(function(){
        $('#passChange').modal('show');
    });
	</script>
<?php endif; ?>

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

