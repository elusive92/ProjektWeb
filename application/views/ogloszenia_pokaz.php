<div class="container">
  <div class="row">
  	<div class="col-md-7">

    <div class="panel panel-default">
    <div class="panel-body">
      
 	  <h3>Ogłoszenia &raquo; <?=$ad->ad_title?></h3>
 	  <br>
 	  
    <p><?=$ad->ad_content?></p>
 	  	
  	</div>
    </div>
    </div>

    <div class="col-md-5">
      <div class="panel panel-default">
      <div class="panel-body">

    	<h3>Autor ogłoszenia</h3>
    	<br>

      <?php if($where == 'ads_artist'): ?>

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
                  <p><a href="/zespoly/pokaz/<?=$band->band_id?>"><?=$band->name?></a> (<?=$band->role?>)</p>
                  </div>

                <?php endforeach; ?>
              <?php endif; ?>

            </div>

      <?php else: ?>

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
                  <p><a href="/artysci/pokaz/<?=$mem->artist_account_id?>"><?=$mem->nick?></a> (<?=$mem->role?>)</p>
                  </div>

                <?php endforeach; ?>
              <?php endif; ?>

            </div>

      <?php endif; ?>

    </div>
    </div>
    </div>

  </div>
</div>