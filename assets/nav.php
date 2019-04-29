<nav  class="navbar navbar-expand-md bg-white navbar-light">
  <!-- Brand -->
<div class="container">
  <a class="navbar-brand" href="/" ><img src="http://passport.mclmediagroup.com/assets/logo.jpg" height="50"> <span class="display-4" style="font-size:1em">Passport</span></a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="/">Wineries</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/scan">Scan</a>
      </li>
<?php if (isset($_SESSION["userID"])){?>
  <li class="nav-item">
    <a class="nav-link" href="/profile">Profile</a>
  </li>
      <li class="nav-item">
        <a class="nav-link" href="/logout">Logout</a>
      </li>
    <?php }else{ ?>
      <li class="nav-item">
        <a class="nav-link" href="/profile">Login</a>
      </li>
    <?php } ?>
    </ul>
  </div>
  </div>
</nav>
