
function addFavoriteToList(checkBox) {
	
	let existingEntries = JSON.parse(localStorage.getItem("favoritesItems") || '[]');

	if(checkBox.checked) {
		
		existingEntries.push(checkBox.value);
        localStorage.setItem("favoritesItems", JSON.stringify(existingEntries));
	} else {
		
		const article = existingEntries.indexOf(checkBox.value);
		existingEntries.splice(article, 1);
        localStorage.setItem("favoritesItems", JSON.stringify(existingEntries));

	}
}



const existingEntries = JSON.parse(localStorage.getItem("favoritesItems") || '[]');

document.querySelectorAll(".listFavorite").forEach(function (addFavorite) {
	
	const idArticle = addFavorite.value;
	
	if(existingEntries !== null) {
		for(let i=0; i < existingEntries.length; i++) {	
			if(existingEntries[i] === idArticle) {
			
				addFavorite.checked = true;
			}

		}
	}
      
	addFavorite.addEventListener('change', function () {		

		addFavoriteToList(addFavorite);
	});
});	




