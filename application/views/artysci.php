<?php $this->load->helper('image_helper'); ?>
<div class="container">
  <div class="row">
  	<div class="col-md-12">
      
 	  <h3>Katalog artystów</h3>
 	  
    <?php if(isSet($_GET['s'])): ?>
      <h4>szukaj: '<?=$_GET['s']?>'</h4>
      <br>
    <?php else: ?>
      <br>
    <?php endif; ?>

 	  <?php
    if(empty($artists)):
    ?>
    Nie ma żadnych artystów
    <?php
    else:
    ?>

    <div class="row">
    <?php
    foreach($artists as $i => $artist):
    ?>

    <div class="col-md-4 band-box">
      <div class="artist-box">
        <div class="thumb">
          <img src="<?=get_thumb($artist->photo)?>">
        </div>
        <p class="nick">
          <a href="/artysci/pokaz/<?=$artist->artist_account_id?>">
            <?=$artist->nick?>
          </a>
        </p>
        <p class="instrument"><?=$artist->instrument?></p>
        <p class="place"><?=$artist->place_name?></p>
      </div>        
    </div>

    <?php
    endforeach;
    ?>
    </div>

    <br>
    <div class="text-right">
      <?=$pagination?>
    </div>

    <?php
    endif;
    ?>

 	  <br>

  	</div>
  </div>
</div>