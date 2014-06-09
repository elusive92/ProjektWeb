<div class="container">
  <div class="row">
  	<div class="col-md-12">
      
 	  <h3>Utwory &raquo; Dodaj utwór</h3>
 	  <br>

 	  <?php if(isset($validation_errors)): ?>
		<div class="alert alert-danger"><?=$validation_errors?></div>
		<?php endif; ?>

 		  <form action="/twoje-konto/utwory/dodaj" method="post" class="form-horizontal" enctype="multipart/form-data">
 		  	
 		  	<div class="form-group">
 		  	  <label for="title" class="col-sm-2 control-label">Tytuł utworu: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="text" class="form-control" name="title" value="<?=$this->input->post('title')?>">
 		  	  </div>
 		  	  </div>

 		  	<div class="form-group">
 		  	  <label for="content" class="col-sm-2 control-label">Opis utworu: </label>
 		  	  <div class="col-sm-4">
 		  	  	<textarea class="form-control" name="content" rows="7"><?=$this->input->post('content')?></textarea>
 		  	  </div>
 		  	</div>

 		  	<div class="form-group">
 		  	  <label for="file" class="col-sm-2 control-label">Plik: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="file" class="form-control" name="file">
 		  	  	<span class="help-block">dostępne formaty: .mp3</span>
 		  	  </div>
 		  	</div>


 		  	<div class="col-sm-6 text-right">
 		  		<button type="submit" class="btn btn-success">Dodaj</button>
 		  	</div>
 		  	
 		  </form>
 	
  	</div>
  </div>
</div>