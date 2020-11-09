<?php

  require "db.php" ;

  $id = $_GET["id"] ;

  try {
      $stmt = $db->prepare("delete from bookmark where id = :id") ;
      $stmt->execute(["id" => $id]) ;
  } catch(PDOException $ex) {
     
  }

  // Redirection
  header("Location: bookmark.php") ;