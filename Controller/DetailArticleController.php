<?php

require_once("Model/ArticleModel.php");
require_once("View/ArticleView.php");

class DetailArticleController {
	
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
	
	}
	
	private function getArticle() {
		
		$articleData = $this->articleModel->getArticle($this->id);

		if($articleData !== null) {
			$this->articleView->renderView("articleData", $articleData, "article-detail", 200);
		} else {
			$this->articleView->renderView("error", "404 - Neexistující url", "error", 404);
		}	
		
	}	
}