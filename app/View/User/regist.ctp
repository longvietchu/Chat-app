<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="/user/login">Simple Chat System</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
</nav>
<div class="row">
	<div class="col-sm-6 offset-md-3">
		<div class="greeting">
			<h2>Sign-up</h2>
			<p>Join with us here!</p>
		</div>
		<div id="register-content" class=container>
			<div class="row">
				<div class="col-sm-8 col-lg-12">
					<form id="register-form" action="/user/regist" method="post">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" id="inputName" aria-describedby="nameHelp" placeholder="Enter name" name="name">
						</div>

						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email" name="e-mail">
						</div>

						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
						</div>

						<button type="submit" class="btn btn-primary">Sign-up</button>
					</form>
				</div>
			</div>
		</div>
		<?php
		if(!empty($regist_errors)){
			foreach($regist_errors as $error){
				echo "<div>" . $error[0] . "</div>";
			}
		}
		?>
	</div>
</div>