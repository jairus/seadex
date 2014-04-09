<?php
$DATABASE_HOST = "seadex.com";
$DATABASE_USER = "seadexco_root";
$DATABASE_PASSWORD = "roy123!";
$DATABASE = "seadexco_seadex";
function dbQuery($query)
{
    global $DATABASE_HOST;
    global $DATABASE_USER;
    global $DATABASE_PASSWORD;
    global $DATABASE;
    $returnArr = array();

    /* Connecting, selecting database */
    $link = mysql_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD)
        or die("Could not connect : " . mysql_error());
    mysql_select_db($DATABASE) or die("Could not select database");

    /* Performing SQL query */
    $result = mysql_query($query) or die("Query failed : " . mysql_error() . "<br>Query: <b>$query</b>");

   
    //if query is select
    if(@mysql_num_rows($result))
    {
        while ($row = mysql_fetch_assoc($result))
        {
            array_push($returnArr, $row);
        }      
    }
    //if query is insert
    else if(@mysql_insert_id())
    {
        $returnArr["mysql_insert_id"] = @mysql_insert_id();
    }
    //other queries
    else
    {
        /* Closing connection */
        mysql_close($link);
        return $returnArr;
    }
       

    /* Free resultset */
    @mysql_free_result($result);

    /* Closing connection */
    mysql_close($link);
   
    //return array
    return $returnArr;
}

$sql = "select * from `ports`";
$rows = dbQuery($sql);
$t = count($rows);
$n = 0;
for($i=0; $i<$t; $i++){
	$port1 = $rows[$i]['port_id'];
	for($j=0; $j<$t; $j++){
		$port2 = $rows[$j]['port_id'];
		$sql = "delete from `distances` where `port1`='".$port1."' and `port2` = '".$port2."'";
		dbQuery($sql);
		
		$ch = curl_init("http://sirius.searates.com/port/port-to-port");
		$encoded = 'port_a='.$port1."&port_b=".$port2;
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS,  $encoded);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		$res = curl_exec($ch);
		curl_close($ch);
		
		$sql = "insert into `distances` set
		`port1` = '".$port1."',
		`port2` = '".$port2."',
		`data` = '".base64_encode($res)."'
		";
		dbQuery($sql);
		//echo $n." of ".($t*$t)." ($port1 - $port2) <br />\n";
		//echo $res."<hr /><br /><br />\n\n";
		//if($n==2){
		//	exit();
		//}
		$n++;
		
	}
}


exit();


$ch = curl_init("http://sirius.searates.com/port/port-to-port");
$encoded = 'port_a='.$port1."&port_b=".$port2;
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,  $encoded);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
$res = curl_exec($ch);
curl_close($ch);
?>