<?php
  require "db.php" ;

  if( $_SERVER["REQUEST_METHOD"] == "POST") {

     try {
        extract($_POST);
        $sql = "insert into bookmark (title, url, note, owner) values (?,?,?,?)" ;
        $stmt = $db->prepare($sql) ;
        $stmt->execute([$title, $url, $note, $owner]) ;
        $msg = "Success" ;
     } catch(PDOException $ex3) {
        $msg = "Fail" ;
     }

  }
?>

<?php

  extract($_GET);
  $sortt = isset($sort) ? $sort : "created" ;

  $sql = "select name, bookmark.id, title, url, note, created from bookmark,user where owner=user.id order by " . $sortt ;

  try {
     /* $stmt = $db->prepare($sql) ;
      $stmt->execute() ; */
      $stmt = $db->query($sql) ; // shorthand way of sending fixed query
      $size2 = $stmt->rowCount() ;
      $bookmarks = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
  } catch(PDOException $ex) {
     echo $ex->getMessage() ;
     die("<p>Try Later</p>") ;
  }

    $sql2 = "select * from user" ;  // fixed query

    try {
      /* $stmt = $db->prepare($sql) ;
        $stmt->execute() ; */
        $stmt2 = $db->query($sql2) ; // shorthand way of sending fixed query
        $size2 = $stmt2->rowCount() ;
        $users = $stmt2->fetchAll(PDO::FETCH_ASSOC) ;
    } catch(PDOException $ex2) {
      echo $ex2->getMessage() ;
      die("<p>Try Later</p>") ;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <title>All Users</title>
    <style>
      .mt-4 {
        margin-top: 4em ;
      }
      td.truncate{
        width: 200px;
      }
      .btn-floating{
        position: fixed;
        top: 90vh;
        left: 79vw; 
      }
      #btnadd{
        margin-bottom: 1em;
      }
      .listtable{
        margin-top: 2em;
      }
      .listtable th{
        color: gray;
      }
      .listtable th a{
        color: gray;
      }
      .fmodal{
        margin-left: 0.5em;
        display: inline-block;
        width: 10vw;
        color: gray;
        font-size: 1.5em;
      }
      .smodal{
        color: gray;
        display: inline-block;
        width: 40vw;
        font-size: 1.5em;
      }
      #toast-container {
        top: auto !important;
        right: auto !important;
        bottom: 10%;
        left:47%;  
      }
    </style>
</head>
<body>
  <div class="container">

    <nav>
      <div class="nav-wrapper">
        <a href="homepage.php" class="brand-logo"><i class="material-icons">home</i>BMS</a>
        <ul class="right hide-on-med-and-down">
          <li><a href="bookmark.php"><i class="material-icons left">bookmark_border</i>Bookmarks</a></li>
        </ul>
      </div>
    </nav>

    <table class="highlight listtable">

      <tr>
        <th><a href="bookmark.php?sort=name">Owner</a></th>
        <th><a href="bookmark.php?sort=title">Title</a></th>
        <th class="truncate"><a href="bookmark.php?sort=note">Note</a></th>
        <th><a href="bookmark.php?sort=created">Date</a></th>
        <th>Actions</th>
      </tr>

      <?php foreach( $bookmarks as $bookmark) : ?>
        <tr>
          <td><?= $bookmark["name"] ?></td>
          <td><a><?= $bookmark["title"] ?></a></td>
          <td class="truncate"><?= $bookmark["note"] ?></td>
          <td><?php
          $newdate = strtotime($bookmark["created"]);
          ?><?= date("d M y", $newdate) ?></td>
          <td><a href="delete.php?id=<?= $bookmark["id"] ?>" class="btn-small"><i class="material-icons">delete</i></a>
          <a href="#mview<?= $bookmark["id"] ?>" class="btn-small modal-trigger"><i class="material-icons">visibility</i></a></td>
        </tr>

        <!-- Modal Structure -->
        <div id="mview<?= $bookmark["id"] ?>" class="modal">
          <div class="modal-content">
            <p class="valign-wrapper"><span class="fmodal">Owner: </span><span class="smodal"><?= $bookmark["name"] ?></span></p>
            <p class="valign-wrapper"><span class="fmodal">Title: </span><span class="smodal"><?= $bookmark["title"] ?></span></p>
            <p class="valign-wrapper"><span class="fmodal">Notes: </span><span class="smodal"><?= $bookmark["note"] ?></span></p>
            <p class="valign-wrapper"><span class="fmodal">URL: </span><span class="smodal"><?= $bookmark["url"] ?></span></p>
            <p class="valign-wrapper"><span class="fmodal">Date: </span><span class="smodal"><?= $bookmark["created"] ?></span></p>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
      <?php endforeach ; ?>

    </table>

    <a class="btn-floating btn-large waves-effect waves-light red right modal-trigger" href="#modaladd"><i class="material-icons">add</i></a>

    <!-- Modal Structure -->
    <div id="modaladd" class="modal">
      <div class="modal-content">
        <h4 class="center">New Bookmark</h4>
        <form method="post">
      
          <div class="input-field">
            <select name="owner">
              <option value="" disabled selected>Choose your option</option>
              <?php foreach( $users as $user) : ?>
                <option value="<?= $user["id"] ?>"><?= $user["name"] ?></option>
              <?php endforeach ; ?>
            </select>
            <label>Owner</label>
          </div>

          <div class="input-field">
            <input placeholder="Title" id="title" type="text" name="title">
            <label for="bookmark_title">Title</label>
          </div>

          <div class="input-field">
            <input placeholder="Url" id="bookmark_url" type="text" name="url">
            <label for="bookmark_url">Url</label>
          </div>

          <div class="input-field">
            <textarea id="bookmark_note" class="materialize-textarea" name="note"></textarea>
            <label for="bookmark_note">Note</label>
          </div>

          <div class="input-field">
            <button class="btn waves-effect waves-light right" id="btnadd" type="submit" name="action">Add
              <i class="material-icons right">send</i>
            </button>
          </div>

          <?php
            if (isset($msg)) {
              echo "<script> M.toast({html: '$msg!', classes:'teal'}) </script>" ;
            }
          ?>

        </form>
      </div>
    </div>

    <script>
      $(document).ready(function(){
        $('.modal').modal();
        $('select').formSelect();
      });
    </script>

  </div>
</body>
</html>