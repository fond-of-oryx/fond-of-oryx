<?php

namespace Orm\Zed\Glossary\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation as ChildSpyGlossaryTranslation;
use Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery as ChildSpyGlossaryTranslationQuery;
use Orm\Zed\Glossary\Persistence\Map\SpyGlossaryTranslationTableMap;
use Orm\Zed\Locale\Persistence\SpyLocale;
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
 * Base class that represents a query for the 'spy_glossary_translation' table.
 *
 *
 *
 * @method     ChildSpyGlossaryTranslationQuery orderByIdGlossaryTranslation($order = Criteria::ASC) Order by the id_glossary_translation column
 * @method     ChildSpyGlossaryTranslationQuery orderByFkGlossaryKey($order = Criteria::ASC) Order by the fk_glossary_key column
 * @method     ChildSpyGlossaryTranslationQuery orderByFkLocale($order = Criteria::ASC) Order by the fk_locale column
 * @method     ChildSpyGlossaryTranslationQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method     ChildSpyGlossaryTranslationQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 *
 * @method     ChildSpyGlossaryTranslationQuery groupByIdGlossaryTranslation() Group by the id_glossary_translation column
 * @method     ChildSpyGlossaryTranslationQuery groupByFkGlossaryKey() Group by the fk_glossary_key column
 * @method     ChildSpyGlossaryTranslationQuery groupByFkLocale() Group by the fk_locale column
 * @method     ChildSpyGlossaryTranslationQuery groupByValue() Group by the value column
 * @method     ChildSpyGlossaryTranslationQuery groupByIsActive() Group by the is_active column
 *
 * @method     ChildSpyGlossaryTranslationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyGlossaryTranslationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyGlossaryTranslationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyGlossaryTranslationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyGlossaryTranslationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyGlossaryTranslationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyGlossaryTranslationQuery leftJoinGlossaryKey($relationAlias = null) Adds a LEFT JOIN clause to the query using the GlossaryKey relation
 * @method     ChildSpyGlossaryTranslationQuery rightJoinGlossaryKey($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GlossaryKey relation
 * @method     ChildSpyGlossaryTranslationQuery innerJoinGlossaryKey($relationAlias = null) Adds a INNER JOIN clause to the query using the GlossaryKey relation
 *
 * @method     ChildSpyGlossaryTranslationQuery joinWithGlossaryKey($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GlossaryKey relation
 *
 * @method     ChildSpyGlossaryTranslationQuery leftJoinWithGlossaryKey() Adds a LEFT JOIN clause and with to the query using the GlossaryKey relation
 * @method     ChildSpyGlossaryTranslationQuery rightJoinWithGlossaryKey() Adds a RIGHT JOIN clause and with to the query using the GlossaryKey relation
 * @method     ChildSpyGlossaryTranslationQuery innerJoinWithGlossaryKey() Adds a INNER JOIN clause and with to the query using the GlossaryKey relation
 *
 * @method     ChildSpyGlossaryTranslationQuery leftJoinLocale($relationAlias = null) Adds a LEFT JOIN clause to the query using the Locale relation
 * @method     ChildSpyGlossaryTranslationQuery rightJoinLocale($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Locale relation
 * @method     ChildSpyGlossaryTranslationQuery innerJoinLocale($relationAlias = null) Adds a INNER JOIN clause to the query using the Locale relation
 *
 * @method     ChildSpyGlossaryTranslationQuery joinWithLocale($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Locale relation
 *
 * @method     ChildSpyGlossaryTranslationQuery leftJoinWithLocale() Adds a LEFT JOIN clause and with to the query using the Locale relation
 * @method     ChildSpyGlossaryTranslationQuery rightJoinWithLocale() Adds a RIGHT JOIN clause and with to the query using the Locale relation
 * @method     ChildSpyGlossaryTranslationQuery innerJoinWithLocale() Adds a INNER JOIN clause and with to the query using the Locale relation
 *
 * @method     \Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery|\Orm\Zed\Locale\Persistence\SpyLocaleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyGlossaryTranslation|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyGlossaryTranslation matching the query
 * @method     ChildSpyGlossaryTranslation findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyGlossaryTranslation matching the query, or a new ChildSpyGlossaryTranslation object populated from the query conditions when no match is found
 *
 * @method     ChildSpyGlossaryTranslation|null findOneByIdGlossaryTranslation(int $id_glossary_translation) Return the first ChildSpyGlossaryTranslation filtered by the id_glossary_translation column
 * @method     ChildSpyGlossaryTranslation|null findOneByFkGlossaryKey(int $fk_glossary_key) Return the first ChildSpyGlossaryTranslation filtered by the fk_glossary_key column
 * @method     ChildSpyGlossaryTranslation|null findOneByFkLocale(int $fk_locale) Return the first ChildSpyGlossaryTranslation filtered by the fk_locale column
 * @method     ChildSpyGlossaryTranslation|null findOneByValue(string $value) Return the first ChildSpyGlossaryTranslation filtered by the value column
 * @method     ChildSpyGlossaryTranslation|null findOneByIsActive(boolean $is_active) Return the first ChildSpyGlossaryTranslation filtered by the is_active column *

 * @method     ChildSpyGlossaryTranslation requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyGlossaryTranslation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyGlossaryTranslation requireOne(?ConnectionInterface $con = null) Return the first ChildSpyGlossaryTranslation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyGlossaryTranslation requireOneByIdGlossaryTranslation(int $id_glossary_translation) Return the first ChildSpyGlossaryTranslation filtered by the id_glossary_translation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyGlossaryTranslation requireOneByFkGlossaryKey(int $fk_glossary_key) Return the first ChildSpyGlossaryTranslation filtered by the fk_glossary_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyGlossaryTranslation requireOneByFkLocale(int $fk_locale) Return the first ChildSpyGlossaryTranslation filtered by the fk_locale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyGlossaryTranslation requireOneByValue(string $value) Return the first ChildSpyGlossaryTranslation filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyGlossaryTranslation requireOneByIsActive(boolean $is_active) Return the first ChildSpyGlossaryTranslation filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyGlossaryTranslation[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyGlossaryTranslation objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyGlossaryTranslation> find(?ConnectionInterface $con = null) Return ChildSpyGlossaryTranslation objects based on current ModelCriteria
 * @method     ChildSpyGlossaryTranslation[]|Collection findByIdGlossaryTranslation(int $id_glossary_translation) Return ChildSpyGlossaryTranslation objects filtered by the id_glossary_translation column
 * @psalm-method Collection&\Traversable<ChildSpyGlossaryTranslation> findByIdGlossaryTranslation(int $id_glossary_translation) Return ChildSpyGlossaryTranslation objects filtered by the id_glossary_translation column
 * @method     ChildSpyGlossaryTranslation[]|Collection findByFkGlossaryKey(int $fk_glossary_key) Return ChildSpyGlossaryTranslation objects filtered by the fk_glossary_key column
 * @psalm-method Collection&\Traversable<ChildSpyGlossaryTranslation> findByFkGlossaryKey(int $fk_glossary_key) Return ChildSpyGlossaryTranslation objects filtered by the fk_glossary_key column
 * @method     ChildSpyGlossaryTranslation[]|Collection findByFkLocale(int $fk_locale) Return ChildSpyGlossaryTranslation objects filtered by the fk_locale column
 * @psalm-method Collection&\Traversable<ChildSpyGlossaryTranslation> findByFkLocale(int $fk_locale) Return ChildSpyGlossaryTranslation objects filtered by the fk_locale column
 * @method     ChildSpyGlossaryTranslation[]|Collection findByValue(string $value) Return ChildSpyGlossaryTranslation objects filtered by the value column
 * @psalm-method Collection&\Traversable<ChildSpyGlossaryTranslation> findByValue(string $value) Return ChildSpyGlossaryTranslation objects filtered by the value column
 * @method     ChildSpyGlossaryTranslation[]|Collection findByIsActive(boolean $is_active) Return ChildSpyGlossaryTranslation objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyGlossaryTranslation> findByIsActive(boolean $is_active) Return ChildSpyGlossaryTranslation objects filtered by the is_active column
 * @method     ChildSpyGlossaryTranslation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyGlossaryTranslation> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SpyGlossaryTranslationQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Glossary\Persistence\Base\SpyGlossaryTranslationQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Glossary\\Persistence\\SpyGlossaryTranslation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyGlossaryTranslationQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyGlossaryTranslationQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyGlossaryTranslationQuery) {
            return $criteria;
        }
        $query = new ChildSpyGlossaryTranslationQuery();
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
     * @return ChildSpyGlossaryTranslation|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyGlossaryTranslationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyGlossaryTranslation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT [id_glossary_translation], [fk_glossary_key], [fk_locale], [value], [is_active] FROM [spy_glossary_translation] WHERE [id_glossary_translation] = :p0';
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
            /** @var ChildSpyGlossaryTranslation $obj */
            $obj = new ChildSpyGlossaryTranslation();
            $obj->hydrate($row);
            SpyGlossaryTranslationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyGlossaryTranslation|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyGlossaryTranslationTableMap::COL_ID_GLOSSARY_TRANSLATION, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyGlossaryTranslationTableMap::COL_ID_GLOSSARY_TRANSLATION, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idGlossaryTranslation Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdGlossaryTranslation_Between(array $idGlossaryTranslation)
    {
        return $this->filterByIdGlossaryTranslation($idGlossaryTranslation, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idGlossaryTranslations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdGlossaryTranslation_In(array $idGlossaryTranslations)
    {
        return $this->filterByIdGlossaryTranslation($idGlossaryTranslations, Criteria::IN);
    }

    /**
     * Filter the query on the id_glossary_translation column
     *
     * Example usage:
     * <code>
     * $query->filterByIdGlossaryTranslation(1234); // WHERE id_glossary_translation = 1234
     * $query->filterByIdGlossaryTranslation(array(12, 34), Criteria::IN); // WHERE id_glossary_translation IN (12, 34)
     * $query->filterByIdGlossaryTranslation(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_glossary_translation > 12
     * </code>
     *
     * @param     mixed $idGlossaryTranslation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdGlossaryTranslation($idGlossaryTranslation = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idGlossaryTranslation)) {
            $useMinMax = false;
            if (isset($idGlossaryTranslation['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyGlossaryTranslationTableMap::COL_ID_GLOSSARY_TRANSLATION, $idGlossaryTranslation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idGlossaryTranslation['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyGlossaryTranslationTableMap::COL_ID_GLOSSARY_TRANSLATION, $idGlossaryTranslation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idGlossaryTranslation of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyGlossaryTranslationTableMap::COL_ID_GLOSSARY_TRANSLATION, $idGlossaryTranslation, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkGlossaryKey Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkGlossaryKey_Between(array $fkGlossaryKey)
    {
        return $this->filterByFkGlossaryKey($fkGlossaryKey, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkGlossaryKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkGlossaryKey_In(array $fkGlossaryKeys)
    {
        return $this->filterByFkGlossaryKey($fkGlossaryKeys, Criteria::IN);
    }

    /**
     * Filter the query on the fk_glossary_key column
     *
     * Example usage:
     * <code>
     * $query->filterByFkGlossaryKey(1234); // WHERE fk_glossary_key = 1234
     * $query->filterByFkGlossaryKey(array(12, 34), Criteria::IN); // WHERE fk_glossary_key IN (12, 34)
     * $query->filterByFkGlossaryKey(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_glossary_key > 12
     * </code>
     *
     * @see       filterByGlossaryKey()
     *
     * @param     mixed $fkGlossaryKey The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkGlossaryKey($fkGlossaryKey = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkGlossaryKey)) {
            $useMinMax = false;
            if (isset($fkGlossaryKey['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyGlossaryTranslationTableMap::COL_FK_GLOSSARY_KEY, $fkGlossaryKey['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkGlossaryKey['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyGlossaryTranslationTableMap::COL_FK_GLOSSARY_KEY, $fkGlossaryKey['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkGlossaryKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyGlossaryTranslationTableMap::COL_FK_GLOSSARY_KEY, $fkGlossaryKey, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkLocale Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkLocale_Between(array $fkLocale)
    {
        return $this->filterByFkLocale($fkLocale, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkLocales Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkLocale_In(array $fkLocales)
    {
        return $this->filterByFkLocale($fkLocales, Criteria::IN);
    }

    /**
     * Filter the query on the fk_locale column
     *
     * Example usage:
     * <code>
     * $query->filterByFkLocale(1234); // WHERE fk_locale = 1234
     * $query->filterByFkLocale(array(12, 34), Criteria::IN); // WHERE fk_locale IN (12, 34)
     * $query->filterByFkLocale(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_locale > 12
     * </code>
     *
     * @see       filterByLocale()
     *
     * @param     mixed $fkLocale The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkLocale($fkLocale = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkLocale)) {
            $useMinMax = false;
            if (isset($fkLocale['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyGlossaryTranslationTableMap::COL_FK_LOCALE, $fkLocale['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkLocale['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyGlossaryTranslationTableMap::COL_FK_LOCALE, $fkLocale['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkLocale of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyGlossaryTranslationTableMap::COL_FK_LOCALE, $fkLocale, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $values Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValue_In(array $values)
    {
        return $this->filterByValue($values, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $value Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValue_Like($value)
    {
        return $this->filterByValue($value, Criteria::LIKE);
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue('fooValue');   // WHERE value = 'fooValue'
     * $query->filterByValue('%fooValue%', Criteria::LIKE); // WHERE value LIKE '%fooValue%'
     * $query->filterByValue([1, 'foo'], Criteria::IN); // WHERE value IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $value The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByValue($value = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $value = str_replace('*', '%', $value);
        }

        if (is_array($value) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$value of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyGlossaryTranslationTableMap::COL_VALUE, $value, $comparison);

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

        $query = $this->addUsingAlias(SpyGlossaryTranslationTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Glossary\Persistence\SpyGlossaryKey object
     *
     * @param \Orm\Zed\Glossary\Persistence\SpyGlossaryKey|ObjectCollection $spyGlossaryKey The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGlossaryKey($spyGlossaryKey, ?string $comparison = null)
    {
        if ($spyGlossaryKey instanceof \Orm\Zed\Glossary\Persistence\SpyGlossaryKey) {
            return $this
                ->addUsingAlias(SpyGlossaryTranslationTableMap::COL_FK_GLOSSARY_KEY, $spyGlossaryKey->getIdGlossaryKey(), $comparison);
        } elseif ($spyGlossaryKey instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyGlossaryTranslationTableMap::COL_FK_GLOSSARY_KEY, $spyGlossaryKey->toKeyValue('PrimaryKey', 'IdGlossaryKey'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGlossaryKey() only accepts arguments of type \Orm\Zed\Glossary\Persistence\SpyGlossaryKey or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GlossaryKey relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGlossaryKey(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GlossaryKey');

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
            $this->addJoinObject($join, 'GlossaryKey');
        }

        return $this;
    }

    /**
     * Use the GlossaryKey relation SpyGlossaryKey object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery A secondary query class using the current class as primary query
     */
    public function useGlossaryKeyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGlossaryKey($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GlossaryKey', '\Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery');
    }

    /**
     * Use the GlossaryKey relation SpyGlossaryKey object
     *
     * @param callable(\Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery):\Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGlossaryKeyQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useGlossaryKeyQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the GlossaryKey relation to the SpyGlossaryKey table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery The inner query object of the EXISTS statement
     */
    public function useGlossaryKeyExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('GlossaryKey', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the GlossaryKey relation to the SpyGlossaryKey table for a NOT EXISTS query.
     *
     * @see useGlossaryKeyExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery The inner query object of the NOT EXISTS statement
     */
    public function useGlossaryKeyNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('GlossaryKey', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Orm\Zed\Locale\Persistence\SpyLocale object
     *
     * @param \Orm\Zed\Locale\Persistence\SpyLocale|ObjectCollection $spyLocale The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocale($spyLocale, ?string $comparison = null)
    {
        if ($spyLocale instanceof \Orm\Zed\Locale\Persistence\SpyLocale) {
            return $this
                ->addUsingAlias(SpyGlossaryTranslationTableMap::COL_FK_LOCALE, $spyLocale->getIdLocale(), $comparison);
        } elseif ($spyLocale instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyGlossaryTranslationTableMap::COL_FK_LOCALE, $spyLocale->toKeyValue('PrimaryKey', 'IdLocale'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByLocale() only accepts arguments of type \Orm\Zed\Locale\Persistence\SpyLocale or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Locale relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinLocale(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Locale');

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
            $this->addJoinObject($join, 'Locale');
        }

        return $this;
    }

    /**
     * Use the Locale relation SpyLocale object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery A secondary query class using the current class as primary query
     */
    public function useLocaleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLocale($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Locale', '\Orm\Zed\Locale\Persistence\SpyLocaleQuery');
    }

    /**
     * Use the Locale relation SpyLocale object
     *
     * @param callable(\Orm\Zed\Locale\Persistence\SpyLocaleQuery):\Orm\Zed\Locale\Persistence\SpyLocaleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLocaleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLocaleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the Locale relation to the SpyLocale table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the EXISTS statement
     */
    public function useLocaleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Locale', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the Locale relation to the SpyLocale table for a NOT EXISTS query.
     *
     * @see useLocaleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the NOT EXISTS statement
     */
    public function useLocaleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Locale', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildSpyGlossaryTranslation $spyGlossaryTranslation Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyGlossaryTranslation = null)
    {
        if ($spyGlossaryTranslation) {
            $this->addUsingAlias(SpyGlossaryTranslationTableMap::COL_ID_GLOSSARY_TRANSLATION, $spyGlossaryTranslation->getIdGlossaryTranslation(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the spy_glossary_translation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyGlossaryTranslationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyGlossaryTranslationTableMap::clearInstancePool();
            SpyGlossaryTranslationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyGlossaryTranslationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyGlossaryTranslationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyGlossaryTranslationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyGlossaryTranslationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
