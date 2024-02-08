<?php

require_once("Model/ArticleModel.php");
require_once("View/ArticleView.php");

class ShowArticlesController {
	
	private $articleModel;
	private $articleView;
	
	public function __construct() {	
		$this->articleModel = new ArticleModel();		
		$this->articleView = new ArticleView();		
	}
	
	public function process() {	
		
		if ($_SERVER["REQUEST_METHOD"] === "GET") {
			$this->getArticles();	
		}
		
		if ($_SERVER["REQUEST_METHOD"] === "POST") {
			$this->createArticle();
		}	
		
		if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
			$jsonData = json_decode(file_get_contents('php://input'), true);
			$this->deleteArticle($jsonData['id']);
		}
	}	
	
	private function getArticles() {
				
		$articlesData = $this->articleModel->getAllArticles();						
		$this->articleView->renderView("articlesData", $articlesData, "articles", 200);
		
	}

	private function createArticle() {
				
		$name = $_POST['name'];
		
		if(iconv_strlen($name) > 32 || iconv_strlen($name) === 0) {
			$this->articleView->renderView("error", "404 - Invalidni velikost názvu článku", "error", 404);
		}
		
		$newId = $this->articleModel->createArticle($name);
			
		header('Location: ../article-edit/' . $newId);
		exit;
		
	}
	
	private function deleteArticle($id) {
		
		if(!is_numeric($id)) {
			http_response_code(403);
			exit;
		}
		
		$articleData = $this->articleModel->getArticle($id);

		if($articleData === null) {
			http_response_code(404);
			exit;
		} 	
		
		$this->articleModel->deleteArticle($id);	

		http_response_code(300);
		exit;
	}
}