<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
      .hm{
          text-align: center;
      }
    </style>
</head>
<body>
   <div class="container">
   <nav>
    <div class="nav-wrapper">
      <a href="mt1.php" class="brand-logo"><i class="material-icons">home</i>HOME</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li
        <?php
        if(isset($_GET["gender"])){
            $gendr = $_GET["gender"];
            if($gendr == "female"){
                echo "style='background-color: lightblue;'";
            }
        }
        ?>
        ><a href="mt1.php?gender=female&page=1">Female</a></li>
        <li
        <?php
        if(isset($_GET["gender"])){
            $gendr = $_GET["gender"];
            if($gendr == "male"){
                echo "style='background-color: lightblue;'";
            }
        }
        ?>
        ><a href="mt1.php?gender=male&page=1">Male</a></li>
      </ul>
    </div>
  </nav>
    <?php
    if(isset($_GET["gender"])){
        $gendr = $_GET["gender"];
        require "./db.php" ;
        echo "<table class='striped' id='responsive'>
        <tr>
          <th>Name</th>
          <th>Age</th>
          <th>Product</th>
          <th>Price</th>
        </tr>";
        $ordersArray = [[]] ;
        $c =0;
        foreach( $orders as $order) {
            foreach($users as $email => $userdata){
                if($email==$order["email"]){
                    if ( $userdata["gender"] == $gendr) {
                        $Name=$userdata["fullname"];
                        $bday = DateTime::createFromFormat("d/m/Y", $userdata["birthday"]);
                        $now = new DateTime();
                        $difr = $now->diff($bday);
                        $Age = $difr->y;
                        $Product = $order["prd_name"];
                        $Price = $order["price"];
                        $ordersArray[$c]["name"] = $Name;
                        $ordersArray[$c]["age"] = $Age;
                        $ordersArray[$c]["product"] = $Product;
                        $ordersArray[$c]["price"] = "$" . $Price . ",00";
                        $c=$c+1;
                    }
                }
            }
        }

        usort($ordersArray, function($a, $b) {
            $d1 = $a["name"] ;
            $d2 =  $b["name"] ;
            return $d1 <=> $d2 ;
        }) ;


        $pagecnt = (int)(sizeof($ordersArray)/10+1);
        $curpage = (int)$_GET["page"];
        $arcount = sizeof($ordersArray);

        if($curpage==$pagecnt){
            for($j =($curpage-1)*10; $j<sizeof($ordersArray);$j++) {
                extract($ordersArray[$j]);
                echo "<tr><td>$name</td><td>$age</td><td>$product</td><td>$price</td></tr>";
            }
        }else{
            for($j =($curpage-1)*10; $j<($curpage)*10;$j++) {
                extract($ordersArray[$j]);
                echo "<tr><td>$name</td><td>$age</td><td>$product</td><td>$price</td></tr>";
            }
        }
        echo "</table>";

        echo '<ul class="pagination">';
            echo '<li class="';
            if($curpage==1){
                echo 'disabled"><a href="mt1.php?gender=' . $gendr . '&page=1';
            }else{
                echo 'waves-effect"><a href="mt1.php?gender=' . $gendr . '&page=' . ($curpage-1);
            }
            echo '"><i class="material-icons">chevron_left</i></a></li>';

            for($i=0;$i<$pagecnt;$i++){
                if($curpage==$i+1){
                    echo '<li class="active"><a href="mt1.php?gender=' . $gendr . '&page=' . (string)($i+1) . '">' . (string)($i+1) . '</a></li>';
                }else{
                    echo '<li class="waves-effect"><a href="mt1.php?gender=' . $gendr . '&page=' . (string)($i+1) . '">' . (string)($i+1) . '</a></li>';
                }
            }

            echo '<li class="';
            if($curpage==$pagecnt){
                echo 'disabled"><a href="mt1.php?gender=' . $gendr . '&page=' . $pagecnt;
            }else{
                echo 'waves-effect"><a href="mt1.php?gender=' . $gendr . '&page=' . ($curpage + 1);
            }
            echo '"><i class="material-icons">chevron_right</i></a></li>';
        echo "</ul>";
    }else{
        echo "<div class='hm'><h1>Cem Kurulay</h1><h2>21803090</h2><h5>Midterm 1 - Part 1</h5></div>";
    }
      
   ?>
   </div>
</body>
</html>
