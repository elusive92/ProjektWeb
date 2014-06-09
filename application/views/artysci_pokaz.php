<div class="container">
  <div class="row">
  	<div class="col-md-12">
      
 	  <h3>Artyści &raquo; <b><?=$artist->nick?></b></h3>
    <br>

  	</div>
  </div>

  <div class="row">
  	<div class="col-md-7">

  	  <div class="panel panel-default">
        <div class="panel-body">

          <h3>Ogłoszenia</h3>    

           <?php if(count($artist_ads)): ?>
              <?php foreach($artist_ads as $ad): ?>

                <div class="ad-box">
                  <p class="title">
                    <a href="/ogloszenia-artystow/pokaz/<?=$ad->ad_id?>"><?=$ad->ad_title?></a>
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

           <?php if(count($artist_audio)): ?>
              <?php foreach($artist_audio as $audio): ?>

                <div class="ad-box">
                  <p class="title">
                    <a href="/utwory-artystow/pokaz/<?=$audio->audio_id?>"><?=$audio->audio_title?></a>
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
                <img src="<?=get_thumb($artist->photo)?>">
              </div><br>
              <p><?=$artist->nick?></p>
              <p>instrument: <?=$artist->instrument?></p>
              <p>miejscowość: <?=$artist->place_name?> (<?=$artist->province_name?>)</p>

              <?php if(count($artist_bands)): ?>
                <p>Członek zespołu:</p>
                <?php foreach($artist_bands as $band): ?>
          
                  <div class="artist-box">
                  <!--<div class="thumb">
                    <img src="<?=get_thumb($band->photo)?>">
                  </div>-->
                  <p><a href="/zespoly/pokaz/<?=$band->band_id?>"><?=$band->name?></a> (<?=$band->role?>)</p>
                  </div>

                <?php endforeach; ?>
              <?php endif; ?>

            </div>

        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-body">

          <h3>Biografia</h3>

              <?=$artist->bio?>

        </div>
      </div>



  	</div>
  </div>

</div>