<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
	<link rel="stylesheet" href="../CSS/article-edit.css">
</head>
<body>
    <div id="container">
		<form method="post">
			<div>
				<div>
					<h1 id="nameHeader">Name</h1>
				</div>
				<div>
					<input type="text" id="name" name="name" maxlength="32" value="<?php echo htmlspecialchars($articleData->name); ?>" required>
				</div>
			</div>
			
			<div id="content">
				<div>
					<h1 id="contentHeader">Content</h1>
				</div>
				<div>
					<textarea name="content" rows="6" maxlength="1024"><?php  echo htmlspecialchars($articleData->content); ?></textarea>
				</div>
			</div>
			
			<div id="buttons">
				<button type="submit" id="save">Save</button>
				<a href="./../articles" id="back">Back to Articles</a>
			</div>
		</form>
    </div>
</body>
</html>
