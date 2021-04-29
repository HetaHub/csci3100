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

<!-- main navigation bar -->
<nav class = "navbar navbar-expand navbar-dark bg-dark mb-3">
	<ul class = "navbar-nav">
		<li class = "nav-item"><a href = "javascript:gotoPage('game')" class = "nav-link" id = "gameBarButton">Game</a></li>
		<li class = "nav-item"><a href = "javascript:activateBar(0)" class = "nav-link" id = "accountBarButton">Account</a></li>
		<li class = "nav-item"><a href = "javascript:activateBar(1)" class = "nav-link" id = "leaderboardBarButton">Leaderboard</a></li>
		<li class = "nav-item"><a href = "javascript:gotoPage('comments')" class = "nav-link" id = "leaderboardBarButton">Comments</a></li>
	</ul>
</nav>

<!-- secondary navigation bar for account related items -->
<div id = "accountBar" style = "display:none">
<nav class = "navbar navbar-expand navbar-dark mb-3" style = "background-color:rgb(32,32,32)">
	<ul class = "navbar-nav">
		<li class = "nav-item"><a href = "javascript:gotoPage('login')" class = "nav-link">Login</a></li>
		<li class = "nav-item"><a href = "javascript:gotoPage('register')" class = "nav-link">Register</a></li>
		<li class = "nav-item"><a href = "javascript:gotoPage('account')" class = "nav-link">Account Info</a></li>
	</ul>
</nav>
</div>

<!-- secondary navigation bar for leaderboard related items -->
<div id = "leaderboardBar" style = "display:none">
<nav class = "navbar navbar-expand navbar-dark mb-3" style = "background-color:rgb(32,32,32)">
	<ul class = "navbar-nav">
		<li class = "nav-item"><a href = "javascript:gotoPage('leaderboard1')" class = "nav-link">Total Score</a></li>
		<li class = "nav-item"><a href = "javascript:gotoPage('leaderboard2')" class = "nav-link">Max Score</a></li>
		<li class = "nav-item"><a href = "javascript:gotoPage('leaderboard3')" class = "nav-link">Play Count</a></li>
	</ul>
</nav>
</div>

<!-- empty navigation bar for when the secondary navigation bar is not opened -->
<div id = "emptyBar" style = "display:block">
<nav class = "navbar navbar-expand navbar-dark mb-3" style = "background-color:rgb(32,32,32)">
</nav>
</div>

<!-- main game page -->
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

<!-- login page -->
<div id = "login" class = "page" style = "display:none">
   <h1>Login</h1>
   <body>
        <form class="mui-input-group"  action="login.php" method="post">
	         <p>
			<div class="mui-input-row">
	            <label class="account_pass">UserName:</label>
				<br>
	            <input type="text" name="username" class="mui-input-clear" placeholder="User Name">
	        </div>
			</p>
	        <p></P>
			<p>
	        <div class="mui-input-row">
	            <label class="account_pass">Password:</label><br>
	            <input type="password" name="password" class="mui-input-clear" placeholder="Enter PW">
		    <button type="submit" class="mui-btn">Login</button>
	        </div></p>
	</form>
    </body>
</div>

<!-- register page -->
<div id = "register" class = "page" style = "display:none">
    <h1>Registration</h1>
    <body>
        <form class="mui-input-group"  action="reg.php" method="post">
	        <p>
			<div class="mui-input-row">
	            <label class="account_pass">Enter your UserName:</label><br>
	            <input type="text" name="username" class="mui-input-clear" placeholder="User Name">
	        </div>
			</p>
	        <p></P>
			<p>
	        <div class="mui-input-row">
	            <label class="account_pass">Set your Password:</label><br>
	            <input type="password" name="password" class="mui-input-clear" placeholder="Enter PW">
	        </div>
			</p>
	        <p></P>
			<p>
			<div class="mui-input-row">
	            <label class="account_pass">Enter your Password again:</label><br>
	            <input type="password" name="rpwd" class="mui-input-clear" placeholder="Enter PW Again">
		    <button type="submit" class="mui-btn">Register</button>
	        </div></p>
	</form>
    </body>
</div>

<!-- account info page, contents replaced by scripts.js -->
<div id = "account" class = "page" style = "display:none">
	<h1>Account Info</h1>
</div>

<!-- leaderboard page for Total Score-->
<div id = "leaderboard1" class = "page" style = "display:none">
	<h1>Leaderboard</h1>
	
	    <table>
	    <tr>
		<th>Rank</th>
	    <th>Username</th>
	    <th>Score</th>
	    </tr>
	    <?php
		    $conn = mysqli_connect("localhost", "root", "", 'users');
		    if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		    }
		    $sql = "SELECT * FROM users where TotalScore IS NOT NULL ORDER BY TotalScore DESC LIMIT 10";
		    $result = $conn->query($sql);
		    if ($result->num_rows > 0) {
				$rank = 1;
			    while($row = $result->fetch_assoc()) {
					echo "<tr><td>". $rank++  . "</td><td>". $row["UserName"] . "</td><td>". $row["TotalScore"]. "</td></tr>";
			    }
			    echo "</table>";
		    } else { echo "0 results"; }
		    $conn->close();
	    ?>
		<p></p>
	    </table>
	
</div>

<!-- leaderboard page for Max Score-->
<div id = "leaderboard2" class = "page" style = "display:none">
	<h1>Leaderboard</h1>
	
	    <table>
	    <tr>
		<th>Rank</th>
	    <th>Username</th>
	    <th>Score</th>
	    </tr>
	    <?php
		    $conn = mysqli_connect("localhost", "root", "", 'users');
		    if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		    }
		    
		    $sql = "SELECT * FROM users where MaxScore IS NOT NULL ORDER BY MaxScore DESC LIMIT 10";
		    $result = $conn->query($sql);
		    if ($result->num_rows > 0) {
				$rank = 1;
			    while($row = $result->fetch_assoc()) {
					echo "<tr><td>". $rank++  . "</td><td>". $row["UserName"] . "</td><td>". $row["MaxScore"]. "</td></tr>";
			    }
			    echo "</table>";
		    } else { echo "0 results"; }
		    $conn->close();
	    ?>
	    </table>
		<p></p>
	
</div>

<!-- leaderboard page for Play Count-->
<div id = "leaderboard3" class = "page" style = "display:none">
	<h1>Leaderboard</h1>
	
	    <table>
	    <tr>
		<th>Rank</th>
	    <th>Username</th>
	    <th>Score</th>
	    </tr>
	    <?php
		    $conn = mysqli_connect("localhost", "root", "", 'users');

		    if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		    }
		    $sql = "SELECT * FROM users where PlayCount IS NOT NULL ORDER BY PlayCount DESC LIMIT 10";
		    $result = $conn->query($sql);
		    if ($result->num_rows > 0) {
				$rank = 1;
			    while($row = $result->fetch_assoc()) {
				echo "<tr><td>". $rank++ . "</td><td>". $row["UserName"] . "</td><td>". $row["PlayCount"]. "</td></tr>";
			    }
			    echo "</table>";
		    } else { echo "0 results"; }
		    $conn->close();
	    ?>
	    </table>
		<p></p>
	
</div>

<!-- comments page -->
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
