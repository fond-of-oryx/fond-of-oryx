<?php

namespace Orm\Zed\SequenceNumber\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\SequenceNumber\Persistence\SpySequenceNumber as ChildSpySequenceNumber;
use Orm\Zed\SequenceNumber\Persistence\SpySequenceNumberQuery as ChildSpySequenceNumberQuery;
use Orm\Zed\SequenceNumber\Persistence\Map\SpySequenceNumberTableMap;
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
 * Base class that represents a query for the 'spy_sequence_number' table.
 *
 *
 *
 * @method     ChildSpySequenceNumberQuery orderByIdSequenceNumber($order = Criteria::ASC) Order by the id_sequence_number column
 * @method     ChildSpySequenceNumberQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpySequenceNumberQuery orderByCurrentId($order = Criteria::ASC) Order by the current_id column
 *
 * @method     ChildSpySequenceNumberQuery groupByIdSequenceNumber() Group by the id_sequence_number column
 * @method     ChildSpySequenceNumberQuery groupByName() Group by the name column
 * @method     ChildSpySequenceNumberQuery groupByCurrentId() Group by the current_id column
 *
 * @method     ChildSpySequenceNumberQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpySequenceNumberQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpySequenceNumberQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpySequenceNumberQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpySequenceNumberQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpySequenceNumberQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpySequenceNumber|null findOne(?ConnectionInterface $con = null) Return the first ChildSpySequenceNumber matching the query
 * @method     ChildSpySequenceNumber findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpySequenceNumber matching the query, or a new ChildSpySequenceNumber object populated from the query conditions when no match is found
 *
 * @method     ChildSpySequenceNumber|null findOneByIdSequenceNumber(int $id_sequence_number) Return the first ChildSpySequenceNumber filtered by the id_sequence_number column
 * @method     ChildSpySequenceNumber|null findOneByName(string $name) Return the first ChildSpySequenceNumber filtered by the name column
 * @method     ChildSpySequenceNumber|null findOneByCurrentId(int $current_id) Return the first ChildSpySequenceNumber filtered by the current_id column *

 * @method     ChildSpySequenceNumber requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpySequenceNumber by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySequenceNumber requireOne(?ConnectionInterface $con = null) Return the first ChildSpySequenceNumber matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySequenceNumber requireOneByIdSequenceNumber(int $id_sequence_number) Return the first ChildSpySequenceNumber filtered by the id_sequence_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySequenceNumber requireOneByName(string $name) Return the first ChildSpySequenceNumber filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySequenceNumber requireOneByCurrentId(int $current_id) Return the first ChildSpySequenceNumber filtered by the current_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySequenceNumber[]|Collection find(?ConnectionInterface $con = null) Return ChildSpySequenceNumber objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpySequenceNumber> find(?ConnectionInterface $con = null) Return ChildSpySequenceNumber objects based on current ModelCriteria
 * @method     ChildSpySequenceNumber[]|Collection findByIdSequenceNumber(int $id_sequence_number) Return ChildSpySequenceNumber objects filtered by the id_sequence_number column
 * @psalm-method Collection&\Traversable<ChildSpySequenceNumber> findByIdSequenceNumber(int $id_sequence_number) Return ChildSpySequenceNumber objects filtered by the id_sequence_number column
 * @method     ChildSpySequenceNumber[]|Collection findByName(string $name) Return ChildSpySequenceNumber objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpySequenceNumber> findByName(string $name) Return ChildSpySequenceNumber objects filtered by the name column
 * @method     ChildSpySequenceNumber[]|Collection findByCurrentId(int $current_id) Return ChildSpySequenceNumber objects filtered by the current_id column
 * @psalm-method Collection&\Traversable<ChildSpySequenceNumber> findByCurrentId(int $current_id) Return ChildSpySequenceNumber objects filtered by the current_id column
 * @method     ChildSpySequenceNumber[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpySequenceNumber> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SpySequenceNumberQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\SequenceNumber\Persistence\Base\SpySequenceNumberQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\SequenceNumber\\Persistence\\SpySequenceNumber', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpySequenceNumberQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpySequenceNumberQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpySequenceNumberQuery) {
            return $criteria;
        }
        $query = new ChildSpySequenceNumberQuery();
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
     * @return ChildSpySequenceNumber|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpySequenceNumberTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpySequenceNumber A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_sequence_number, name, current_id FROM spy_sequence_number WHERE id_sequence_number = :p0';
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
            /** @var ChildSpySequenceNumber $obj */
            $obj = new ChildSpySequenceNumber();
            $obj->hydrate($row);
            SpySequenceNumberTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpySequenceNumber|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpySequenceNumberTableMap::COL_ID_SEQUENCE_NUMBER, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpySequenceNumberTableMap::COL_ID_SEQUENCE_NUMBER, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idSequenceNumber Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSequenceNumber_Between(array $idSequenceNumber)
    {
        return $this->filterByIdSequenceNumber($idSequenceNumber, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idSequenceNumbers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSequenceNumber_In(array $idSequenceNumbers)
    {
        return $this->filterByIdSequenceNumber($idSequenceNumbers, Criteria::IN);
    }

    /**
     * Filter the query on the id_sequence_number column
     *
     * Example usage:
     * <code>
     * $query->filterByIdSequenceNumber(1234); // WHERE id_sequence_number = 1234
     * $query->filterByIdSequenceNumber(array(12, 34), Criteria::IN); // WHERE id_sequence_number IN (12, 34)
     * $query->filterByIdSequenceNumber(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_sequence_number > 12
     * </code>
     *
     * @param     mixed $idSequenceNumber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdSequenceNumber($idSequenceNumber = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idSequenceNumber)) {
            $useMinMax = false;
            if (isset($idSequenceNumber['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySequenceNumberTableMap::COL_ID_SEQUENCE_NUMBER, $idSequenceNumber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSequenceNumber['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySequenceNumberTableMap::COL_ID_SEQUENCE_NUMBER, $idSequenceNumber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idSequenceNumber of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySequenceNumberTableMap::COL_ID_SEQUENCE_NUMBER, $idSequenceNumber, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $names Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName_In(array $names)
    {
        return $this->filterByName($names, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $name Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName_Like($name)
    {
        return $this->filterByName($name, Criteria::LIKE);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName([1, 'foo'], Criteria::IN); // WHERE name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByName($name = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $name = str_replace('*', '%', $name);
        }

        if (is_array($name) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$name of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySequenceNumberTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $currentId Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCurrentId_Between(array $currentId)
    {
        return $this->filterByCurrentId($currentId, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $currentIds Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCurrentId_In(array $currentIds)
    {
        return $this->filterByCurrentId($currentIds, Criteria::IN);
    }

    /**
     * Filter the query on the current_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrentId(1234); // WHERE current_id = 1234
     * $query->filterByCurrentId(array(12, 34), Criteria::IN); // WHERE current_id IN (12, 34)
     * $query->filterByCurrentId(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE current_id > 12
     * </code>
     *
     * @param     mixed $currentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCurrentId($currentId = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($currentId)) {
            $useMinMax = false;
            if (isset($currentId['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySequenceNumberTableMap::COL_CURRENT_ID, $currentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($currentId['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySequenceNumberTableMap::COL_CURRENT_ID, $currentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$currentId of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySequenceNumberTableMap::COL_CURRENT_ID, $currentId, $comparison);

        return $query;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpySequenceNumber $spySequenceNumber Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spySequenceNumber = null)
    {
        if ($spySequenceNumber) {
            $this->addUsingAlias(SpySequenceNumberTableMap::COL_ID_SEQUENCE_NUMBER, $spySequenceNumber->getIdSequenceNumber(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the spy_sequence_number table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySequenceNumberTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpySequenceNumberTableMap::clearInstancePool();
            SpySequenceNumberTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySequenceNumberTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpySequenceNumberTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpySequenceNumberTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpySequenceNumberTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
