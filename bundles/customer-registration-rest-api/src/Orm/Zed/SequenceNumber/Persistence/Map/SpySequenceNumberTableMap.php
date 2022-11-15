<?php

namespace Orm\Zed\SequenceNumber\Persistence\Map;

use Orm\Zed\SequenceNumber\Persistence\SpySequenceNumber;
use Orm\Zed\SequenceNumber\Persistence\SpySequenceNumberQuery;
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
 * This class defines the structure of the 'spy_sequence_number' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySequenceNumberTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'Orm.Zed.SequenceNumber.Persistence.Map.SpySequenceNumberTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sequence_number';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SequenceNumber\\Persistence\\SpySequenceNumber';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Orm.Zed.SequenceNumber.Persistence.SpySequenceNumber';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the id_sequence_number field
     */
    public const COL_ID_SEQUENCE_NUMBER = 'spy_sequence_number.id_sequence_number';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_sequence_number.name';

    /**
     * the column name for the current_id field
     */
    public const COL_CURRENT_ID = 'spy_sequence_number.current_id';

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
        self::TYPE_PHPNAME       => ['IdSequenceNumber', 'Name', 'CurrentId', ],
        self::TYPE_CAMELNAME     => ['idSequenceNumber', 'name', 'currentId', ],
        self::TYPE_COLNAME       => [SpySequenceNumberTableMap::COL_ID_SEQUENCE_NUMBER, SpySequenceNumberTableMap::COL_NAME, SpySequenceNumberTableMap::COL_CURRENT_ID, ],
        self::TYPE_FIELDNAME     => ['id_sequence_number', 'name', 'current_id', ],
        self::TYPE_NUM           => [0, 1, 2, ]
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
        self::TYPE_PHPNAME       => ['IdSequenceNumber' => 0, 'Name' => 1, 'CurrentId' => 2, ],
        self::TYPE_CAMELNAME     => ['idSequenceNumber' => 0, 'name' => 1, 'currentId' => 2, ],
        self::TYPE_COLNAME       => [SpySequenceNumberTableMap::COL_ID_SEQUENCE_NUMBER => 0, SpySequenceNumberTableMap::COL_NAME => 1, SpySequenceNumberTableMap::COL_CURRENT_ID => 2, ],
        self::TYPE_FIELDNAME     => ['id_sequence_number' => 0, 'name' => 1, 'current_id' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSequenceNumber' => 'ID_SEQUENCE_NUMBER',
        'SpySequenceNumber.IdSequenceNumber' => 'ID_SEQUENCE_NUMBER',
        'idSequenceNumber' => 'ID_SEQUENCE_NUMBER',
        'spySequenceNumber.idSequenceNumber' => 'ID_SEQUENCE_NUMBER',
        'SpySequenceNumberTableMap::COL_ID_SEQUENCE_NUMBER' => 'ID_SEQUENCE_NUMBER',
        'COL_ID_SEQUENCE_NUMBER' => 'ID_SEQUENCE_NUMBER',
        'id_sequence_number' => 'ID_SEQUENCE_NUMBER',
        'spy_sequence_number.id_sequence_number' => 'ID_SEQUENCE_NUMBER',
        'Name' => 'NAME',
        'SpySequenceNumber.Name' => 'NAME',
        'name' => 'NAME',
        'spySequenceNumber.name' => 'NAME',
        'SpySequenceNumberTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_sequence_number.name' => 'NAME',
        'CurrentId' => 'CURRENT_ID',
        'SpySequenceNumber.CurrentId' => 'CURRENT_ID',
        'currentId' => 'CURRENT_ID',
        'spySequenceNumber.currentId' => 'CURRENT_ID',
        'SpySequenceNumberTableMap::COL_CURRENT_ID' => 'CURRENT_ID',
        'COL_CURRENT_ID' => 'CURRENT_ID',
        'current_id' => 'CURRENT_ID',
        'spy_sequence_number.current_id' => 'CURRENT_ID',
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
        $this->setName('spy_sequence_number');
        $this->setPhpName('SpySequenceNumber');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SequenceNumber\\Persistence\\SpySequenceNumber');
        $this->setPackage('Orm.Zed.SequenceNumber.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sequence_number_pk_seq');
        // columns
        $this->addPrimaryKey('id_sequence_number', 'IdSequenceNumber', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('current_id', 'CurrentId', 'INTEGER', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSequenceNumber', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSequenceNumber', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSequenceNumber', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSequenceNumber', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSequenceNumber', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSequenceNumber', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSequenceNumber', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySequenceNumberTableMap::CLASS_DEFAULT : SpySequenceNumberTableMap::OM_CLASS;
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
     * @return array (SpySequenceNumber object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySequenceNumberTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySequenceNumberTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySequenceNumberTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySequenceNumberTableMap::OM_CLASS;
            /** @var SpySequenceNumber $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySequenceNumberTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySequenceNumberTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySequenceNumberTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySequenceNumber $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySequenceNumberTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySequenceNumberTableMap::COL_ID_SEQUENCE_NUMBER);
            $criteria->addSelectColumn(SpySequenceNumberTableMap::COL_NAME);
            $criteria->addSelectColumn(SpySequenceNumberTableMap::COL_CURRENT_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id_sequence_number');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.current_id');
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
            $criteria->removeSelectColumn(SpySequenceNumberTableMap::COL_ID_SEQUENCE_NUMBER);
            $criteria->removeSelectColumn(SpySequenceNumberTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpySequenceNumberTableMap::COL_CURRENT_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sequence_number');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.current_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySequenceNumberTableMap::DATABASE_NAME)->getTable(SpySequenceNumberTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySequenceNumber or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySequenceNumber object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySequenceNumberTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SequenceNumber\Persistence\SpySequenceNumber) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySequenceNumberTableMap::DATABASE_NAME);
            $criteria->add(SpySequenceNumberTableMap::COL_ID_SEQUENCE_NUMBER, (array) $values, Criteria::IN);
        }

        $query = SpySequenceNumberQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySequenceNumberTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySequenceNumberTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sequence_number table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySequenceNumberQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySequenceNumber or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySequenceNumber object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySequenceNumberTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySequenceNumber object
        }

        if ($criteria->containsKey(SpySequenceNumberTableMap::COL_ID_SEQUENCE_NUMBER) && $criteria->keyContainsValue(SpySequenceNumberTableMap::COL_ID_SEQUENCE_NUMBER) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySequenceNumberTableMap::COL_ID_SEQUENCE_NUMBER.')');
        }


        // Set the correct dbName
        $query = SpySequenceNumberQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
