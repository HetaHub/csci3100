function activateBar(id) {
	var x = Array(3); 
	//x[0] = document.getElementById("gameBar");
	x[0] = document.getElementById("accountBar")
	x[1] = document.getElementById("leaderboardBar");
	x[2] = document.getElementById("emptyBar");
	var y = Array(3); 
	//y[0] = document.getElementById("gameBarButton");
	y[0] = document.getElementById("accountBarButton");
	y[1] = document.getElementById("leaderboardBarButton");
	if (x[id].style.display === "none") {
		for (let i = 0; i < 2; i++) {
			x[i].style.display = "none";
			y[i].classList.remove("active");
		}
		x[2].style.display = "none";
		x[id].style.display = "block";
		y[id].classList.add("active");
	} else {
		x[id].style.display = "none";
		y[id].classList.remove("active")
		x[2].style.display = "block";
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

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function accountInfo() {
	var accountCookie = getCookie(username);
	if (accountCookie == "") {
		document.getElementById("account").innerHTML = "Currently not logged in";
	}
	else {
		document.getElementById("account").innerHTML = "Logged in as user: " + accountCookie;
	}
}
