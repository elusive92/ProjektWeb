<div class="container">
  <div class="row">
  	<div class="col-md-12">

  	<h3>Ogłoszenia zespołu</h3>
    <br>

    <?php
    if(empty($ads)):
    ?>
    Brak ogłoszeń
    <?php
    else:
    ?>
    <table class="table table-hover table-striped">
    <thead>
    <td> Tytuł ogłoszenia </td>
    <td style="width:450px;"> Treść ogłoszenia </td>
    <td> Operacje </td>
    </thead>
    <?php
    foreach($ads as $i => $ad):
    ?>

      <tr>
        <td>
          <a href="/ogloszenia-zespolow/pokaz/<?=$ad->ad_id?>"><?=$ad->ad_title?></a>
        </td>
        <td>
          <?=$ad->ad_content?>
        </td>
        <td>
          <a href="/zarzadzanie-zespolem/<?=$band->band_id?>/ogloszenia/edytuj/<?=$ad->ad_id?>" class="btn btn-primary">edytuj</a> 
          <a href="/zarzadzanie-zespolem/<?=$band->band_id?>/ogloszenia/usun/<?=$ad->ad_id?>" class="btn btn-danger">usuń</a>
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
 	<a href="/zarzadzanie-zespolem/<?=$band->band_id?>/ogloszenia/dodaj" class="btn btn-success">Dodaj ogłoszenie</a>
    
  	</div>
  </div>
</div>