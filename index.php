<?php

$request_uri = $_GET['page'];

if ($request_uri === 'articles') {
	
    require_once('Controller/ShowArticleController.php');
	$showArticlesController = new ShowArticlesController();
	$showArticlesController->process();
	
} elseif (preg_match('~^article/(\d+)$~', $request_uri, $matches)) {
	
    require_once('Controller/DetailArticleController.php');
	$detailArticleController = new DetailArticleController($matches[1]);
	$detailArticleController->process();
	
} elseif (preg_match('~^article-edit/(\d+)$~', $request_uri, $matches)) {
	
    require_once('Controller/EditArticleController.php');
	$editArticleController = new EditArticleController($matches[1]);
	$editArticleController->process();
	
} else {
	
	require_once('View/ArticleView.php');
	$articleView = new ArticleView();
	$articleView->renderView("error", "403 - NOT FOUND PAGE!!!", "error", 403);
	
}

