<?php
$db = parse_url(getenv("postgres://gkojdedreexiqp:a1b846369321913c7fe8253512e3ca3cc42862e369f7c2a397d2617364f4d2c0@ec2-54-247-123-231.eu-west-1.compute.amazonaws.com:5432/dk4dbb2au34o8"));
$db = $db["path"] = ltrim($db["path"], "/");

echo "data...";
print_r($db);
?>

<h1>HELLO WORLD</h1>
