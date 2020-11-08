<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <style>
      .hm{
          text-align: center;
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
      <a class="right brand-logo"><i class="material-icons">person</i>Cem Kurulay</a>
    </div>
  </nav>
      
  <table>
    <tbody>
        <tr>
        <th>Title</th>
        <td><?= $out["title"] ?></td>
        </tr>
        <tr>
        <th>Url</th>
        <td><?= $out["url"] ?></td>
        </tr>
        <tr>
        <th>Protocol</th>
        <td><?= $out["protocol"] ?></td>
        </tr>
        <tr>
        <th>Domain</th>
        <td><?= $out["domain"] ?></td>
        </tr>
        <tr>
        <th>Share</th>
        <td><?= $out["share"] ?></td>
        </tr>
    </tbody>
  </table>
      <script>
          $(function(){
            M.toast({html: 'New bookmark added', classes: 'rounded blue'});
          });
      </script>
  </div>
</body>
</html>