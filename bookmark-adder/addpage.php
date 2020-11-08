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
      .error { color: red; font-style: italic; display: none; margin:0;}
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
    <div class='hm'><h3>New Bookmark</h3>
            <div class="row">
                <form action="indexx.php" method="post" class="col s12">
                    <div class="input-field col s6 offset-s3">
                    <i class="material-icons prefix">mode_edit</i>
                    <input id="title" name="title" type="text" value="<?= $p_title ?? ''  ?>">
                    <label for="title">Title</label>
                    <div class="error title-error" <?= isset($error) && in_array("title", $error) ? ' style="display:block"' : '' ?> >
                            &#9888; Title cannot be empty.</div>
                    </div>
                    <div class="input-field col s6 offset-s3">
                    <i class="material-icons prefix">link</i>
                    <input id="url" name="url" type="text" value="<?= $p_url ?? ''  ?>">
                    <label for="url">URL</label>
                    <div class="error url-error" <?= isset($error) && in_array("url", $error) ? ' style="display:block"' : '' ?> >
                            &#9888; URL is not valid.</div>
                    </div>
                <div class="row">
                    <div class="input-field col s9">
                    <div class="switch">
                        <a class="btn disabled">Share</a>
                        <label class="right">
                        Off
                        <input type="checkbox" name="sharee" <?= isset($p_sharee) ? "checked" : "" ?>>
                        <span class="lever"></span>
                        On
                        </label>
                    </div>
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                </button>
                </form>
            </div>
   </div>
</body>
</html>