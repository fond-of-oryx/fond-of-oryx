<?php

namespace Orm\Zed\Country\Persistence\Map;

use Orm\Zed\Country\Persistence\SpyRegion;
use Orm\Zed\Country\Persistence\SpyRegionQuery;
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
 * This class defines the structure of the 'spy_region' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyRegionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'Orm.Zed.Country.Persistence.Map.SpyRegionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_region';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Country\\Persistence\\SpyRegion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Orm.Zed.Country.Persistence.SpyRegion';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the id_region field
     */
    public const COL_ID_REGION = 'spy_region.id_region';

    /**
     * the column name for the fk_country field
     */
    public const COL_FK_COUNTRY = 'spy_region.fk_country';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_region.name';

    /**
     * the column name for the iso2_code field
     */
    public const COL_ISO2_CODE = 'spy_region.iso2_code';

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
        self::TYPE_PHPNAME       => ['IdRegion', 'FkCountry', 'Name', 'Iso2Code', ],
        self::TYPE_CAMELNAME     => ['idRegion', 'fkCountry', 'name', 'iso2Code', ],
        self::TYPE_COLNAME       => [SpyRegionTableMap::COL_ID_REGION, SpyRegionTableMap::COL_FK_COUNTRY, SpyRegionTableMap::COL_NAME, SpyRegionTableMap::COL_ISO2_CODE, ],
        self::TYPE_FIELDNAME     => ['id_region', 'fk_country', 'name', 'iso2_code', ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
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
        self::TYPE_PHPNAME       => ['IdRegion' => 0, 'FkCountry' => 1, 'Name' => 2, 'Iso2Code' => 3, ],
        self::TYPE_CAMELNAME     => ['idRegion' => 0, 'fkCountry' => 1, 'name' => 2, 'iso2Code' => 3, ],
        self::TYPE_COLNAME       => [SpyRegionTableMap::COL_ID_REGION => 0, SpyRegionTableMap::COL_FK_COUNTRY => 1, SpyRegionTableMap::COL_NAME => 2, SpyRegionTableMap::COL_ISO2_CODE => 3, ],
        self::TYPE_FIELDNAME     => ['id_region' => 0, 'fk_country' => 1, 'name' => 2, 'iso2_code' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdRegion' => 'ID_REGION',
        'SpyRegion.IdRegion' => 'ID_REGION',
        'idRegion' => 'ID_REGION',
        'spyRegion.idRegion' => 'ID_REGION',
        'SpyRegionTableMap::COL_ID_REGION' => 'ID_REGION',
        'COL_ID_REGION' => 'ID_REGION',
        'id_region' => 'ID_REGION',
        'spy_region.id_region' => 'ID_REGION',
        'FkCountry' => 'FK_COUNTRY',
        'SpyRegion.FkCountry' => 'FK_COUNTRY',
        'fkCountry' => 'FK_COUNTRY',
        'spyRegion.fkCountry' => 'FK_COUNTRY',
        'SpyRegionTableMap::COL_FK_COUNTRY' => 'FK_COUNTRY',
        'COL_FK_COUNTRY' => 'FK_COUNTRY',
        'fk_country' => 'FK_COUNTRY',
        'spy_region.fk_country' => 'FK_COUNTRY',
        'Name' => 'NAME',
        'SpyRegion.Name' => 'NAME',
        'name' => 'NAME',
        'spyRegion.name' => 'NAME',
        'SpyRegionTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_region.name' => 'NAME',
        'Iso2Code' => 'ISO2_CODE',
        'SpyRegion.Iso2Code' => 'ISO2_CODE',
        'iso2Code' => 'ISO2_CODE',
        'spyRegion.iso2Code' => 'ISO2_CODE',
        'SpyRegionTableMap::COL_ISO2_CODE' => 'ISO2_CODE',
        'COL_ISO2_CODE' => 'ISO2_CODE',
        'iso2_code' => 'ISO2_CODE',
        'spy_region.iso2_code' => 'ISO2_CODE',
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
        $this->setName('spy_region');
        $this->setPhpName('SpyRegion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Country\\Persistence\\SpyRegion');
        $this->setPackage('Orm.Zed.Country.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_region_pk_seq');
        // columns
        $this->addPrimaryKey('id_region', 'IdRegion', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_country', 'FkCountry', 'INTEGER', 'spy_country', 'id_country', false, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 100, null);
        $this->addColumn('iso2_code', 'Iso2Code', 'VARCHAR', true, 6, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyCountry', '\\Orm\\Zed\\Country\\Persistence\\SpyCountry', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_country',
    1 => ':id_country',
  ),
), null, null, null, false);
        $this->addRelation('CustomerAddress', '\\Orm\\Zed\\Customer\\Persistence\\SpyCustomerAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_region',
    1 => ':id_region',
  ),
), null, null, 'CustomerAddresses', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdRegion', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdRegion', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdRegion', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdRegion', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdRegion', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdRegion', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdRegion', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyRegionTableMap::CLASS_DEFAULT : SpyRegionTableMap::OM_CLASS;
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
     * @return array (SpyRegion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyRegionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyRegionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyRegionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyRegionTableMap::OM_CLASS;
            /** @var SpyRegion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyRegionTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyRegionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyRegionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyRegion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyRegionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyRegionTableMap::COL_ID_REGION);
            $criteria->addSelectColumn(SpyRegionTableMap::COL_FK_COUNTRY);
            $criteria->addSelectColumn(SpyRegionTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyRegionTableMap::COL_ISO2_CODE);
        } else {
            $criteria->addSelectColumn($alias . '.id_region');
            $criteria->addSelectColumn($alias . '.fk_country');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.iso2_code');
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
            $criteria->removeSelectColumn(SpyRegionTableMap::COL_ID_REGION);
            $criteria->removeSelectColumn(SpyRegionTableMap::COL_FK_COUNTRY);
            $criteria->removeSelectColumn(SpyRegionTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyRegionTableMap::COL_ISO2_CODE);
        } else {
            $criteria->removeSelectColumn($alias . '.id_region');
            $criteria->removeSelectColumn($alias . '.fk_country');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.iso2_code');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyRegionTableMap::DATABASE_NAME)->getTable(SpyRegionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyRegion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyRegion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyRegionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Country\Persistence\SpyRegion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyRegionTableMap::DATABASE_NAME);
            $criteria->add(SpyRegionTableMap::COL_ID_REGION, (array) $values, Criteria::IN);
        }

        $query = SpyRegionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyRegionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyRegionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_region table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyRegionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyRegion or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyRegion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyRegionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyRegion object
        }

        if ($criteria->containsKey(SpyRegionTableMap::COL_ID_REGION) && $criteria->keyContainsValue(SpyRegionTableMap::COL_ID_REGION) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyRegionTableMap::COL_ID_REGION.')');
        }


        // Set the correct dbName
        $query = SpyRegionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
