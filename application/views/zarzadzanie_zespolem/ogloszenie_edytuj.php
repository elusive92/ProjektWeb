<div class="container">
  <div class="row">
  	<div class="col-md-12">
      
 	  <h3>Ogłoszenia &raquo; Edytuj ogłoszenie</h3>
 	  <br>

 	  <?php if(isset($validation_errors)): ?>
		<div class="alert alert-danger"><?=$validation_errors?></div>
		<?php endif; ?>

 		  <form action="" method="post" class="form-horizontal">
 		  	
 		  	<div class="form-group">
 		  	  <label for="title" class="col-sm-2 control-label">Tytuł ogłoszenia: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="text" class="form-control" name="title" value="<?=$ad->ad_title?>">
 		  	  </div>
 		  	  </div>

 		  	<div class="form-group">
 		  	  <label for="content" class="col-sm-2 control-label">Treść ogłoszenia: </label>
 		  	  <div class="col-sm-4">
 		  	  	<textarea class="form-control" name="content" rows="7"><?=$ad->ad_content?></textarea>
 		  	  </div>
 		  	</div>


 		  	<div class="col-sm-6 text-right">
 		  		<button type="submit" class="btn btn-success">Edytuj</button>
 		  	</div>
 		  	
 		  </form>
 	
  	</div>
  </div>
</div>