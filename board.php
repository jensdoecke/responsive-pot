<?php
define('URL', 'http://forum.mods.de/bb/');
require_once('./bbcode/Parser.php');
require_once('ModsCodeDefinitions.php');


$parser = new JBBCode\Parser();
$parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());

$builder = new QuoteCodeDefinition();
$builder->setUseOption(true);
$parser->addCodeDefinition($builder);

$builder = new QuoteCodeDefinition();
$parser->addCodeDefinition($builder);

$builder = new YouTubeCodeDefinition();
$parser->addCodeDefinition($builder);

function holeBoardAlsXML($page)
{
  $boardUrl = URL . 'xml/board.php?BID=14';
  if(isset($page)){
    if($page < 1) {
      $page = 1;
    }
  }
  else {
    $page = 1;
  }
  $boardUrl .= '&page=' . $page;
  return simplexml_load_file($boardUrl);
}

function holeThreadAlsXML($threadId, $page)
{
  $threadUrl = URL . 'xml/thread.php?TID=' .$threadId . '&page=' . $page;
  return simplexml_load_file($threadUrl);
}

function prevPage($page)
{
  return (($page > 1) ? ($page -1) : 1);
}

function nextPage($page)
{
  return ($page+1);
}

function getNumericParam($param, $defaultValue)
{
  $retVal = $defaultValue;
  if(isset($_GET[$param]) && is_numeric($_GET[$param]))
  {
      $retVal = $_GET[$param];
  }
  return $retVal;
}

 ?>
