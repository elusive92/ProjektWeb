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
 		  	  	<input type="text" class="form-control" name="login" value="<?=$this->input->post('login')?>">
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
 		  	  <label for="email" class="col-sm-2 control-label">Nick: </label>
 		  	  <div class="col-sm-4">
 		  	  	<input type="text" class="form-control" name="nick" value="<?=$this->input->post('nick')?>">
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