<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Responsive pOT</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <?php
      $boardUrl = 'http://forum.mods.de/bb/xml/board.php?BID=14';

      if(isset($_GET['page'])){
        $page = htmlspecialchars($_GET['page']);
        if($page < 1) { $page = 1; }
        $boardUrl .= '&page=' . $page;
      } else
      {
        $page = 1;
      }
      $xml = simplexml_load_file($boardUrl);
   ?>
    <div class="container">

      <ul class="pager">
          <li class="previous"><a href="<?php echo 'index.php?page=' . ($page -1); ?>">&lt;&lt;</a></li>
          <li class="next"><a href="<?php echo 'index.php?page=' . ($page+1); ?>">&gt;&gt;</a></li>
      </ul>

      <?php foreach ($xml->threads->thread as $thread): ?>
      <a href="<?php echo 'thread.php?id=' .$thread ; ?>">
        <div class="row">
          <div id="left" class="col-xs-8">
            <div class="row">
              <div id="title" class="col-xs-12">
                <?php echo (string) $thread->title; ?>
              </div>
            </div>
            <div class="row">
              <div id="title" class="col-xs-12">
                <small>
                <?php echo (string) $thread->subtitle; ?>
              </small>
              </div>
            </div>
          </div>
          <div id="right" class="col-xs-4">
            <div class="row">
              <div id="title" class="col-xs-12">
                <?php
                if(isset($thread->lastpost)) {
                  echo (string) $thread->lastpost->post->user;
                } else {
                  echo '';
                }
                ?>
              </div>
              <div id="lastpostdate" class="col-xs-12">
                <small>
                <?php
                if(isset($thread->lastpost)) {
                  echo (string) $thread->lastpost->post->date;
                }
                ?>
                </small>
              </div>
            </div>
          </div>
        </div>
      </a>
     <?php endforeach; ?>

     <ul class="pager">
         <li class="previous"><a href="<?php echo 'index.php?page=' . ($page -1); ?>">&lt;&lt;</a></li>
         <li class="next"><a href="<?php echo 'index.php?page=' . ($page+1); ?>">&gt;&gt;</a></li>
     </ul>

   </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
