<?php 
include 'header.php';
?>
<body>
<div class="container">
	<div class="bar">
		<span class="ps-5">Child Abuse Management System</span>
	</div>
	<div class="container card login-pane p-3">
		<span class="login-label mb-3">LOGIN TO ACCOUNT</span>
		<form id="login-form">
		  <div class="form-group">
		    <label for="exampleInputEmail1" class="mb-2"><small>Username</small></label>
		    <input type="email" class="form-control outline-success" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username" required name="email">
		  </div>
		  <div class="form-group mt-4">
		    <label for="exampleInputPassword1" class="mb-2"><small>Password</small></label>
		    <input type="password" class="form-control outline-success" id="exampleInputPassword1" placeholder="Password" name="password" required>
		  </div>
	  <button type="submit" class="btn btn-outline-success form-control mt-3">LOG IN</button>
</form>
	</div>
</div>


<?php 
include 'footer.php';
 ?>