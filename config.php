<?php
$config = array();

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$conexao = 'localhost';
preg_match("/{$conexao}/i", $url, $match);

//defininco se esta em desenvolvimento ou produção
if (!empty($match)) {
	define("BASE", "http://localhost/projetos/shafiles/");
	$config['dbname'] = 'sha_files';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
} else {
	define("BASE", "");
	$config['dbname'] = '';
	$config['host'] = 'localhost';
	$config['dbuser'] = '';
	$config['dbpass'] = '';
}

global $db;

try {
	$options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"];
	$db = new PDO("mysql:dbname=" . $config['dbname'] . ";host=" . $config['host'], $config['dbuser'], $config['dbpass'], $options);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Falhou " . $e->getMessage();
	exit;
}
