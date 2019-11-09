<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  position: fixed;
  background-color: #111;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  color: white;
  display: block;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 40px;
  margin-right: 5px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

</style>
</head>
<body>
    <div id="sideBarNav" class="sidenav">
        <a class="closebtn" onclick="closeNav()">
            <i class="material-icons">close</i>
        </a>
        <a href="#">A</a>
        <a href="#">B</a>
        <a href="#">C</a>
        <a href="#">D</a>
    </div>


    <div class="drawerIcon" onclick="openNav()">
        <i class="material-icons">menu</i>
    </div>

    <script>
        function openNav() {
        document.getElementById("sideBarNav").style.width = "250px";
        }

        function closeNav() {
        document.getElementById("sideBarNav").style.width = "0";
        }
    </script>
</body>


   