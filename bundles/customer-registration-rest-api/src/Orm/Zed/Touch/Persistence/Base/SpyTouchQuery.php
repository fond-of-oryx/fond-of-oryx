<?php

namespace Orm\Zed\Touch\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Touch\Persistence\SpyTouch as ChildSpyTouch;
use Orm\Zed\Touch\Persistence\SpyTouchQuery as ChildSpyTouchQuery;
use Orm\Zed\Touch\Persistence\Map\SpyTouchTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria as SprykerCriteria;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;

/**
 * Base class that represents a query for the 'spy_touch' table.
 *
 *
 *
 * @method     ChildSpyTouchQuery orderByIdTouch($order = Criteria::ASC) Order by the id_touch column
 * @method     ChildSpyTouchQuery orderByItemType($order = Criteria::ASC) Order by the item_type column
 * @method     ChildSpyTouchQuery orderByItemEvent($order = Criteria::ASC) Order by the item_event column
 * @method     ChildSpyTouchQuery orderByItemId($order = Criteria::ASC) Order by the item_id column
 * @method     ChildSpyTouchQuery orderByTouched($order = Criteria::ASC) Order by the touched column
 *
 * @method     ChildSpyTouchQuery groupByIdTouch() Group by the id_touch column
 * @method     ChildSpyTouchQuery groupByItemType() Group by the item_type column
 * @method     ChildSpyTouchQuery groupByItemEvent() Group by the item_event column
 * @method     ChildSpyTouchQuery groupByItemId() Group by the item_id column
 * @method     ChildSpyTouchQuery groupByTouched() Group by the touched column
 *
 * @method     ChildSpyTouchQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyTouchQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyTouchQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyTouchQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyTouchQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyTouchQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyTouchQuery leftJoinTouchStorage($relationAlias = null) Adds a LEFT JOIN clause to the query using the TouchStorage relation
 * @method     ChildSpyTouchQuery rightJoinTouchStorage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TouchStorage relation
 * @method     ChildSpyTouchQuery innerJoinTouchStorage($relationAlias = null) Adds a INNER JOIN clause to the query using the TouchStorage relation
 *
 * @method     ChildSpyTouchQuery joinWithTouchStorage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TouchStorage relation
 *
 * @method     ChildSpyTouchQuery leftJoinWithTouchStorage() Adds a LEFT JOIN clause and with to the query using the TouchStorage relation
 * @method     ChildSpyTouchQuery rightJoinWithTouchStorage() Adds a RIGHT JOIN clause and with to the query using the TouchStorage relation
 * @method     ChildSpyTouchQuery innerJoinWithTouchStorage() Adds a INNER JOIN clause and with to the query using the TouchStorage relation
 *
 * @method     ChildSpyTouchQuery leftJoinTouchSearch($relationAlias = null) Adds a LEFT JOIN clause to the query using the TouchSearch relation
 * @method     ChildSpyTouchQuery rightJoinTouchSearch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TouchSearch relation
 * @method     ChildSpyTouchQuery innerJoinTouchSearch($relationAlias = null) Adds a INNER JOIN clause to the query using the TouchSearch relation
 *
 * @method     ChildSpyTouchQuery joinWithTouchSearch($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TouchSearch relation
 *
 * @method     ChildSpyTouchQuery leftJoinWithTouchSearch() Adds a LEFT JOIN clause and with to the query using the TouchSearch relation
 * @method     ChildSpyTouchQuery rightJoinWithTouchSearch() Adds a RIGHT JOIN clause and with to the query using the TouchSearch relation
 * @method     ChildSpyTouchQuery innerJoinWithTouchSearch() Adds a INNER JOIN clause and with to the query using the TouchSearch relation
 *
 * @method     \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery|\Orm\Zed\Touch\Persistence\SpyTouchSearchQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyTouch|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyTouch matching the query
 * @method     ChildSpyTouch findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyTouch matching the query, or a new ChildSpyTouch object populated from the query conditions when no match is found
 *
 * @method     ChildSpyTouch|null findOneByIdTouch(int $id_touch) Return the first ChildSpyTouch filtered by the id_touch column
 * @method     ChildSpyTouch|null findOneByItemType(string $item_type) Return the first ChildSpyTouch filtered by the item_type column
 * @method     ChildSpyTouch|null findOneByItemEvent(int $item_event) Return the first ChildSpyTouch filtered by the item_event column
 * @method     ChildSpyTouch|null findOneByItemId(int $item_id) Return the first ChildSpyTouch filtered by the item_id column
 * @method     ChildSpyTouch|null findOneByTouched(string $touched) Return the first ChildSpyTouch filtered by the touched column *

 * @method     ChildSpyTouch requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyTouch by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyTouch requireOne(?ConnectionInterface $con = null) Return the first ChildSpyTouch matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyTouch requireOneByIdTouch(int $id_touch) Return the first ChildSpyTouch filtered by the id_touch column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyTouch requireOneByItemType(string $item_type) Return the first ChildSpyTouch filtered by the item_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyTouch requireOneByItemEvent(int $item_event) Return the first ChildSpyTouch filtered by the item_event column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyTouch requireOneByItemId(int $item_id) Return the first ChildSpyTouch filtered by the item_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyTouch requireOneByTouched(string $touched) Return the first ChildSpyTouch filtered by the touched column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyTouch[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyTouch objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyTouch> find(?ConnectionInterface $con = null) Return ChildSpyTouch objects based on current ModelCriteria
 * @method     ChildSpyTouch[]|Collection findByIdTouch(int $id_touch) Return ChildSpyTouch objects filtered by the id_touch column
 * @psalm-method Collection&\Traversable<ChildSpyTouch> findByIdTouch(int $id_touch) Return ChildSpyTouch objects filtered by the id_touch column
 * @method     ChildSpyTouch[]|Collection findByItemType(string $item_type) Return ChildSpyTouch objects filtered by the item_type column
 * @psalm-method Collection&\Traversable<ChildSpyTouch> findByItemType(string $item_type) Return ChildSpyTouch objects filtered by the item_type column
 * @method     ChildSpyTouch[]|Collection findByItemEvent(int $item_event) Return ChildSpyTouch objects filtered by the item_event column
 * @psalm-method Collection&\Traversable<ChildSpyTouch> findByItemEvent(int $item_event) Return ChildSpyTouch objects filtered by the item_event column
 * @method     ChildSpyTouch[]|Collection findByItemId(int $item_id) Return ChildSpyTouch objects filtered by the item_id column
 * @psalm-method Collection&\Traversable<ChildSpyTouch> findByItemId(int $item_id) Return ChildSpyTouch objects filtered by the item_id column
 * @method     ChildSpyTouch[]|Collection findByTouched(string $touched) Return ChildSpyTouch objects filtered by the touched column
 * @psalm-method Collection&\Traversable<ChildSpyTouch> findByTouched(string $touched) Return ChildSpyTouch objects filtered by the touched column
 * @method     ChildSpyTouch[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyTouch> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SpyTouchQuery extends ModelCriteria
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

    // query_cache behavior
    protected $queryKey = '';
    protected static $cacheBackend;
                protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Orm\Zed\Touch\Persistence\Base\SpyTouchQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Touch\\Persistence\\SpyTouch', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyTouchQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyTouchQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyTouchQuery) {
            return $criteria;
        }
        $query = new ChildSpyTouchQuery();
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
     * @return ChildSpyTouch|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyTouchTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyTouch A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT [id_touch], [item_type], [item_event], [item_id], [touched] FROM [spy_touch] WHERE [id_touch] = :p0';
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
            /** @var ChildSpyTouch $obj */
            $obj = new ChildSpyTouch();
            $obj->hydrate($row);
            SpyTouchTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyTouch|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyTouchTableMap::COL_ID_TOUCH, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyTouchTableMap::COL_ID_TOUCH, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idTouch Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdTouch_Between(array $idTouch)
    {
        return $this->filterByIdTouch($idTouch, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idTouchs Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdTouch_In(array $idTouchs)
    {
        return $this->filterByIdTouch($idTouchs, Criteria::IN);
    }

    /**
     * Filter the query on the id_touch column
     *
     * Example usage:
     * <code>
     * $query->filterByIdTouch(1234); // WHERE id_touch = 1234
     * $query->filterByIdTouch(array(12, 34), Criteria::IN); // WHERE id_touch IN (12, 34)
     * $query->filterByIdTouch(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_touch > 12
     * </code>
     *
     * @param     mixed $idTouch The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdTouch($idTouch = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idTouch)) {
            $useMinMax = false;
            if (isset($idTouch['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyTouchTableMap::COL_ID_TOUCH, $idTouch['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idTouch['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyTouchTableMap::COL_ID_TOUCH, $idTouch['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idTouch of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyTouchTableMap::COL_ID_TOUCH, $idTouch, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $itemTypes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByItemType_In(array $itemTypes)
    {
        return $this->filterByItemType($itemTypes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $itemType Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByItemType_Like($itemType)
    {
        return $this->filterByItemType($itemType, Criteria::LIKE);
    }

    /**
     * Filter the query on the item_type column
     *
     * Example usage:
     * <code>
     * $query->filterByItemType('fooValue');   // WHERE item_type = 'fooValue'
     * $query->filterByItemType('%fooValue%', Criteria::LIKE); // WHERE item_type LIKE '%fooValue%'
     * $query->filterByItemType([1, 'foo'], Criteria::IN); // WHERE item_type IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $itemType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByItemType($itemType = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $itemType = str_replace('*', '%', $itemType);
        }

        if (is_array($itemType) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$itemType of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyTouchTableMap::COL_ITEM_TYPE, $itemType, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $itemEvents Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByItemEvent_In(array $itemEvents)
    {
        return $this->filterByItemEvent($itemEvents, Criteria::IN);
    }

    /**
     * Filter the query on the item_event column
     *
     * @param     mixed $itemEvent The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByItemEvent($itemEvent = null, $comparison = Criteria::EQUAL)
    {
        $valueSet = SpyTouchTableMap::getValueSet(SpyTouchTableMap::COL_ITEM_EVENT);
        if (is_scalar($itemEvent)) {
            if (!in_array($itemEvent, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $itemEvent));
            }
            $itemEvent = array_search($itemEvent, $valueSet);
        } elseif (is_array($itemEvent)) {
            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
            $convertedValues = array();
            foreach ($itemEvent as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $itemEvent = $convertedValues;
        }

        $query = $this->addUsingAlias(SpyTouchTableMap::COL_ITEM_EVENT, $itemEvent, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $itemId Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByItemId_Between(array $itemId)
    {
        return $this->filterByItemId($itemId, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $itemIds Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByItemId_In(array $itemIds)
    {
        return $this->filterByItemId($itemIds, Criteria::IN);
    }

    /**
     * Filter the query on the item_id column
     *
     * Example usage:
     * <code>
     * $query->filterByItemId(1234); // WHERE item_id = 1234
     * $query->filterByItemId(array(12, 34), Criteria::IN); // WHERE item_id IN (12, 34)
     * $query->filterByItemId(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE item_id > 12
     * </code>
     *
     * @param     mixed $itemId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByItemId($itemId = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($itemId)) {
            $useMinMax = false;
            if (isset($itemId['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyTouchTableMap::COL_ITEM_ID, $itemId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itemId['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyTouchTableMap::COL_ITEM_ID, $itemId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$itemId of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyTouchTableMap::COL_ITEM_ID, $itemId, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $touched Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTouched_Between(array $touched)
    {
        return $this->filterByTouched($touched, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $toucheds Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTouched_In(array $toucheds)
    {
        return $this->filterByTouched($toucheds, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $touched Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTouched_Like($touched)
    {
        return $this->filterByTouched($touched, Criteria::LIKE);
    }

    /**
     * Filter the query on the touched column
     *
     * Example usage:
     * <code>
     * $query->filterByTouched('2011-03-14'); // WHERE touched = '2011-03-14'
     * $query->filterByTouched('now'); // WHERE touched = '2011-03-14'
     * $query->filterByTouched(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE touched > '2011-03-13'
     * </code>
     *
     * @param     mixed $touched The value to use as filter.
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
    public function filterByTouched($touched = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($touched)) {
            $useMinMax = false;
            if (isset($touched['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyTouchTableMap::COL_TOUCHED, $touched['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($touched['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyTouchTableMap::COL_TOUCHED, $touched['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$touched of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyTouchTableMap::COL_TOUCHED, $touched, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Touch\Persistence\SpyTouchStorage object
     *
     * @param \Orm\Zed\Touch\Persistence\SpyTouchStorage|ObjectCollection $spyTouchStorage the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTouchStorage($spyTouchStorage, ?string $comparison = null)
    {
        if ($spyTouchStorage instanceof \Orm\Zed\Touch\Persistence\SpyTouchStorage) {
            $this
                ->addUsingAlias(SpyTouchTableMap::COL_ID_TOUCH, $spyTouchStorage->getFkTouch(), $comparison);

            return $this;
        } elseif ($spyTouchStorage instanceof ObjectCollection) {
            $this
                ->useTouchStorageQuery()
                ->filterByPrimaryKeys($spyTouchStorage->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTouchStorage() only accepts arguments of type \Orm\Zed\Touch\Persistence\SpyTouchStorage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TouchStorage relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTouchStorage(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TouchStorage');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'TouchStorage');
        }

        return $this;
    }

    /**
     * Use the TouchStorage relation SpyTouchStorage object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery A secondary query class using the current class as primary query
     */
    public function useTouchStorageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTouchStorage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TouchStorage', '\Orm\Zed\Touch\Persistence\SpyTouchStorageQuery');
    }

    /**
     * Use the TouchStorage relation SpyTouchStorage object
     *
     * @param callable(\Orm\Zed\Touch\Persistence\SpyTouchStorageQuery):\Orm\Zed\Touch\Persistence\SpyTouchStorageQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTouchStorageQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTouchStorageQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the TouchStorage relation to the SpyTouchStorage table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery The inner query object of the EXISTS statement
     */
    public function useTouchStorageExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('TouchStorage', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the TouchStorage relation to the SpyTouchStorage table for a NOT EXISTS query.
     *
     * @see useTouchStorageExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery The inner query object of the NOT EXISTS statement
     */
    public function useTouchStorageNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('TouchStorage', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Orm\Zed\Touch\Persistence\SpyTouchSearch object
     *
     * @param \Orm\Zed\Touch\Persistence\SpyTouchSearch|ObjectCollection $spyTouchSearch the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTouchSearch($spyTouchSearch, ?string $comparison = null)
    {
        if ($spyTouchSearch instanceof \Orm\Zed\Touch\Persistence\SpyTouchSearch) {
            $this
                ->addUsingAlias(SpyTouchTableMap::COL_ID_TOUCH, $spyTouchSearch->getFkTouch(), $comparison);

            return $this;
        } elseif ($spyTouchSearch instanceof ObjectCollection) {
            $this
                ->useTouchSearchQuery()
                ->filterByPrimaryKeys($spyTouchSearch->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTouchSearch() only accepts arguments of type \Orm\Zed\Touch\Persistence\SpyTouchSearch or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TouchSearch relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTouchSearch(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TouchSearch');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'TouchSearch');
        }

        return $this;
    }

    /**
     * Use the TouchSearch relation SpyTouchSearch object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery A secondary query class using the current class as primary query
     */
    public function useTouchSearchQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTouchSearch($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TouchSearch', '\Orm\Zed\Touch\Persistence\SpyTouchSearchQuery');
    }

    /**
     * Use the TouchSearch relation SpyTouchSearch object
     *
     * @param callable(\Orm\Zed\Touch\Persistence\SpyTouchSearchQuery):\Orm\Zed\Touch\Persistence\SpyTouchSearchQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTouchSearchQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTouchSearchQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the TouchSearch relation to the SpyTouchSearch table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery The inner query object of the EXISTS statement
     */
    public function useTouchSearchExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('TouchSearch', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the TouchSearch relation to the SpyTouchSearch table for a NOT EXISTS query.
     *
     * @see useTouchSearchExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery The inner query object of the NOT EXISTS statement
     */
    public function useTouchSearchNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('TouchSearch', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildSpyTouch $spyTouch Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyTouch = null)
    {
        if ($spyTouch) {
            $this->addUsingAlias(SpyTouchTableMap::COL_ID_TOUCH, $spyTouch->getIdTouch(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the spy_touch table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyTouchTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyTouchTableMap::clearInstancePool();
            SpyTouchTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyTouchTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyTouchTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyTouchTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyTouchTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // query_cache behavior

    public function setQueryKey($key)
    {
        $this->queryKey = $key;

        return $this;
    }

    public function getQueryKey()
    {
        return $this->queryKey;
    }

    public function cacheContains($key)
    {
        throw new PropelException('You must override the cacheContains(), cacheStore(), and cacheFetch() methods to enable query cache');
    }

    public function cacheFetch($key)
    {
        throw new PropelException('You must override the cacheContains(), cacheStore(), and cacheFetch() methods to enable query cache');
    }

    public function cacheStore($key, $value, $lifetime = 3600)
    {
        throw new PropelException('You must override the cacheContains(), cacheStore(), and cacheFetch() methods to enable query cache');
    }

    public function doSelect(?ConnectionInterface $con = null): \Propel\Runtime\DataFetcher\DataFetcherInterface
    {
        // check that the columns of the main class are already added (if this is the primary ModelCriteria)
        if (!$this->hasSelectClause() && !$this->getPrimaryCriteria()) {
            $this->addSelfSelectColumns();
        }
        $this->configureSelectColumns();

        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SpyTouchTableMap::DATABASE_NAME);
        $db = Propel::getServiceContainer()->getAdapter(SpyTouchTableMap::DATABASE_NAME);

        $key = $this->getQueryKey();
        if ($key && $this->cacheContains($key)) {
            $params = $this->getParams();
            $sql = $this->cacheFetch($key);
        } else {
            $params = [];
            $sql = $this->createSelectSql($params);
        }

        try {
            $stmt = $con->prepare($sql);
            $db->bindValues($stmt, $params, $dbMap);
            $stmt->execute();
            } catch (Exception $e) {
                Propel::log($e->getMessage(), Propel::LOG_ERR);
                throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
            }

        if ($key && !$this->cacheContains($key)) {
                $this->cacheStore($key, $sql);
        }

        return $con->getDataFetcher($stmt);
    }

    public function doCount(?ConnectionInterface $con = null): \Propel\Runtime\DataFetcher\DataFetcherInterface
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap($this->getDbName());
        $db = Propel::getServiceContainer()->getAdapter($this->getDbName());

        $key = $this->getQueryKey();
        if ($key && $this->cacheContains($key)) {
            $params = $this->getParams();
            $sql = $this->cacheFetch($key);
        } else {
            // check that the columns of the main class are already added (if this is the primary ModelCriteria)
            if (!$this->hasSelectClause() && !$this->getPrimaryCriteria()) {
                $this->addSelfSelectColumns();
            }

            $this->configureSelectColumns();

            $needsComplexCount = $this->getGroupByColumns()
                || $this->getOffset()
                || $this->getLimit() >= 0
                || $this->getHaving()
                || in_array(Criteria::DISTINCT, $this->getSelectModifiers())
                || count($this->selectQueries) > 0
            ;

            $params = [];
            if ($needsComplexCount) {
                if ($this->needsSelectAliases()) {
                    if ($this->getHaving()) {
                        throw new PropelException('Propel cannot create a COUNT query when using HAVING and  duplicate column names in the SELECT part');
                    }
                    $db->turnSelectColumnsToAliases($this);
                }
                $selectSql = $this->createSelectSql($params);
                $sql = 'SELECT COUNT(*) FROM (' . $selectSql . ') propelmatch4cnt';
            } else {
                // Replace SELECT columns with COUNT(*)
                $this->clearSelectColumns()->addSelectColumn('COUNT(*)');
                $sql = $this->createSelectSql($params);
            }
        }

        try {
            $stmt = $con->prepare($sql);
            $db->bindValues($stmt, $params, $dbMap);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute COUNT statement [%s]', $sql), 0, $e);
        }

        if ($key && !$this->cacheContains($key)) {
                $this->cacheStore($key, $sql);
        }

        return $con->getDataFetcher($stmt);
    }

}
