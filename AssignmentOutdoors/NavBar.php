<?php
session_start();
?>

<!doctype html>

<head>


</head>
<body>
    <div id="navigation">
        <div id="loginOptions">

<?php
if (isset($_SESSION['loggedIn'])) {
    $bannerName = $_SESSION['first'] . " " . $_SESSION['last'];
    echo "<p>Hello $bannerName <a href = \"logout.php\">Logout</a></p>";
    
} else {
    echo "<p>Welcome</p>";
}
?>




        </div>

        <ul id="navbar">
            <li>
                <a href = "index.php">Home</a>
            </li>
            <li>
                <a href = "productinfo.php">Product Information</a>
            </li>
            <li>
                <a href = "login.php">Login</a>
            </li>
            <li>
                <a href = "cart.php">Order Online</a>
            </li>    

        </ul>
    </div>




