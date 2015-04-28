<?php
//This function is used to return all IP blocks
function all_blocks ($db) {
  //Get all IP ranges from the database
  $query = "SELECT `id`, `start`, `end`, `cidr`, `ipv`, `company` FROM `ip_ranges` WHERE 1 ORDER BY `company` ASC;";
  $res = $db->query($query);
  //Table header row creation
  $return_val = '<table border="1" cellpadding="5" cellspacing"10">'."\r\n".
                "<tr><td><b>ID</b></td><td><b>Network</b></td>".
                "<td><b>Broadcast</b></td><td><b>CIDR</b></td>".
                "<td><b>IP&nbsp;Version</b></td><td><b>Company</b></td></tr>\r\n";
  //Get all the records from the database
  foreach ($res as $records) {
    //Create each records row
    $return_val = $return_val . "<tr>\r\n";
    $return_val = $return_val . '<td><a href="ipshow.php?id=' . $records["id"] . '">' . $records["id"] . "</a></td>\r\n";
    //IPv4 and IPv6 have different functions, check and make the determination
    if ($records["ipv"] == '4') {
      //Convert the network and broadcast back to human formats
      $network = new IPv4($records["start"]);
      $broadcast = new IPv4($records["end"]);
      $return_val = $return_val . "<td>" . $network . "</td>\r\n";
      $return_val = $return_val . "<td>" . $broadcast . "</td>\r\n";
    } else if ($records["ipv"] == '6') {
      //Convert the network and broadcast back to human formats
      $network = new IPv6($records["start"]);
      $broadcast = new IPv6($records["end"]);
      $return_val = $return_val . "<td>" . $network . "</td>\r\n";
      $return_val = $return_val . "<td>" . $broadcast . "</td>\r\n";
    } //end if ($records["ipv"] == '4') {
    $return_val = $return_val . "<td>" . $records["cidr"] . "</td>\r\n";
    $return_val = $return_val . "<td>" . $records["ipv"] . "</td>\r\n";
    $return_val = $return_val . "<td>" . $records["company"] . "</td>\r\n";
    $return_val = $return_val . "</tr>\r\n";
  } //end foreach ($res as $records) {

  //Close out the table
  $return_val = $return_val . "</table>";

  //Return the data back to the calling function
  return $return_val;
} //end function all_blocks ($db) {

//This function gets the info for one block
function block_info($id, $db){
  //Search for the block by ID passed to this function
  $query = "SELECT `id`, `start`, `end`, `cidr`, `ipv`, `company` FROM `ip_ranges` WHERE `id` = ". $db->quote($id) ." LIMIT 1;";
  //die ($query);
  $res = $db->query($query);
  //There should only be one record, retrieve it
  foreach ($res as $records) {
    if ($records["ipv"] == '4') {
      //Convert the network and broadcast back to human formats
      $network = new IPv4($records["start"]);
      $broadcast = new IPv4($records["end"]);
      $return_val = "<b>ID:</b>&nbsp;" . $records['id']  . "<br>\r\n".
                    "<b>Network:</b>&nbsp;" . $network  . "<br>\r\n".
                    "<b>Broadcast:</b>&nbsp;" . $broadcast  . "<br>\r\n".
                    "<b>CIDR:</b>&nbsp;" . $records['cidr']  . "<br>\r\n".
                    "<b>IP&nbsp;Version:</b>&nbsp;" . $records['ipv']  . "<br>\r\n".
                    "<b>Company:</b>&nbsp;" . $records['company']  . "<br>\r\n";
    }else if ($records["ipv"] == '6') {
      //Convert the network and broadcast back to human formats
      $network = new IPv6($records["start"]);
      $broadcast = new IPv6($records["end"]);
      $return_val = "<b>ID:</b>&nbsp;" . $records['id']  . "<br>\r\n".
                    "<b>Network:</b>&nbsp;" . $network  . "<br>\r\n".
                    "<b>Broadcast:</b>&nbsp;" . $broadcast  . "<br>\r\n".
                    "<b>CIDR:</b>&nbsp;" . $records['cidr']  . "<br>\r\n".
                    "<b>IP&nbsp;Version:</b>&nbsp;" . $records['ipv']  . "<br>\r\n".
                    "<b>Company:</b>&nbsp;" . $records['company']  . "<br>\r\n";
    } //end if ($records["ipv"] == '4') {
  } //end foreach ($res as $records) {
  return $return_val;
}
?>
