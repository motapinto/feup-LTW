<?php function drawNavBar() { ?>
  <nav>
      <a href="../listings/listings_all.php"><img class="logo" src="../../assets/logoi.png" alt="logo"></a>
        <ul class="links">
            <li><a href="#">About</a></li>
            <li><a href="#">Buy</a></li>
            <li><a href="#">Rent</a></li>
        </ul>
        <a href="../profile/profile.php"><button formaction="#" formmethod="post"> Profile</button></a>
        <a href="../actions/logout_action.php"><button formaction="#" formmethod="post"> LogOut</button></a>
  </nav>
<?php } ?>
