<?php
function get_google_plusone_count($url) {
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_HTTPHEADER => array('Content-type: application/json'),
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_URL => 'https://clients6.google.com/rpc?key=AIzaSyCKSbrvQasunBoV16zDH9R33D88CeLr9gQ'
	));
	$result = curl_exec($curl);
	curl_close($curl);

	if ($result) {
		$json = json_decode($result, true);
		return $json[0]['result']['metadata']['globalCounts']['count'];
	}
	return false;
}

if (empty($_GET['callback']) || empty($_GET['url'])) {
	print 'սխալ';
	exit();
}

print $_GET['callback'] . '("' . get_google_plusone_count($_GET['url']) . '")';
?>
