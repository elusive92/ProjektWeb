<div class="container">
  <div class="row">
  	<div class="col-md-12">

 	<h3>Twoje konto</h3>
 	<br>
 	
 	<ul class="nav nav-tabs">
	  <li class="<?=($this->uri->segment(2)=='informacje' ? 'active' : '')?>">
	  	<a href="/twoje-konto/informacje">Informacje</a>
	  </li>
	  <li class="<?=($this->uri->segment(2)=='ogloszenia' ? 'active' : '')?>">
	  	<a href="/twoje-konto/ogloszenia">Ogłoszenia</a>
	  </li>
	  <li class="<?=($this->uri->segment(2)=='zespoly' ? 'active' : '')?>">
	  	<a href="/twoje-konto/zespoly">Zespoły</a>
	  </li>
	  <li class="<?=($this->uri->segment(2)=='utwory' ? 'active' : '')?>">
	  	<a href="/twoje-konto/utwory">Utwory</a>
	  </li>
	</ul>

	<br>

	<?=$subpage?>

	<br>

  </div>
</div>