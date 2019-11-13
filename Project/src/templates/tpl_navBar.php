<?php function draw_navBar($search=false) { ?>
    <nav>
        <a href="../listings/listings_all.php"><img class="logo" src="../../assets/logo.png" alt="logo" ></a>
        <?php if($search){ ?>
        <form action="../listings/listings_city.php" method="GET">
          <input name="search" type="text" placeholder="Search" required/>
        </form>
        <?php } ?>
        <ul class="links">
            <!-- <li><a href="#">About</a></li> -->
            <li><a href="#">My Properties</a></li>
            <li><a href="#">Rent</a></li>
        </ul>
      <?php
        if(isset($_SESSION['email'])) { ?>
          <a href="../profile/profile.php"><button formaction="#" formmethod="post"> Profile</button></a>
          <a href="../actions/action_logout.php"><button formaction="#" formmethod="post"> Log Out</button></a>
        <?php }
        else { ?>
          <a href="../authentication/login.php"><button formaction="#" formmethod="post"> Log In</button></a>
        <?php } ?>
    </nav>
<?php } ?>
