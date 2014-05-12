
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MusicFolio</title>

    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-default navbar-static-top top-header">
      <div class="container">
        <div class="navbar-header">

          <a class="navbar-brand page-title" href="/">
            MusicFolio <span class="page-subtitle">portal dla muzyków</span>
          </a>

        </div>
        <div class="navbar-collapse collapse">

        <?php if(isset($user)): ?>
          <div class="navbar-right">
            <p><?=$user->nick?></p>
            <p><a href="/?logout=1">wyloguj</a></p>
          </div>
        <?php else: ?>
          <form action="/logowanie" method="post" class="navbar-form navbar-right" role="form">
            <div class="form-group">
              <input type="text" name="login" placeholder="Login" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Hasło" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Zaloguj się</button>
          </form>
        <?php endif; ?>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <div class="navbar navbar-default">
            <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav top-nav">
                <li><a href="/">Strona główna</a></li>
                <li><a href="/ogloszenia">Ogłoszenia</a></li>
                <li><a href="/zespoly">Zespoły</a></li>
                <li><a href="/artysci">Artyści</a></li>
                <li><a href="/utwory">Utwory</a></li>
                <?php if(!isSet($user)): ?>
                  <li><a href="/rejestracja">Zarejestruj się</a></li>
                <?php endif; ?>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="page">
      <?=$page?>
    </div>

    <div class="container">
      <footer>
       <p>&copy; 2014 <b>MusicFolio</b></p>
      </footer><br><br>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>
