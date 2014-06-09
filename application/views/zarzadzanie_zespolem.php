<div class="container">
  <div class="row">
  	<div class="col-md-12">

	 	<h3>Zarządzanie zespołem: <b><?=$band->name?></b></h3>
	 	<br>
	 	
	 	<ul class="nav nav-pills">
			<li class="<?=($this->uri->segment(3)=='informacje' ? 'active' : '')?>">
				<a href="/zarzadzanie-zespolem/<?=$band->band_id?>/informacje">Informacje</a>
			</li>
			<li class="<?=($this->uri->segment(3)=='czlonkowie' ? 'active' : '')?>">
				<a href="/zarzadzanie-zespolem/<?=$band->band_id?>/czlonkowie">Członkowie</a>
			</li>
			<li class="<?=($this->uri->segment(3)=='ogloszenia' ? 'active' : '')?>">
				<a href="/zarzadzanie-zespolem/<?=$band->band_id?>/ogloszenia">Ogłoszenia</a>
			</li>
			<li class="<?=($this->uri->segment(3)=='utwory' ? 'active' : '')?>">
				<a href="/zarzadzanie-zespolem/<?=$band->band_id?>/utwory">Utwory</a>
			</li>
		</ul><br>

		<?=$subpage?>

  </div>
</div>