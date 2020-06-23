<?php

namespace Composer;

use Composer\Semver\VersionParser;






class InstalledVersions
{
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => 'dev-master',
    'version' => 'dev-master',
    'aliases' => 
    array (
      0 => '9999999-dev',
    ),
    'reference' => 'fccfa0a27a1dd0b34d04c9916bca7175a195adfb',
    'name' => '__root__',
  ),
  'versions' => 
  array (
    '__root__' => 
    array (
      'pretty_version' => 'dev-master',
      'version' => 'dev-master',
      'aliases' => 
      array (
        0 => '9999999-dev',
      ),
      'reference' => 'fccfa0a27a1dd0b34d04c9916bca7175a195adfb',
    ),
    'guzzlehttp/guzzle' => 
    array (
      'pretty_version' => '6.5.4',
      'version' => '6.5.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a4a1b6930528a8f7ee03518e6442ec7a44155d9d',
    ),
    'guzzlehttp/promises' => 
    array (
      'pretty_version' => 'v1.3.1',
      'version' => '1.3.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a59da6cf61d80060647ff4d3eb2c03a2bc694646',
    ),
    'guzzlehttp/psr7' => 
    array (
      'pretty_version' => '1.6.1',
      'version' => '1.6.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '239400de7a173fe9901b9ac7c06497751f00727a',
    ),
    'microsoft/azure-storage-blob' => 
    array (
      'pretty_version' => '1.5.0',
      'version' => '1.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6a333cd28a3742c3e99e79042dc6510f9f917919',
    ),
    'microsoft/azure-storage-common' => 
    array (
      'pretty_version' => '1.4.1',
      'version' => '1.4.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'be4df800761d0d0fa91a9460c7f42517197d57a0',
    ),
    'microsoft/azure-storage-file' => 
    array (
      'pretty_version' => '1.2.2',
      'version' => '1.2.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '8c6b1c0797fe7cd2274e111213b4cfaf0053050f',
    ),
    'microsoft/azure-storage-queue' => 
    array (
      'pretty_version' => '1.3.1',
      'version' => '1.3.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c85f9c6ce9f7cefd21bb8755f455f2cecd6aed1e',
    ),
    'microsoft/azure-storage-table' => 
    array (
      'pretty_version' => '1.1.2',
      'version' => '1.1.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b5f3bf09df6a4d71cf6bc32765f1a019556b78c6',
    ),
    'psr/http-message' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f6561bf28d520154e4b0ec72be95418abe6d9363',
    ),
    'psr/http-message-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'ralouphie/getallheaders' => 
    array (
      'pretty_version' => '3.0.3',
      'version' => '3.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '120b605dfeb996808c31b6477290a714d356e822',
    ),
    'symfony/polyfill-intl-idn' => 
    array (
      'pretty_version' => 'v1.17.0',
      'version' => '1.17.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '3bff59ea7047e925be6b7f2059d60af31bb46d6a',
    ),
    'symfony/polyfill-mbstring' => 
    array (
      'pretty_version' => 'v1.17.0',
      'version' => '1.17.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'fa79b11539418b02fc5e1897267673ba2c19419c',
    ),
    'symfony/polyfill-php72' => 
    array (
      'pretty_version' => 'v1.17.0',
      'version' => '1.17.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f048e612a3905f34931127360bdd2def19a5e582',
    ),
  ),
);







public static function getInstalledPackages()
{
return array_keys(self::$installed['versions']);
}









public static function isInstalled($packageName)
{
return isset(self::$installed['versions'][$packageName]);
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

$ranges = array();
if (isset(self::$installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = self::$installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}





public static function getVersion($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['version'])) {
return null;
}

return self::$installed['versions'][$packageName]['version'];
}





public static function getPrettyVersion($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return self::$installed['versions'][$packageName]['pretty_version'];
}





public static function getReference($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['reference'])) {
return null;
}

return self::$installed['versions'][$packageName]['reference'];
}





public static function getRootPackage()
{
return self::$installed['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
}
}
