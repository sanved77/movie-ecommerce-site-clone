<?php

    $con = new MongoClient();
    $collection = $con->social->cart;


    $temp = array("user" => $_SESSION['username']);

    $cartnum = $collection->find($temp)->count();
        echo "<ul>
        <li><a class='active' href='home.php'>Home</a></li>
        <li><a href='movies.php'>Movies</a></li>
        <li><a href='#'>TV Shows</a></li>
        <li style='float:right; background:#333 url('res/cart_black.png') no-repeat 5% 50%;'>
            <a href='profile.php'>" . $_SESSION['username'] ."'s Profile</a>
        </li>
        <li style='float:right'><a href='orders.php'>Orders</a></li>
        <li id='cart' style='float:right'><a href='cart.php'>&nbsp;&nbsp;&nbsp;&nbsp;Items in Cart ". $cartnum ." </a></li>
        </ul>";
?>