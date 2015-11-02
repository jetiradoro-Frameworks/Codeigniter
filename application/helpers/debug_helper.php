<?php
function s($x) {
	print "<pre style='border:1px solid gray; background-color:#efefef; padding: 15px;'>";
	print_r ($x);
	print "</pre>";
}

function x($data){
	s($data);
	die();
}