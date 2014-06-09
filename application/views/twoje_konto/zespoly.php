<div class="container">
  <div class="row">
  	<div class="col-md-12">
      
 	  <h3>Twoje zespoły</h3>
 	  <br>

    <?php if(isset($added)): ?>
      <div class="alert alert-success">Zespół został dodany</div>
    <?php endif; ?>

 	  <?php
    if(empty($user_bands)):
    ?>
    Nie posiadasz żadnych zespołów
    <?php
    else:
    ?>
    <table class="table table-hover table-striped">
    <thead>
    <td width="70%"> Nazwa zespołu </td>
    <td> Operacje </td>
    </thead>
    <?php
    foreach($user_bands as $i => $band):
    ?>

      <tr>
      <td>
        <a class="" href="/zespoly/pokaz/<?=$band->band_id?>"><?=$band->name?></a>
      </td>
      <td>
        <a href="/zarzadzanie-zespolem/<?=$band->band_id?>" class="btn btn-primary">zarządzaj zespołem</a>
        <?php if($band->band_artist_id == $this->session->userdata('user_id')): ?>
          <a href="/twoje-konto/zespoly/usun/<?=$band->band_id?>" class="btn btn-danger">usuń</a>
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

 	  <br><br>
 	  <a href="/twoje-konto/zespoly/dodaj" class="btn btn-success">Stwórz zespół</a>
 	
  	</div>
  </div>
</div>