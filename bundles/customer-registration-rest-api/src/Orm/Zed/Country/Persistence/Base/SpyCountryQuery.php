<?php

namespace Orm\Zed\Country\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Country\Persistence\SpyCountry as ChildSpyCountry;
use Orm\Zed\Country\Persistence\SpyCountryQuery as ChildSpyCountryQuery;
use Orm\Zed\Country\Persistence\Map\SpyCountryTableMap;
use Orm\Zed\Customer\Persistence\SpyCustomerAddress;
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
 * Base class that represents a query for the 'spy_country' table.
 *
 *
 *
 * @method     ChildSpyCountryQuery orderByIdCountry($order = Criteria::ASC) Order by the id_country column
 * @method     ChildSpyCountryQuery orderByIso2Code($order = Criteria::ASC) Order by the iso2_code column
 * @method     ChildSpyCountryQuery orderByIso3Code($order = Criteria::ASC) Order by the iso3_code column
 * @method     ChildSpyCountryQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyCountryQuery orderByPostalCodeMandatory($order = Criteria::ASC) Order by the postal_code_mandatory column
 * @method     ChildSpyCountryQuery orderByPostalCodeRegex($order = Criteria::ASC) Order by the postal_code_regex column
 *
 * @method     ChildSpyCountryQuery groupByIdCountry() Group by the id_country column
 * @method     ChildSpyCountryQuery groupByIso2Code() Group by the iso2_code column
 * @method     ChildSpyCountryQuery groupByIso3Code() Group by the iso3_code column
 * @method     ChildSpyCountryQuery groupByName() Group by the name column
 * @method     ChildSpyCountryQuery groupByPostalCodeMandatory() Group by the postal_code_mandatory column
 * @method     ChildSpyCountryQuery groupByPostalCodeRegex() Group by the postal_code_regex column
 *
 * @method     ChildSpyCountryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCountryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCountryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCountryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCountryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCountryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCountryQuery leftJoinSpyRegion($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyRegion relation
 * @method     ChildSpyCountryQuery rightJoinSpyRegion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyRegion relation
 * @method     ChildSpyCountryQuery innerJoinSpyRegion($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyRegion relation
 *
 * @method     ChildSpyCountryQuery joinWithSpyRegion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyRegion relation
 *
 * @method     ChildSpyCountryQuery leftJoinWithSpyRegion() Adds a LEFT JOIN clause and with to the query using the SpyRegion relation
 * @method     ChildSpyCountryQuery rightJoinWithSpyRegion() Adds a RIGHT JOIN clause and with to the query using the SpyRegion relation
 * @method     ChildSpyCountryQuery innerJoinWithSpyRegion() Adds a INNER JOIN clause and with to the query using the SpyRegion relation
 *
 * @method     ChildSpyCountryQuery leftJoinCustomerAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the CustomerAddress relation
 * @method     ChildSpyCountryQuery rightJoinCustomerAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CustomerAddress relation
 * @method     ChildSpyCountryQuery innerJoinCustomerAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the CustomerAddress relation
 *
 * @method     ChildSpyCountryQuery joinWithCustomerAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CustomerAddress relation
 *
 * @method     ChildSpyCountryQuery leftJoinWithCustomerAddress() Adds a LEFT JOIN clause and with to the query using the CustomerAddress relation
 * @method     ChildSpyCountryQuery rightJoinWithCustomerAddress() Adds a RIGHT JOIN clause and with to the query using the CustomerAddress relation
 * @method     ChildSpyCountryQuery innerJoinWithCustomerAddress() Adds a INNER JOIN clause and with to the query using the CustomerAddress relation
 *
 * @method     \Orm\Zed\Country\Persistence\SpyRegionQuery|\Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyCountry|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCountry matching the query
 * @method     ChildSpyCountry findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCountry matching the query, or a new ChildSpyCountry object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCountry|null findOneByIdCountry(int $id_country) Return the first ChildSpyCountry filtered by the id_country column
 * @method     ChildSpyCountry|null findOneByIso2Code(string $iso2_code) Return the first ChildSpyCountry filtered by the iso2_code column
 * @method     ChildSpyCountry|null findOneByIso3Code(string $iso3_code) Return the first ChildSpyCountry filtered by the iso3_code column
 * @method     ChildSpyCountry|null findOneByName(string $name) Return the first ChildSpyCountry filtered by the name column
 * @method     ChildSpyCountry|null findOneByPostalCodeMandatory(boolean $postal_code_mandatory) Return the first ChildSpyCountry filtered by the postal_code_mandatory column
 * @method     ChildSpyCountry|null findOneByPostalCodeRegex(string $postal_code_regex) Return the first ChildSpyCountry filtered by the postal_code_regex column *

 * @method     ChildSpyCountry requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCountry by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCountry requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCountry matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCountry requireOneByIdCountry(int $id_country) Return the first ChildSpyCountry filtered by the id_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCountry requireOneByIso2Code(string $iso2_code) Return the first ChildSpyCountry filtered by the iso2_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCountry requireOneByIso3Code(string $iso3_code) Return the first ChildSpyCountry filtered by the iso3_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCountry requireOneByName(string $name) Return the first ChildSpyCountry filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCountry requireOneByPostalCodeMandatory(boolean $postal_code_mandatory) Return the first ChildSpyCountry filtered by the postal_code_mandatory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCountry requireOneByPostalCodeRegex(string $postal_code_regex) Return the first ChildSpyCountry filtered by the postal_code_regex column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCountry[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCountry objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCountry> find(?ConnectionInterface $con = null) Return ChildSpyCountry objects based on current ModelCriteria
 * @method     ChildSpyCountry[]|Collection findByIdCountry(int $id_country) Return ChildSpyCountry objects filtered by the id_country column
 * @psalm-method Collection&\Traversable<ChildSpyCountry> findByIdCountry(int $id_country) Return ChildSpyCountry objects filtered by the id_country column
 * @method     ChildSpyCountry[]|Collection findByIso2Code(string $iso2_code) Return ChildSpyCountry objects filtered by the iso2_code column
 * @psalm-method Collection&\Traversable<ChildSpyCountry> findByIso2Code(string $iso2_code) Return ChildSpyCountry objects filtered by the iso2_code column
 * @method     ChildSpyCountry[]|Collection findByIso3Code(string $iso3_code) Return ChildSpyCountry objects filtered by the iso3_code column
 * @psalm-method Collection&\Traversable<ChildSpyCountry> findByIso3Code(string $iso3_code) Return ChildSpyCountry objects filtered by the iso3_code column
 * @method     ChildSpyCountry[]|Collection findByName(string $name) Return ChildSpyCountry objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyCountry> findByName(string $name) Return ChildSpyCountry objects filtered by the name column
 * @method     ChildSpyCountry[]|Collection findByPostalCodeMandatory(boolean $postal_code_mandatory) Return ChildSpyCountry objects filtered by the postal_code_mandatory column
 * @psalm-method Collection&\Traversable<ChildSpyCountry> findByPostalCodeMandatory(boolean $postal_code_mandatory) Return ChildSpyCountry objects filtered by the postal_code_mandatory column
 * @method     ChildSpyCountry[]|Collection findByPostalCodeRegex(string $postal_code_regex) Return ChildSpyCountry objects filtered by the postal_code_regex column
 * @psalm-method Collection&\Traversable<ChildSpyCountry> findByPostalCodeRegex(string $postal_code_regex) Return ChildSpyCountry objects filtered by the postal_code_regex column
 * @method     ChildSpyCountry[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCountry> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SpyCountryQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Country\Persistence\Base\SpyCountryQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Country\\Persistence\\SpyCountry', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCountryQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCountryQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCountryQuery) {
            return $criteria;
        }
        $query = new ChildSpyCountryQuery();
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
     * @return ChildSpyCountry|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCountryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyCountry A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_country, iso2_code, iso3_code, name, postal_code_mandatory, postal_code_regex FROM spy_country WHERE id_country = :p0';
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
            /** @var ChildSpyCountry $obj */
            $obj = new ChildSpyCountry();
            $obj->hydrate($row);
            SpyCountryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyCountry|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCountry Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCountry_Between(array $idCountry)
    {
        return $this->filterByIdCountry($idCountry, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCountrys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCountry_In(array $idCountrys)
    {
        return $this->filterByIdCountry($idCountrys, Criteria::IN);
    }

    /**
     * Filter the query on the id_country column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCountry(1234); // WHERE id_country = 1234
     * $query->filterByIdCountry(array(12, 34), Criteria::IN); // WHERE id_country IN (12, 34)
     * $query->filterByIdCountry(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_country > 12
     * </code>
     *
     * @param     mixed $idCountry The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCountry($idCountry = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCountry)) {
            $useMinMax = false;
            if (isset($idCountry['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $idCountry['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCountry['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $idCountry['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCountry of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $idCountry, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $iso2Codes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIso2Code_In(array $iso2Codes)
    {
        return $this->filterByIso2Code($iso2Codes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $iso2Code Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIso2Code_Like($iso2Code)
    {
        return $this->filterByIso2Code($iso2Code, Criteria::LIKE);
    }

    /**
     * Filter the query on the iso2_code column
     *
     * Example usage:
     * <code>
     * $query->filterByIso2Code('fooValue');   // WHERE iso2_code = 'fooValue'
     * $query->filterByIso2Code('%fooValue%', Criteria::LIKE); // WHERE iso2_code LIKE '%fooValue%'
     * $query->filterByIso2Code([1, 'foo'], Criteria::IN); // WHERE iso2_code IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $iso2Code The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIso2Code($iso2Code = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $iso2Code = str_replace('*', '%', $iso2Code);
        }

        if (is_array($iso2Code) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$iso2Code of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCountryTableMap::COL_ISO2_CODE, $iso2Code, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $iso3Codes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIso3Code_In(array $iso3Codes)
    {
        return $this->filterByIso3Code($iso3Codes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $iso3Code Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIso3Code_Like($iso3Code)
    {
        return $this->filterByIso3Code($iso3Code, Criteria::LIKE);
    }

    /**
     * Filter the query on the iso3_code column
     *
     * Example usage:
     * <code>
     * $query->filterByIso3Code('fooValue');   // WHERE iso3_code = 'fooValue'
     * $query->filterByIso3Code('%fooValue%', Criteria::LIKE); // WHERE iso3_code LIKE '%fooValue%'
     * $query->filterByIso3Code([1, 'foo'], Criteria::IN); // WHERE iso3_code IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $iso3Code The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIso3Code($iso3Code = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $iso3Code = str_replace('*', '%', $iso3Code);
        }

        if (is_array($iso3Code) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$iso3Code of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCountryTableMap::COL_ISO3_CODE, $iso3Code, $comparison);

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

        $query = $this->addUsingAlias(SpyCountryTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Filter the query on the postal_code_mandatory column
     *
     * Example usage:
     * <code>
     * $query->filterByPostalCodeMandatory(true); // WHERE postal_code_mandatory = true
     * $query->filterByPostalCodeMandatory('yes'); // WHERE postal_code_mandatory = true
     * </code>
     *
     * @param     bool|string $postalCodeMandatory The value to use as filter.
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
    public function filterByPostalCodeMandatory($postalCodeMandatory = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($postalCodeMandatory)) {
            $postalCodeMandatory = in_array(strtolower($postalCodeMandatory), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyCountryTableMap::COL_POSTAL_CODE_MANDATORY, $postalCodeMandatory, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $postalCodeRegexs Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPostalCodeRegex_In(array $postalCodeRegexs)
    {
        return $this->filterByPostalCodeRegex($postalCodeRegexs, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $postalCodeRegex Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPostalCodeRegex_Like($postalCodeRegex)
    {
        return $this->filterByPostalCodeRegex($postalCodeRegex, Criteria::LIKE);
    }

    /**
     * Filter the query on the postal_code_regex column
     *
     * Example usage:
     * <code>
     * $query->filterByPostalCodeRegex('fooValue');   // WHERE postal_code_regex = 'fooValue'
     * $query->filterByPostalCodeRegex('%fooValue%', Criteria::LIKE); // WHERE postal_code_regex LIKE '%fooValue%'
     * $query->filterByPostalCodeRegex([1, 'foo'], Criteria::IN); // WHERE postal_code_regex IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $postalCodeRegex The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPostalCodeRegex($postalCodeRegex = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $postalCodeRegex = str_replace('*', '%', $postalCodeRegex);
        }

        if (is_array($postalCodeRegex) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$postalCodeRegex of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCountryTableMap::COL_POSTAL_CODE_REGEX, $postalCodeRegex, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Country\Persistence\SpyRegion object
     *
     * @param \Orm\Zed\Country\Persistence\SpyRegion|ObjectCollection $spyRegion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyRegion($spyRegion, ?string $comparison = null)
    {
        if ($spyRegion instanceof \Orm\Zed\Country\Persistence\SpyRegion) {
            $this
                ->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $spyRegion->getFkCountry(), $comparison);

            return $this;
        } elseif ($spyRegion instanceof ObjectCollection) {
            $this
                ->useSpyRegionQuery()
                ->filterByPrimaryKeys($spyRegion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyRegion() only accepts arguments of type \Orm\Zed\Country\Persistence\SpyRegion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyRegion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyRegion(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyRegion');

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
            $this->addJoinObject($join, 'SpyRegion');
        }

        return $this;
    }

    /**
     * Use the SpyRegion relation SpyRegion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery A secondary query class using the current class as primary query
     */
    public function useSpyRegionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyRegion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyRegion', '\Orm\Zed\Country\Persistence\SpyRegionQuery');
    }

    /**
     * Use the SpyRegion relation SpyRegion object
     *
     * @param callable(\Orm\Zed\Country\Persistence\SpyRegionQuery):\Orm\Zed\Country\Persistence\SpyRegionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyRegionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyRegionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to SpyRegion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery The inner query object of the EXISTS statement
     */
    public function useSpyRegionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('SpyRegion', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to SpyRegion table for a NOT EXISTS query.
     *
     * @see useSpyRegionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyRegionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('SpyRegion', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Orm\Zed\Customer\Persistence\SpyCustomerAddress object
     *
     * @param \Orm\Zed\Customer\Persistence\SpyCustomerAddress|ObjectCollection $spyCustomerAddress the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCustomerAddress($spyCustomerAddress, ?string $comparison = null)
    {
        if ($spyCustomerAddress instanceof \Orm\Zed\Customer\Persistence\SpyCustomerAddress) {
            $this
                ->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $spyCustomerAddress->getFkCountry(), $comparison);

            return $this;
        } elseif ($spyCustomerAddress instanceof ObjectCollection) {
            $this
                ->useCustomerAddressQuery()
                ->filterByPrimaryKeys($spyCustomerAddress->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCustomerAddress() only accepts arguments of type \Orm\Zed\Customer\Persistence\SpyCustomerAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CustomerAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCustomerAddress(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CustomerAddress');

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
            $this->addJoinObject($join, 'CustomerAddress');
        }

        return $this;
    }

    /**
     * Use the CustomerAddress relation SpyCustomerAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery A secondary query class using the current class as primary query
     */
    public function useCustomerAddressQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCustomerAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CustomerAddress', '\Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery');
    }

    /**
     * Use the CustomerAddress relation SpyCustomerAddress object
     *
     * @param callable(\Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery):\Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCustomerAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCustomerAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the CustomerAddress relation to the SpyCustomerAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery The inner query object of the EXISTS statement
     */
    public function useCustomerAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('CustomerAddress', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the CustomerAddress relation to the SpyCustomerAddress table for a NOT EXISTS query.
     *
     * @see useCustomerAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useCustomerAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('CustomerAddress', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildSpyCountry $spyCountry Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCountry = null)
    {
        if ($spyCountry) {
            $this->addUsingAlias(SpyCountryTableMap::COL_ID_COUNTRY, $spyCountry->getIdCountry(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the spy_country table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCountryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCountryTableMap::clearInstancePool();
            SpyCountryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCountryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCountryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCountryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCountryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
