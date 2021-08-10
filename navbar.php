<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-transparent bor">
  <div class="container">
 <div class="sign">
      <span class="fast-flicker">E</span>X-<span class="flicker">Rat</span>e
    </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?= url('index.php')?>">Home</a>
      </li>
      

      <li class="nav-item">
        <a class="nav-link" href="<?= url('exchange.php')?>">Exchange cars</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= url('auction.php')?>">Auctions</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= url('rating.php')?>">Rating</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= url('mainten.php')?>">Maintenance center</a>
      </li>

      
        
      <?php 
        if (isset($_SESSION['login'])) {
      ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo url('profile.php')?>">profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo url('logout.php')?>">Logout</a>
      </li>
      <?php 
      } else {
        ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo url('login.php')?>">Login</a>
      </li>
        <?php
      }
      ?>
      
    </ul>
    
  </div>
  </div>
</nav>