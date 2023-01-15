<?php
require '../src/cIPUtils.class.php';

// Check for GMP
if(!extension_loaded('gmp'))
{
	die('GMP not loaded!');
}

// A link local address (fe80::203:47ff:feb4:c30) for this examples (int64 array)
$aInt64 = ['18338657682652659712', '145038777821432880'];

/*
 * Int64 to IPv6 (requires GMP)
 * Convert Int64 array back to IPv6 address
 *
 *  This method is only available if PHP was configured with --with-gmp.
 */
$sIPv6 = cIPUtils::Int64_to_IPv6($aInt64);
if(!$sIPv6)
{
	// Needs error handling
	exit;
}
echo "IPv6 converted back from int64 array: {$sIPv6}<br />";