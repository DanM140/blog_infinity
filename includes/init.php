<?php
require_once './vendor/autoload.php';
$cache_config=new \Phpfastcache\Drivers\Files\Config([
'path'=>realpath(__DIR__).'/cache',
'preventCacheSlams'=>true,
'cacheSlamsTimeout'=>20,
'secureFileManipulation'=>true
]);
\Phpfastcache\CacheManager::setDefaultConfig($cache_config);
$cache=\Phpfastcache\CacheManager::getInstance('Files');
?>