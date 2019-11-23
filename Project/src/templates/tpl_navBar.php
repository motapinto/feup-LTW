<?php function draw_navBar($search=true) { ?>
    <nav class='common-navbar'>
        <?php if($search){ ?>
          <form class="search-form" action='../listings/listings_city.php' method='GET'>
          <input type="text" id="search-bar" placeholder="What can I help you with today?">
          <a href="#"><img class="search-icon" src="http://www.endlessicons.com/wp-content/uploads/2012/12/search-icon.png"></a>
          </form>
        <?php } ?>
        <?php if(isset($_SESSION['id'])) { ?>
          <a onclick='navBar(0);' id='navbar-properties' class='common-navbar-elem' href='../properties/properties.php'>My Properties </a>
          <a onclick='navBar(1);' id='navbar-profile' class='common-navbar-elem' href='../profile/profile.php'> Profile </a>
          <a onclick='navBar(2);' id='navbar-logout' class='common-navbar-elem' href='../actions/action_logout.php'> Log Out </a>
        <?php }
          else { ?>
            <a onclick='navBar(3);' id='navbar-login' class='common-navbar-elem' href='../authentication/login.php'> Log In </a>
        <?php  } ?>
    </nav>

    <script>
      function navBar(option) {
        switch(option) {
          case 0: 
                  document.getElementById('navbar-properties').style.borderBottom ='solid 2px teal';
                  document.getElementById('navbar-properties').style.color = 'teal'
                  document.getElementById('navbar-profile').style.borderBottom ='solid 2px trasnparent';
                  document.getElementById('navbar-profile').style.color ='grey';
                  document.getElementById('navbar-logout').style.borderBottom ='solid 2px trasnparent';
                  document.getElementById('navbar-logout').style.color ='grey';
                  break;

          case 1: 
                  document.getElementById('navbar-profile').style.borderBottom ='solid 2px teal';
                  document.getElementById('navbar-profile').style.color = 'teal'
                  document.getElementById('navbar-properties').style.borderBottom ='solid 2px trasnparent';
                  document.getElementById('navbar-properties').style.color ='grey';
                  document.getElementById('navbar-logout').style.borderBottom ='solid 2px trasnparent';
                  document.getElementById('navbar-logout').style.color ='grey';
                  break;
          case 2: 
                  document.getElementById('navbar-logout').style.borderBottom ='solid 2px teal';
                  document.getElementById('navbar-logout').style.color = 'teal'
                  document.getElementById('navbar-properties').style.borderBottom ='solid 2px trasnparent';
                  document.getElementById('navbar-properties').style.color ='grey';
                  document.getElementById('navbar-profile').style.borderBottom ='solid 2px trasnparent';
                  document.getElementById('navbar-profile').style.color ='grey';
                  break;

          case 3: document.getElementById('navbar-properties').style.borderBottom ='solid teal 2px';
          default: return;
        }
      }

      
    </script>
<?php } ?>
