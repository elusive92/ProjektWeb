<div class="container">
  <div class="row">
  	<div class="col-md-12">
      
 	  <h3>Informacje &raquo; Zmień hasło</h3>
 	  <br>

 	  <?php if(isset($validation_errors)): ?>
		<div class="alert alert-danger"><?=$validation_errors?></div>
		<?php endif; ?>

 		  <form action="/twoje-konto/utwory/dodaj" method="post" class="form-horizontal" enctype="multipart/form-data">
 		  	
 		  	<div class="form-group">
 		  	  <label for="" class="col-sm-2 control-label">Aktualne hasło: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="password" class="form-control" name="current_pass">
 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="" class="col-sm-2 control-label">Nowe hasło: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="password" class="form-control" name="new_pass">
 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="" class="col-sm-2 control-label">Potwierdź hasło: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="password" class="form-control" name="new_pass_confirm">
 		  	  </div>
 		  	</div>

 		  	<div class="col-sm-6 text-right">
 		  		<button type="submit" class="btn btn-success">Zmień</button>
 		  	</div>
 		  	
 		  </form>
 	
  	</div>
  </div>
</div>