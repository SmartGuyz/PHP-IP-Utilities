<?php
require '../src/cIPUtils.class.php';

// Check for BCMath
if(!extension_loaded('bcmath'))
{
	die('BCMath not loaded!');
}

// A link local address for this examples
$sIPv6 = 'fe80::203:47ff:feb4:c30';

/*
 * IPv6 to Int64 array (requires BCMath)
 * Easy for IP database storage on a 64 bit system (BIGINT = 64 bit)
 *
 * This method is only available if PHP was configured with --enable-bcmath.
 */
$aInt64 = cIPUtils::IPv6_to_Int64($sIPv6);
if(!$aInt64)
{
	// Needs error handling
	exit;
}
echo "Int64 IPv6 array: ['{$aInt64[0]}', '{$aInt64[1]}']<br />";