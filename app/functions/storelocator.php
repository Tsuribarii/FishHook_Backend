<?php
require("phpsqlsearch_dbinfo.php");
// Get parameters from URL
// get방식으로 들어오는 latitude 변수명을 가진 데이터 가져옴
$center_lat = $_GET["latitude"];
$center_lng = $_GET["longitude"];
$radius = $_GET["radius"];
// Start XML file, create parent node
// XML 파일을 시작하고 부모 노드를 만듭니다.
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);
// Opens a connection to a mySQL server
// mySQL 서버에 대한 연결을 엽니다
$connection = mysql_connect("localhost", $username, $password);
if (!$connection) {
  die("Not connected : " . mysql_error());
}
// Set the active mySQL database
// 활성 mySQL 데이터베이스 설정
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ("Can\'t use db : " . mysql_error());
}
// Search the rows in the markers table
// 마커 테이블에서 행을 검색
$query = sprintf("SELECT id, name, address, latitude, longitude, ( 3959 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
  mysql_real_escape_string($center_lat),
  mysql_real_escape_string($center_lng),
  mysql_real_escape_string($center_lat),
  mysql_real_escape_string($radius));
$result = mysql_query($query);
$result = mysql_query($query);
if (!$result) {
  die("Invalid query: " . mysql_error());
}
header("Content-type: text/xml");
// Iterate through the rows, adding XML nodes for each
// 각 행에 XML 노드를 추가하여 행을 반복합니다.
while ($row = @mysql_fetch_assoc($result)){
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("id", $row['id']);
  $newnode->setAttribute("name", $row['name']);
  $newnode->setAttribute("address", $row['address']);
  $newnode->setAttribute("latitude", $row['lat']);
  $newnode->setAttribute("longitude", $row['lng']);
  $newnode->setAttribute("distance", $row['distance']);
}
echo $dom->saveXML();
?>
