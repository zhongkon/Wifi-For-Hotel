<?php
require('routeros_api.class.php');
$API = new RouterosAPI();
$API->debug = true;
if ($API->connect('192.168.69.20', 'mtapi', 'eeBU69ZQ2prWX1y')) {
   $API->write('/interface/getall');
   $READ = $API->read(false);
   $ARRAY = $API->parseResponse($READ);
   print_r($ARRAY);
   $API->disconnect();
}
?>
