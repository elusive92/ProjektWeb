<div class="container">
  <div class="row">
  	<div class="col-md-12">
      
 	  <h3>Członkowie zespołu</h3>
 	  <br>

 	  <?php
    if(empty($members)):
    ?>
    Brak artystów
    <?php
    else:
    ?>
    <table class="table table-hover table-striped">
    <thead>
    <td> Artysta </td>
    <td style="width:450px"> Rola </td>
    <td> Operacje </td>
    </thead>
    <?php
    foreach($members as $i => $member):
    ?>

      <tr>
        <td>
          <a href="/artysci/pokaz/<?=$member->artist_account_id?>"><?=$member->nick?></a>
        </td>
        <td>
          <?=$member->role?>
        </td>
        <td>
          <?php if($band->band_artist_id != $member->member_artist_id): ?> 
            <a href="/zarzadzanie-zespolem/<?=$band->band_id?>/czlonkowie/usun/<?=$member->artist_account_id?>" class="btn btn-danger">usuń</a>
          <?php endif; ?>
        </td>
      </tr>

    <?php
    endforeach;
    ?>
    </table>
    <?php
    endif;
    ?>

		<button class="btn btn-success" data-toggle="modal" data-target="#addMember">
		  Dodaj
		</button>


    <form action="" method="post" class="form-horizontal">
		<div class="modal fade" id="addMember" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Dodaj członka zespołu</h4>
		      </div>
		      <div class="modal-body">

          <?php if(isset($validation_errors)): ?>
          <div class="alert alert-danger"><?=$validation_errors?></div>
          <?php endif; ?>
		        
		 		  	<div class="form-group">
              <label for="nick" class="col-sm-3 control-label">Artysta: </label>
              <div class="col-sm-6">
                <select class="form-control" name="member_id" id="members">
                <option value="" selected>-- wybierz artystę --</option>
                <?php foreach($artists as $a): ?>
                  <option value="<?=$a->artist_account_id?>"><?=$a->nick?></option>
                <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="role" class="col-sm-3 control-label">Rola: </label>
              <div class="col-sm-6">
                <input type="text" name="role" class="form-control">
              </div>
            </div>

            <div id="artist_box" style="overflow:hidden">

            </div>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
		        <button type="submit" class="btn btn-success">Dodaj</button>
		      </div>
		    </div>
		  </div>
		</div>
    </form>

 	
  	</div>
  </div>
</div>

<script>
$(document).ready(function() {
  $('#members').change(function() {
    $.get('/zarzadzanie-zespolem/get_selected_member', { id: $('#members').val() }, function(data) {

      $('#artist_box').html(data);

   });
  });
});
</script>

<?php
if($this->input->post()):
?>
<script>
$(document).ready(function() {

	$('#addMember').modal('show');

});
</script>
<?php
endif;
?>