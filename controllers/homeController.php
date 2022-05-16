<?php
class homeController extends controller
{

	public function __construct()
	{
		// echo 'OK';
	}

	public function index()
	{
		$dados = array();

		$this->loadTemplate('home', $dados);
	}
}
