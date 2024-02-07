<?php

require_once("Model/ArticleModel.php");
require_once("View/ArticleView.php");

class EditArticleController {
	 
	private $id;
	private $articleModel;
	private $articleView;

	public function __construct($id) {
		
		$this->id = $id;
		$this->articleModel = new ArticleModel();
		$this->articleView = new ArticleView();	
		
	}
	
	public function process() {
		
		if ($_SERVER["REQUEST_METHOD"] === "GET") {
			$this->getArticle();
		}
		
		if ($_SERVER["REQUEST_METHOD"] === "POST") {
			$this->editArticle();
		}
		
	}
	
	private function getArticle() {
		
		$articleData = $this->articleModel->getArticle($this->id);

		if($articleData !== null) {
			$this->articleView->renderView("articleData", $articleData, "article-edit", 200);
		} else {
			$this->articleView->renderView("error", "404 - Neexistující url", "error", 404);
		}	
	}
	
	private function editArticle() {
		
		$name = $_POST['name'];
		$content = $_POST['content'];
		
		$articleData = $this->articleModel->getArticle($this->id);

		if($articleData === null) {
			$this->articleView->renderView("error", "404 - Neexistující url - Pokus o změnu se nepovedl", "error", 404);
		} 
		
		if(iconv_strlen($name) > 32 || iconv_strlen($name) === 0 || iconv_strlen($content) > 1024 ) {
			$this->articleView->renderView("error", "403 - Invalidni velikosti názvu článku nebo velikost contentu článku", "error", 403);
		}
		
		$this->articleModel->editArticle($this->id, $name, $content);

		header("Location: ../articles");
		exit;
	}
	
}