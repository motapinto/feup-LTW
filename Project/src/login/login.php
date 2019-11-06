<?php
  include_once('../templates/common/header.php');
  include_once('../templates/common/footer.php');

  drawHead('Login');

?>
  <section class="log_in">
    <form action="../login/login_action.php" method="POST">
      <img class="logo" src="../../assets/logoi.png" alt="logo">
      <h2>Sign in</h2>
      <input name="email" type="email" placeholder="email" />
      <input name="password" type="password" placeholder="password" maxlength=30/>
      <?php 
        if (isset($_GET["msg"])) {
          $msg = explode("%20",$_GET["msg"]);
          echo '<p>';
          foreach($msg as $item) {
            echo $item." ";
          }
          echo '</p>';
        }		
      ?>
      <a href="#">Forgot your password?</a>
      <button class="loginin_button" formaction="login_action.php" formmethod="post">LOG IN</button>
      <button class="signup_button" formaction="signup.php" formmethod="post">SIGN UP</button>
    </form>
  </section>

<?php
  drawFooter();
?>
