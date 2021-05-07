<?php
$url = "http://localhost/magento2/index.php/";
$token_url=$url."rest/V1/integration/admin/token";
$ch = curl_init();
$data = array("username" => "admin", "password" => "admin123");
$data_string = json_encode($data);
$ch = curl_init($token_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($data_string))
);
$token = curl_exec($ch);
$adminToken=  json_decode($token);

$skus = array(
  'Jeans-001-Black-s' => 12,
  'Jeans-001-Blue-s' => 24
);

foreach ($skus as $sku => $stock) {
  $requestUrl='http://localhost/magento2/index.php/rest/V1/products/' . $sku . '/stockItems/1';
  $sampleProductData = array(
          'qty' => $stock,
          'is_in_stock'   => 1
  );

$productData = json_encode(array('stockItem' => $sampleProductData));
$setHaders = array('Content-Type:application/json','Authorization:Bearer '.$adminToken);

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $requestUrl);
curl_setopt($ch,CURLOPT_POSTFIELDS, $productData);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_HTTPHEADER, $setHaders);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

  var_dump($response);
}
?>
