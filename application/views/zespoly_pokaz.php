<div class="container">
  <div class="row">
  	<div class="col-md-12">
      
 	  <h3>Zespoły &raquo; <b><?=$band->name?></b></h3>
    <br>

  	</div>
  </div>

  <div class="row">
  	<div class="col-md-7">

  	  <div class="panel panel-default">
        <div class="panel-body">

          <h3>Ogłoszenia</h3> 

          <?php if(count($band_ads)): ?>
              <?php foreach($band_ads as $ad): ?>

                <div class="ad-box">
                  <p class="title">
                    <a href="/ogloszenia-zespolow/pokaz/<?=$ad->ad_id?>"><?=$ad->ad_title?></a>
                  </p>
                </div>
                
              <?php endforeach; ?>
              <?php else: ?>
                <p>Brak ogłoszeń</p>
              <?php endif; ?>      

        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-body">

          <h3>Utwory</h3>

          <?php if(count($band_audio)): ?>
              <?php foreach($band_audio as $audio): ?>

                <div class="ad-box">
                  <p class="title">
                    <a href="/utwory-zespolow/pokaz/<?=$audio->audio_id?>"><?=$audio->audio_title?></a>
                  </p>
                </div>
                
              <?php endforeach; ?>
              <?php else: ?>
                <p>Brak utworów</p>
              <?php endif; ?> 
              
        </div>
      </div>

  	</div>
  	<div class="col-md-5">

  	  <div class="panel panel-default">
        <div class="panel-body">

          <h3>Informacje</h3>

            <div class="artist-info-block">

              <div class="thumb">
                <img src="<?=get_thumb($band->photo)?>">
              </div><br>
              <p><?=$band->name?></p>
              <p>gatunek: <?=$band->genre?></p>
              <p>miejscowość: <?=$band->place_name?> (<?=$band->province_name?>)</p>

              <?php if(count($band_members)): ?>
                <p>Członkowie zespołu:</p>
                <?php foreach($band_members as $mem): ?>
                  
                  <div class="artist-box">
                  <!--<div class="thumb">
                    <img src="<?=get_thumb($mem->photo)?>">
                  </div>-->
                  <p><a href="/artysci/pokaz/<?=$mem->artist_account_id?>"><?=$mem->nick?></a> (<?=$mem->role?>)</p>
                  </div>

                <?php endforeach; ?>
              <?php endif; ?>

            </div>

        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-body">

          <h3>Biografia</h3>

              <?=$band->bio?>

        </div>
      </div>



  	</div>
  </div>

</div>