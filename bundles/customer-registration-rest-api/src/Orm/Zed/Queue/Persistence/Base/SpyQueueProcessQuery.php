<?php

namespace Orm\Zed\Queue\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Queue\Persistence\SpyQueueProcess as ChildSpyQueueProcess;
use Orm\Zed\Queue\Persistence\SpyQueueProcessQuery as ChildSpyQueueProcessQuery;
use Orm\Zed\Queue\Persistence\Map\SpyQueueProcessTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria as SprykerCriteria;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;

/**
 * Base class that represents a query for the 'spy_queue_process' table.
 *
 *
 *
 * @method     ChildSpyQueueProcessQuery orderByIdQueueProcess($order = Criteria::ASC) Order by the id_queue_process column
 * @method     ChildSpyQueueProcessQuery orderByServerId($order = Criteria::ASC) Order by the server_id column
 * @method     ChildSpyQueueProcessQuery orderByProcessPid($order = Criteria::ASC) Order by the process_pid column
 * @method     ChildSpyQueueProcessQuery orderByWorkerPid($order = Criteria::ASC) Order by the worker_pid column
 * @method     ChildSpyQueueProcessQuery orderByQueueName($order = Criteria::ASC) Order by the queue_name column
 * @method     ChildSpyQueueProcessQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyQueueProcessQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyQueueProcessQuery groupByIdQueueProcess() Group by the id_queue_process column
 * @method     ChildSpyQueueProcessQuery groupByServerId() Group by the server_id column
 * @method     ChildSpyQueueProcessQuery groupByProcessPid() Group by the process_pid column
 * @method     ChildSpyQueueProcessQuery groupByWorkerPid() Group by the worker_pid column
 * @method     ChildSpyQueueProcessQuery groupByQueueName() Group by the queue_name column
 * @method     ChildSpyQueueProcessQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyQueueProcessQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyQueueProcessQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyQueueProcessQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyQueueProcessQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyQueueProcessQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyQueueProcessQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyQueueProcessQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyQueueProcess|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyQueueProcess matching the query
 * @method     ChildSpyQueueProcess findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyQueueProcess matching the query, or a new ChildSpyQueueProcess object populated from the query conditions when no match is found
 *
 * @method     ChildSpyQueueProcess|null findOneByIdQueueProcess(int $id_queue_process) Return the first ChildSpyQueueProcess filtered by the id_queue_process column
 * @method     ChildSpyQueueProcess|null findOneByServerId(string $server_id) Return the first ChildSpyQueueProcess filtered by the server_id column
 * @method     ChildSpyQueueProcess|null findOneByProcessPid(int $process_pid) Return the first ChildSpyQueueProcess filtered by the process_pid column
 * @method     ChildSpyQueueProcess|null findOneByWorkerPid(int $worker_pid) Return the first ChildSpyQueueProcess filtered by the worker_pid column
 * @method     ChildSpyQueueProcess|null findOneByQueueName(string $queue_name) Return the first ChildSpyQueueProcess filtered by the queue_name column
 * @method     ChildSpyQueueProcess|null findOneByCreatedAt(string $created_at) Return the first ChildSpyQueueProcess filtered by the created_at column
 * @method     ChildSpyQueueProcess|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyQueueProcess filtered by the updated_at column *

 * @method     ChildSpyQueueProcess requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyQueueProcess by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQueueProcess requireOne(?ConnectionInterface $con = null) Return the first ChildSpyQueueProcess matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyQueueProcess requireOneByIdQueueProcess(int $id_queue_process) Return the first ChildSpyQueueProcess filtered by the id_queue_process column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQueueProcess requireOneByServerId(string $server_id) Return the first ChildSpyQueueProcess filtered by the server_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQueueProcess requireOneByProcessPid(int $process_pid) Return the first ChildSpyQueueProcess filtered by the process_pid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQueueProcess requireOneByWorkerPid(int $worker_pid) Return the first ChildSpyQueueProcess filtered by the worker_pid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQueueProcess requireOneByQueueName(string $queue_name) Return the first ChildSpyQueueProcess filtered by the queue_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQueueProcess requireOneByCreatedAt(string $created_at) Return the first ChildSpyQueueProcess filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyQueueProcess requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyQueueProcess filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyQueueProcess[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyQueueProcess objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyQueueProcess> find(?ConnectionInterface $con = null) Return ChildSpyQueueProcess objects based on current ModelCriteria
 * @method     ChildSpyQueueProcess[]|Collection findByIdQueueProcess(int $id_queue_process) Return ChildSpyQueueProcess objects filtered by the id_queue_process column
 * @psalm-method Collection&\Traversable<ChildSpyQueueProcess> findByIdQueueProcess(int $id_queue_process) Return ChildSpyQueueProcess objects filtered by the id_queue_process column
 * @method     ChildSpyQueueProcess[]|Collection findByServerId(string $server_id) Return ChildSpyQueueProcess objects filtered by the server_id column
 * @psalm-method Collection&\Traversable<ChildSpyQueueProcess> findByServerId(string $server_id) Return ChildSpyQueueProcess objects filtered by the server_id column
 * @method     ChildSpyQueueProcess[]|Collection findByProcessPid(int $process_pid) Return ChildSpyQueueProcess objects filtered by the process_pid column
 * @psalm-method Collection&\Traversable<ChildSpyQueueProcess> findByProcessPid(int $process_pid) Return ChildSpyQueueProcess objects filtered by the process_pid column
 * @method     ChildSpyQueueProcess[]|Collection findByWorkerPid(int $worker_pid) Return ChildSpyQueueProcess objects filtered by the worker_pid column
 * @psalm-method Collection&\Traversable<ChildSpyQueueProcess> findByWorkerPid(int $worker_pid) Return ChildSpyQueueProcess objects filtered by the worker_pid column
 * @method     ChildSpyQueueProcess[]|Collection findByQueueName(string $queue_name) Return ChildSpyQueueProcess objects filtered by the queue_name column
 * @psalm-method Collection&\Traversable<ChildSpyQueueProcess> findByQueueName(string $queue_name) Return ChildSpyQueueProcess objects filtered by the queue_name column
 * @method     ChildSpyQueueProcess[]|Collection findByCreatedAt(string $created_at) Return ChildSpyQueueProcess objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyQueueProcess> findByCreatedAt(string $created_at) Return ChildSpyQueueProcess objects filtered by the created_at column
 * @method     ChildSpyQueueProcess[]|Collection findByUpdatedAt(string $updated_at) Return ChildSpyQueueProcess objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyQueueProcess> findByUpdatedAt(string $updated_at) Return ChildSpyQueueProcess objects filtered by the updated_at column
 * @method     ChildSpyQueueProcess[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyQueueProcess> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SpyQueueProcessQuery extends ModelCriteria
{

    /**
     * @var bool
     */
    protected $isForUpdateEnabled = false;

    /**
     * @deprecated Use {@link \Propel\Runtime\ActiveQuery\Criteria::lockForUpdate()} instead.
     *
     * @param bool $isForUpdateEnabled
     *
     * @return $this The primary criteria object
     */
    public function forUpdate($isForUpdateEnabled)
    {
        $this->isForUpdateEnabled = $isForUpdateEnabled;

        return $this;
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function createSelectSql(&$params): string
    {
        $sql = parent::createSelectSql($params);
        if ($this->isForUpdateEnabled) {
            $sql .= ' FOR UPDATE';
        }

        return $sql;
    }

    /**
     * Clear the conditions to allow the reuse of the query object.
     * The ModelCriteria's Model and alias 'all the properties set by construct) will remain.
     *
     * @return $this The primary criteria object
     */
    public function clear()
    {
        parent::clear();

        $this->isSelfSelected = false;
        $this->forUpdate(false);

        return $this;
    }


    /**
     * @param int $affectedRows
     * @param \Propel\Runtime\Connection\ConnectionInterface $con
     *
     * @return int|null
     */
    protected function postUpdate(int $affectedRows, ConnectionInterface $con): ?int
    {
        return null;
    }

    /**
     * @param int $affectedRows
     * @param \Propel\Runtime\Connection\ConnectionInterface $con
     *
     * @return int|null
     */
    protected function postDelete(int $affectedRows, ConnectionInterface $con): ?int
    {
        return null;
    }

    /**
     * Issue a SELECT query based on the current ModelCriteria
     * and format the list of results with the current formatter
     * By default, returns an array of model objects
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return \Propel\Runtime\Collection\ObjectCollection|\Propel\Runtime\ActiveRecord\ActiveRecordInterface[]|mixed the list of results, formatted by the current formatter
     */
    public function find(?ConnectionInterface $con = null)
    {
        return parent::find($con);
    }

    /**
     * Issue a SELECT ... LIMIT 1 query based on the current ModelCriteria
     * and format the result with the current formatter
     * By default, returns a model object.
     *
     * Does not work with ->with()s containing one-to-many relations.
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return mixed the result, formatted by the current formatter
     */
    public function findOne(?ConnectionInterface $con = null)
    {
        return parent::findOne($con);
    }

    /**
     * Issue an existence check on the current ModelCriteria
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return bool column existence
     */
    public function exists(?ConnectionInterface $con = null): bool
    {
        return parent::exists($con);
    }
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Orm\Zed\Queue\Persistence\Base\SpyQueueProcessQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Queue\\Persistence\\SpyQueueProcess', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyQueueProcessQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyQueueProcessQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyQueueProcessQuery) {
            return $criteria;
        }
        $query = new ChildSpyQueueProcessQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSpyQueueProcess|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SpyQueueProcessTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSpyQueueProcess A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_queue_process, server_id, process_pid, worker_pid, queue_name, created_at, updated_at FROM spy_queue_process WHERE id_queue_process = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSpyQueueProcess $obj */
            $obj = new ChildSpyQueueProcess();
            $obj->hydrate($row);
            SpyQueueProcessTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildSpyQueueProcess|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }

        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(SpyQueueProcessTableMap::COL_ID_QUEUE_PROCESS, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(SpyQueueProcessTableMap::COL_ID_QUEUE_PROCESS, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idQueueProcess Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdQueueProcess_Between(array $idQueueProcess)
    {
        return $this->filterByIdQueueProcess($idQueueProcess, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idQueueProcesss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdQueueProcess_In(array $idQueueProcesss)
    {
        return $this->filterByIdQueueProcess($idQueueProcesss, Criteria::IN);
    }

    /**
     * Filter the query on the id_queue_process column
     *
     * Example usage:
     * <code>
     * $query->filterByIdQueueProcess(1234); // WHERE id_queue_process = 1234
     * $query->filterByIdQueueProcess(array(12, 34), Criteria::IN); // WHERE id_queue_process IN (12, 34)
     * $query->filterByIdQueueProcess(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_queue_process > 12
     * </code>
     *
     * @param     mixed $idQueueProcess The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdQueueProcess($idQueueProcess = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idQueueProcess)) {
            $useMinMax = false;
            if (isset($idQueueProcess['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQueueProcessTableMap::COL_ID_QUEUE_PROCESS, $idQueueProcess['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idQueueProcess['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQueueProcessTableMap::COL_ID_QUEUE_PROCESS, $idQueueProcess['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idQueueProcess of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQueueProcessTableMap::COL_ID_QUEUE_PROCESS, $idQueueProcess, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $serverIds Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByServerId_In(array $serverIds)
    {
        return $this->filterByServerId($serverIds, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $serverId Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByServerId_Like($serverId)
    {
        return $this->filterByServerId($serverId, Criteria::LIKE);
    }

    /**
     * Filter the query on the server_id column
     *
     * Example usage:
     * <code>
     * $query->filterByServerId('fooValue');   // WHERE server_id = 'fooValue'
     * $query->filterByServerId('%fooValue%', Criteria::LIKE); // WHERE server_id LIKE '%fooValue%'
     * $query->filterByServerId([1, 'foo'], Criteria::IN); // WHERE server_id IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $serverId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByServerId($serverId = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $serverId = str_replace('*', '%', $serverId);
        }

        if (is_array($serverId) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$serverId of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyQueueProcessTableMap::COL_SERVER_ID, $serverId, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $processPid Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcessPid_Between(array $processPid)
    {
        return $this->filterByProcessPid($processPid, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $processPids Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProcessPid_In(array $processPids)
    {
        return $this->filterByProcessPid($processPids, Criteria::IN);
    }

    /**
     * Filter the query on the process_pid column
     *
     * Example usage:
     * <code>
     * $query->filterByProcessPid(1234); // WHERE process_pid = 1234
     * $query->filterByProcessPid(array(12, 34), Criteria::IN); // WHERE process_pid IN (12, 34)
     * $query->filterByProcessPid(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE process_pid > 12
     * </code>
     *
     * @param     mixed $processPid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByProcessPid($processPid = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($processPid)) {
            $useMinMax = false;
            if (isset($processPid['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQueueProcessTableMap::COL_PROCESS_PID, $processPid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($processPid['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQueueProcessTableMap::COL_PROCESS_PID, $processPid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$processPid of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQueueProcessTableMap::COL_PROCESS_PID, $processPid, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $workerPid Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkerPid_Between(array $workerPid)
    {
        return $this->filterByWorkerPid($workerPid, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $workerPids Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWorkerPid_In(array $workerPids)
    {
        return $this->filterByWorkerPid($workerPids, Criteria::IN);
    }

    /**
     * Filter the query on the worker_pid column
     *
     * Example usage:
     * <code>
     * $query->filterByWorkerPid(1234); // WHERE worker_pid = 1234
     * $query->filterByWorkerPid(array(12, 34), Criteria::IN); // WHERE worker_pid IN (12, 34)
     * $query->filterByWorkerPid(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE worker_pid > 12
     * </code>
     *
     * @param     mixed $workerPid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByWorkerPid($workerPid = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($workerPid)) {
            $useMinMax = false;
            if (isset($workerPid['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQueueProcessTableMap::COL_WORKER_PID, $workerPid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($workerPid['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQueueProcessTableMap::COL_WORKER_PID, $workerPid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$workerPid of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQueueProcessTableMap::COL_WORKER_PID, $workerPid, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $queueNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQueueName_In(array $queueNames)
    {
        return $this->filterByQueueName($queueNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $queueName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQueueName_Like($queueName)
    {
        return $this->filterByQueueName($queueName, Criteria::LIKE);
    }

    /**
     * Filter the query on the queue_name column
     *
     * Example usage:
     * <code>
     * $query->filterByQueueName('fooValue');   // WHERE queue_name = 'fooValue'
     * $query->filterByQueueName('%fooValue%', Criteria::LIKE); // WHERE queue_name LIKE '%fooValue%'
     * $query->filterByQueueName([1, 'foo'], Criteria::IN); // WHERE queue_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $queueName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByQueueName($queueName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $queueName = str_replace('*', '%', $queueName);
        }

        if (is_array($queueName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$queueName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyQueueProcessTableMap::COL_QUEUE_NAME, $queueName, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $createdAt Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt_Between(array $createdAt)
    {
        return $this->filterByCreatedAt($createdAt, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $createdAts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt_In(array $createdAts)
    {
        return $this->filterByCreatedAt($createdAts, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $createdAt Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt_Like($createdAt)
    {
        return $this->filterByCreatedAt($createdAt, Criteria::LIKE);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCreatedAt($createdAt = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQueueProcessTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQueueProcessTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQueueProcessTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $updatedAt Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt_Between(array $updatedAt)
    {
        return $this->filterByUpdatedAt($updatedAt, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $updatedAts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt_In(array $updatedAts)
    {
        return $this->filterByUpdatedAt($updatedAts, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $updatedAt Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt_Like($updatedAt)
    {
        return $this->filterByUpdatedAt($updatedAt, Criteria::LIKE);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQueueProcessTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyQueueProcessTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyQueueProcessTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyQueueProcess $spyQueueProcess Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyQueueProcess = null)
    {
        if ($spyQueueProcess) {
            $this->addUsingAlias(SpyQueueProcessTableMap::COL_ID_QUEUE_PROCESS, $spyQueueProcess->getIdQueueProcess(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the spy_queue_process table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQueueProcessTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyQueueProcessTableMap::clearInstancePool();
            SpyQueueProcessTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQueueProcessTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyQueueProcessTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyQueueProcessTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyQueueProcessTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param int $nbDays Maximum age of the latest update in days
     *
     * @return $this The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        $this->addUsingAlias(SpyQueueProcessTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyQueueProcessTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyQueueProcessTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyQueueProcessTableMap::COL_CREATED_AT);

        return $this;
    }

    /**
     * Filter by the latest created
     *
     * @param int $nbDays Maximum age of in days
     *
     * @return $this The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        $this->addUsingAlias(SpyQueueProcessTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyQueueProcessTableMap::COL_CREATED_AT);

        return $this;
    }

}
