<?php
if (YII_ENV == 'dev') {
	return [
	    'adminEmail' => 'pheagey@gmail.com',
	];
} elseif (YII_ENV == 'sit') {
	return [
	    'adminEmail' => 'pheagey@gmail.com',
	];
} else {
	return [
	    'adminEmail' => 'support@windnetworks.net',
	];
}
