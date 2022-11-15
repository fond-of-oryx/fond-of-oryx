<?php

namespace Orm\Zed\Locale\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Customer\Persistence\SpyCustomer;
use Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation;
use Orm\Zed\Locale\Persistence\SpyLocale as ChildSpyLocale;
use Orm\Zed\Locale\Persistence\SpyLocaleQuery as ChildSpyLocaleQuery;
use Orm\Zed\Locale\Persistence\Map\SpyLocaleTableMap;
use Orm\Zed\Touch\Persistence\SpyTouchSearch;
use Orm\Zed\Touch\Persistence\SpyTouchStorage;
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
 * Base class that represents a query for the 'spy_locale' table.
 *
 *
 *
 * @method     ChildSpyLocaleQuery orderByIdLocale($order = Criteria::ASC) Order by the id_locale column
 * @method     ChildSpyLocaleQuery orderByLocaleName($order = Criteria::ASC) Order by the locale_name column
 * @method     ChildSpyLocaleQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 *
 * @method     ChildSpyLocaleQuery groupByIdLocale() Group by the id_locale column
 * @method     ChildSpyLocaleQuery groupByLocaleName() Group by the locale_name column
 * @method     ChildSpyLocaleQuery groupByIsActive() Group by the is_active column
 *
 * @method     ChildSpyLocaleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyLocaleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyLocaleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyLocaleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyLocaleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyLocaleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyCustomer($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCustomer relation
 * @method     ChildSpyLocaleQuery rightJoinSpyCustomer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCustomer relation
 * @method     ChildSpyLocaleQuery innerJoinSpyCustomer($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCustomer relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyCustomer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCustomer relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyCustomer() Adds a LEFT JOIN clause and with to the query using the SpyCustomer relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyCustomer() Adds a RIGHT JOIN clause and with to the query using the SpyCustomer relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyCustomer() Adds a INNER JOIN clause and with to the query using the SpyCustomer relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyGlossaryTranslation($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyGlossaryTranslation relation
 * @method     ChildSpyLocaleQuery rightJoinSpyGlossaryTranslation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyGlossaryTranslation relation
 * @method     ChildSpyLocaleQuery innerJoinSpyGlossaryTranslation($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyGlossaryTranslation relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyGlossaryTranslation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyGlossaryTranslation relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyGlossaryTranslation() Adds a LEFT JOIN clause and with to the query using the SpyGlossaryTranslation relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyGlossaryTranslation() Adds a RIGHT JOIN clause and with to the query using the SpyGlossaryTranslation relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyGlossaryTranslation() Adds a INNER JOIN clause and with to the query using the SpyGlossaryTranslation relation
 *
 * @method     ChildSpyLocaleQuery leftJoinTouchStorage($relationAlias = null) Adds a LEFT JOIN clause to the query using the TouchStorage relation
 * @method     ChildSpyLocaleQuery rightJoinTouchStorage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TouchStorage relation
 * @method     ChildSpyLocaleQuery innerJoinTouchStorage($relationAlias = null) Adds a INNER JOIN clause to the query using the TouchStorage relation
 *
 * @method     ChildSpyLocaleQuery joinWithTouchStorage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TouchStorage relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithTouchStorage() Adds a LEFT JOIN clause and with to the query using the TouchStorage relation
 * @method     ChildSpyLocaleQuery rightJoinWithTouchStorage() Adds a RIGHT JOIN clause and with to the query using the TouchStorage relation
 * @method     ChildSpyLocaleQuery innerJoinWithTouchStorage() Adds a INNER JOIN clause and with to the query using the TouchStorage relation
 *
 * @method     ChildSpyLocaleQuery leftJoinTouchSearch($relationAlias = null) Adds a LEFT JOIN clause to the query using the TouchSearch relation
 * @method     ChildSpyLocaleQuery rightJoinTouchSearch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TouchSearch relation
 * @method     ChildSpyLocaleQuery innerJoinTouchSearch($relationAlias = null) Adds a INNER JOIN clause to the query using the TouchSearch relation
 *
 * @method     ChildSpyLocaleQuery joinWithTouchSearch($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TouchSearch relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithTouchSearch() Adds a LEFT JOIN clause and with to the query using the TouchSearch relation
 * @method     ChildSpyLocaleQuery rightJoinWithTouchSearch() Adds a RIGHT JOIN clause and with to the query using the TouchSearch relation
 * @method     ChildSpyLocaleQuery innerJoinWithTouchSearch() Adds a INNER JOIN clause and with to the query using the TouchSearch relation
 *
 * @method     \Orm\Zed\Customer\Persistence\SpyCustomerQuery|\Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery|\Orm\Zed\Touch\Persistence\SpyTouchStorageQuery|\Orm\Zed\Touch\Persistence\SpyTouchSearchQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyLocale|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyLocale matching the query
 * @method     ChildSpyLocale findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyLocale matching the query, or a new ChildSpyLocale object populated from the query conditions when no match is found
 *
 * @method     ChildSpyLocale|null findOneByIdLocale(int $id_locale) Return the first ChildSpyLocale filtered by the id_locale column
 * @method     ChildSpyLocale|null findOneByLocaleName(string $locale_name) Return the first ChildSpyLocale filtered by the locale_name column
 * @method     ChildSpyLocale|null findOneByIsActive(boolean $is_active) Return the first ChildSpyLocale filtered by the is_active column *

 * @method     ChildSpyLocale requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyLocale by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyLocale requireOne(?ConnectionInterface $con = null) Return the first ChildSpyLocale matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyLocale requireOneByIdLocale(int $id_locale) Return the first ChildSpyLocale filtered by the id_locale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyLocale requireOneByLocaleName(string $locale_name) Return the first ChildSpyLocale filtered by the locale_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyLocale requireOneByIsActive(boolean $is_active) Return the first ChildSpyLocale filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyLocale[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyLocale objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyLocale> find(?ConnectionInterface $con = null) Return ChildSpyLocale objects based on current ModelCriteria
 * @method     ChildSpyLocale[]|Collection findByIdLocale(int $id_locale) Return ChildSpyLocale objects filtered by the id_locale column
 * @psalm-method Collection&\Traversable<ChildSpyLocale> findByIdLocale(int $id_locale) Return ChildSpyLocale objects filtered by the id_locale column
 * @method     ChildSpyLocale[]|Collection findByLocaleName(string $locale_name) Return ChildSpyLocale objects filtered by the locale_name column
 * @psalm-method Collection&\Traversable<ChildSpyLocale> findByLocaleName(string $locale_name) Return ChildSpyLocale objects filtered by the locale_name column
 * @method     ChildSpyLocale[]|Collection findByIsActive(boolean $is_active) Return ChildSpyLocale objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyLocale> findByIsActive(boolean $is_active) Return ChildSpyLocale objects filtered by the is_active column
 * @method     ChildSpyLocale[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyLocale> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SpyLocaleQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Locale\Persistence\Base\SpyLocaleQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Locale\\Persistence\\SpyLocale', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyLocaleQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyLocaleQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyLocaleQuery) {
            return $criteria;
        }
        $query = new ChildSpyLocaleQuery();
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
     * @return ChildSpyLocale|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyLocaleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyLocale A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_locale, locale_name, is_active FROM spy_locale WHERE id_locale = :p0';
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
            /** @var ChildSpyLocale $obj */
            $obj = new ChildSpyLocale();
            $obj->hydrate($row);
            SpyLocaleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyLocale|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idLocale Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdLocale_Between(array $idLocale)
    {
        return $this->filterByIdLocale($idLocale, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idLocales Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdLocale_In(array $idLocales)
    {
        return $this->filterByIdLocale($idLocales, Criteria::IN);
    }

    /**
     * Filter the query on the id_locale column
     *
     * Example usage:
     * <code>
     * $query->filterByIdLocale(1234); // WHERE id_locale = 1234
     * $query->filterByIdLocale(array(12, 34), Criteria::IN); // WHERE id_locale IN (12, 34)
     * $query->filterByIdLocale(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_locale > 12
     * </code>
     *
     * @param     mixed $idLocale The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdLocale($idLocale = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idLocale)) {
            $useMinMax = false;
            if (isset($idLocale['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $idLocale['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idLocale['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $idLocale['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idLocale of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $idLocale, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $localeNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocaleName_In(array $localeNames)
    {
        return $this->filterByLocaleName($localeNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $localeName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocaleName_Like($localeName)
    {
        return $this->filterByLocaleName($localeName, Criteria::LIKE);
    }

    /**
     * Filter the query on the locale_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLocaleName('fooValue');   // WHERE locale_name = 'fooValue'
     * $query->filterByLocaleName('%fooValue%', Criteria::LIKE); // WHERE locale_name LIKE '%fooValue%'
     * $query->filterByLocaleName([1, 'foo'], Criteria::IN); // WHERE locale_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $localeName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByLocaleName($localeName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $localeName = str_replace('*', '%', $localeName);
        }

        if (is_array($localeName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$localeName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyLocaleTableMap::COL_LOCALE_NAME, $localeName, $comparison);

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

        $query = $this->addUsingAlias(SpyLocaleTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Customer\Persistence\SpyCustomer object
     *
     * @param \Orm\Zed\Customer\Persistence\SpyCustomer|ObjectCollection $spyCustomer the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCustomer($spyCustomer, ?string $comparison = null)
    {
        if ($spyCustomer instanceof \Orm\Zed\Customer\Persistence\SpyCustomer) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyCustomer->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyCustomer instanceof ObjectCollection) {
            $this
                ->useSpyCustomerQuery()
                ->filterByPrimaryKeys($spyCustomer->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCustomer() only accepts arguments of type \Orm\Zed\Customer\Persistence\SpyCustomer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCustomer relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCustomer(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCustomer');

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
            $this->addJoinObject($join, 'SpyCustomer');
        }

        return $this;
    }

    /**
     * Use the SpyCustomer relation SpyCustomer object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery A secondary query class using the current class as primary query
     */
    public function useSpyCustomerQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyCustomer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCustomer', '\Orm\Zed\Customer\Persistence\SpyCustomerQuery');
    }

    /**
     * Use the SpyCustomer relation SpyCustomer object
     *
     * @param callable(\Orm\Zed\Customer\Persistence\SpyCustomerQuery):\Orm\Zed\Customer\Persistence\SpyCustomerQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCustomerQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyCustomerQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to SpyCustomer table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery The inner query object of the EXISTS statement
     */
    public function useSpyCustomerExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('SpyCustomer', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to SpyCustomer table for a NOT EXISTS query.
     *
     * @see useSpyCustomerExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCustomerNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('SpyCustomer', $modelAlias, $queryClass, 'NOT EXISTS');
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
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyGlossaryTranslation->getFkLocale(), $comparison);

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
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyTouchStorage->getFkLocale(), $comparison);

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
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyTouchSearch->getFkLocale(), $comparison);

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
     * @param ChildSpyLocale $spyLocale Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyLocale = null)
    {
        if ($spyLocale) {
            $this->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyLocale->getIdLocale(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the spy_locale table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyLocaleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyLocaleTableMap::clearInstancePool();
            SpyLocaleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyLocaleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyLocaleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyLocaleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyLocaleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
