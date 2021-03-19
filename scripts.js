function activateBar(id) {
	var x = Array(3); 
	x[0] = document.getElementById("gameBar");
	x[1] = document.getElementById("accountBar")
	x[2] = document.getElementById("leaderboardBar");
	x[3] = document.getElementById("emptyBar");
	var y = Array(3); 
	y[0] = document.getElementById("gameBarButton");
	y[1] = document.getElementById("accountBarButton");
	y[2] = document.getElementById("leaderboardBarButton");
	if (x[id].style.display === "none") {
		for (let i = 0; i < 3; i++) {
			x[i].style.display = "none";
			y[i].classList.remove("active");
		}
		x[3].style.display = "none";
		x[id].style.display = "block";
		y[id].classList.add("active");
	} else {
		x[id].style.display = "none";
		y[id].classList.remove("active")
		x[3].style.display = "block";
	}
}

function gotoPage(name) {
	pages = document.getElementsByClassName("page");
	for (i = 0; i < pages.length; i++) {
		pages[i].style.display = "none";
	}
	document.getElementById(name).style.display = "block";
}

function leaderboard(id) {
	if (document.getElementById("leaderboard") === "block") {
		
	}
	else {
		gotoPage("leaderboard");
	}
}
