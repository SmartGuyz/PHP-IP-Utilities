<?php
require '../src/cIPUtils.class.php';

// A link local address for this examples
$sIPv6 = 'fe80::203:47ff:feb4:c30';

/*
 * EXPAND IPv6
 */
$sExpandedIPv6 = cIPUtils::getExpandedIPv6($sIPv6);
if(!$sExpandedIPv6)
{
	// Needs error handling
	exit;
}
echo "Expanded IPv6: {$sExpandedIPv6}<br />";