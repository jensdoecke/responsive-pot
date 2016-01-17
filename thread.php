<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    include('board.php');


    if(isset($_GET['id']) && is_numeric($_GET['id']))
    {
      $threadId = $_GET['id'];
      $xml = holeThreadAlsXML($threadId);
    }
    else {
      header('Location: http://'. $_SERVER['SERVER_NAME'] . '/responsive-pot' );
      die();
    }
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo (string)$xml->title; ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

    <div class="container">
      <ul class="pager">
          <li class="previous"><a href="<?php echo 'index.php?page='; ?>">&lt;&lt;</a></li>
          <li class="next"><a href="<?php echo 'index.php?page='; ?>">&gt;&gt;</a></li>
      </ul>

      <?php foreach ($xml->posts->post as $post): ?>
        <div class="row">
          <div class="col-xs-4">
            <div class="row">
              <div class="col-xs-12">
                <img class="img-responsive" src="<?php echo URL . (string)$post->avatar;?>" alt="<?php echo (string)$post->user;?>">
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <?php echo (string)$post->user;?>
              </div>
            </div>
          </div>
          <div class="col-xs-8">
            <?php
            $parser->parse((string)$post->message->content);
            echo $parser->getAsHtml();
            ?>
          </div>
        </div>
     <?php endforeach; ?>

     <ul class="pager">
          <li class="previous"><a href="<?php echo 'index.php?page='; ?>">&lt;&lt;</a></li>
         <li class="next"><a href="<?php echo 'index.php?page='; ?>">&gt;&gt;</a></li>
     </ul>

   </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
