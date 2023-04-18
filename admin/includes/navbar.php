

<nav id="sidebar" class="sidebar js-sidebar">
  <div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="index.php">
      <span class="align-middle">Content Management Panel</span>
    </a>

    <ul class="sidebar-nav">
      <li class="sidebar-header">Pages</li>

      <li class="sidebar-item active">
        <a class="sidebar-link" href="index.php">
          <i class="align-middle" data-feather="sliders"></i>
          <span class="align-middle">Dashboard</span>
        </a>
      </li>

      <li class="sidebar-item dropdown">
        <a class="sidebar-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="align-middle" data-feather="book"></i>
        <span class="align-middle">Posts</span>

          
        </a>
        <ul class="dropdown-menu">
          <li class="sidebar-item"><a class="sidebar-link" href="posts.php">View All Posts</a></li>
          <li class="sidebar-item"><a class="sidebar-link" href="posts.php?source=add_post">Add Posts</a></li>
        </ul>
      </li>
      <li class="sidebar-item dropdown">
        <a class="sidebar-link" href="categories.php">
          <i class="align-middle" data-feather="book"></i>
          <span class="align-middle">categories</span>
        </a>
      </li>

      <li class="sidebar-item dropdown">
        <a class="sidebar-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="align-middle" data-feather="user"></i>
        <span class="align-middle">Users</span>
          
        </a>
        <ul class="dropdown-menu">
          <li class="sidebar-item"><a class="sidebar-link" href="users.php">View All Users</a></li>
          <li class="sidebar-item"><a class="sidebar-link" href="users.php?source=add_user">Add User</a></li>
        </ul>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="comments.php">
          <i class="align-middle" data-feather="message-circle"></i>
          <span class="align-middle">Comments</span>
        </a>
      </li>

    </ul>
  </div>
</nav>

<div class="main">
  <nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
      <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
      <ul class="navbar-nav navbar-align">
        <li class="nav-item"><a class="nav-link" href="../index">Home<span></span></a></li>
        <li class="nav-item"><a class="nav-link" href="">Users Online : <span class="usersonline"></span></a></li>



        <li class="nav-item dropdown">
          <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
            <i class="align-middle" data-feather="settings"></i>
          </a>

          <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
            <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" />
            <span class="text-dark"><?php echo $_SESSION['username'] ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="profile.php"><i class="align-middle me-1" data-feather="user"></i>
              Profile</a>
            <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i>
              Analytics</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="profile.php"><i class="align-middle me-1" data-feather="settings"></i>
              Settings & Privacy</a>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../includes/logout.php">Log out</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>