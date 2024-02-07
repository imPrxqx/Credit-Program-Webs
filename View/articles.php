<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../CSS/articles.css">
		<title>Article List</title>
		<script src="./Javascript/articles.js" defer></script>
	</head>
	<body>
		<div id="container">	
			<div>
				<h1>Article List</h1>
			</div>
			
			<div>
				<hr>
			</div>
			
			<div>		
				<ul id="article-list">					
					<?php

						foreach ($articlesData as $article) {
							echo '<li class="article" id="' . htmlspecialchars($article->id) . '" style="display: none;">';
							echo '<div>';
							echo '<p>' . htmlspecialchars($article->name) . '</p>';
							echo '</div>';
							echo '<div>';
							echo '<a href="./article/' . htmlspecialchars($article->id) . '">Show</a>';
							echo '<a href="./article-edit/' . htmlspecialchars($article->id) . '">Edit</a>';
							echo '<a class="delete">Delete</a>';
							echo '</div>';
							echo '</li>';
						}
					?>				
				</ul>				
			</div>
			
			<div>
				<hr>
			</div>		
				
			<div id="pagination">
				<div id="page-left">
					<div>
						<button id="prev-page">Previous</button>
					</div>
					<div>
						<button id="next-page">Next</button>
					</div>
				</div>
				<div id="page-middle">		
					<span id="count-page"></span>
				</div>
				<div id="page-right">						
					<button id="create-article">Create article</button>
				</div>
			</div>
			
			<div>
				<dialog id="dialog"> 
					<form method="post">
						<div>
							<label for="article-name">Article name:</label>
							<input type="text" name="name" id="article-name" maxlength="32" required>
						</div>
						<div>
							<button id="cancel-create">Cancel</button>
							<button type="submit" id="create-article-btn">Create</button>
						</div>	
					</form>
				</dialog>
			</div>
		</div>	
	</body>
</html>
