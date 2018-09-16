<?php

namespace App\Core;

use PDO, Symfony\Component\Yaml\Yaml;

class Model {

    protected $db;
	
    public function __construct() {
		
		$config = $this->config();
	
        $this->db = new PDO($config['banco']['configuration'] . "=" . $config['config']['dbname'] . ";".$config['banco']['host']."=" . $config['config']['host'], $config['config']['dbuser'], $config['config']['dbpass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
	}

	/**
	 * Captura as informações de configurações dp banco de dados no arquivo
	 * phinx.yml e retorna um array com os dados.
	 *
	 * @return array
	 */
	private function config()
	{
		$filename = $_SERVER['DOCUMENT_ROOT'].'\phinx.yml';

		if (file_exists($filename)) {
			
			$parameters = [];
			
			$conf = Yaml::parseFile($filename)['environments'];

			if ($conf['default_database'] != 'development')
			{
				$enviroment = 'production';
			}
			else {
				$enviroment = 'development';
			}

			// Carrega os paramentros de conexão
			$parameters['config'] = [
				'dbname' => $conf[$enviroment]['name'],
				'host'	 => $conf[$enviroment]['host'],
				'dbuser' => $conf[$enviroment]['user'],
				'dbpass' => $conf[$enviroment]['pass'],

				// Implementa a ideia da possibilidade de utilização de vários bd
				'banco' => [
					'configuration' => 'mysql:dbname',
					'host'			=> 'host',
					'encoding'		=> 'PDO::MYSQL_ATTR_INIT_COMMAND'
				]
			];

			// Retorna as informações
			return $parameters;
		}
		else {
			echo 'Arquivo de configuração indisponível.';
			exit;
		}	
	}
}