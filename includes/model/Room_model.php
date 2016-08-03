<?php
/**
 * Delete a room
 * @param int $room_id
 */
function Room_delete($room_id) {
  return sql_query("DELETE FROM `Room` WHERE `RID`=" . sql_escape($room_id));
}

/**
 * Create a new room
 *
 * @param string $name
 *          Name of the room
 * @param boolean $from_frab
 *          Is this a frab imported room?
 * @param boolean $public
 *          Is the room visible for angels?
 */
function Room_create($name, $from_frab, $public) {
  $result = sql_query("
      INSERT INTO `Room` SET
      `Name`='" . sql_escape($name) . "',
      `FromPentabarf`='" . sql_escape($from_frab ? 1 : '') . "',
      `show`='" . sql_escape($public ? 1 : '') . "',
      `Number`=0");
  if ($result === false)
    return false;
  return sql_id();
}

/**
 * Returns room by id.
 *
 * @param $id RID
 */
function Room($id) {
  $room_source = sql_select("SELECT * FROM `Room` WHERE `RID`='" . sql_escape($id) . "' AND `show` = 'Y'");

  if ($room_source === false)
    return false;
  if (count($room_source) > 0)
    return $room_source[0];
  return null;
}

function Room_by_name() {
  return sql_select("SELECT * FROM `Room` ORDER BY `Name`");
}

function Room_by_id($id) {
  return sql_select("SELECT * FROM `Room` WHERE `RID`='" . sql_escape($id) . "'");
}

function count_room_by_id_name($name, $id) {
  return sql_num_query("SELECT * FROM `Room` WHERE `Name`='" . sql_escape($name) . "' AND NOT `RID`=" . sql_escape($id));
}

function update_rooms($name, $from_pentabarf, $public, $number, $id) {
  return sql_query("UPDATE `Room` SET `Name`='" . sql_escape($name) . "', `FromPentabarf`='" . sql_escape($from_pentabarf) . "', `show`='" . sql_escape($public) . "', `Number`='" . sql_escape($number) . "' WHERE `RID`='" . sql_escape($id) . "' LIMIT 1");
}

function gets_rooms() {
  return sql_select("SELECT `RID` AS `id`, `Name` AS `name` FROM `Room` WHERE `show`='1' ORDER BY `Name`");
}

function selects_visible_rooms() {
  return sql_select("SELECT * FROM `Room` WHERE `show`='1' ORDER BY `Name`");
}

function Room_by_FromPentabarf() {
  return sql_select("SELECT * FROM `Room` WHERE `FromPentabarf`='1'");
}
function Room_all() {
  return sql_select("SELECT * FROM `Room`");
}

function delete_room_by_name ($room) {
  return sql_query("DELETE FROM `Room` WHERE `Name`='" . sql_escape($room) . "' LIMIT 1");
}

function Rooms() {
  $room_source = sql_select("SELECT * FROM `Room` WHERE `show` = 'Y'");

  if ($room_source === false)
    return false;
  if (count($room_source) > 0)
    return $room_source[0];
  return null;
}

?>

