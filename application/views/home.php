 
    <div class="container">
      <div class="row">
        <div class="col-md-7">

          <div class="panel panel-default">
            <div class="panel-body">

              <div class="row">
                <div class="col-md-6">
                  <h3>Nowe ogłoszenia</h3>
                </div>
              </div>

              <?php if(isSet($artists_ads)): ?>
                <h4>Artystów</h4>
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

              <br>

              <?php if(isSet($bands_ads)): ?>
                <h4>Zespołów</h4>
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
          </div>

          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-6">
                  <h3>Nowe utwory</h3>
                </div>
              </div>

              <?php if(isSet($artists_audio)): ?>
                <h4>Artystów</h4>
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

              <br>

              <?php if(isSet($bands_audio)): ?>
                <h4>Zespołów</h4>
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
          </div>

        </div>
        <div class="col-md-5">

          <div class="panel panel-default">
            <div class="panel-body">
              <h3>Szukaj w katalogu</h3>
              
              <form id="search" action="/zespoly" method="GET" class="form-inline search-catalog">
                <div class="radio">
                  <label>
                    <input type="radio" name="w" value="zespoly" checked> szukaj zespołu
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="w" value="artysci"> szukaj artysty
                  </label>
                </div><div class="clear"></div>

                <div class="form-group">
                <input type="text" class="form-control" name="s">
                <button type="submit" class="btn btn-default">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
                </div>
              </form>

            </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-body">
              <h3>Ostatnio dodane zespoły</h3>
              <?php if(isSet($latest_bands)): ?>
              <?php foreach($latest_bands as $band): ?>

                <!--<div class="artist-box">
                  <img src="xyz" class="avatar">
                  <p class="nick">
                    <a href="/zespoly/pokaz/<?=$band->band_id?>">
                      <?=$band->name?>
                    </a>
                  </p>
                  <p class="genre">lorem ipsum</p>
                  <p class="city">dolor sit amet</p>
                </div>-->

                <p><a href="/zespoly/pokaz/<?=$band->band_id?>"><?=$band->name?></a></p>
                
              <?php endforeach; ?>
              <?php endif; ?>

            </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-body">
              <h3>Ostatnio dodani artyści</h3>
              <?php if(isSet($latest_artists)): ?>
              <?php foreach($latest_artists as $art): ?>

                <!--<div class="artist-box">
                  <img src="xyz" class="avatar">
                  <p class="nick">
                    <a href="/artysci/pokaz/<?=$art->artist_account_id?>">
                      <?=$art->nick?>
                    </a>
                  </p>
                  <p class="instrument"><?=$art->instrument?></p>
                  <p class="city"><?=$art->city?></p>
                </div>-->

                <p><a href="/artysci/pokaz/<?=$art->artist_account_id?>"><?=$art->nick?></a></p>

              <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>

       </div>
      </div>

    </div>

    <script>
    $(document).ready(function() {
      $('input[type=radio]').click(function() { 
          var action = $(this).attr('value');
          $('#search').attr('action', '/'+action);
        });
    });
    </script>