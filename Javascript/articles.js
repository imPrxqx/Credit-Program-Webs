const dialog = document.getElementById('dialog'); 
const articlesPerPage = 10; 
let pageNumber = 1; 

function showArticles() {
	
	const articles = document.querySelectorAll(".article");
	const startIndex = (pageNumber - 1) * articlesPerPage;
	const endIndex = Math.min(startIndex + articlesPerPage, articles.length);
	
	articles.forEach(function (article) {
		article.style.display = 'none';
	});

	for (let i = startIndex; i < endIndex; i++) {
        articles[i].style.display = 'flex';
    }
	
	pageCount(articles.length);
	checkNextPrevious(articles.length);
}

function checkNextPrevious(length) {
	
	const prevButton = document.getElementById('prev-page');
	const nextButton = document.getElementById('next-page');

	if(pageNumber == 1) {
        prevButton.style.display = 'none';
	} else {
		prevButton.style.display = 'block';
	}
		
	if(pageNumber*articlesPerPage >= length) {
        nextButton.style.display = 'none';
		
		if((pageNumber-1)*articlesPerPage == length && pageNumber !== 1) {
			previousPage();
			return; 
		}
	} else {
		nextButton.style.display = 'block';
	}
	
}

function pageCount(length) {
	if(length !== 0) {
		hodnota =  pageNumber + "/" + Math.ceil(length / 10);
	} else {
		hodnota = "1/1";
	}
	document.getElementById("count-page").innerHTML = hodnota;
}

function nextPage() {
	pageNumber += 1;
	showArticles();  
}

function previousPage() {
	pageNumber -= 1;
	showArticles();  
}

function deleteArticle(deleteButton) {
	
	const idArticle = deleteButton.parentNode.parentNode;

	fetch("./articles", {
		method: "DELETE",
		body: JSON.stringify({ 
			'id': idArticle.getAttribute("id") 
		}),
	}).then(response => {
		if (response.status === 404) {
			throw new Error('Článek nebyl úspěšně smazán - neexistující URL');
		}
		
		if (response.status === 403) {
			throw new Error('Článek nebyl úspěšně smazán - neplatné URL');
		}
		
		alert("Článek byl úspěšně smazán");
		
		idArticle.remove();
		showArticles();
		
	}).catch(error => {
		alert(error.message);
	});
}


document.getElementById('next-page').addEventListener('click', function() {
	nextPage();	
});
	
document.getElementById('prev-page').addEventListener('click', function() {
	previousPage();
});

document.querySelectorAll(".delete").forEach(function (deleteButton) {
	deleteButton.addEventListener('click', function () {		
		deleteArticle(deleteButton);
	});
});
	
document.getElementById('create-article').addEventListener('click', function() {
	if (dialog.open === false) {
		dialog.open = true;
		document.getElementById('article-name').value = "";
	} else {
		dialog.open = false;
	}
});
	
document.getElementById('cancel-create').addEventListener('click', function(event) {
	event.preventDefault();
	dialog.open = false;
});
	
showArticles();