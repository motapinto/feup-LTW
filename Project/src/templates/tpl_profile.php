<?php function draw_profile($user) { ?>
<div id="user">
    <article class="side-drawer">
        <!-- USER PHOTO -->
        <div class="profile-photo">
            <div style="display: inline-block;">
                <div class="photo" style="height: 120px; width: 120px; display: block;">
                <img class="_1mgxxu3" src="https://www.google.com/url?sa=i&source=images&cd=&cad=rja&uact=8&ved=2ahUKEwjlpYnp9OnlAhXqAWMBHd3BAeIQjRx6BAgBEAQ&url=https%3A%2F%2Ficon-library.net%2Ficon%2Fdefault-profile-icon-24.html&psig=AOvVaw0b0TCFkVmKeiKwUP3AcaO-&ust=1573828134180909" height="120" width="120" alt="User Photo" title="User Photo">
                </div>
            </div>
        </div>

        <div class="profile-change-photo">
            <a href="edit-photo.php" class="change-photo" >
                Update Photo
            </a>                
        </div>
        
        <!-- USER NAME -->
        <header>
            <div class="profile-name">
                <h1><?=$user['name']?></h1>
            </div>
        </header>

        <!-- SIDEBAR BUTTONS -->
        <div class="profile-userbuttons">
            <button type="button" class="profile-userbuttons-properties">Properties</button>
            <button type="button" class="profile-userbuttons-message">Message</button>
        </div>

        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="usermenu">
                <li class="overview">
                    <a href="#"> Overview </a>
                </li>
                <li class="settings">
                    <a href="#"> Account Settings </a>
                </li>
                <li class="rating">
                    <a href="#"> Rating </a>
                </li>
                <li class="comments">
                    <a href="#"> Comments </a>
                </li>
            </ul>
        </div>
    </article>
</div>



<style>  

.side-drawer {
    display: flex; /* or inline-flex */
    flex-direction: column ;
    width: 300px;
    height: 550px; 
    background-color: green;
    padding: 50px;
    margin: 20px;
}


</style>

<?php } ?>
