<div class="container">
  <div class="row">
  	<div class="col-md-12">
      
 	  <h3>Utwory &raquo; Edytuj utwór</h3>
 	  <br>

 	  <?php if(isset($validation_errors)): ?>
		<div class="alert alert-danger"><?=$validation_errors?></div>
		<?php endif; ?>

 		  <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
 		  	
 		  	<div class="form-group">
 		  	  <label for="title" class="col-sm-2 control-label">Tytuł utworu: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="text" class="form-control" name="title" value="<?=$audio->audio_title?>">
 		  	  </div>
 		  	  </div>

 		  	<div class="form-group">
 		  	  <label for="description" class="col-sm-2 control-label">Opis utworu: </label>
 		  	  <div class="col-sm-4">
 		  	  	<textarea class="form-control" name="description" rows="7"><?=$audio->audio_description?></textarea>
 		  	  </div>
 		  	</div>

 		  	<div class="col-sm-6 text-right">
 		  		<button type="submit" class="btn btn-success">Edytuj</button>
 		  	</div>
 		  	
 		  </form>
 	
  	</div>
  </div>
</div>