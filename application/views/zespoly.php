<div class="container">
  <div class="row">
  	<div class="col-md-12">
      
 	  <h3>Katalog zespołów</h3>
 	  
    <?php if(isSet($_GET['s'])): ?>
      <h4>szukaj: '<?=$_GET['s']?>'</h4>
      <br>
    <?php else: ?>
      <br>
    <?php endif; ?>
    
    <?php
    if(empty($bands)):
    ?>

    Nie ma żadnych zespołów

    <?php
    else:
    ?>

    <div class="row">
    <?php
    foreach($bands as $i => $band):
    ?>

    <div class="col-md-4 band-box">
      <div class="artist-box">
        <div class="thumb">
          <img src="<?=get_thumb($band->photo)?>">
        </div>
        <p class="nick">
          <a href="/zespoly/pokaz/<?=$band->band_id?>">
            <?=$band->name?>
          </a>
        </p>
        <p class="genre"><?=$band->genre?></p>
        <p class="place"><?=$band->place_name?></p>
      </div>        
    </div>

    <?php
    endforeach;
    ?>
    </div>

    <?php
    endif;
    ?>

 	  <br><br>

  	</div>
  </div>
</div>