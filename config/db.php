<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'kiki');
define('DB_PASS', '123456');
define('DB_NAME', 'review_app');
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
    die("连接失败". $db->connect_error); // 修改了变量名
}
echo "链接成功";
