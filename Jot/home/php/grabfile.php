<?php // upload file

include_once("../../methods2.php");
session_start();
$token = $_SESSION["token"];
if($_FILES['filename']['name'])
{
	if ($_FILES["filename"]["error"] > 0)
  	{
  		echo "Error: " . $_FILES["filename"]["error"] . "<br>";
  	}
	else
  	{
		$specialKey = $_POST['special'];
		$itemType = $_POST['item_type'];
		$annotation = $_POST['annotation'];
		echo $specialKey."<br />";
		echo $itemType."<br />";
		echo $annotation."<br />";
		echo $token."<br />";
		$fileName = $_FILES['filename']['name']; // image file name 
		$tmpName  = $_FILES["filename"][tmp_name]; // name of the temporary stored file name 
		$fileSize = $_FILES["filename"][size]; // size of the uploaded file 
		$fileType = $_FILES["filename"][type]; // file type 

		$fileHandle = fopen($tmpName, "r"); 
		$fileContent = fread($fileHandle, $fileSize);  
		fclose($fileHandle);

		$bdata = base64_encode($fileContent);

$url = 'http://10.0.0.77/jot/service2.php?wsdl';
$client = new SoapClient($url);
$entity = new stdClass();
$entity->key = $specialKey;
$entity->item_memory_bytes = 0;
$entity->modified = '';

$item = new stdClass();
$item->itemid = 1;
$item->itemtype = $itemType;
$item->annotation = $annotation;
$item->bdata = $bdata;

$entity->items = array($item);
$rslt = $client->storeEntity($token, $entity);
echo $rslt;


/*		$entity = new Entity();
		$entity->setKey($specialKey);
		echo $entity;
		$entityItem = new EntityItem();
		$entityItem->setItemId(1);
		$entityItem->setItemType($itemType);
		$entityItem->setAnnotation($annotation);
		$entityItem->setBdata($bdata);
		$entity->addItem($entityItem);

		$result = storeEntity($_SESSION["token"], $entity);
		echo $result;*/
		header("location: /jot/home/index.php");
	}
}
else
{
	echo "something went wrong";
}
?>
