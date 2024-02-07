<?php

class ArticleView {
	
	public function renderView($variableName, $data, $view, $httpCode) {
	
		$$variableName = $data;
		include($view . ".php");
		http_response_code($httpCode);
		exit;
		
	}	
	
}