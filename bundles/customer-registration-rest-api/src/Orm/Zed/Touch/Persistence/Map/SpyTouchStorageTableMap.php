<?php

namespace Orm\Zed\Touch\Persistence\Map;

use Orm\Zed\Touch\Persistence\SpyTouchStorage;
use Orm\Zed\Touch\Persistence\SpyTouchStorageQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'spy_touch_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyTouchStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'Orm.Zed.Touch.Persistence.Map.SpyTouchStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_touch_storage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Touch\\Persistence\\SpyTouchStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Orm.Zed.Touch.Persistence.SpyTouchStorage';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id_touch_storage field
     */
    public const COL_ID_TOUCH_STORAGE = 'spy_touch_storage.id_touch_storage';

    /**
     * the column name for the fk_locale field
     */
    public const COL_FK_LOCALE = 'spy_touch_storage.fk_locale';

    /**
     * the column name for the fk_store field
     */
    public const COL_FK_STORE = 'spy_touch_storage.fk_store';

    /**
     * the column name for the fk_touch field
     */
    public const COL_FK_TOUCH = 'spy_touch_storage.fk_touch';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_touch_storage.key';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdTouchStorage', 'FkLocale', 'FkStore', 'FkTouch', 'Key', ],
        self::TYPE_CAMELNAME     => ['idTouchStorage', 'fkLocale', 'fkStore', 'fkTouch', 'key', ],
        self::TYPE_COLNAME       => [SpyTouchStorageTableMap::COL_ID_TOUCH_STORAGE, SpyTouchStorageTableMap::COL_FK_LOCALE, SpyTouchStorageTableMap::COL_FK_STORE, SpyTouchStorageTableMap::COL_FK_TOUCH, SpyTouchStorageTableMap::COL_KEY, ],
        self::TYPE_FIELDNAME     => ['id_touch_storage', 'fk_locale', 'fk_store', 'fk_touch', 'key', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['IdTouchStorage' => 0, 'FkLocale' => 1, 'FkStore' => 2, 'FkTouch' => 3, 'Key' => 4, ],
        self::TYPE_CAMELNAME     => ['idTouchStorage' => 0, 'fkLocale' => 1, 'fkStore' => 2, 'fkTouch' => 3, 'key' => 4, ],
        self::TYPE_COLNAME       => [SpyTouchStorageTableMap::COL_ID_TOUCH_STORAGE => 0, SpyTouchStorageTableMap::COL_FK_LOCALE => 1, SpyTouchStorageTableMap::COL_FK_STORE => 2, SpyTouchStorageTableMap::COL_FK_TOUCH => 3, SpyTouchStorageTableMap::COL_KEY => 4, ],
        self::TYPE_FIELDNAME     => ['id_touch_storage' => 0, 'fk_locale' => 1, 'fk_store' => 2, 'fk_touch' => 3, 'key' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdTouchStorage' => 'ID_TOUCH_STORAGE',
        'SpyTouchStorage.IdTouchStorage' => 'ID_TOUCH_STORAGE',
        'idTouchStorage' => 'ID_TOUCH_STORAGE',
        'spyTouchStorage.idTouchStorage' => 'ID_TOUCH_STORAGE',
        'SpyTouchStorageTableMap::COL_ID_TOUCH_STORAGE' => 'ID_TOUCH_STORAGE',
        'COL_ID_TOUCH_STORAGE' => 'ID_TOUCH_STORAGE',
        'id_touch_storage' => 'ID_TOUCH_STORAGE',
        'spy_touch_storage.id_touch_storage' => 'ID_TOUCH_STORAGE',
        'FkLocale' => 'FK_LOCALE',
        'SpyTouchStorage.FkLocale' => 'FK_LOCALE',
        'fkLocale' => 'FK_LOCALE',
        'spyTouchStorage.fkLocale' => 'FK_LOCALE',
        'SpyTouchStorageTableMap::COL_FK_LOCALE' => 'FK_LOCALE',
        'COL_FK_LOCALE' => 'FK_LOCALE',
        'fk_locale' => 'FK_LOCALE',
        'spy_touch_storage.fk_locale' => 'FK_LOCALE',
        'FkStore' => 'FK_STORE',
        'SpyTouchStorage.FkStore' => 'FK_STORE',
        'fkStore' => 'FK_STORE',
        'spyTouchStorage.fkStore' => 'FK_STORE',
        'SpyTouchStorageTableMap::COL_FK_STORE' => 'FK_STORE',
        'COL_FK_STORE' => 'FK_STORE',
        'fk_store' => 'FK_STORE',
        'spy_touch_storage.fk_store' => 'FK_STORE',
        'FkTouch' => 'FK_TOUCH',
        'SpyTouchStorage.FkTouch' => 'FK_TOUCH',
        'fkTouch' => 'FK_TOUCH',
        'spyTouchStorage.fkTouch' => 'FK_TOUCH',
        'SpyTouchStorageTableMap::COL_FK_TOUCH' => 'FK_TOUCH',
        'COL_FK_TOUCH' => 'FK_TOUCH',
        'fk_touch' => 'FK_TOUCH',
        'spy_touch_storage.fk_touch' => 'FK_TOUCH',
        'Key' => 'KEY',
        'SpyTouchStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyTouchStorage.key' => 'KEY',
        'SpyTouchStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_touch_storage.key' => 'KEY',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('spy_touch_storage');
        $this->setPhpName('SpyTouchStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Touch\\Persistence\\SpyTouchStorage');
        $this->setPackage('Orm.Zed.Touch.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_touch_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_touch_storage', 'IdTouchStorage', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_locale', 'FkLocale', 'INTEGER', 'spy_locale', 'id_locale', true, null, null);
        $this->addForeignKey('fk_store', 'FkStore', 'INTEGER', 'spy_store', 'id_store', false, null, null);
        $this->addForeignKey('fk_touch', 'FkTouch', 'INTEGER', 'spy_touch', 'id_touch', true, null, null);
        $this->addColumn('key', 'Key', 'VARCHAR', true, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Touch', '\\Orm\\Zed\\Touch\\Persistence\\SpyTouch', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_touch',
    1 => ':id_touch',
  ),
), null, null, null, false);
        $this->addRelation('Store', '\\Orm\\Zed\\Store\\Persistence\\SpyStore', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_store',
    1 => ':id_store',
  ),
), null, null, null, false);
        $this->addRelation('Locale', '\\Orm\\Zed\\Locale\\Persistence\\SpyLocale', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_locale',
    1 => ':id_locale',
  ),
), null, null, null, false);
    }

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array<string, array> Associative array (name => parameters) of behaviors
     */
    public function getBehaviors(): array
    {
        return [
            'query_cache' => ['backend' => 'custom', 'lifetime' => '3600'],
        ];
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTouchStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTouchStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTouchStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTouchStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTouchStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTouchStorage', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdTouchStorage', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? SpyTouchStorageTableMap::CLASS_DEFAULT : SpyTouchStorageTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (SpyTouchStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyTouchStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyTouchStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyTouchStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyTouchStorageTableMap::OM_CLASS;
            /** @var SpyTouchStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyTouchStorageTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = SpyTouchStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyTouchStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyTouchStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyTouchStorageTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(SpyTouchStorageTableMap::COL_ID_TOUCH_STORAGE);
            $criteria->addSelectColumn(SpyTouchStorageTableMap::COL_FK_LOCALE);
            $criteria->addSelectColumn(SpyTouchStorageTableMap::COL_FK_STORE);
            $criteria->addSelectColumn(SpyTouchStorageTableMap::COL_FK_TOUCH);
            $criteria->addSelectColumn(SpyTouchStorageTableMap::COL_KEY);
        } else {
            $criteria->addSelectColumn($alias . '.id_touch_storage');
            $criteria->addSelectColumn($alias . '.fk_locale');
            $criteria->addSelectColumn($alias . '.fk_store');
            $criteria->addSelectColumn($alias . '.fk_touch');
            $criteria->addSelectColumn($alias . '.key');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(SpyTouchStorageTableMap::COL_ID_TOUCH_STORAGE);
            $criteria->removeSelectColumn(SpyTouchStorageTableMap::COL_FK_LOCALE);
            $criteria->removeSelectColumn(SpyTouchStorageTableMap::COL_FK_STORE);
            $criteria->removeSelectColumn(SpyTouchStorageTableMap::COL_FK_TOUCH);
            $criteria->removeSelectColumn(SpyTouchStorageTableMap::COL_KEY);
        } else {
            $criteria->removeSelectColumn($alias . '.id_touch_storage');
            $criteria->removeSelectColumn($alias . '.fk_locale');
            $criteria->removeSelectColumn($alias . '.fk_store');
            $criteria->removeSelectColumn($alias . '.fk_touch');
            $criteria->removeSelectColumn($alias . '.key');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(SpyTouchStorageTableMap::DATABASE_NAME)->getTable(SpyTouchStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyTouchStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyTouchStorage object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyTouchStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Touch\Persistence\SpyTouchStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyTouchStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyTouchStorageTableMap::COL_ID_TOUCH_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyTouchStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyTouchStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyTouchStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_touch_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyTouchStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyTouchStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyTouchStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyTouchStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyTouchStorage object
        }

        if ($criteria->containsKey(SpyTouchStorageTableMap::COL_ID_TOUCH_STORAGE) && $criteria->keyContainsValue(SpyTouchStorageTableMap::COL_ID_TOUCH_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyTouchStorageTableMap::COL_ID_TOUCH_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyTouchStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
