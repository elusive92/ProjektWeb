<div class="container">
  <div class="row">
  	<div class="col-md-12">
      
 	  <h3>Utwory muzyczne</h3>

 	  <div class="row">

 	  	<div class="col-md-6">
 	  		<h4>Zespołów</h4><br>

		 	  <?php if(isSet($bands_audio)): ?>
              <?php foreach($bands_audio as $audio): ?>

                <div class="ad-box">
                  <p class="nick">
                    <a href="/zespoly/pokaz/<?=$audio->band_id?>"><?=$audio->name?></a>
                  </p>
                  <p class="title">
                    <a href="/utwory-zespolow/pokaz/<?=$audio->audio_id?>"><?=$audio->audio_title?></a>
                  </p>
                </div>
                
              <?php endforeach; ?>
              <?php endif; ?>

 	  	</div>

 	  	<div class="col-md-6">
 	  		<h4>Artystów</h4><br>

 	  				<?php if(isSet($artists_audio)): ?>
              <?php foreach($artists_audio as $audio): ?>

                <div class="ad-box">
                  <p class="nick">
                    <a href="/artysci/pokaz/<?=$audio->artist_account_id?>"><?=$audio->nick?></a>
                  </p>
                  <p class="title">
                    <a href="/utwory-artystow/pokaz/<?=$audio->audio_id?>"><?=$audio->audio_title?></a>
                  </p>
                </div>
                
              <?php endforeach; ?>
              <?php endif; ?>

 	  	</div>

 	  </div>

  	</div>
  </div>
</div>