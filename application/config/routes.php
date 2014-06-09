<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';

$route['artysci/(:num)'] = "artysci/index/$1";
$route['zespoly/(:num)'] = "zespoly/index/$1";

$route['ogloszenia-artystow/pokaz/(:num)'] = "ogloszenia/pokaz/$1/ads_artist";
$route['ogloszenia-zespolow/pokaz/(:num)'] = "ogloszenia/pokaz/$1/ads_band";

$route['utwory-artystow/pokaz/(:num)'] = "utwory/pokaz/$1/audio_artist";
$route['utwory-zespolow/pokaz/(:num)'] = "utwory/pokaz/$1/audio_band";

$route['zarzadzanie-zespolem'] = "zarzadzanie_zespolem";
$route['zarzadzanie-zespolem/(:num)/usun-zdjecie'] = "zarzadzanie_zespolem/usun_zdjecie/$1";
$route['zarzadzanie-zespolem/(:num)/czlonkowie/usun/(:num)'] = "zarzadzanie_zespolem/usun_czlonka/$1/$2";
$route['zarzadzanie-zespolem/(:num)/ogloszenia/dodaj'] = "zarzadzanie_zespolem/dodaj_ogloszenie/$1";
$route['zarzadzanie-zespolem/(:num)/ogloszenia/edytuj/(:num)'] = "zarzadzanie_zespolem/edytuj_ogloszenie/$1/$2";
$route['zarzadzanie-zespolem/(:num)/ogloszenia/usun/(:num)'] = "zarzadzanie_zespolem/usun_ogloszenie/$1/$2";
$route['zarzadzanie-zespolem/(:num)/utwory/dodaj'] = "zarzadzanie_zespolem/dodaj_utwor/$1";
$route['zarzadzanie-zespolem/(:num)/utwory/edytuj/(:num)'] = "zarzadzanie_zespolem/edytuj_utwor/$1/$2";
$route['zarzadzanie-zespolem/(:num)/utwory/usun/(:num)'] = "zarzadzanie_zespolem/usun_utwor/$1/$2";
$route['zarzadzanie-zespolem/(:num)/(:any)'] = "zarzadzanie_zespolem/$2/$1";
$route['zarzadzanie-zespolem/(:num)'] = "zarzadzanie_zespolem/index/$1";
$route['zarzadzanie-zespolem/(:any)'] = "zarzadzanie_zespolem/$1";

$route['twoje-konto'] = "twoje_konto";
$route['twoje-konto/zmien-haslo'] = "twoje_konto/zmien_haslo";
$route['twoje-konto/usun-zdjecie'] = "twoje_konto/usun_zdjecie";
$route['twoje-konto/zespoly/dodaj'] = "twoje_konto/dodaj_zespol";
$route['twoje-konto/zespoly/usun/(:num)'] = "twoje_konto/usun_zespol/$1";
$route['twoje-konto/ogloszenia/dodaj'] = "twoje_konto/dodaj_ogloszenie";
$route['twoje-konto/ogloszenia/edytuj/(:num)'] = "twoje_konto/edytuj_ogloszenie/$1";
$route['twoje-konto/ogloszenia/usun/(:num)'] = "twoje_konto/usun_ogloszenie/$1";
$route['twoje-konto/utwory/dodaj'] = "twoje_konto/dodaj_utwor";
$route['twoje-konto/utwory/edytuj/(:num)'] = "twoje_konto/edytuj_utwor/$1";
$route['twoje-konto/utwory/usun/(:num)'] = "twoje_konto/usun_utwor/$1";
$route['twoje-konto/(:any)'] = "twoje_konto/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */