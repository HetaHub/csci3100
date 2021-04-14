<!doctype html>
<html lang="en">
<head>
	<meta charset = "utf-8">
	<title>Card Game</title>
	<meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
	<link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src = "scripts.js"></script>
	<script src="loginscrip.js" defer></script>
	<script src="regisscrip.js" defer></script>
    <script src="new.js" defer></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.12.0/lodash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
	<style>table, th, td {border: 1px solid white; border-collapse: collapse;}th, td { padding: 5px;  text-align: center;}</style>
</head>

<body style = "background-color:black; color:white; font-family: 'Shippori Mincho', serif" onload = "javascript:accountInfo()">
<article>

<header>
	<h1>CUHK Card Matching Game</h1>
</header>

<nav class = "navbar navbar-expand navbar-dark bg-dark mb-3">
	<ul class = "navbar-nav">
		<li class = "nav-item"><a href = "javascript:gotoPage('game')" class = "nav-link" id = "gameBarButton">Game</a></li>
		<li class = "nav-item"><a href = "javascript:activateBar(0)" class = "nav-link" id = "accountBarButton">Account</a></li>
		<li class = "nav-item"><a href = "javascript:activateBar(1)" class = "nav-link" id = "leaderboardBarButton">Leaderboard</a></li>
		<li class = "nav-item"><a href = "javascript:gotoPage('comments')" class = "nav-link" id = "leaderboardBarButton">Comments</a></li>
	</ul>
</nav>

<!--
<div id = "gameBar" style = "display:none">
<nav class = "navbar navbar-expand navbar-dark mb-3" style = "background-color:rgb(32,32,32)">
	<ul class = "navbar-nav">
		<li class = "nav-item"><a href = "javascript:gotoPage('game')" class = "nav-link">Game</a></li>
		<li class = "nav-item"><a href = "javascript:gotoPage('options')" class = "nav-link">Options</a></li>
	</ul>
</nav>
</div>
-->

<div id = "accountBar" style = "display:none">
<nav class = "navbar navbar-expand navbar-dark mb-3" style = "background-color:rgb(32,32,32)">
	<ul class = "navbar-nav">
		<li class = "nav-item"><a href = "javascript:gotoPage('login')" class = "nav-link">Login</a></li>
		<li class = "nav-item"><a href = "javascript:gotoPage('register')" class = "nav-link">Register</a></li>
		<li class = "nav-item"><a href = "javascript:gotoPage('account')" class = "nav-link">Account Info</a></li>
	</ul>
</nav>
</div>

<div id = "leaderboardBar" style = "display:none">
<nav class = "navbar navbar-expand navbar-dark mb-3" style = "background-color:rgb(32,32,32)">
	<ul class = "navbar-nav">
		<li class = "nav-item"><a href = "javascript:gotoPage('leaderboard1')" class = "nav-link">Total Score</a></li>
		<li class = "nav-item"><a href = "javascript:gotoPage('leaderboard2')" class = "nav-link">Max Score</a></li>
		<li class = "nav-item"><a href = "javascript:gotoPage('leaderboard3')" class = "nav-link">Play Count</a></li>
	</ul>
</nav>
</div>

<div id = "emptyBar" style = "display:block">
<nav class = "navbar navbar-expand navbar-dark mb-3" style = "background-color:rgb(32,32,32)">
</nav>
</div>

<div id = "game" class = "page" style = "display:block">
  <div id="app" class="container">
    <div class="header">
      <div><span class="label">Time:</span> <span class="value">{{ time }} </span></div>
      <div><span class="label">Turns:</span> <span class="value">{{ turns }} </span></div>
      <div><span class="label">Score:</span> <span class="value">{{ score }} </span></div>
    </div>
    <div class="cards">
      <div class="card" v-for="card in cards" :class="{ flipped: card.flipped, found: card.found }" @click="flipCard(card)">
        <div class="back"></div>
        <div class="front" :style="{ backgroundImage: 'url(' + card.image + ')' }"></div>
      </div>
    </div>
    <div class="splash" v-if="showSplash">
      <div class="overlay"></div>
      <div class="content">
        <div class="title">Score: {{ score }}</div>
        <button @click="resetGame()">Play again!</button>
      </div>
    </div>
    <div id="info" class="splash hidden">
      <div class="overlay"></div>
      <div class="content">
        <div id="info-title" class="title"></div>
        <img id="info-image" src="" height=70>
        <div id="info-description" class="score"></div>
        <button @click="closeModal()">keep playing</button>
      </div>
    </div>
  </div>
	<script src="script.js" type="text/javascript"></script>
</div>

<!--
<div id = "options" class = "page" style = "display:none">
	<h1>Options</h1>
	
	<label for="difficulty">Choose a difficulty:</label>
	<select name="difficulty" id="difficulty">
		<option value="easy">easy</option>
		<option value="normal">normal</option>
		<option value="hard">hard</option>
		<option value="insane">insane</option>
	</select>
	<br>
	
	<label for="mode">Choose a mode:</label>
	<select name="mode" id="mode">
		<option value="classic">Classic</option>
		<option value="time">Time Trial</option>
		<option value="zen">Zen</option>
	</select>
</div>
-->

<div id = "login" class = "page" style = "display:none">
   <h1>Login</h1>
   <form id= "login" @submit.prevent="record">
       <input id= "username" type="text" required="required" name="username" class="input" v-model="username" placeholder="Username">
	<br>
       <input id= "password" type="password" required="required" name="password" class="input" v-model="password" placeholder="Password">
	<br>
       <button type="submit" class="submit">login</button>
   </form>
</div>

<div id = "register" class = "page" style = "display:none">
    <h1>Registration</h1>
    <body>
        <form id= "register" @submit.prevent="processForm">
            <input name="username" type="text" required="required" class="input" id= "username" placeholder="Username" v-model="username">
            <br>
            <input name="password" type="password" required="required" class="input" id= "password" placeholder="Password" v-model="password">
            <br>
            <input name="repassword" type="password" required="required" class="input" id= "repassword" placeholder="Confirm Password" v-model="repassword">
            <br>
            <button type="submit" class="submit">Register</button>
        </form>
	</body>
</div>

<div id = "account" class = "page" style = "display:none">
	<h1>Account Info</h1>
</div>

<div id = "leaderboard1" class = "page" style = "display:none">
	<h1>Leaderboard</h1>
	
	    <table>
	    <tr>
	    <th>Username</th>
	    <th>Score</th>
	    </tr>
	    <?php
		    $conn = mysqli_connect("localhost", "root", "", 'users');
		    if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		    }
		    $sql = "SELECT * FROM users ORDER BY TotalScore ASC LIMIT 10";
		    $result = $conn->query($sql);
		    if ($result->num_rows > 0) {
			    while($row = $result->fetch_assoc()) {
			    	echo "<tr><td>" . $row["UserName"] . "</td><td>". $row["TotalScore"]. "</td></tr>";
			    }
			    echo "</table>";
		    } else { echo "0 results"; }
		    $conn->close();
	    ?>
	    </table>
	
</div>
			
<div id = "leaderboard2" class = "page" style = "display:none">
	<h1>Leaderboard</h1>
	
	    <table>
	    <tr>
	    <th>Username</th>
	    <th>Score</th>
	    </tr>
	    <?php
		    $conn = mysqli_connect("localhost", "root", "", 'users');
		    if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		    }
		    
		    $sql = "SELECT * FROM users ORDER BY MaxScore ASC LIMIT 10";
		    $result = $conn->query($sql);
		    if ($result->num_rows > 0) {
			    while($row = $result->fetch_assoc()) {
			    	echo "<tr><td>" . $row["UserName"] . "</td><td>". $row["MaxScore"]. "</td></tr>";
			    }
			    echo "</table>";
		    } else { echo "0 results"; }
		    $conn->close();
	    ?>
	    </table>
	
</div>
			
<div id = "leaderboard3" class = "page" style = "display:none">
	<h1>Leaderboard</h1>
	
	    <table>
	    <tr>
	    <th>Username</th>
	    <th>Score</th>
	    </tr>
	    <?php
		    $conn = mysqli_connect("localhost", "root", "", 'users');

		    if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		    }
		    $sql = "SELECT * FROM users ORDER BY PlayCount ASC LIMIT 10";
		    $result = $conn->query($sql);
		    if ($result->num_rows > 0) {
			    while($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row["UserName"] . "</td><td>". $row["PlayCount"]. "</td></tr>";
			    }
			    echo "</table>";
		    } else { echo "0 results"; }
		    $conn->close();
	    ?>
	    </table>
	
</div>

<div id = "comments" class = "page" style = "display:none">
	<h1>Comments</h1>
    <body>
        <form id= "comment" @submit.prevent="processForm">
            <textarea rows="4" cols="50" name="comment" required="required" form="comment" v-model="comment" placeholder="Comment here...">
            </textarea>	<br>
            <button type="submit" class="submit">submit</button>
        </form>
	    
	    <table>
	    <tr>
	    <th>Recent Comments</th>

		</tr>
<!--
	    <?php
		    $conn = mysqli_connect("localhost", "root", "", "COMMENT");
		    
		    if ($mysqli -> connect_errno) {
			  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
			  exit();
			}
		    
		    $sql = "SELECT TOP 10 * FROM COMMENT";
		    $result = $conn->query($sql);
		    if ($result->num_rows > 0) {
			    while($row = $result->fetch_assoc()) {
				echo "</td><td>". $row["com"]. "</td></tr>";
			    }
			    echo "</table>";
		    } else { echo "0 results"; }
		    $conn->close();
	    ?>
-->
	    </table>
    </body>
</div>

</article>
</body>
</html>
