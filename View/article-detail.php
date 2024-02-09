<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Detail</title>
	<link rel="stylesheet" href="../CSS/article-detail.css">
	<script src="../Javascript/articles-detail.js" defer=""></script>

</head>
	<body>
		<div id="container">
		

			<div>
				<h1><?php echo htmlspecialchars($articleData->name); ?></h1>
			</div>
			
			<div>
				<p><?php echo htmlspecialchars($articleData->content); ?></p>
				<label>Favorite:</label>
				<?php echo '<input class="listFavorite" type="checkbox" value="' .  htmlspecialchars($articleData->id) . '">'; ?>

			</div>
			
			<div id="buttons">
				<a href="../article-edit/<?php echo htmlspecialchars($articleData->id); ?>" id="edit">Edit</a>
				<a href="./../articles" id="back">Back to Articles</a>
			</div>            
			
		</div>
	</body>
</html>
