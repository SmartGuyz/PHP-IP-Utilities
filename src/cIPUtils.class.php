<?php
class cIPUtils
{
	public static function getExpandedIPv6(string $sIPv6): false|string
	{
		if(!filter_var($sIPv6, FILTER_VALIDATE_IP,FILTER_FLAG_IPV6))
		{
			return false;
		}

		if(str_contains($sIPv6, "::"))                	// Compressed ;-)
		{
			$aParts 	= explode("::", $sIPv6);
			$aParts[0] 	= explode(":", $aParts[0]); 	// Everything before ::
			$aParts[1] 	= explode(":", $aParts[1]); 	// Everything after ::

			$aMissing 	= [];
			for($i = 0; $i < (8 - (count($aParts[0]) + count($aParts[1]))); $i++)
			{
				$aMissing[] = '0000';
			}
			$aMissing 	= array_merge($aParts[0], $aMissing);
			$aParts 	= array_merge($aMissing, $aParts[1]);
		}
		else 													// Not compressed
		{
			$aParts = explode(":", $sIPv6);
		}

		// Every part must have 4 characters, so we need to add some zero's
		foreach($aParts as &$sValue)
		{
			while(strlen($sValue) < 4)
			{
				$sValue = "0".$sValue;
			}
		}

		// : Need to be added back
		$sResult = implode(":", $aParts);

		// Last check
		if(strlen($sResult) !== 39)
		{
			return false;

		}
		return $sResult;
	}

	final public static function IPv6_to_Int128($sIPv6): false|string
	{
		if(!filter_var($sIPv6, FILTER_VALIDATE_IP,FILTER_FLAG_IPV6))
		{
			return false;
		}

		$sNum = '';
		foreach(unpack('C*', inet_pton($sIPv6)) AS $sByte)
		{
			$sNum .= str_pad(decbin($sByte), 8, "0", STR_PAD_LEFT);
		}
		return gmp_strval(gmp_init(ltrim($sNum, '0'), 2));
	}

	final public static function IPv6_to_Int64($sIPv6): false|array
	{
		if(!filter_var($sIPv6, FILTER_VALIDATE_IP,FILTER_FLAG_IPV6))
		{
			return false;
		}

		$sIPv6    = self::getExpandedIPv6($sIPv6);
		$sIPv6    = str_replace(":", "", $sIPv6);
		$aPart[0] = gmp_init('0x' . substr($sIPv6, 0, 16));
		$aPart[1] = gmp_init('0x' . substr($sIPv6, 16));

		return [gmp_strval($aPart[0]), gmp_strval($aPart[1])];
	}

	final public static function Int64_to_IPv6(array $aIP): false|string
	{
		if(count($aIP) != 2)
		{
			return false;
		}

		$sPart1 = gmp_strval(gmp_init((string)$aIP[0]), 16);
		$sPart2 = gmp_strval(gmp_init((string)$aIP[1]), 16);

		while(strlen($sPart1) < 16)
		{
			$sPart1 = "0{$sPart1}";
		}

		while(strlen($sPart2) < 16)
		{
			$sPart2 = "0{$sPart2}";
		}

		$sAddress = $sPart1 . $sPart2;
		$sResult  = "";
		for($i = 0; $i < 8; $i++)
		{
			$sResult .= substr($sAddress, ($i * 4), 4);
			if($i != 7)
			{
				$sResult .= ":";
			}
		}
		return inet_ntop(inet_pton(($sResult)));
	}
}