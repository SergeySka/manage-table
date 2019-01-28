<?php 
$pdo = new PDO("mysql:host=localhost;dbname=neto; charset=utf8", "root","");
$table = "CREATE TABLE `countries` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`country` varchar(50) NOT NULL,
`capital` varchar(50) DEFAULT NOT NULL,
`population` int(20) NOT NULL,
`based` smallint(10) NOT NULL DEFAULT '0',
`date_added` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$pdo->exec($table);
    echo "Table created successfully";

 ?>
 <!doctype html>
 <html lang="ru">
 <head>
 	<meta charset="UTF-8">
 	<title>Document</title>
 </head>
 <body>
 	<p><a href="describe.php">Посмотреть все таблицы в БД</a></p>	
 </body>
 </html>