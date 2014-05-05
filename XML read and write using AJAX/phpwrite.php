<?php
//pulls values from javascript
if (isset($_GET['add'])) $add = $_GET['add'];
if (isset($_GET['val1'])) $val1 = $_GET['val1'];
if (isset($_GET['val2'])) $val2 = $_GET['val2'];

//loads XML file
$xml = simplexml_load_file('urls.xml');

//writes to xml
$url = $xml->addChild('url');
$url->addChild('address', $add);
$url->addChild('admvalue', $val1);
$url->addChild('gsvalue', $val2);

//saves xml
$xml->asXML('urls.xml');


?>