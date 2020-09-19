<html>
<head>
<title>
Recover
</title>
<link rel="shortcut icon" href="data/data/icon.png" type="image/icon">
<link rel="stylesheet" href="css/help.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/frgtpwdstrength.js"></script>
<script src="js/recover.js"></script>
</head>
<body>
<div class="wp"><a href="index.php">Log In</a></div>
<div id="stepone">
<p>STEP 1</p>
<input type="text" placeholder="Your Username" id="boxes" class="username"><img src="data/data/spinner.gif" id="spinner" />
</div>
<div id="steptwo">
<p>STEP 2</p>
<p id="question"></p>
<input type="password" placeholder="Answer" id="boxes" class="answer"><img src="data/data/spinner.gif" id="spinner" />
</div>
<div id="stepthree">
<p>STEP 3</p>
<input type="password" placeholder=" Enter New Password" id="boxes" class="password"><div id="meter"></div>
<input type="password" placeholder=" Confirm Password" id="boxes" class="cpassword">
<button>Done</button>
</div>
</body>
</html>