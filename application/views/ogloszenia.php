<div class="container">
  <div class="row">
  	<div class="col-md-12">
      
 	  <h3>Ogłoszenia</h3>
 	  <br>
 	  
 	  <div class="row">

 	  	<div class="col-md-6">
 	  		<h4>Zespołów</h4><br>

		 	  		<?php if(isSet($bands_ads)): ?>
              <?php foreach($bands_ads as $ad): ?>

                <div class="ad-box">
                  <div class="thumb">
                    <img src="<?=get_thumb($ad->photo)?>">
                  </div>
                  <p class="nick">
                    <a href="/zespoly/pokaz/<?=$ad->band_id?>"><?=$ad->name?></a>
                  </p>
                  <p class="title">
                    <a href="/ogloszenia-zespolow/pokaz/<?=$ad->ad_id?>"><?=$ad->ad_title?></a>
                  </p>
                </div>
                
              <?php endforeach; ?>
              <?php endif; ?>

 	  	</div>

 	  	<div class="col-md-6">
 	  		<h4>Artystów</h4><br>

 	  				<?php if(isSet($artists_ads)): ?>
              <?php foreach($artists_ads as $ad): ?>

                <div class="ad-box">
                  <div class="thumb">
                    <img src="<?=get_thumb($ad->photo)?>">
                  </div>
                  <p class="nick">
                    <a href="/artysci/pokaz/<?=$ad->artist_account_id?>"><?=$ad->nick?></a>
                  </p>
                  <p class="title">
                    <a href="/ogloszenia-artystow/pokaz/<?=$ad->ad_id?>"><?=$ad->ad_title?></a>
                  </p>
                </div>
                
              <?php endforeach; ?>
              <?php endif; ?>

 	  	</div>

 	  </div>

  	</div>
  </div>
</div>