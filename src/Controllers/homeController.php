<?php

namespace App\Controllers;

use App\Core\Controller, 
	App\Models\DataBase,
	Twig_Loader_Filesystem, 
	Twig_Environment;

Class homeController extends Controller
{
	public function __construct(){

		if ($this->isLogged() === false)
		{
			header('Location: ' . BASE_URL . '/login');
			exit;
		}
	}
	
	public function index()
	{
		echo $this->load()->render('home.html', $this->getData());
	}
}