#!/usr/bin/php
<?php

exec('echo "lllagboxx" > /home/test/pl/aa.txt');

		$email = "testemail";
		$name = "myname";

$data = ['email' => $email,
         'name' => $name
        ];

print_r($data);
var_dump($data);

$tt=(object) $data;

echo "bbbb\n\n\n";

print_r($tt);
var_dump($tt);

echo "mail-to 1email ".$email."\n";
echo "mail-to 1name ".$name."\n\n\n";

echo "mail-to 2email ".$data['email']."\n\n";

echo "ccc\n\n\n";

echo "mail-to 3email ".$tt->email."\n";
//echo "mail-to 4email ".$tt.email."\n";


?>

