# PHP-IP-Utilities

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)

A simple PHP helper class, full of usable IPv4 and IPv6 utilities.

USAGE
============

Incude the class file src/cIPUtils.class.php
Then instance the class and play around with all the methods:

    cIPUtils::IPv6_to_Int64(string $sIPv6): false|array

    getExpandedIPv6(string $sIPv6): false|string

    IPv6_to_Int128(string $sIPv6): false|string

    IPv6_to_Int64(string $sIPv6): false|array

    Int64_to_IPv6(array $aIP): false|string

That is all. Goodluck with it :)