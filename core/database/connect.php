<?php
/*$connect_error = "Site under maintenance.";
mysql_connect('localhost', 'webdevu1_webley', 'supplier123', '') or die($connect_error);
mysql_select_db('webdevu1_useru') or die($connect_error);*/
?>

<?php
$connect_error = "Site under maintenance.";
mysql_connect(getenv("USERU_DB_HOST"), getenv("USERU_DB_USER"), getenv("USERU_DB_PASSWD"), '') or die($connect_error);
mysql_select_db(getenv("USERU_DB_NAME")) or die($connect_error);
?>
