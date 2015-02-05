<?php
$params = [
];
$params = array_merge(
		$params,
		require(__DIR__ . '/../../data/cache/cachedData.php')
);

return $params;