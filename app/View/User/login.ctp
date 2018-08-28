<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/user/login">Simple Chat System</a>
</nav>
<div class="row">
  <div class="col-sm-6 offset-md-3">
    <!-- Greeting -->
    <div class="greeting">
      <h2>Sign-in</h2>
      <p>You gonna have some fun!</p>
    </div>

    <!-- Sign-in form -->
    <form action="/User/login" method="post">
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email" name="e-mail">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
      </div>
      <div class="link-signin">
        <a class="sign-up" href="/user/regist">New around here? Sign up</a>
      </div>
      <button type="submit" class="btn btn-primary">Sign-in</button>
    </form>
  </div>
</div>