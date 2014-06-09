<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Pagination
| -------------------------------------------------------------------------
*/

$config = array(

	'full_tag_open' => '<ul class="pagination pagination-sm">',
	'full_tag_close' => '</ul>',

	'first_link' => 'Pierwsza',
	'last_link' => 'Ostatnia',

	'first_tag_open' => '<li>',
	'last_tag_open' => '<li>',
	'num_tag_open' => '<li>',
	'prev_tag_open' => '<li>',
	'next_tag_open' => '<li>',

	'first_tag_close' => '</li>',
	'last_tag_close' => '</li>',
	'num_tag_close' => '</li>',
	'prev_tag_close' => '</li>',
	'next_tag_close' => '</li>',

	'cur_tag_open' => '<li class="current"><a>',
	'cur_tag_close' => '</a></li>',

);

if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");

/* End of file pagination.php */
/* Location: ./application/config/pagination.php */