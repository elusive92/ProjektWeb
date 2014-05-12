 
    <div class="container">
      <div class="row">
        <div class="col-md-7">

          <div class="panel panel-default">
            <div class="panel-body">

              <div class="row">
                <div class="col-md-3">
                  <h3>Ogłoszenia</h3>
                </div>
                <div class="col-md-8">
                  <ul class="nav-links">
                    <li class="active"><a href="#">Zespołów</a></li>
                    <li><a href="#">Artystów</a></li>
                  </ul>
                </div>
              </div>

              <?php if(isSet($ads)): ?>
              <?php foreach($ads as $ad): ?>

                <p><?=$ad->title?></p>
                
              <?php endforeach; ?>
              <?php endif; ?>


            </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-body">
              <h3>Utwory</h3>

              <p></p>

            </div>
          </div>

        </div>
        <div class="col-md-5">

          <div class="panel panel-default">
            <div class="panel-body">
              <h3>Szukaj w katalogu</h3>
              
              <form action="/szukaj" method="GET" class="form-inline search-catalog">
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
                <input type="text" class="form-control" placeholder="nazwa zespołu...">
                <button type="submit" class="btn btn-default">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
                </div>
              </form>

              <a href="/szukanie_zaawansowane">zaawansowane szukanie &raquo;</a>

            </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-body">
              <h3>Ostatnio dodane zespoły</h3>
              <?php if(isSet($last_bands)): ?>
              <?php foreach($last_bands as $band): ?>

                <p><?=$band->name?></p>
                
              <?php endforeach; ?>
              <?php endif; ?>

            </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-body">
              <h3>Ostatnio dodani artyści</h3>
              <?php if(isSet($last_artists)): ?>
              <?php foreach($last_artists as $art): ?>

                <p><?=$art->nick?></p>

              <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>

       </div>
      </div>

    </div>