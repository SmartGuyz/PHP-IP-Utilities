<?php
require '../src/cIPUtils.class.php';

// A link local address for this examples
$sIPv6 = '2a02:7f80::0';

/*
 * EXPAND IPv6
 */
$iIPv6Prefix = cIPUtils::getIPv6Prefix($sIPv6);
if(!$iIPv6Prefix)
{
	// Needs error handling
	exit;
}
echo "IPv6 Prefix: {$iIPv6Prefix}<br />";