<?php
/**
 * Description of Crud class
 *
 * author: Daniel Yamada
 * 
 * 
 */
class Crud {
	private $pdo = null;   
	private $table = null;   
	private static $crud;

	private function __construct($connection, $table=NULL)
	{   
		if (!empty($connection)){
			$this->pdo = $connection;   
		}
		else{  
			echo "<h3>Conexão inexistente!</h3>";  
			exit();  
		} 
		if (!empty($table)) 
			$this->table =$table;   
	}

	public static function getInstance($connection, $table=NULL) 
	{
		if ( !isset( self::$crud ) ) {
				try {
					self::$crud = new Crud($connection, $table);
				} catch (Exception $e) {
					echo "<br>Erro: ".$e->getMessage();
				}
		}
		return self::$crud;
	}

	public function setTableName($table)
	{  
		if(!empty($table)){  
			$this->table = $table;  
		}  
	}  

	/*
	* @param $data = Array de dados contendo colunas e valores   
	* @return String contendo instrução SQL   
	*/    
	private function buildInsert($data)
	{   
		$sql = "";   
		$fields = "";   
		$values = "";   

		// Loop para montar a instrução com os campos e valores   
		foreach($data as $key => $value){   
			$fields .= $key . ', ';   
			$values .= '?, ';   
		}

		// Retira vírgula do final da string   
		$fields = (substr($fields, -2) == ', ') ? trim(substr($fields, 0, (strlen($fields) - 2))) : $fields ;

		// Retira vírgula do final da string   
		$values = (substr($values, -2) == ', ') ? trim(substr($values, 0, (strlen($values) - 2))) : $values ;    

		// Concatena todas as variáveis e finaliza a instrução   
		$sql = "INSERT INTO {$this->table} (" . $fields . ")VALUES(" . $values . ")";   
		//echo "insert: ".$sql."<br>";

		// Retorna string com instrução SQL   
		return trim($sql);   
	}   
		
	/*   
	* @param $data = Array de dados contendo colunas, operadores e valores   
	* @param $conditions = Array de dados contendo colunas e valores para condição WHERE   
	* @return String contendo instrução SQL   
	*/    
	private function buildUpdate($data, $conditions)
	{   
		$sql = "";   
		$valFields = "";   
		$valConditions = "";   

		// Loop para montar a instrução com os campos e valores   
		foreach($data as $key => $value)
			$valFields .= $key . '=?, ';   

		// Retira vírgula do final da string   
		$valFields = (substr($valFields, -2) == ', ') ? trim(substr($valFields, 0, (strlen($valFields) - 2))) : $valFields ;    
		// Loop para montar a condição WHERE   
		foreach($conditions as $key => $value){
			$valConditions .= $key . '? AND ';   
		}

		// Retira vírgula do final da string   
		$valConditions = (substr($valConditions, -4) == 'AND ') ? trim(substr($valConditions, 0, (strlen($valConditions) - 4))) : $valConditions ;    

		// Concatena todas as variáveis e finaliza a instrução   
		$sql .= "UPDATE {$this->table} SET " . $valFields . " WHERE " . $valConditions;   

		// Retorna string com instrução SQL   
		return trim($sql);   
	}   
		
	/*   
	* @param $conditions = Array de dados contendo colunas, operadores e valores para condição WHERE   
	* @return String contendo instrução SQL   
	*/    
	private function buildDelete($conditions)
	{
		$sql = "";   
		$valFields= "";   

		// Loop para montar a instrução com os campos e valores   
		foreach($conditions as $key => $value){
			$valFields .= $key . '? AND ';   
		}

		// Retira a palavra AND do final da string   
		$valFields = (substr($valFields, -4) == 'AND ') ? trim(substr($valFields, 0, (strlen($valFields) - 4))) : $valFields ;

		// Concatena todas as variáveis e finaliza a instrução   
		$sql .= "DELETE FROM {$this->table} WHERE " . $valFields;   

		// Retorna string com instrução SQL   
		return trim($sql);   
	}   
		
	/*   
	* @param $data = Array de dados contendo colunas e valores   
	* @return Retorna resultado booleano da instrução SQL   
	*/   
	public function insert($data)
	{   
		try {   
			// Atribui a instrução SQL construida no método   
			$sql = $this->buildInsert($data);   
			//echo "<br>Insert: ".$sql."<br>";

			// Passa a instrução para o PDO   
			$stm = $this->pdo->prepare($sql);   

			// Loop para passar os dados como parâmetro   
			$count = 1;   
			foreach ($data as $value){
				$stm->bindValue($count, $value);   
				$count++;   
			}

			// Executa a instrução SQL e captura o retorno   
			$result = $stm->execute();   
			return $result;   

		} catch (PDOException $e) {   
			echo "<br>Erro: " . $e->getMessage();   
		}   
	}   
		
	/*   
	* @param $data = Array de dados contendo colunas e valores   
	* @param $conditions = Array de dados contendo colunas e valores para condição WHERE - Exemplo array('$id='=>1)   
	* @return Retorna resultado booleano da instrução SQL   
	*/   
	public function update($data, $conditions)
	{   
		try {   
			// Atribui a instrução SQL construida no método   
			$sql = $this->buildUpdate($data, $conditions);   
			//echo "<br>Update: ".$sql."<br>";
			// Passa a instrução para o PDO   
			$stm = $this->pdo->prepare($sql);   

			// Loop para passar os dados como parâmetro   
			$count = 1;   
			foreach ($data as $value){
				$stm->bindValue($count, $value);   
				$count++;   
			}

			// Loop para passar os dados como parâmetro cláusula WHERE   
			foreach ($conditions as $value){
				$stm->bindValue($count, $value);   
				$count++;   
			}

			// Executa a instrução SQL e captura o retorno   
			$result = $stm->execute();   
			return $result;   

		} catch (PDOException $e) {   
			echo "<br>Erro: " . $e->getMessage();   
		}   
	}   
		
	/*   
	* @param $conditions = Array de dados contendo colunas e valores para condição WHERE - Exemplo array('$id='=>1)   
	* @return Retorna resultado booleano da instrução SQL   
	*/   
	public function delete($conditions)
	{   
		try {   
			// Atribui a instrução SQL construida no método   
			$sql = $this->buildDelete($conditions);   
	
			// Passa a instrução para o PDO   
			$stm = $this->pdo->prepare($sql);   
	
			// Loop para passar os dados como parâmetro cláusula WHERE   
			$count = 1;   
			foreach ($conditions as $valor){
				$stm->bindValue($count, $valor);
				$count++;
			}

			// Executa a instrução SQL e captura o retorno   
			$result = $stm->execute();   
			return $result;   

		} catch (PDOException $e) {   
			echo "<br>Erro: " . $e->getMessage();   
		}   
	}   
	
	/*  
	* @param $sql = Instrução SQL inteira contendo, nome das tabelas envolvidas, JOINS, WHERE, ORDER BY, GROUP BY e LIMIT  
	* @param $parm = Array contendo somente os parâmetros necessários para clásusla WHERE  
	* @param $fetchAll  = Valor booleano com valor default TRUE indicando que serão retornadas várias linhas, FALSE retorna apenas a primeira linha  
	* @return Retorna array de dados da consulta em forma de objetos  
	*/  
	public function getSQLGeneric($sql, $params=null, $fetchAll=TRUE)
	{  
		try {   
			// Passa a instrução para o PDO   
			$stm = $this->pdo->prepare($sql);   

			// Verifica se existem condições para carregar os parâmetros    
			if (!empty($params)){

				// Loop para passar os dados como parâmetro cláusula WHERE   
				$count = 1;
				foreach ($params as $value){
					$stm->bindValue($count, $value);   
					$count++;   
				}
			}

			// Executa a instrução SQL    
			$stm->execute();   

			// Verifica se é necessário retornar várias linhas  
			if($fetchAll)
				$result = $stm->fetchAll();   
			else
				$result = $stm->fetch();   
			return $result;   

		} catch (PDOException $e) {   
			echo "<br>Erro: " . $e->getMessage();   
		}   
	}   

}

?>
