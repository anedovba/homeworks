 <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="#"><?= isset($_SESSION['user'])? $_SESSION['user'] : 'guest' ?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">Home</a></li>
            <li><a href="/index.php?page=comments">Comments</a></li>
            <li><a href="/index.php?page=gallery">Gallery</a></li>

            <li>
              <?php if(isset($_SESSION['user'])):?>
              <a href="/index.php?page=logout">Logout</a>
              <?php else:?>
              <a href="/index.php?page=login">Login</a>
              <?php endif;?>

            </li>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
