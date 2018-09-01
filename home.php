<?php
  require_once './config.php';
  require_once './User.php';
if (isset($_SESSION['facebook_access_token'])) {
    $loggedUser = new User($_SESSION['facebook_access_token'], $fb);
    $albums = $loggedUser->fetchAlbumList();
} else {
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/custom.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="./js/custom.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<title>FacebookAlbum</title>
</head>

<body>
  <div class="modal fade" id="infoModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body" id="modalSpan">
          <span id="modalBody"></span></button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-sm" style="background-color:#20a1e5">
    <!-- Brand/logo -->
    <a class="navbar-brand" href="deepaklalwani.000webhostapp.com/AlbumMate">
      <img src="./assets/logo.png" alt="logo" style="width:90px;">
    </a>

    <div class="ml-auto">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            <img src="<?php echo $loggedUser->getProfilePic(); ?>" class="avatar">
            <span style="color:white">
              <?php echo $loggedUser->getName(); ?>
            </span>
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="logout.php">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <div style="margin-top:1%">


    <div style="text-align: center;">
      <h1 style="text-align:center;">Albums</h1>
      <button class="btn btn-primary btn-md" onclick="downloadSelected(this);">
        <i class="fas fa-download"></i>Download Selected
      </button>
      <button class="btn btn-primary btn-md" onclick="downloadAll(this);">
        <i class="fas fa-download"></i>Download ALL
      </button>
      <button class="btn btn-primary btn-md" data-toggle="tooltip" title="Move selected albums Google Drive" onclick="moveSelectedAlbums(this);">
        <i class="fab fa-google-drive"></i>Move Selected
      </button>
      <button class="btn btn-primary btn-md" data-toggle="tooltip" title="Move all albums Google Drive" onclick="moveAll(this);">
        <i class="fab fa-google-drive"></i>Move ALL
      </button>
    </div>
    <div class="container">
      <div class="row">
        <?php
        foreach ($albums as $album) {
            ?>
        <div class="col-md-4 album">
          <div class="card">
            <div class="card-body">
              <img src="<?php echo isset($album['cover_photo']['picture'])?$album['cover_photo']['picture']:" ./assets/fb-logo.png
                " ?>" onclick="openFullscreen(<?php echo $album['id'] ?>)" class="album-thumbnail">
              <div style="margin-top:2%;">
                <button class="btn btn-primary btn-sm" onclick="downloadSingleAlbum(<?php echo $album['id'].',\''.$album['name'].'\''; ?>,this)">
                  <i class="fas fa-download"></i>Download This Album
                </button>
                <button class="btn btn-primary btn-sm" data-toggle="tooltip" title="Move this album to Google Drive" onclick="moveSingleAlbum(<?php echo $album['id']?>,this)">
                  <i class="fab fa-google-drive"></i>Move</button>
              </div>
              <div class="album-name">
                <span>
                  <?php echo $album['name']?></span>
                <input type="checkbox" class="" value="<?php echo $album['id']?>">
              </div>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</body>
</html>