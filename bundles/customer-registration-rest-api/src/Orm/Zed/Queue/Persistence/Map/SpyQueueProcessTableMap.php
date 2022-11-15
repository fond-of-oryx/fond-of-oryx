<?php

namespace Orm\Zed\Queue\Persistence\Map;

use Orm\Zed\Queue\Persistence\SpyQueueProcess;
use Orm\Zed\Queue\Persistence\SpyQueueProcessQuery;
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
 * This class defines the structure of the 'spy_queue_process' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyQueueProcessTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'Orm.Zed.Queue.Persistence.Map.SpyQueueProcessTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_queue_process';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Queue\\Persistence\\SpyQueueProcess';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Orm.Zed.Queue.Persistence.SpyQueueProcess';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id_queue_process field
     */
    public const COL_ID_QUEUE_PROCESS = 'spy_queue_process.id_queue_process';

    /**
     * the column name for the server_id field
     */
    public const COL_SERVER_ID = 'spy_queue_process.server_id';

    /**
     * the column name for the process_pid field
     */
    public const COL_PROCESS_PID = 'spy_queue_process.process_pid';

    /**
     * the column name for the worker_pid field
     */
    public const COL_WORKER_PID = 'spy_queue_process.worker_pid';

    /**
     * the column name for the queue_name field
     */
    public const COL_QUEUE_NAME = 'spy_queue_process.queue_name';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_queue_process.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_queue_process.updated_at';

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
        self::TYPE_PHPNAME       => ['IdQueueProcess', 'ServerId', 'ProcessPid', 'WorkerPid', 'QueueName', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idQueueProcess', 'serverId', 'processPid', 'workerPid', 'queueName', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyQueueProcessTableMap::COL_ID_QUEUE_PROCESS, SpyQueueProcessTableMap::COL_SERVER_ID, SpyQueueProcessTableMap::COL_PROCESS_PID, SpyQueueProcessTableMap::COL_WORKER_PID, SpyQueueProcessTableMap::COL_QUEUE_NAME, SpyQueueProcessTableMap::COL_CREATED_AT, SpyQueueProcessTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_queue_process', 'server_id', 'process_pid', 'worker_pid', 'queue_name', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
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
        self::TYPE_PHPNAME       => ['IdQueueProcess' => 0, 'ServerId' => 1, 'ProcessPid' => 2, 'WorkerPid' => 3, 'QueueName' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idQueueProcess' => 0, 'serverId' => 1, 'processPid' => 2, 'workerPid' => 3, 'queueName' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyQueueProcessTableMap::COL_ID_QUEUE_PROCESS => 0, SpyQueueProcessTableMap::COL_SERVER_ID => 1, SpyQueueProcessTableMap::COL_PROCESS_PID => 2, SpyQueueProcessTableMap::COL_WORKER_PID => 3, SpyQueueProcessTableMap::COL_QUEUE_NAME => 4, SpyQueueProcessTableMap::COL_CREATED_AT => 5, SpyQueueProcessTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_queue_process' => 0, 'server_id' => 1, 'process_pid' => 2, 'worker_pid' => 3, 'queue_name' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdQueueProcess' => 'ID_QUEUE_PROCESS',
        'SpyQueueProcess.IdQueueProcess' => 'ID_QUEUE_PROCESS',
        'idQueueProcess' => 'ID_QUEUE_PROCESS',
        'spyQueueProcess.idQueueProcess' => 'ID_QUEUE_PROCESS',
        'SpyQueueProcessTableMap::COL_ID_QUEUE_PROCESS' => 'ID_QUEUE_PROCESS',
        'COL_ID_QUEUE_PROCESS' => 'ID_QUEUE_PROCESS',
        'id_queue_process' => 'ID_QUEUE_PROCESS',
        'spy_queue_process.id_queue_process' => 'ID_QUEUE_PROCESS',
        'ServerId' => 'SERVER_ID',
        'SpyQueueProcess.ServerId' => 'SERVER_ID',
        'serverId' => 'SERVER_ID',
        'spyQueueProcess.serverId' => 'SERVER_ID',
        'SpyQueueProcessTableMap::COL_SERVER_ID' => 'SERVER_ID',
        'COL_SERVER_ID' => 'SERVER_ID',
        'server_id' => 'SERVER_ID',
        'spy_queue_process.server_id' => 'SERVER_ID',
        'ProcessPid' => 'PROCESS_PID',
        'SpyQueueProcess.ProcessPid' => 'PROCESS_PID',
        'processPid' => 'PROCESS_PID',
        'spyQueueProcess.processPid' => 'PROCESS_PID',
        'SpyQueueProcessTableMap::COL_PROCESS_PID' => 'PROCESS_PID',
        'COL_PROCESS_PID' => 'PROCESS_PID',
        'process_pid' => 'PROCESS_PID',
        'spy_queue_process.process_pid' => 'PROCESS_PID',
        'WorkerPid' => 'WORKER_PID',
        'SpyQueueProcess.WorkerPid' => 'WORKER_PID',
        'workerPid' => 'WORKER_PID',
        'spyQueueProcess.workerPid' => 'WORKER_PID',
        'SpyQueueProcessTableMap::COL_WORKER_PID' => 'WORKER_PID',
        'COL_WORKER_PID' => 'WORKER_PID',
        'worker_pid' => 'WORKER_PID',
        'spy_queue_process.worker_pid' => 'WORKER_PID',
        'QueueName' => 'QUEUE_NAME',
        'SpyQueueProcess.QueueName' => 'QUEUE_NAME',
        'queueName' => 'QUEUE_NAME',
        'spyQueueProcess.queueName' => 'QUEUE_NAME',
        'SpyQueueProcessTableMap::COL_QUEUE_NAME' => 'QUEUE_NAME',
        'COL_QUEUE_NAME' => 'QUEUE_NAME',
        'queue_name' => 'QUEUE_NAME',
        'spy_queue_process.queue_name' => 'QUEUE_NAME',
        'CreatedAt' => 'CREATED_AT',
        'SpyQueueProcess.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyQueueProcess.createdAt' => 'CREATED_AT',
        'SpyQueueProcessTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_queue_process.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyQueueProcess.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyQueueProcess.updatedAt' => 'UPDATED_AT',
        'SpyQueueProcessTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_queue_process.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_queue_process');
        $this->setPhpName('SpyQueueProcess');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Queue\\Persistence\\SpyQueueProcess');
        $this->setPackage('Orm.Zed.Queue.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_queue_process_pk_seq');
        // columns
        $this->addPrimaryKey('id_queue_process', 'IdQueueProcess', 'INTEGER', true, null, null);
        $this->addColumn('server_id', 'ServerId', 'VARCHAR', true, 255, null);
        $this->addColumn('process_pid', 'ProcessPid', 'INTEGER', true, null, null);
        $this->addColumn('worker_pid', 'WorkerPid', 'INTEGER', true, null, null);
        $this->addColumn('queue_name', 'QueueName', 'VARCHAR', true, 255, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
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
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array<string, array> Associative array (name => parameters) of behaviors
     */
    public function getBehaviors(): array
    {
        return [
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQueueProcess', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQueueProcess', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQueueProcess', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQueueProcess', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQueueProcess', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQueueProcess', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdQueueProcess', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyQueueProcessTableMap::CLASS_DEFAULT : SpyQueueProcessTableMap::OM_CLASS;
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
     * @return array (SpyQueueProcess object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyQueueProcessTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyQueueProcessTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyQueueProcessTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyQueueProcessTableMap::OM_CLASS;
            /** @var SpyQueueProcess $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyQueueProcessTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyQueueProcessTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyQueueProcessTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyQueueProcess $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyQueueProcessTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyQueueProcessTableMap::COL_ID_QUEUE_PROCESS);
            $criteria->addSelectColumn(SpyQueueProcessTableMap::COL_SERVER_ID);
            $criteria->addSelectColumn(SpyQueueProcessTableMap::COL_PROCESS_PID);
            $criteria->addSelectColumn(SpyQueueProcessTableMap::COL_WORKER_PID);
            $criteria->addSelectColumn(SpyQueueProcessTableMap::COL_QUEUE_NAME);
            $criteria->addSelectColumn(SpyQueueProcessTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyQueueProcessTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_queue_process');
            $criteria->addSelectColumn($alias . '.server_id');
            $criteria->addSelectColumn($alias . '.process_pid');
            $criteria->addSelectColumn($alias . '.worker_pid');
            $criteria->addSelectColumn($alias . '.queue_name');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
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
            $criteria->removeSelectColumn(SpyQueueProcessTableMap::COL_ID_QUEUE_PROCESS);
            $criteria->removeSelectColumn(SpyQueueProcessTableMap::COL_SERVER_ID);
            $criteria->removeSelectColumn(SpyQueueProcessTableMap::COL_PROCESS_PID);
            $criteria->removeSelectColumn(SpyQueueProcessTableMap::COL_WORKER_PID);
            $criteria->removeSelectColumn(SpyQueueProcessTableMap::COL_QUEUE_NAME);
            $criteria->removeSelectColumn(SpyQueueProcessTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyQueueProcessTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_queue_process');
            $criteria->removeSelectColumn($alias . '.server_id');
            $criteria->removeSelectColumn($alias . '.process_pid');
            $criteria->removeSelectColumn($alias . '.worker_pid');
            $criteria->removeSelectColumn($alias . '.queue_name');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyQueueProcessTableMap::DATABASE_NAME)->getTable(SpyQueueProcessTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyQueueProcess or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyQueueProcess object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQueueProcessTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Queue\Persistence\SpyQueueProcess) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyQueueProcessTableMap::DATABASE_NAME);
            $criteria->add(SpyQueueProcessTableMap::COL_ID_QUEUE_PROCESS, (array) $values, Criteria::IN);
        }

        $query = SpyQueueProcessQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyQueueProcessTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyQueueProcessTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_queue_process table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyQueueProcessQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyQueueProcess or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyQueueProcess object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQueueProcessTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyQueueProcess object
        }

        if ($criteria->containsKey(SpyQueueProcessTableMap::COL_ID_QUEUE_PROCESS) && $criteria->keyContainsValue(SpyQueueProcessTableMap::COL_ID_QUEUE_PROCESS) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyQueueProcessTableMap::COL_ID_QUEUE_PROCESS.')');
        }


        // Set the correct dbName
        $query = SpyQueueProcessQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
