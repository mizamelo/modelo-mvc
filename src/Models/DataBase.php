<?php

/**
 * Este objeto tem a finalidade de buscar informações no banco de 
 * dados.
 * 
 * PHP version 7.1
 * 
 * @category  modelo-mvc
 * @package   modelo-mvc
 * @copyright (c) 2017, Mizael Melo PHP Developer
 */

namespace App\Models;

use App\Core\Model, PDO;

Class DataBase extends Model
{
/**
 * Função que vai buscar os dados da tabela informada no parametro $nomeTable
 * retotnando-os em forma de array
 *
 * @param  STRING $campo campos a serem retornados
 * @param  STRING $nomeTable variavel onde será passado o nome da tabela.
 * @param  ARRAY $where array associativo com as informações de filtro para o select. 
 * @param STRING $clausulas onde será inserido os ORDER E GROUP BY da vida
 * @param  INT $limitIni limite de linha inicial.
 * @param  INT $limitFim limite de linha final.
 * @return ARRAY
 */
    public function select($nomeTable, $where = array(), $campo = '*', $clausulas = null, $limitIni =  null, $limitFim = null)
    {
		$rData = [];
		
		$select = "SELECT {$campo} FROM {$nomeTable} ";
		
		if (!empty($where))
		{
			$condicao = "";
			foreach ($where as $key => $value) 
			{
				$condicao .= "{$key} = '{$value}' AND ";
			}
			
			$condicao = substr($condicao, 0, -4);
			$select = $select . 'WHERE '.$condicao;
		}
		
		if(isset($clausulas)) {
			$select .= $clausulas;
		}
		
		if (isset($limitIni)) {
			$select = $select . " LIMIT {$limitIni} ". (isset($limitFim)?",{$limitFim}":"");
		}
				
		$sql = $this->db->prepare($select);
		$sql->execute();

		if ($sql->rowCount() > 0)
		{
		 	$rData = $sql->fetchAll(PDO::FETCH_ASSOC);
		}
		
		return $rData;
	}

	public function update($nomeTable, $set = array(), $where = array())
	{
		$update = "UPDATE {$nomeTable} SET ";
		$cond_where = "";

		if (!empty($where))
		{
			foreach ($where as $key => $value) 
			{
				$cond_where .= "{$key} = '{$value}' AND ";
			}
			
			$cond_where  = substr($cond_where, 0, -4);
			$cond_where  = " WHERE {$cond_where}";
		}

		if (!empty($set)) {
			
			$condicao = "";
			
			foreach ($set as $key => $value) {
				$condicao .= "{$key} = '{$value}', ";
			}

			$condicao = substr($condicao, 0, -2);
			
			$update .= $condicao;
			$update .= $cond_where;

			$sql = $this->db->prepare($update);
			$stmt = $sql->execute();

			if (!$stmt) { 
				return $this->db->errorInfo()[0];
			} 
		}	
			
	}

	public function insert($nomeTable, $set = array())
	{
		$insert = "INSERT {$nomeTable} SET ";

		if (!empty($set)) {
			$setando = "";
			foreach ($set as $key => $value) {
				$setando .= "{$key} = '{$value}', ";
			}
			$setando = substr($setando, 0, -2);
			$insert .= $setando;	
		}
			$sql = $this->db->prepare($insert);
	
			$stmt = $sql->execute();
			
			if (!$stmt) { 
				return $this->db->errorInfo()[0];
			} 
		}

	public function delete($nomeTable, $id)
	{
		try {
			$delete = "DELETE FROM {$nomeTable} WHERE id = '{$id}'";

			$sql = $this->db->prepare($delete);
			$sql->execute();
		
			return TRUE;

		} catch (Exception $e) {
			return $e->getMessage;
		}
	}	
}
