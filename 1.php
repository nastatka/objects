<?php 

class Item {

private $id = 0; 
private $name = "";
private $status = 0;
private $changed = false;

function __construct($id) {
    $this->id = $id;
}
private function init() {
	$db = connect();
	$query = "
	SELECT `name`, `status` FROM `objects`;
	";
	$result = mysqli_query($link, $query);
	if($result) {
		while($row = mysqli_fetch_assoc($result)) {
			$arrname[] = $row['name'];
			$arrstatus[] = $row['status'];
		}
	}	
}
public function connect() {
	$connect = mysqli_connect('localhost', 'my_user', 'my_password', 'my_db');
	mysqli_set_charset($connect, 'utf8');
	return $connect;
}
public function __set($property, $value) {
	switch($property) {
		case 'id':
			echo "ID изменить нельзя<br>";
		break;
		case 'name':
			if (is_string($value)) {
				$this->$property = $value;
				$this->changed = true;
			} else if (!isset($value)) {
				echo "Не установлено значение";
			}
		break;
		case 'status':
			if (is_int($value)) {
				$this->$property = $value;
				$this->changed = true;
			} else if (!isset($value)) {
				echo "Не установлено значение";
			}
		break;
		default:
		break;
	}
}
public function __get($property){
    return $this->$property;
}
public function save() {	
	$db = Item::connect();
	if ($this->changed) {
		$query = "
			UPDATE `objects`
			SET `name` = '$this->name',
				`status` = '$this->status'
			WHERE `id` = '$this->id';
			";
		$result = mysqli_query($db, $query);
	}
	else {
		echo "Нет изменений";
	}
}
}
?>