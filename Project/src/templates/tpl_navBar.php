<?php function draw_navBar($option=-1) { ?>
    <nav class='common-navbar'>
        <form class="search-form" action='../listings/listings_city.php' method='GET'>
            <input type="text" id="search-bar" placeholder="What can I help you with today?">
            <a href="#"><img class="search-icon" src="http://www.endlessicons.com/wp-content/uploads/2012/12/search-icon.png"></a>
        </form>
        <?php if(isset($_SESSION['id'])) { 
            switch ($option) {
                case 0: ?>
                    <a id='navbar-properties' class='selected-navbar-elem' href='../listings/listings_all.php'> Home </a>
                    <a id='navbar-properties' class='common-navbar-elem' href='../properties/properties.php'>My Properties </a>
                    <a id='navbar-messages' class='common-navbar-elem' href='../messages/messages.php'> Messages </a>
                    <a id='navbar-profile' class='common-navbar-elem' href='../profile/profile.php'> Profile </a>
                    <a id='navbar-logout' class='common-navbar-elem' href='../actions/action_logout.php'> Log Out </a>
                    <?php break;
                
                case 1: ?>
                    <a id='navbar-properties' class='common-navbar-elem' href='../listings/listings_all.php'> Home </a>
                    <a id='navbar-properties' class='selected-navbar-elem' href='../properties/properties.php'>My Properties </a>
                    <a id='navbar-messages' class='common-navbar-elem' href='../messages/messages.php'> Messages </a>
                    <a id='navbar-profile' class='common-navbar-elem' href='../profile/profile.php'> Profile </a>
                    <a id='navbar-logout' class='common-navbar-elem' href='../actions/action_logout.php'> Log Out </a>
                    <?php break;

                case 2: ?>
                    <a id='navbar-properties' class='common-navbar-elem' href='../listings/listings_all.php'> Home </a>
                    <a id='navbar-properties' class='common-navbar-elem' href='../properties/properties.php'>My Properties </a>
                    <a id='navbar-messages' class='common-navbar-elem' href='../messages/messages.php'> Messages </a>
                    <a id='navbar-profile' class='selected-navbar-elem' href='../profile/profile.php'> Profile </a>
                    <a id='navbar-logout' class='common-navbar-elem' href='../actions/action_logout.php'> Log Out </a>
                    <?php break;

                case 3: ?>
                    <a id='navbar-properties' class='common-navbar-elem' href='../listings/listings_all.php'> Home </a>
                    <a id='navbar-properties' class='common-navbar-elem' href='../properties/properties.php'>My Properties </a>
                    <a id='navbar-messages' class='common-navbar-elem' href='../messages/messages.php'> Messages </a>
                    <a id='navbar-profile' class='common-navbar-elem' href='../profile/profile.php'> Profile </a>
                    <a id='navbar-logout' class='selected-navbar-elem' href='../actions/action_logout.php'> Log Out </a>
                    <?php break;

                case 4: ?>
                    <a id='navbar-properties' class='common-navbar-elem' href='../listings/listings_all.php'> Home </a>
                    <a id='navbar-properties' class='common-navbar-elem' href='../properties/properties.php'>My Properties </a>
                    <a id='navbar-messages' class='selected-navbar-elem' href='../messages/messages.php'> Messages </a>
                    <a id='navbar-profile' class='common-navbar-elem' href='../profile/profile.php'> Profile </a>
                    <a id='navbar-logout' class='common-navbar-elem' href='../actions/action_logout.php'> Log Out </a>
                    <?php break;

                default: ?>
                    <a id='navbar-properties' class='common-navbar-elem' href='../listings/listings_all.php'> Home </a>
                    <a id='navbar-properties' class='common-navbar-elem' href='../properties/properties.php'>My Properties </a>
                    <a id='navbar-messages' class='common-navbar-elem' href='../messages/messages.php'> Messages </a>
                    <a id='navbar-profile' class='common-navbar-elem' href='../profile/profile.php'> Profile </a>
                    <a id='navbar-logout' class='common-navbar-elem' href='../actions/action_logout.php'> Log Out </a>
                <?php break;
            } ?>
        <?php }
            else { ?>
                <a id='navbar-properties' class='selected-navbar-elem' href='../listings/listings_all.php'> Home </a>
                <a id='navbar-login' class='common-navbar-elem' href='../authentication/login.php'> Log In </a>
            <?php } ?>
    </nav>
<?php } ?>
