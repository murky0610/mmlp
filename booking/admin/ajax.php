<?php


include 'admin_class.php';

$action = $_GET['action'];


$crud = new Action();


if($action == 'save_reserve'){
	$save = $crud->save_reserve();
	if($save)
		echo $save;
}