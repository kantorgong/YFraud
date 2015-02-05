<?php
$params = [
    'sshell' => [
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => 'wt123asd'
    ],
	'adminEmail' => 'lanhuwei@qq.com',
    'supportEmail' => 'lanhuwei@qq.com',
    'user.passwordResetTokenExpire' => 3600,
];

$params = array_merge(
		$params,
		require(__DIR__ . '/../data/cache/cachedData.php')
);
return $params;