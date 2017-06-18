<?php

include '../src/Phois/Whois/Whois.php';

//$sld = 'unblocksite.org';
$sld = 'mortgagecalculator.com';
//$sld = 'bannedadsense.com';
$domain = new Phois\Whois\Whois($sld);

$whois_answer = $domain->info();

echo $whois_answer;

if ($domain->isAvailable()) {
    echo "Domain is available\n";
} else {
    echo "Domain is registered\n";
}
