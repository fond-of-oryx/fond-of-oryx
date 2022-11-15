<?php

namespace Orm\Zed\Glossary\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Glossary\Persistence\SpyGlossaryKey as ChildSpyGlossaryKey;
use Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery as ChildSpyGlossaryKeyQuery;
use Orm\Zed\Glossary\Persistence\Map\SpyGlossaryKeyTableMap;
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
 * Base class that represents a query for the 'spy_glossary_key' table.
 *
 *
 *
 * @method     ChildSpyGlossaryKeyQuery orderByIdGlossaryKey($order = Criteria::ASC) Order by the id_glossary_key column
 * @method     ChildSpyGlossaryKeyQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method     ChildSpyGlossaryKeyQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 *
 * @method     ChildSpyGlossaryKeyQuery groupByIdGlossaryKey() Group by the id_glossary_key column
 * @method     ChildSpyGlossaryKeyQuery groupByKey() Group by the key column
 * @method     ChildSpyGlossaryKeyQuery groupByIsActive() Group by the is_active column
 *
 * @method     ChildSpyGlossaryKeyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyGlossaryKeyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyGlossaryKeyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyGlossaryKeyQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyGlossaryKeyQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyGlossaryKeyQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyGlossaryKeyQuery leftJoinSpyGlossaryTranslation($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyGlossaryTranslation relation
 * @method     ChildSpyGlossaryKeyQuery rightJoinSpyGlossaryTranslation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyGlossaryTranslation relation
 * @method     ChildSpyGlossaryKeyQuery innerJoinSpyGlossaryTranslation($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyGlossaryTranslation relation
 *
 * @method     ChildSpyGlossaryKeyQuery joinWithSpyGlossaryTranslation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyGlossaryTranslation relation
 *
 * @method     ChildSpyGlossaryKeyQuery leftJoinWithSpyGlossaryTranslation() Adds a LEFT JOIN clause and with to the query using the SpyGlossaryTranslation relation
 * @method     ChildSpyGlossaryKeyQuery rightJoinWithSpyGlossaryTranslation() Adds a RIGHT JOIN clause and with to the query using the SpyGlossaryTranslation relation
 * @method     ChildSpyGlossaryKeyQuery innerJoinWithSpyGlossaryTranslation() Adds a INNER JOIN clause and with to the query using the SpyGlossaryTranslation relation
 *
 * @method     \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyGlossaryKey|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyGlossaryKey matching the query
 * @method     ChildSpyGlossaryKey findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyGlossaryKey matching the query, or a new ChildSpyGlossaryKey object populated from the query conditions when no match is found
 *
 * @method     ChildSpyGlossaryKey|null findOneByIdGlossaryKey(int $id_glossary_key) Return the first ChildSpyGlossaryKey filtered by the id_glossary_key column
 * @method     ChildSpyGlossaryKey|null findOneByKey(string $key) Return the first ChildSpyGlossaryKey filtered by the key column
 * @method     ChildSpyGlossaryKey|null findOneByIsActive(boolean $is_active) Return the first ChildSpyGlossaryKey filtered by the is_active column *

 * @method     ChildSpyGlossaryKey requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyGlossaryKey by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyGlossaryKey requireOne(?ConnectionInterface $con = null) Return the first ChildSpyGlossaryKey matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyGlossaryKey requireOneByIdGlossaryKey(int $id_glossary_key) Return the first ChildSpyGlossaryKey filtered by the id_glossary_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyGlossaryKey requireOneByKey(string $key) Return the first ChildSpyGlossaryKey filtered by the key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyGlossaryKey requireOneByIsActive(boolean $is_active) Return the first ChildSpyGlossaryKey filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyGlossaryKey[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyGlossaryKey objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyGlossaryKey> find(?ConnectionInterface $con = null) Return ChildSpyGlossaryKey objects based on current ModelCriteria
 * @method     ChildSpyGlossaryKey[]|Collection findByIdGlossaryKey(int $id_glossary_key) Return ChildSpyGlossaryKey objects filtered by the id_glossary_key column
 * @psalm-method Collection&\Traversable<ChildSpyGlossaryKey> findByIdGlossaryKey(int $id_glossary_key) Return ChildSpyGlossaryKey objects filtered by the id_glossary_key column
 * @method     ChildSpyGlossaryKey[]|Collection findByKey(string $key) Return ChildSpyGlossaryKey objects filtered by the key column
 * @psalm-method Collection&\Traversable<ChildSpyGlossaryKey> findByKey(string $key) Return ChildSpyGlossaryKey objects filtered by the key column
 * @method     ChildSpyGlossaryKey[]|Collection findByIsActive(boolean $is_active) Return ChildSpyGlossaryKey objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyGlossaryKey> findByIsActive(boolean $is_active) Return ChildSpyGlossaryKey objects filtered by the is_active column
 * @method     ChildSpyGlossaryKey[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyGlossaryKey> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SpyGlossaryKeyQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Glossary\Persistence\Base\SpyGlossaryKeyQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Glossary\\Persistence\\SpyGlossaryKey', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyGlossaryKeyQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyGlossaryKeyQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyGlossaryKeyQuery) {
            return $criteria;
        }
        $query = new ChildSpyGlossaryKeyQuery();
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
     * @return ChildSpyGlossaryKey|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyGlossaryKeyTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyGlossaryKey A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT [id_glossary_key], [key], [is_active] FROM [spy_glossary_key] WHERE [id_glossary_key] = :p0';
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
            /** @var ChildSpyGlossaryKey $obj */
            $obj = new ChildSpyGlossaryKey();
            $obj->hydrate($row);
            SpyGlossaryKeyTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyGlossaryKey|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyGlossaryKeyTableMap::COL_ID_GLOSSARY_KEY, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyGlossaryKeyTableMap::COL_ID_GLOSSARY_KEY, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idGlossaryKey Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdGlossaryKey_Between(array $idGlossaryKey)
    {
        return $this->filterByIdGlossaryKey($idGlossaryKey, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idGlossaryKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdGlossaryKey_In(array $idGlossaryKeys)
    {
        return $this->filterByIdGlossaryKey($idGlossaryKeys, Criteria::IN);
    }

    /**
     * Filter the query on the id_glossary_key column
     *
     * Example usage:
     * <code>
     * $query->filterByIdGlossaryKey(1234); // WHERE id_glossary_key = 1234
     * $query->filterByIdGlossaryKey(array(12, 34), Criteria::IN); // WHERE id_glossary_key IN (12, 34)
     * $query->filterByIdGlossaryKey(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_glossary_key > 12
     * </code>
     *
     * @param     mixed $idGlossaryKey The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdGlossaryKey($idGlossaryKey = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idGlossaryKey)) {
            $useMinMax = false;
            if (isset($idGlossaryKey['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyGlossaryKeyTableMap::COL_ID_GLOSSARY_KEY, $idGlossaryKey['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idGlossaryKey['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyGlossaryKeyTableMap::COL_ID_GLOSSARY_KEY, $idGlossaryKey['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idGlossaryKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyGlossaryKeyTableMap::COL_ID_GLOSSARY_KEY, $idGlossaryKey, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $keys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByKey_In(array $keys)
    {
        return $this->filterByKey($keys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $key Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByKey_Like($key)
    {
        return $this->filterByKey($key, Criteria::LIKE);
    }

    /**
     * Filter the query on the key column
     *
     * Example usage:
     * <code>
     * $query->filterByKey('fooValue');   // WHERE key = 'fooValue'
     * $query->filterByKey('%fooValue%', Criteria::LIKE); // WHERE key LIKE '%fooValue%'
     * $query->filterByKey([1, 'foo'], Criteria::IN); // WHERE key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $key The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByKey($key = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $key = str_replace('*', '%', $key);
        }

        if (is_array($key) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$key of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyGlossaryKeyTableMap::COL_KEY, $key, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByIsActive(true); // WHERE is_active = true
     * $query->filterByIsActive('yes'); // WHERE is_active = true
     * </code>
     *
     * @param     bool|string $isActive The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIsActive($isActive = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isActive)) {
            $isActive = in_array(strtolower($isActive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyGlossaryKeyTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation object
     *
     * @param \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation|ObjectCollection $spyGlossaryTranslation the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyGlossaryTranslation($spyGlossaryTranslation, ?string $comparison = null)
    {
        if ($spyGlossaryTranslation instanceof \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation) {
            $this
                ->addUsingAlias(SpyGlossaryKeyTableMap::COL_ID_GLOSSARY_KEY, $spyGlossaryTranslation->getFkGlossaryKey(), $comparison);

            return $this;
        } elseif ($spyGlossaryTranslation instanceof ObjectCollection) {
            $this
                ->useSpyGlossaryTranslationQuery()
                ->filterByPrimaryKeys($spyGlossaryTranslation->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyGlossaryTranslation() only accepts arguments of type \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyGlossaryTranslation relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyGlossaryTranslation(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyGlossaryTranslation');

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
            $this->addJoinObject($join, 'SpyGlossaryTranslation');
        }

        return $this;
    }

    /**
     * Use the SpyGlossaryTranslation relation SpyGlossaryTranslation object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery A secondary query class using the current class as primary query
     */
    public function useSpyGlossaryTranslationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyGlossaryTranslation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyGlossaryTranslation', '\Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery');
    }

    /**
     * Use the SpyGlossaryTranslation relation SpyGlossaryTranslation object
     *
     * @param callable(\Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery):\Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyGlossaryTranslationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyGlossaryTranslationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to SpyGlossaryTranslation table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery The inner query object of the EXISTS statement
     */
    public function useSpyGlossaryTranslationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('SpyGlossaryTranslation', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to SpyGlossaryTranslation table for a NOT EXISTS query.
     *
     * @see useSpyGlossaryTranslationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyGlossaryTranslationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('SpyGlossaryTranslation', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildSpyGlossaryKey $spyGlossaryKey Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyGlossaryKey = null)
    {
        if ($spyGlossaryKey) {
            $this->addUsingAlias(SpyGlossaryKeyTableMap::COL_ID_GLOSSARY_KEY, $spyGlossaryKey->getIdGlossaryKey(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the spy_glossary_key table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyGlossaryKeyTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyGlossaryKeyTableMap::clearInstancePool();
            SpyGlossaryKeyTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyGlossaryKeyTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyGlossaryKeyTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyGlossaryKeyTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyGlossaryKeyTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
