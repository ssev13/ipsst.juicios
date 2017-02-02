<?php

echo 'Servidor2';

$serverName = "134.14.1.20";
$connectionOptions = array(
 "Database" => "IpsstDesarrollo",
 "Uid" => "usudesarrollo",
 "PWD" => "usu789"
);
//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
//Select Query
$tsql= "SELECT @@Version as SQL_VERSION";
//Executes the query
$getResults= sqlsrv_query($conn, $tsql);
//Error handling
if ($getResults == FALSE)
 die(FormatErrors(sqlsrv_errors()));
?>
<h1> Results : </h1>
<?php
while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
 echo ($row['SQL_VERSION']);
 echo ("<br/>");
}
sqlsrv_free_stmt($getResults);

function FormatErrors( $errors )
{
 /* Display errors. */
 echo "Error information: <br/>";
 foreach ( $errors as $error )
 {
 echo "SQLSTATE: ".$error['SQLSTATE']."<br/>";
 echo "Code: ".$error['code']."<br/>";
 echo "Message: ".$error['message']."<br/>";
 }
}

?>

