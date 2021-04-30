<!DOCTYPE html>
<html>
<head>
	<title>Helpline</title>
	<style type="text/css">
		body {
		  font-family: Arial, Helvetica, sans-serif;
		  margin: 0;
		}

		html {
		  box-sizing: border-box;
		}

		*, *:before, *:after {
		  box-sizing: inherit;
		}

		.column {
		  float: left;
		  width: 33.3%;
		  margin-bottom: 16px;
		  padding: 0 8px;
		}

		.card {
		  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		  margin: 8px;
		}

		.about-section {
		  padding: 50px;
		  text-align: center;
		  background-color: skyblue;
		  color: white;
		}

		.container {
		  padding: 0 16px;
		}

		.container::after, .row::after {
		  content: "";
		  clear: both;
		  display: table;
		}

		.title {
		  color: grey;
		}

		.button {
		  border: none;
		  outline: 0;
		  display: inline-block;
		  padding: 8px;
		  color: white;
		  background-color: skyblue;
		  text-align: center;
		  cursor: pointer;
		  width: 100%;
		}

		.button:hover {
		  background-color: #555;
		}
	</style>
</head>
<body>
	<div class="about-section">
	  <h1>About Us</h1>
	</div>

	<h2 style="text-align:center">Our Team</h2>
	<div class="row">
	<div class="column">
	    <div class="card">  
	      <div class="container">
	        <h2>Rajin,MD. Iktedar Hasan Rushdi</h2>
	        <p class="title">Student</p>
	        <p><button class="button">Contact</button></p>
	      </div>
	    </div>
	</div>

	<div class="column">
	    <div class="card">
	      <div class="container">
	        <h2>Tonmoy Turjya</h2>
	        <p class="title">Student</p>
	        <p><button class="button">Contact</button></p>
	      </div>
	    </div>
	</div>

	<div class="column">
	    <div class="card">
	      <div class="container">
	        <h2>Mushfiqur Abir</h2>
	        <p class="title">Student</p>
	        <p><button class="button">Contact</button></p>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="column">
	    <div class="card">
	      <div class="container">
	        <h2>Afrida Rahman</h2>
	        <p class="title">Student</p>
	        <p><button class="button">Contact</button></p>
	      </div>
	    </div>
	  </div>
	</div>
	<br>
	<div>
		<footer>
			<p><a href="index.php"><-Go Back</a></p></footer>
	</div>
</body>
</html>