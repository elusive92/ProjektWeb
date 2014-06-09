<div class="container">
  <div class="row">
  	<div class="col-md-12">
      
 	  <h3>Twoje utwory</h3>
 	  <br>

 	  <?php
    if(empty($audio)):
    ?>
    Brak utworów
    <?php
    else:
    ?>
    <table class="table table-hover table-striped">
    <thead>
    <td> Tytuł utworu </td>
    <td style="width:450px;"> Opis utworu </td>
    <td> Operacje </td>
    </thead>
    <?php
    foreach($audio as $i => $a):
    ?>

      <tr>
        <td>
          <a href="/utwory-artystow/pokaz/<?=$a->audio_id?>"><?=$a->audio_title?></a>
        </td>
        <td>
          <?php if(!empty($a->audio_description)): ?>
            <?=$a->audio_description?>
          <?php endif; ?>
        </td>
        <td>
          <a href="/twoje-konto/utwory/edytuj/<?=$a->audio_id?>" class="btn btn-primary">edytuj</a> 
          <a href="/twoje-konto/utwory/usun/<?=$a->audio_id?>" class="btn btn-danger">usuń</a>
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

 	  <a href="/twoje-konto/utwory/dodaj" class="btn btn-success">Dodaj utwór</a>
 
  	</div>
  </div>
</div>