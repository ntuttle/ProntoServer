<?php
define('output','html');
require_once __DIR__ .'/core/core.php';
if(!isset($_GET['PAGE'])){
  if(ParseURI($_GET['URI'],$CFG->DB))
    exit();
}
$WWW = new WWW($CFG);
echo implode(LF,$WWW->HTML);
?>