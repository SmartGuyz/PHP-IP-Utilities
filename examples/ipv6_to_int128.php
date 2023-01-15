<?php
require '../src/cIPUtils.class.php';

// Check for BCMath
if(!extension_loaded('gmp'))
{
	die('BCMath not loaded!');
}

// A link local address for this examples
$sIPv6 = 'fe80::203:47ff:feb4:c30';

/*
 * IPv6 to Int128 (requires BCMath)
 * This can be helpfull when saving IPv6 or when adding a number of IP addresses
 *
 * This method is only available if PHP was configured with --enable-bcmath.
 */
$sInt128 = cIPUtils::IPv6_to_Int128($sIPv6);
if(!$sInt128)
{
	// Needs error handling
	exit;
}
echo "Int128 IPv6: {$sInt128}<br />";