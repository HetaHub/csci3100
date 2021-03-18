function activateBar(id) {
	var x = Array(3); 
	x[0] = document.getElementById("gameBar");
	x[1] = document.getElementById("accountBar")
	x[2] = document.getElementById("leaderboardBar");
	var y = Array(3); 
	y[0] = document.getElementById("gameBarButton");
	y[1] = document.getElementById("accountBarButton");
	y[2] = document.getElementById("leaderboardBarButton");
	if (x[id].style.display === "none") {
		for (let i = 0; i < 3; i++) {
			x[i].style.display = "none";
			y[i].classList.remove("active");
		}
		x[id].style.display = "block";
		y[id].classList.add("active");
	} else {
		x[id].style.display = "none";
		y[id].classList.remove("active")
	}
}

function gotoPage(name) {
	pages = document.getElementsByClassName("page");
	for (i = 0; i < pages.length; i++) {
		pages[i].style.display = "none";
	}
}