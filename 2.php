<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Логин</th>
			<th>Пароль</th>
			<th>Object ID</th>
		</tr>
	</thead>
	<tbody>
	<?

function connect()
	{
		$connect = mysqli_connect('localhost', 'my_user', 'my_password', 'my_db');
		mysqli_set_charset($connect, 'utf8');
		return $connect;
	}
    $db = connect();
	$query = "
	SELECT * FROM `users` INNER JOIN `objects` ON users.`object_id` = objects.`id`;
	";
	$result = mysqli_query($db, $query);
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
		<? foreach($users as $user) : ?>
			<tr>
				<td><?= $user['id'] ?></td>
				<td><?= $user['login'] ?></td>
				<td><?= $user['password'] ?></td>
				<td><?= $user['object_id'] ?></td>
				
			</tr>
		<? endforeach; ?>
	</tbody>
</table>

</body>
</html>
