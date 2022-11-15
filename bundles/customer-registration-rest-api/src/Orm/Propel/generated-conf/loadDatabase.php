<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'zed' => 
  array (
    0 => '\\Orm\\Zed\\Country\\Persistence\\Map\\SpyCountryTableMap',
    1 => '\\Orm\\Zed\\Country\\Persistence\\Map\\SpyRegionTableMap',
    2 => '\\Orm\\Zed\\Currency\\Persistence\\Map\\SpyCurrencyTableMap',
    3 => '\\Orm\\Zed\\Customer\\Persistence\\Map\\SpyCustomerAddressTableMap',
    4 => '\\Orm\\Zed\\Customer\\Persistence\\Map\\SpyCustomerTableMap',
    5 => '\\Orm\\Zed\\Glossary\\Persistence\\Map\\SpyGlossaryKeyTableMap',
    6 => '\\Orm\\Zed\\Glossary\\Persistence\\Map\\SpyGlossaryTranslationTableMap',
    7 => '\\Orm\\Zed\\Locale\\Persistence\\Map\\SpyLocaleTableMap',
    8 => '\\Orm\\Zed\\Queue\\Persistence\\Map\\SpyQueueProcessTableMap',
    9 => '\\Orm\\Zed\\Sales\\Persistence\\Map\\SpySalesOrderTableMap',
    10 => '\\Orm\\Zed\\SequenceNumber\\Persistence\\Map\\SpySequenceNumberTableMap',
    11 => '\\Orm\\Zed\\Store\\Persistence\\Map\\SpyStoreTableMap',
    12 => '\\Orm\\Zed\\Touch\\Persistence\\Map\\SpyTouchSearchTableMap',
    13 => '\\Orm\\Zed\\Touch\\Persistence\\Map\\SpyTouchStorageTableMap',
    14 => '\\Orm\\Zed\\Touch\\Persistence\\Map\\SpyTouchTableMap',
  ),
));
