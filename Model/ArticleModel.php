<?php


class ArticleModel {	

	private $mysqli;
	
	public function __construct() {   
		require("db_config.php");		
		
		try {
			$this->mysqli = new mysqli($db_config['server'], $db_config['login'], $db_config['password'], $db_config['database']);
		} catch (Exception $e) {
			die('Připojení k databázi selhalo - Zkuste to později :)');
		}	
    }
		
	public function __destruct() {
		$this->mysqli->close();
	}
	
	function getAllArticles() { 
				
		$query = "SELECT * FROM articles";
		$allArticles = array();
		
		if ($result = $this->mysqli->query($query)) {
			while ($row = $result->fetch_assoc()) {
				$allArticles[] = new Article($row["id"], $row["name"], $row["content"]);
			}
		}
				
		return $allArticles;
	}
	
	function getArticle($id) {	
		
		$statement = $this->mysqli->prepare("SELECT * FROM articles WHERE id=?");
		$statement->bind_param('i', $id);
		$statement->execute();
		$query_result = $statement->get_result();
		
		if ($query_result->num_rows === 0) {
			$statement->close();
			return null;
		}
		
		
		$row = $query_result->fetch_assoc();
		$article = new Article($row["id"], $row["name"], $row["content"]);
		$statement->close();
		
		return $article;
	}
	
	function editArticle($id, $name, $content) {
		
		$statement = $this->mysqli->prepare("UPDATE articles SET name=?, content=? WHERE id=?");
		$statement->bind_param('ssi', $name, $content, $id);
		$statement->execute();
		$statement->close();
		
	}
	
	function deleteArticle($id) {
		
		$statement = $this->mysqli->prepare("DELETE FROM articles WHERE id=?");
		$statement->bind_param('i', $id);
		$statement->execute();
		$statement->close();
		
	}
	
	function createArticle($name) {
		
		$statement = $this->mysqli->prepare("INSERT INTO articles(name, content) VALUES (?,'')");
		$statement->bind_param('s', $name);
		$statement->execute();
		$lastId = $this->mysqli->insert_id;
		$statement->close();
		
		return $lastId;
	}
}


class Article {
	
	public $id;
    public $name;
    public $content;

    public function __construct($id, $name, $content) {
        $this->id = $id;
		$this->name = $name;
        $this->content = $content;
    }
	
}
