<?php 
require 'bin/functions.php';
require 'db_configuration.php';
include('header.php');
?>

<html>
    <head>
        <title>ABCD</title>
    </head>
    <style>
        .image {
            width: 100px;
            height: 100px;
            padding: 8px 8px 8px 8px;
            transition: transform .2s;
        }
        .image:hover {abc
            transform: scale(1.2)
        }
        #table_1 {
            border-spacing: 300px 0px;
        }
        #table_2 {
            margin-left: auto;
            margin-right: auto;
        }
        #silc {
            width: 300;
            height: 85;
        }
        #welcome {
            text-align: center;
        }
        #directions {
            text-align: center;
        }
        #title {    
            color: black;        
            text-align: center;
        }
        a:visited, a:link, a:active {
            text-decoration: none;
        }
        #title2 {
        text-align: center;
        color: darkgoldenrod;
        }
    </style>
    <body>
    <?php
        if(isset($_GET['preferencesUpdated'])){
            if($_GET["preferencesUpdated"] == "Success"){
                echo "<br><h3 align=center style='color:green'>Success! The Preferences have been updated!</h3>";
            }
        }
    ?>
    <h1 id = "title2">Welcome to Project ABCD</h1>
    <h2 id = "directions">Select a dress to know more about it</h2><br>
    
    <?php

    $sql1 = "SELECT `value` FROM `preferences` WHERE `name`= 'NO_OF_TOPICS_PER_ROW'";
    $sql2 = "SELECT `name` FROM `dresses`";
    $sql3 = "SELECT `image_url` FROM `dresses`";

    $results1 = mysqli_query($db,$sql1);
    $results2 = mysqli_query($db,$sql2);
    $results3 = mysqli_query($db,$sql3);

    if(mysqli_num_rows($results1)>0){
        while($row = mysqli_fetch_assoc($results1)){
            $column[] = $row;
        }
    }
    
    
    if(mysqli_num_rows($results2)>0){
        while($row = mysqli_fetch_assoc($results2)){
            $dresses[] = $row;
        }
    }

    if(mysqli_num_rows($results3)>0){
        while($row = mysqli_fetch_assoc($results3)){
            $pics[] = $row;
        }
    }

    $columns = $column[0]['value'];

    $count= count($dresses);
    
    echo "<table id = 'table_2'>
    <!--Links to each dress can be put inside the href = -->";
    echo "<tr>";
    for($a=0;$a<$count;$a){
        for($b=0;$b<$columns;$b++){
            if($a>=$count){
                break;
            }else{

        $dress = $dresses[$a]['name'];
        $pic = $pics[$a]['image_url'];
       echo "
        <td>
            <a href = 'display_the_dress.php?topic= $dress' title = $dress>
                <image class = 'image' src = $pic> </image>
                <div id = 'title'>$dress </div>
            </a>
        </td>
        ";        
        $a++;
            }
        }
    echo "</tr>";
    }   
    echo"</table>";
    ?>
    
    </body>
</html>
