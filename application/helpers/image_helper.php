<?php

function get_thumb($file) {
	$f = explode('.', $file);
	if(count($f) == 2)
		return '/uploads/images/'.$f[0].'_thumb.'.$f[1];
}
function get_audio($file) {
	$f = explode('.', $file);
	if(count($f) == 2)
		return '/uploads/audio/'.$file;
}
function get_img($file) {
	return IMGS.$file;
}
function get_thumb_name($file) {
	$f = explode('.', $file);
	if(count($f) == 2)
		return $f[0].'_thumb.'.$f[1];
}