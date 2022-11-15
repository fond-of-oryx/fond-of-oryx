<?php

namespace Orm\Zed\Country\Persistence\Map;

use Orm\Zed\Country\Persistence\SpyCountry;
use Orm\Zed\Country\Persistence\SpyCountryQuery;
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
 * This class defines the structure of the 'spy_country' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCountryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'Orm.Zed.Country.Persistence.Map.SpyCountryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_country';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Country\\Persistence\\SpyCountry';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Orm.Zed.Country.Persistence.SpyCountry';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the id_country field
     */
    public const COL_ID_COUNTRY = 'spy_country.id_country';

    /**
     * the column name for the iso2_code field
     */
    public const COL_ISO2_CODE = 'spy_country.iso2_code';

    /**
     * the column name for the iso3_code field
     */
    public const COL_ISO3_CODE = 'spy_country.iso3_code';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_country.name';

    /**
     * the column name for the postal_code_mandatory field
     */
    public const COL_POSTAL_CODE_MANDATORY = 'spy_country.postal_code_mandatory';

    /**
     * the column name for the postal_code_regex field
     */
    public const COL_POSTAL_CODE_REGEX = 'spy_country.postal_code_regex';

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
        self::TYPE_PHPNAME       => ['IdCountry', 'Iso2Code', 'Iso3Code', 'Name', 'PostalCodeMandatory', 'PostalCodeRegex', ],
        self::TYPE_CAMELNAME     => ['idCountry', 'iso2Code', 'iso3Code', 'name', 'postalCodeMandatory', 'postalCodeRegex', ],
        self::TYPE_COLNAME       => [SpyCountryTableMap::COL_ID_COUNTRY, SpyCountryTableMap::COL_ISO2_CODE, SpyCountryTableMap::COL_ISO3_CODE, SpyCountryTableMap::COL_NAME, SpyCountryTableMap::COL_POSTAL_CODE_MANDATORY, SpyCountryTableMap::COL_POSTAL_CODE_REGEX, ],
        self::TYPE_FIELDNAME     => ['id_country', 'iso2_code', 'iso3_code', 'name', 'postal_code_mandatory', 'postal_code_regex', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['IdCountry' => 0, 'Iso2Code' => 1, 'Iso3Code' => 2, 'Name' => 3, 'PostalCodeMandatory' => 4, 'PostalCodeRegex' => 5, ],
        self::TYPE_CAMELNAME     => ['idCountry' => 0, 'iso2Code' => 1, 'iso3Code' => 2, 'name' => 3, 'postalCodeMandatory' => 4, 'postalCodeRegex' => 5, ],
        self::TYPE_COLNAME       => [SpyCountryTableMap::COL_ID_COUNTRY => 0, SpyCountryTableMap::COL_ISO2_CODE => 1, SpyCountryTableMap::COL_ISO3_CODE => 2, SpyCountryTableMap::COL_NAME => 3, SpyCountryTableMap::COL_POSTAL_CODE_MANDATORY => 4, SpyCountryTableMap::COL_POSTAL_CODE_REGEX => 5, ],
        self::TYPE_FIELDNAME     => ['id_country' => 0, 'iso2_code' => 1, 'iso3_code' => 2, 'name' => 3, 'postal_code_mandatory' => 4, 'postal_code_regex' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCountry' => 'ID_COUNTRY',
        'SpyCountry.IdCountry' => 'ID_COUNTRY',
        'idCountry' => 'ID_COUNTRY',
        'spyCountry.idCountry' => 'ID_COUNTRY',
        'SpyCountryTableMap::COL_ID_COUNTRY' => 'ID_COUNTRY',
        'COL_ID_COUNTRY' => 'ID_COUNTRY',
        'id_country' => 'ID_COUNTRY',
        'spy_country.id_country' => 'ID_COUNTRY',
        'Iso2Code' => 'ISO2_CODE',
        'SpyCountry.Iso2Code' => 'ISO2_CODE',
        'iso2Code' => 'ISO2_CODE',
        'spyCountry.iso2Code' => 'ISO2_CODE',
        'SpyCountryTableMap::COL_ISO2_CODE' => 'ISO2_CODE',
        'COL_ISO2_CODE' => 'ISO2_CODE',
        'iso2_code' => 'ISO2_CODE',
        'spy_country.iso2_code' => 'ISO2_CODE',
        'Iso3Code' => 'ISO3_CODE',
        'SpyCountry.Iso3Code' => 'ISO3_CODE',
        'iso3Code' => 'ISO3_CODE',
        'spyCountry.iso3Code' => 'ISO3_CODE',
        'SpyCountryTableMap::COL_ISO3_CODE' => 'ISO3_CODE',
        'COL_ISO3_CODE' => 'ISO3_CODE',
        'iso3_code' => 'ISO3_CODE',
        'spy_country.iso3_code' => 'ISO3_CODE',
        'Name' => 'NAME',
        'SpyCountry.Name' => 'NAME',
        'name' => 'NAME',
        'spyCountry.name' => 'NAME',
        'SpyCountryTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_country.name' => 'NAME',
        'PostalCodeMandatory' => 'POSTAL_CODE_MANDATORY',
        'SpyCountry.PostalCodeMandatory' => 'POSTAL_CODE_MANDATORY',
        'postalCodeMandatory' => 'POSTAL_CODE_MANDATORY',
        'spyCountry.postalCodeMandatory' => 'POSTAL_CODE_MANDATORY',
        'SpyCountryTableMap::COL_POSTAL_CODE_MANDATORY' => 'POSTAL_CODE_MANDATORY',
        'COL_POSTAL_CODE_MANDATORY' => 'POSTAL_CODE_MANDATORY',
        'postal_code_mandatory' => 'POSTAL_CODE_MANDATORY',
        'spy_country.postal_code_mandatory' => 'POSTAL_CODE_MANDATORY',
        'PostalCodeRegex' => 'POSTAL_CODE_REGEX',
        'SpyCountry.PostalCodeRegex' => 'POSTAL_CODE_REGEX',
        'postalCodeRegex' => 'POSTAL_CODE_REGEX',
        'spyCountry.postalCodeRegex' => 'POSTAL_CODE_REGEX',
        'SpyCountryTableMap::COL_POSTAL_CODE_REGEX' => 'POSTAL_CODE_REGEX',
        'COL_POSTAL_CODE_REGEX' => 'POSTAL_CODE_REGEX',
        'postal_code_regex' => 'POSTAL_CODE_REGEX',
        'spy_country.postal_code_regex' => 'POSTAL_CODE_REGEX',
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
        $this->setName('spy_country');
        $this->setPhpName('SpyCountry');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Country\\Persistence\\SpyCountry');
        $this->setPackage('Orm.Zed.Country.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_country_pk_seq');
        // columns
        $this->addPrimaryKey('id_country', 'IdCountry', 'INTEGER', true, null, null);
        $this->addColumn('iso2_code', 'Iso2Code', 'VARCHAR', true, 2, null);
        $this->addColumn('iso3_code', 'Iso3Code', 'VARCHAR', false, 3, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('postal_code_mandatory', 'PostalCodeMandatory', 'BOOLEAN', false, null, false);
        $this->addColumn('postal_code_regex', 'PostalCodeRegex', 'VARCHAR', false, 500, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyRegion', '\\Orm\\Zed\\Country\\Persistence\\SpyRegion', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_country',
    1 => ':id_country',
  ),
), null, null, 'SpyRegions', false);
        $this->addRelation('CustomerAddress', '\\Orm\\Zed\\Customer\\Persistence\\SpyCustomerAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_country',
    1 => ':id_country',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCountry', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCountry', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCountry', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCountry', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCountry', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCountry', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCountry', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCountryTableMap::CLASS_DEFAULT : SpyCountryTableMap::OM_CLASS;
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
     * @return array (SpyCountry object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCountryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCountryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCountryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCountryTableMap::OM_CLASS;
            /** @var SpyCountry $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCountryTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCountryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCountryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCountry $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCountryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCountryTableMap::COL_ID_COUNTRY);
            $criteria->addSelectColumn(SpyCountryTableMap::COL_ISO2_CODE);
            $criteria->addSelectColumn(SpyCountryTableMap::COL_ISO3_CODE);
            $criteria->addSelectColumn(SpyCountryTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyCountryTableMap::COL_POSTAL_CODE_MANDATORY);
            $criteria->addSelectColumn(SpyCountryTableMap::COL_POSTAL_CODE_REGEX);
        } else {
            $criteria->addSelectColumn($alias . '.id_country');
            $criteria->addSelectColumn($alias . '.iso2_code');
            $criteria->addSelectColumn($alias . '.iso3_code');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.postal_code_mandatory');
            $criteria->addSelectColumn($alias . '.postal_code_regex');
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
            $criteria->removeSelectColumn(SpyCountryTableMap::COL_ID_COUNTRY);
            $criteria->removeSelectColumn(SpyCountryTableMap::COL_ISO2_CODE);
            $criteria->removeSelectColumn(SpyCountryTableMap::COL_ISO3_CODE);
            $criteria->removeSelectColumn(SpyCountryTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyCountryTableMap::COL_POSTAL_CODE_MANDATORY);
            $criteria->removeSelectColumn(SpyCountryTableMap::COL_POSTAL_CODE_REGEX);
        } else {
            $criteria->removeSelectColumn($alias . '.id_country');
            $criteria->removeSelectColumn($alias . '.iso2_code');
            $criteria->removeSelectColumn($alias . '.iso3_code');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.postal_code_mandatory');
            $criteria->removeSelectColumn($alias . '.postal_code_regex');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCountryTableMap::DATABASE_NAME)->getTable(SpyCountryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCountry or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCountry object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCountryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Country\Persistence\SpyCountry) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCountryTableMap::DATABASE_NAME);
            $criteria->add(SpyCountryTableMap::COL_ID_COUNTRY, (array) $values, Criteria::IN);
        }

        $query = SpyCountryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCountryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCountryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_country table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCountryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCountry or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCountry object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCountryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCountry object
        }

        if ($criteria->containsKey(SpyCountryTableMap::COL_ID_COUNTRY) && $criteria->keyContainsValue(SpyCountryTableMap::COL_ID_COUNTRY) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCountryTableMap::COL_ID_COUNTRY.')');
        }


        // Set the correct dbName
        $query = SpyCountryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
