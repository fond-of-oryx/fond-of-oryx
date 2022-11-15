<?php

namespace Orm\Zed\Customer\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Country\Persistence\SpyCountry;
use Orm\Zed\Country\Persistence\SpyRegion;
use Orm\Zed\Customer\Persistence\SpyCustomerAddress as ChildSpyCustomerAddress;
use Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery as ChildSpyCustomerAddressQuery;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerAddressTableMap;
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
 * Base class that represents a query for the 'spy_customer_address' table.
 *
 *
 *
 * @method     ChildSpyCustomerAddressQuery orderByIdCustomerAddress($order = Criteria::ASC) Order by the id_customer_address column
 * @method     ChildSpyCustomerAddressQuery orderByFkCountry($order = Criteria::ASC) Order by the fk_country column
 * @method     ChildSpyCustomerAddressQuery orderByFkCustomer($order = Criteria::ASC) Order by the fk_customer column
 * @method     ChildSpyCustomerAddressQuery orderByFkRegion($order = Criteria::ASC) Order by the fk_region column
 * @method     ChildSpyCustomerAddressQuery orderByAddress1($order = Criteria::ASC) Order by the address1 column
 * @method     ChildSpyCustomerAddressQuery orderByAddress2($order = Criteria::ASC) Order by the address2 column
 * @method     ChildSpyCustomerAddressQuery orderByAddress3($order = Criteria::ASC) Order by the address3 column
 * @method     ChildSpyCustomerAddressQuery orderByAnonymizedAt($order = Criteria::ASC) Order by the anonymized_at column
 * @method     ChildSpyCustomerAddressQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method     ChildSpyCustomerAddressQuery orderByComment($order = Criteria::ASC) Order by the comment column
 * @method     ChildSpyCustomerAddressQuery orderByCompany($order = Criteria::ASC) Order by the company column
 * @method     ChildSpyCustomerAddressQuery orderByDeletedAt($order = Criteria::ASC) Order by the deleted_at column
 * @method     ChildSpyCustomerAddressQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildSpyCustomerAddressQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ChildSpyCustomerAddressQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildSpyCustomerAddressQuery orderBySalutation($order = Criteria::ASC) Order by the salutation column
 * @method     ChildSpyCustomerAddressQuery orderByZipCode($order = Criteria::ASC) Order by the zip_code column
 * @method     ChildSpyCustomerAddressQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyCustomerAddressQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyCustomerAddressQuery groupByIdCustomerAddress() Group by the id_customer_address column
 * @method     ChildSpyCustomerAddressQuery groupByFkCountry() Group by the fk_country column
 * @method     ChildSpyCustomerAddressQuery groupByFkCustomer() Group by the fk_customer column
 * @method     ChildSpyCustomerAddressQuery groupByFkRegion() Group by the fk_region column
 * @method     ChildSpyCustomerAddressQuery groupByAddress1() Group by the address1 column
 * @method     ChildSpyCustomerAddressQuery groupByAddress2() Group by the address2 column
 * @method     ChildSpyCustomerAddressQuery groupByAddress3() Group by the address3 column
 * @method     ChildSpyCustomerAddressQuery groupByAnonymizedAt() Group by the anonymized_at column
 * @method     ChildSpyCustomerAddressQuery groupByCity() Group by the city column
 * @method     ChildSpyCustomerAddressQuery groupByComment() Group by the comment column
 * @method     ChildSpyCustomerAddressQuery groupByCompany() Group by the company column
 * @method     ChildSpyCustomerAddressQuery groupByDeletedAt() Group by the deleted_at column
 * @method     ChildSpyCustomerAddressQuery groupByFirstName() Group by the first_name column
 * @method     ChildSpyCustomerAddressQuery groupByLastName() Group by the last_name column
 * @method     ChildSpyCustomerAddressQuery groupByPhone() Group by the phone column
 * @method     ChildSpyCustomerAddressQuery groupBySalutation() Group by the salutation column
 * @method     ChildSpyCustomerAddressQuery groupByZipCode() Group by the zip_code column
 * @method     ChildSpyCustomerAddressQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyCustomerAddressQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyCustomerAddressQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCustomerAddressQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCustomerAddressQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCustomerAddressQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCustomerAddressQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCustomerAddressQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCustomerAddressQuery leftJoinCustomer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Customer relation
 * @method     ChildSpyCustomerAddressQuery rightJoinCustomer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Customer relation
 * @method     ChildSpyCustomerAddressQuery innerJoinCustomer($relationAlias = null) Adds a INNER JOIN clause to the query using the Customer relation
 *
 * @method     ChildSpyCustomerAddressQuery joinWithCustomer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Customer relation
 *
 * @method     ChildSpyCustomerAddressQuery leftJoinWithCustomer() Adds a LEFT JOIN clause and with to the query using the Customer relation
 * @method     ChildSpyCustomerAddressQuery rightJoinWithCustomer() Adds a RIGHT JOIN clause and with to the query using the Customer relation
 * @method     ChildSpyCustomerAddressQuery innerJoinWithCustomer() Adds a INNER JOIN clause and with to the query using the Customer relation
 *
 * @method     ChildSpyCustomerAddressQuery leftJoinRegion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Region relation
 * @method     ChildSpyCustomerAddressQuery rightJoinRegion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Region relation
 * @method     ChildSpyCustomerAddressQuery innerJoinRegion($relationAlias = null) Adds a INNER JOIN clause to the query using the Region relation
 *
 * @method     ChildSpyCustomerAddressQuery joinWithRegion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Region relation
 *
 * @method     ChildSpyCustomerAddressQuery leftJoinWithRegion() Adds a LEFT JOIN clause and with to the query using the Region relation
 * @method     ChildSpyCustomerAddressQuery rightJoinWithRegion() Adds a RIGHT JOIN clause and with to the query using the Region relation
 * @method     ChildSpyCustomerAddressQuery innerJoinWithRegion() Adds a INNER JOIN clause and with to the query using the Region relation
 *
 * @method     ChildSpyCustomerAddressQuery leftJoinCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Country relation
 * @method     ChildSpyCustomerAddressQuery rightJoinCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Country relation
 * @method     ChildSpyCustomerAddressQuery innerJoinCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the Country relation
 *
 * @method     ChildSpyCustomerAddressQuery joinWithCountry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Country relation
 *
 * @method     ChildSpyCustomerAddressQuery leftJoinWithCountry() Adds a LEFT JOIN clause and with to the query using the Country relation
 * @method     ChildSpyCustomerAddressQuery rightJoinWithCountry() Adds a RIGHT JOIN clause and with to the query using the Country relation
 * @method     ChildSpyCustomerAddressQuery innerJoinWithCountry() Adds a INNER JOIN clause and with to the query using the Country relation
 *
 * @method     ChildSpyCustomerAddressQuery leftJoinCustomerBillingAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the CustomerBillingAddress relation
 * @method     ChildSpyCustomerAddressQuery rightJoinCustomerBillingAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CustomerBillingAddress relation
 * @method     ChildSpyCustomerAddressQuery innerJoinCustomerBillingAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the CustomerBillingAddress relation
 *
 * @method     ChildSpyCustomerAddressQuery joinWithCustomerBillingAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CustomerBillingAddress relation
 *
 * @method     ChildSpyCustomerAddressQuery leftJoinWithCustomerBillingAddress() Adds a LEFT JOIN clause and with to the query using the CustomerBillingAddress relation
 * @method     ChildSpyCustomerAddressQuery rightJoinWithCustomerBillingAddress() Adds a RIGHT JOIN clause and with to the query using the CustomerBillingAddress relation
 * @method     ChildSpyCustomerAddressQuery innerJoinWithCustomerBillingAddress() Adds a INNER JOIN clause and with to the query using the CustomerBillingAddress relation
 *
 * @method     ChildSpyCustomerAddressQuery leftJoinCustomerShippingAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the CustomerShippingAddress relation
 * @method     ChildSpyCustomerAddressQuery rightJoinCustomerShippingAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CustomerShippingAddress relation
 * @method     ChildSpyCustomerAddressQuery innerJoinCustomerShippingAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the CustomerShippingAddress relation
 *
 * @method     ChildSpyCustomerAddressQuery joinWithCustomerShippingAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CustomerShippingAddress relation
 *
 * @method     ChildSpyCustomerAddressQuery leftJoinWithCustomerShippingAddress() Adds a LEFT JOIN clause and with to the query using the CustomerShippingAddress relation
 * @method     ChildSpyCustomerAddressQuery rightJoinWithCustomerShippingAddress() Adds a RIGHT JOIN clause and with to the query using the CustomerShippingAddress relation
 * @method     ChildSpyCustomerAddressQuery innerJoinWithCustomerShippingAddress() Adds a INNER JOIN clause and with to the query using the CustomerShippingAddress relation
 *
 * @method     \Orm\Zed\Customer\Persistence\SpyCustomerQuery|\Orm\Zed\Country\Persistence\SpyRegionQuery|\Orm\Zed\Country\Persistence\SpyCountryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyCustomerAddress|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCustomerAddress matching the query
 * @method     ChildSpyCustomerAddress findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCustomerAddress matching the query, or a new ChildSpyCustomerAddress object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCustomerAddress|null findOneByIdCustomerAddress(int $id_customer_address) Return the first ChildSpyCustomerAddress filtered by the id_customer_address column
 * @method     ChildSpyCustomerAddress|null findOneByFkCountry(int $fk_country) Return the first ChildSpyCustomerAddress filtered by the fk_country column
 * @method     ChildSpyCustomerAddress|null findOneByFkCustomer(int $fk_customer) Return the first ChildSpyCustomerAddress filtered by the fk_customer column
 * @method     ChildSpyCustomerAddress|null findOneByFkRegion(int $fk_region) Return the first ChildSpyCustomerAddress filtered by the fk_region column
 * @method     ChildSpyCustomerAddress|null findOneByAddress1(string $address1) Return the first ChildSpyCustomerAddress filtered by the address1 column
 * @method     ChildSpyCustomerAddress|null findOneByAddress2(string $address2) Return the first ChildSpyCustomerAddress filtered by the address2 column
 * @method     ChildSpyCustomerAddress|null findOneByAddress3(string $address3) Return the first ChildSpyCustomerAddress filtered by the address3 column
 * @method     ChildSpyCustomerAddress|null findOneByAnonymizedAt(string $anonymized_at) Return the first ChildSpyCustomerAddress filtered by the anonymized_at column
 * @method     ChildSpyCustomerAddress|null findOneByCity(string $city) Return the first ChildSpyCustomerAddress filtered by the city column
 * @method     ChildSpyCustomerAddress|null findOneByComment(string $comment) Return the first ChildSpyCustomerAddress filtered by the comment column
 * @method     ChildSpyCustomerAddress|null findOneByCompany(string $company) Return the first ChildSpyCustomerAddress filtered by the company column
 * @method     ChildSpyCustomerAddress|null findOneByDeletedAt(string $deleted_at) Return the first ChildSpyCustomerAddress filtered by the deleted_at column
 * @method     ChildSpyCustomerAddress|null findOneByFirstName(string $first_name) Return the first ChildSpyCustomerAddress filtered by the first_name column
 * @method     ChildSpyCustomerAddress|null findOneByLastName(string $last_name) Return the first ChildSpyCustomerAddress filtered by the last_name column
 * @method     ChildSpyCustomerAddress|null findOneByPhone(string $phone) Return the first ChildSpyCustomerAddress filtered by the phone column
 * @method     ChildSpyCustomerAddress|null findOneBySalutation(int $salutation) Return the first ChildSpyCustomerAddress filtered by the salutation column
 * @method     ChildSpyCustomerAddress|null findOneByZipCode(string $zip_code) Return the first ChildSpyCustomerAddress filtered by the zip_code column
 * @method     ChildSpyCustomerAddress|null findOneByCreatedAt(string $created_at) Return the first ChildSpyCustomerAddress filtered by the created_at column
 * @method     ChildSpyCustomerAddress|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyCustomerAddress filtered by the updated_at column *

 * @method     ChildSpyCustomerAddress requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCustomerAddress by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCustomerAddress matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCustomerAddress requireOneByIdCustomerAddress(int $id_customer_address) Return the first ChildSpyCustomerAddress filtered by the id_customer_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneByFkCountry(int $fk_country) Return the first ChildSpyCustomerAddress filtered by the fk_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneByFkCustomer(int $fk_customer) Return the first ChildSpyCustomerAddress filtered by the fk_customer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneByFkRegion(int $fk_region) Return the first ChildSpyCustomerAddress filtered by the fk_region column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneByAddress1(string $address1) Return the first ChildSpyCustomerAddress filtered by the address1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneByAddress2(string $address2) Return the first ChildSpyCustomerAddress filtered by the address2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneByAddress3(string $address3) Return the first ChildSpyCustomerAddress filtered by the address3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneByAnonymizedAt(string $anonymized_at) Return the first ChildSpyCustomerAddress filtered by the anonymized_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneByCity(string $city) Return the first ChildSpyCustomerAddress filtered by the city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneByComment(string $comment) Return the first ChildSpyCustomerAddress filtered by the comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneByCompany(string $company) Return the first ChildSpyCustomerAddress filtered by the company column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneByDeletedAt(string $deleted_at) Return the first ChildSpyCustomerAddress filtered by the deleted_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneByFirstName(string $first_name) Return the first ChildSpyCustomerAddress filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneByLastName(string $last_name) Return the first ChildSpyCustomerAddress filtered by the last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneByPhone(string $phone) Return the first ChildSpyCustomerAddress filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneBySalutation(int $salutation) Return the first ChildSpyCustomerAddress filtered by the salutation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneByZipCode(string $zip_code) Return the first ChildSpyCustomerAddress filtered by the zip_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneByCreatedAt(string $created_at) Return the first ChildSpyCustomerAddress filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCustomerAddress requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyCustomerAddress filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCustomerAddress[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCustomerAddress objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> find(?ConnectionInterface $con = null) Return ChildSpyCustomerAddress objects based on current ModelCriteria
 * @method     ChildSpyCustomerAddress[]|Collection findByIdCustomerAddress(int $id_customer_address) Return ChildSpyCustomerAddress objects filtered by the id_customer_address column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByIdCustomerAddress(int $id_customer_address) Return ChildSpyCustomerAddress objects filtered by the id_customer_address column
 * @method     ChildSpyCustomerAddress[]|Collection findByFkCountry(int $fk_country) Return ChildSpyCustomerAddress objects filtered by the fk_country column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByFkCountry(int $fk_country) Return ChildSpyCustomerAddress objects filtered by the fk_country column
 * @method     ChildSpyCustomerAddress[]|Collection findByFkCustomer(int $fk_customer) Return ChildSpyCustomerAddress objects filtered by the fk_customer column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByFkCustomer(int $fk_customer) Return ChildSpyCustomerAddress objects filtered by the fk_customer column
 * @method     ChildSpyCustomerAddress[]|Collection findByFkRegion(int $fk_region) Return ChildSpyCustomerAddress objects filtered by the fk_region column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByFkRegion(int $fk_region) Return ChildSpyCustomerAddress objects filtered by the fk_region column
 * @method     ChildSpyCustomerAddress[]|Collection findByAddress1(string $address1) Return ChildSpyCustomerAddress objects filtered by the address1 column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByAddress1(string $address1) Return ChildSpyCustomerAddress objects filtered by the address1 column
 * @method     ChildSpyCustomerAddress[]|Collection findByAddress2(string $address2) Return ChildSpyCustomerAddress objects filtered by the address2 column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByAddress2(string $address2) Return ChildSpyCustomerAddress objects filtered by the address2 column
 * @method     ChildSpyCustomerAddress[]|Collection findByAddress3(string $address3) Return ChildSpyCustomerAddress objects filtered by the address3 column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByAddress3(string $address3) Return ChildSpyCustomerAddress objects filtered by the address3 column
 * @method     ChildSpyCustomerAddress[]|Collection findByAnonymizedAt(string $anonymized_at) Return ChildSpyCustomerAddress objects filtered by the anonymized_at column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByAnonymizedAt(string $anonymized_at) Return ChildSpyCustomerAddress objects filtered by the anonymized_at column
 * @method     ChildSpyCustomerAddress[]|Collection findByCity(string $city) Return ChildSpyCustomerAddress objects filtered by the city column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByCity(string $city) Return ChildSpyCustomerAddress objects filtered by the city column
 * @method     ChildSpyCustomerAddress[]|Collection findByComment(string $comment) Return ChildSpyCustomerAddress objects filtered by the comment column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByComment(string $comment) Return ChildSpyCustomerAddress objects filtered by the comment column
 * @method     ChildSpyCustomerAddress[]|Collection findByCompany(string $company) Return ChildSpyCustomerAddress objects filtered by the company column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByCompany(string $company) Return ChildSpyCustomerAddress objects filtered by the company column
 * @method     ChildSpyCustomerAddress[]|Collection findByDeletedAt(string $deleted_at) Return ChildSpyCustomerAddress objects filtered by the deleted_at column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByDeletedAt(string $deleted_at) Return ChildSpyCustomerAddress objects filtered by the deleted_at column
 * @method     ChildSpyCustomerAddress[]|Collection findByFirstName(string $first_name) Return ChildSpyCustomerAddress objects filtered by the first_name column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByFirstName(string $first_name) Return ChildSpyCustomerAddress objects filtered by the first_name column
 * @method     ChildSpyCustomerAddress[]|Collection findByLastName(string $last_name) Return ChildSpyCustomerAddress objects filtered by the last_name column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByLastName(string $last_name) Return ChildSpyCustomerAddress objects filtered by the last_name column
 * @method     ChildSpyCustomerAddress[]|Collection findByPhone(string $phone) Return ChildSpyCustomerAddress objects filtered by the phone column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByPhone(string $phone) Return ChildSpyCustomerAddress objects filtered by the phone column
 * @method     ChildSpyCustomerAddress[]|Collection findBySalutation(int $salutation) Return ChildSpyCustomerAddress objects filtered by the salutation column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findBySalutation(int $salutation) Return ChildSpyCustomerAddress objects filtered by the salutation column
 * @method     ChildSpyCustomerAddress[]|Collection findByZipCode(string $zip_code) Return ChildSpyCustomerAddress objects filtered by the zip_code column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByZipCode(string $zip_code) Return ChildSpyCustomerAddress objects filtered by the zip_code column
 * @method     ChildSpyCustomerAddress[]|Collection findByCreatedAt(string $created_at) Return ChildSpyCustomerAddress objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByCreatedAt(string $created_at) Return ChildSpyCustomerAddress objects filtered by the created_at column
 * @method     ChildSpyCustomerAddress[]|Collection findByUpdatedAt(string $updated_at) Return ChildSpyCustomerAddress objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyCustomerAddress> findByUpdatedAt(string $updated_at) Return ChildSpyCustomerAddress objects filtered by the updated_at column
 * @method     ChildSpyCustomerAddress[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCustomerAddress> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SpyCustomerAddressQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Customer\Persistence\Base\SpyCustomerAddressQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Customer\\Persistence\\SpyCustomerAddress', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCustomerAddressQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCustomerAddressQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCustomerAddressQuery) {
            return $criteria;
        }
        $query = new ChildSpyCustomerAddressQuery();
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
     * @return ChildSpyCustomerAddress|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCustomerAddressTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyCustomerAddress A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_customer_address, fk_country, fk_customer, fk_region, address1, address2, address3, anonymized_at, city, comment, company, deleted_at, first_name, last_name, phone, salutation, zip_code, created_at, updated_at FROM spy_customer_address WHERE id_customer_address = :p0';
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
            /** @var ChildSpyCustomerAddress $obj */
            $obj = new ChildSpyCustomerAddress();
            $obj->hydrate($row);
            SpyCustomerAddressTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyCustomerAddress|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCustomerAddress Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCustomerAddress_Between(array $idCustomerAddress)
    {
        return $this->filterByIdCustomerAddress($idCustomerAddress, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCustomerAddresss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCustomerAddress_In(array $idCustomerAddresss)
    {
        return $this->filterByIdCustomerAddress($idCustomerAddresss, Criteria::IN);
    }

    /**
     * Filter the query on the id_customer_address column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCustomerAddress(1234); // WHERE id_customer_address = 1234
     * $query->filterByIdCustomerAddress(array(12, 34), Criteria::IN); // WHERE id_customer_address IN (12, 34)
     * $query->filterByIdCustomerAddress(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_customer_address > 12
     * </code>
     *
     * @param     mixed $idCustomerAddress The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCustomerAddress($idCustomerAddress = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCustomerAddress)) {
            $useMinMax = false;
            if (isset($idCustomerAddress['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS, $idCustomerAddress['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCustomerAddress['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS, $idCustomerAddress['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCustomerAddress of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS, $idCustomerAddress, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCountry Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCountry_Between(array $fkCountry)
    {
        return $this->filterByFkCountry($fkCountry, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCountrys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCountry_In(array $fkCountrys)
    {
        return $this->filterByFkCountry($fkCountrys, Criteria::IN);
    }

    /**
     * Filter the query on the fk_country column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCountry(1234); // WHERE fk_country = 1234
     * $query->filterByFkCountry(array(12, 34), Criteria::IN); // WHERE fk_country IN (12, 34)
     * $query->filterByFkCountry(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_country > 12
     * </code>
     *
     * @see       filterByCountry()
     *
     * @param     mixed $fkCountry The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCountry($fkCountry = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCountry)) {
            $useMinMax = false;
            if (isset($fkCountry['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerAddressTableMap::COL_FK_COUNTRY, $fkCountry['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCountry['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerAddressTableMap::COL_FK_COUNTRY, $fkCountry['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCountry of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_FK_COUNTRY, $fkCountry, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCustomer Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCustomer_Between(array $fkCustomer)
    {
        return $this->filterByFkCustomer($fkCustomer, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCustomers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCustomer_In(array $fkCustomers)
    {
        return $this->filterByFkCustomer($fkCustomers, Criteria::IN);
    }

    /**
     * Filter the query on the fk_customer column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCustomer(1234); // WHERE fk_customer = 1234
     * $query->filterByFkCustomer(array(12, 34), Criteria::IN); // WHERE fk_customer IN (12, 34)
     * $query->filterByFkCustomer(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_customer > 12
     * </code>
     *
     * @see       filterByCustomer()
     *
     * @param     mixed $fkCustomer The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCustomer($fkCustomer = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCustomer)) {
            $useMinMax = false;
            if (isset($fkCustomer['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerAddressTableMap::COL_FK_CUSTOMER, $fkCustomer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCustomer['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerAddressTableMap::COL_FK_CUSTOMER, $fkCustomer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCustomer of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_FK_CUSTOMER, $fkCustomer, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkRegion Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkRegion_Between(array $fkRegion)
    {
        return $this->filterByFkRegion($fkRegion, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkRegions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkRegion_In(array $fkRegions)
    {
        return $this->filterByFkRegion($fkRegions, Criteria::IN);
    }

    /**
     * Filter the query on the fk_region column
     *
     * Example usage:
     * <code>
     * $query->filterByFkRegion(1234); // WHERE fk_region = 1234
     * $query->filterByFkRegion(array(12, 34), Criteria::IN); // WHERE fk_region IN (12, 34)
     * $query->filterByFkRegion(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_region > 12
     * </code>
     *
     * @see       filterByRegion()
     *
     * @param     mixed $fkRegion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkRegion($fkRegion = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkRegion)) {
            $useMinMax = false;
            if (isset($fkRegion['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerAddressTableMap::COL_FK_REGION, $fkRegion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkRegion['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerAddressTableMap::COL_FK_REGION, $fkRegion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkRegion of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_FK_REGION, $fkRegion, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $address1s Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress1_In(array $address1s)
    {
        return $this->filterByAddress1($address1s, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $address1 Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress1_Like($address1)
    {
        return $this->filterByAddress1($address1, Criteria::LIKE);
    }

    /**
     * Filter the query on the address1 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress1('fooValue');   // WHERE address1 = 'fooValue'
     * $query->filterByAddress1('%fooValue%', Criteria::LIKE); // WHERE address1 LIKE '%fooValue%'
     * $query->filterByAddress1([1, 'foo'], Criteria::IN); // WHERE address1 IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $address1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAddress1($address1 = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $address1 = str_replace('*', '%', $address1);
        }

        if (is_array($address1) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$address1 of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_ADDRESS1, $address1, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $address2s Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress2_In(array $address2s)
    {
        return $this->filterByAddress2($address2s, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $address2 Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress2_Like($address2)
    {
        return $this->filterByAddress2($address2, Criteria::LIKE);
    }

    /**
     * Filter the query on the address2 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress2('fooValue');   // WHERE address2 = 'fooValue'
     * $query->filterByAddress2('%fooValue%', Criteria::LIKE); // WHERE address2 LIKE '%fooValue%'
     * $query->filterByAddress2([1, 'foo'], Criteria::IN); // WHERE address2 IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $address2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAddress2($address2 = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $address2 = str_replace('*', '%', $address2);
        }

        if (is_array($address2) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$address2 of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_ADDRESS2, $address2, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $address3s Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress3_In(array $address3s)
    {
        return $this->filterByAddress3($address3s, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $address3 Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress3_Like($address3)
    {
        return $this->filterByAddress3($address3, Criteria::LIKE);
    }

    /**
     * Filter the query on the address3 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress3('fooValue');   // WHERE address3 = 'fooValue'
     * $query->filterByAddress3('%fooValue%', Criteria::LIKE); // WHERE address3 LIKE '%fooValue%'
     * $query->filterByAddress3([1, 'foo'], Criteria::IN); // WHERE address3 IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $address3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAddress3($address3 = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $address3 = str_replace('*', '%', $address3);
        }

        if (is_array($address3) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$address3 of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_ADDRESS3, $address3, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $anonymizedAt Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAnonymizedAt_Between(array $anonymizedAt)
    {
        return $this->filterByAnonymizedAt($anonymizedAt, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $anonymizedAts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAnonymizedAt_In(array $anonymizedAts)
    {
        return $this->filterByAnonymizedAt($anonymizedAts, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $anonymizedAt Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAnonymizedAt_Like($anonymizedAt)
    {
        return $this->filterByAnonymizedAt($anonymizedAt, Criteria::LIKE);
    }

    /**
     * Filter the query on the anonymized_at column
     *
     * Example usage:
     * <code>
     * $query->filterByAnonymizedAt('2011-03-14'); // WHERE anonymized_at = '2011-03-14'
     * $query->filterByAnonymizedAt('now'); // WHERE anonymized_at = '2011-03-14'
     * $query->filterByAnonymizedAt(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE anonymized_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $anonymizedAt The value to use as filter.
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
    public function filterByAnonymizedAt($anonymizedAt = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($anonymizedAt)) {
            $useMinMax = false;
            if (isset($anonymizedAt['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerAddressTableMap::COL_ANONYMIZED_AT, $anonymizedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($anonymizedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerAddressTableMap::COL_ANONYMIZED_AT, $anonymizedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$anonymizedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_ANONYMIZED_AT, $anonymizedAt, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $citys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCity_In(array $citys)
    {
        return $this->filterByCity($citys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $city Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCity_Like($city)
    {
        return $this->filterByCity($city, Criteria::LIKE);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%', Criteria::LIKE); // WHERE city LIKE '%fooValue%'
     * $query->filterByCity([1, 'foo'], Criteria::IN); // WHERE city IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $city The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCity($city = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $city = str_replace('*', '%', $city);
        }

        if (is_array($city) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$city of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_CITY, $city, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $comments Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByComment_In(array $comments)
    {
        return $this->filterByComment($comments, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $comment Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByComment_Like($comment)
    {
        return $this->filterByComment($comment, Criteria::LIKE);
    }

    /**
     * Filter the query on the comment column
     *
     * Example usage:
     * <code>
     * $query->filterByComment('fooValue');   // WHERE comment = 'fooValue'
     * $query->filterByComment('%fooValue%', Criteria::LIKE); // WHERE comment LIKE '%fooValue%'
     * $query->filterByComment([1, 'foo'], Criteria::IN); // WHERE comment IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $comment The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByComment($comment = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $comment = str_replace('*', '%', $comment);
        }

        if (is_array($comment) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$comment of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_COMMENT, $comment, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $companys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompany_In(array $companys)
    {
        return $this->filterByCompany($companys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $company Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompany_Like($company)
    {
        return $this->filterByCompany($company, Criteria::LIKE);
    }

    /**
     * Filter the query on the company column
     *
     * Example usage:
     * <code>
     * $query->filterByCompany('fooValue');   // WHERE company = 'fooValue'
     * $query->filterByCompany('%fooValue%', Criteria::LIKE); // WHERE company LIKE '%fooValue%'
     * $query->filterByCompany([1, 'foo'], Criteria::IN); // WHERE company IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $company The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCompany($company = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $company = str_replace('*', '%', $company);
        }

        if (is_array($company) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$company of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_COMPANY, $company, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $deletedAt Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeletedAt_Between(array $deletedAt)
    {
        return $this->filterByDeletedAt($deletedAt, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $deletedAts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeletedAt_In(array $deletedAts)
    {
        return $this->filterByDeletedAt($deletedAts, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $deletedAt Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeletedAt_Like($deletedAt)
    {
        return $this->filterByDeletedAt($deletedAt, Criteria::LIKE);
    }

    /**
     * Filter the query on the deleted_at column
     *
     * Example usage:
     * <code>
     * $query->filterByDeletedAt('2011-03-14'); // WHERE deleted_at = '2011-03-14'
     * $query->filterByDeletedAt('now'); // WHERE deleted_at = '2011-03-14'
     * $query->filterByDeletedAt(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE deleted_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $deletedAt The value to use as filter.
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
    public function filterByDeletedAt($deletedAt = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($deletedAt)) {
            $useMinMax = false;
            if (isset($deletedAt['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerAddressTableMap::COL_DELETED_AT, $deletedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deletedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerAddressTableMap::COL_DELETED_AT, $deletedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$deletedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_DELETED_AT, $deletedAt, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $firstNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFirstName_In(array $firstNames)
    {
        return $this->filterByFirstName($firstNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $firstName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFirstName_Like($firstName)
    {
        return $this->filterByFirstName($firstName, Criteria::LIKE);
    }

    /**
     * Filter the query on the first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
     * $query->filterByFirstName('%fooValue%', Criteria::LIKE); // WHERE first_name LIKE '%fooValue%'
     * $query->filterByFirstName([1, 'foo'], Criteria::IN); // WHERE first_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $firstName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFirstName($firstName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $firstName = str_replace('*', '%', $firstName);
        }

        if (is_array($firstName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$firstName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_FIRST_NAME, $firstName, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $lastNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastName_In(array $lastNames)
    {
        return $this->filterByLastName($lastNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $lastName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastName_Like($lastName)
    {
        return $this->filterByLastName($lastName, Criteria::LIKE);
    }

    /**
     * Filter the query on the last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE last_name = 'fooValue'
     * $query->filterByLastName('%fooValue%', Criteria::LIKE); // WHERE last_name LIKE '%fooValue%'
     * $query->filterByLastName([1, 'foo'], Criteria::IN); // WHERE last_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $lastName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByLastName($lastName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $lastName = str_replace('*', '%', $lastName);
        }

        if (is_array($lastName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$lastName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_LAST_NAME, $lastName, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $phones Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPhone_In(array $phones)
    {
        return $this->filterByPhone($phones, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $phone Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPhone_Like($phone)
    {
        return $this->filterByPhone($phone, Criteria::LIKE);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * $query->filterByPhone([1, 'foo'], Criteria::IN); // WHERE phone IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $phone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPhone($phone = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $phone = str_replace('*', '%', $phone);
        }

        if (is_array($phone) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$phone of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_PHONE, $phone, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $salutations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySalutation_In(array $salutations)
    {
        return $this->filterBySalutation($salutations, Criteria::IN);
    }

    /**
     * Filter the query on the salutation column
     *
     * @param     mixed $salutation The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterBySalutation($salutation = null, $comparison = Criteria::EQUAL)
    {
        $valueSet = SpyCustomerAddressTableMap::getValueSet(SpyCustomerAddressTableMap::COL_SALUTATION);
        if (is_scalar($salutation)) {
            if (!in_array($salutation, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $salutation));
            }
            $salutation = array_search($salutation, $valueSet);
        } elseif (is_array($salutation)) {
            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
            $convertedValues = array();
            foreach ($salutation as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $salutation = $convertedValues;
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_SALUTATION, $salutation, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $zipCodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZipCode_In(array $zipCodes)
    {
        return $this->filterByZipCode($zipCodes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $zipCode Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZipCode_Like($zipCode)
    {
        return $this->filterByZipCode($zipCode, Criteria::LIKE);
    }

    /**
     * Filter the query on the zip_code column
     *
     * Example usage:
     * <code>
     * $query->filterByZipCode('fooValue');   // WHERE zip_code = 'fooValue'
     * $query->filterByZipCode('%fooValue%', Criteria::LIKE); // WHERE zip_code LIKE '%fooValue%'
     * $query->filterByZipCode([1, 'foo'], Criteria::IN); // WHERE zip_code IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $zipCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByZipCode($zipCode = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $zipCode = str_replace('*', '%', $zipCode);
        }

        if (is_array($zipCode) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$zipCode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_ZIP_CODE, $zipCode, $comparison);

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
                $this->addUsingAlias(SpyCustomerAddressTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerAddressTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyCustomerAddressTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCustomerAddressTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCustomerAddressTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Customer\Persistence\SpyCustomer object
     *
     * @param \Orm\Zed\Customer\Persistence\SpyCustomer|ObjectCollection $spyCustomer The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCustomer($spyCustomer, ?string $comparison = null)
    {
        if ($spyCustomer instanceof \Orm\Zed\Customer\Persistence\SpyCustomer) {
            return $this
                ->addUsingAlias(SpyCustomerAddressTableMap::COL_FK_CUSTOMER, $spyCustomer->getIdCustomer(), $comparison);
        } elseif ($spyCustomer instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCustomerAddressTableMap::COL_FK_CUSTOMER, $spyCustomer->toKeyValue('PrimaryKey', 'IdCustomer'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCustomer() only accepts arguments of type \Orm\Zed\Customer\Persistence\SpyCustomer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Customer relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCustomer(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Customer');

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
            $this->addJoinObject($join, 'Customer');
        }

        return $this;
    }

    /**
     * Use the Customer relation SpyCustomer object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery A secondary query class using the current class as primary query
     */
    public function useCustomerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCustomer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Customer', '\Orm\Zed\Customer\Persistence\SpyCustomerQuery');
    }

    /**
     * Use the Customer relation SpyCustomer object
     *
     * @param callable(\Orm\Zed\Customer\Persistence\SpyCustomerQuery):\Orm\Zed\Customer\Persistence\SpyCustomerQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCustomerQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCustomerQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the Customer relation to the SpyCustomer table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery The inner query object of the EXISTS statement
     */
    public function useCustomerExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Customer', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the Customer relation to the SpyCustomer table for a NOT EXISTS query.
     *
     * @see useCustomerExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery The inner query object of the NOT EXISTS statement
     */
    public function useCustomerNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Customer', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Orm\Zed\Country\Persistence\SpyRegion object
     *
     * @param \Orm\Zed\Country\Persistence\SpyRegion|ObjectCollection $spyRegion The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegion($spyRegion, ?string $comparison = null)
    {
        if ($spyRegion instanceof \Orm\Zed\Country\Persistence\SpyRegion) {
            return $this
                ->addUsingAlias(SpyCustomerAddressTableMap::COL_FK_REGION, $spyRegion->getIdRegion(), $comparison);
        } elseif ($spyRegion instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCustomerAddressTableMap::COL_FK_REGION, $spyRegion->toKeyValue('PrimaryKey', 'IdRegion'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByRegion() only accepts arguments of type \Orm\Zed\Country\Persistence\SpyRegion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Region relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinRegion(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Region');

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
            $this->addJoinObject($join, 'Region');
        }

        return $this;
    }

    /**
     * Use the Region relation SpyRegion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery A secondary query class using the current class as primary query
     */
    public function useRegionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRegion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Region', '\Orm\Zed\Country\Persistence\SpyRegionQuery');
    }

    /**
     * Use the Region relation SpyRegion object
     *
     * @param callable(\Orm\Zed\Country\Persistence\SpyRegionQuery):\Orm\Zed\Country\Persistence\SpyRegionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withRegionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useRegionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the Region relation to the SpyRegion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery The inner query object of the EXISTS statement
     */
    public function useRegionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Region', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the Region relation to the SpyRegion table for a NOT EXISTS query.
     *
     * @see useRegionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery The inner query object of the NOT EXISTS statement
     */
    public function useRegionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Region', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Orm\Zed\Country\Persistence\SpyCountry object
     *
     * @param \Orm\Zed\Country\Persistence\SpyCountry|ObjectCollection $spyCountry The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCountry($spyCountry, ?string $comparison = null)
    {
        if ($spyCountry instanceof \Orm\Zed\Country\Persistence\SpyCountry) {
            return $this
                ->addUsingAlias(SpyCustomerAddressTableMap::COL_FK_COUNTRY, $spyCountry->getIdCountry(), $comparison);
        } elseif ($spyCountry instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCustomerAddressTableMap::COL_FK_COUNTRY, $spyCountry->toKeyValue('PrimaryKey', 'IdCountry'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCountry() only accepts arguments of type \Orm\Zed\Country\Persistence\SpyCountry or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Country relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCountry(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Country');

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
            $this->addJoinObject($join, 'Country');
        }

        return $this;
    }

    /**
     * Use the Country relation SpyCountry object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery A secondary query class using the current class as primary query
     */
    public function useCountryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Country', '\Orm\Zed\Country\Persistence\SpyCountryQuery');
    }

    /**
     * Use the Country relation SpyCountry object
     *
     * @param callable(\Orm\Zed\Country\Persistence\SpyCountryQuery):\Orm\Zed\Country\Persistence\SpyCountryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCountryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCountryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the Country relation to the SpyCountry table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery The inner query object of the EXISTS statement
     */
    public function useCountryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Country', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the Country relation to the SpyCountry table for a NOT EXISTS query.
     *
     * @see useCountryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery The inner query object of the NOT EXISTS statement
     */
    public function useCountryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Country', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Orm\Zed\Customer\Persistence\SpyCustomer object
     *
     * @param \Orm\Zed\Customer\Persistence\SpyCustomer|ObjectCollection $spyCustomer the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCustomerBillingAddress($spyCustomer, ?string $comparison = null)
    {
        if ($spyCustomer instanceof \Orm\Zed\Customer\Persistence\SpyCustomer) {
            $this
                ->addUsingAlias(SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS, $spyCustomer->getDefaultBillingAddress(), $comparison);

            return $this;
        } elseif ($spyCustomer instanceof ObjectCollection) {
            $this
                ->useCustomerBillingAddressQuery()
                ->filterByPrimaryKeys($spyCustomer->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCustomerBillingAddress() only accepts arguments of type \Orm\Zed\Customer\Persistence\SpyCustomer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CustomerBillingAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCustomerBillingAddress(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CustomerBillingAddress');

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
            $this->addJoinObject($join, 'CustomerBillingAddress');
        }

        return $this;
    }

    /**
     * Use the CustomerBillingAddress relation SpyCustomer object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery A secondary query class using the current class as primary query
     */
    public function useCustomerBillingAddressQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCustomerBillingAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CustomerBillingAddress', '\Orm\Zed\Customer\Persistence\SpyCustomerQuery');
    }

    /**
     * Use the CustomerBillingAddress relation SpyCustomer object
     *
     * @param callable(\Orm\Zed\Customer\Persistence\SpyCustomerQuery):\Orm\Zed\Customer\Persistence\SpyCustomerQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCustomerBillingAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCustomerBillingAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the CustomerBillingAddress relation to the SpyCustomer table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery The inner query object of the EXISTS statement
     */
    public function useCustomerBillingAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('CustomerBillingAddress', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the CustomerBillingAddress relation to the SpyCustomer table for a NOT EXISTS query.
     *
     * @see useCustomerBillingAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery The inner query object of the NOT EXISTS statement
     */
    public function useCustomerBillingAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('CustomerBillingAddress', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Orm\Zed\Customer\Persistence\SpyCustomer object
     *
     * @param \Orm\Zed\Customer\Persistence\SpyCustomer|ObjectCollection $spyCustomer the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCustomerShippingAddress($spyCustomer, ?string $comparison = null)
    {
        if ($spyCustomer instanceof \Orm\Zed\Customer\Persistence\SpyCustomer) {
            $this
                ->addUsingAlias(SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS, $spyCustomer->getDefaultShippingAddress(), $comparison);

            return $this;
        } elseif ($spyCustomer instanceof ObjectCollection) {
            $this
                ->useCustomerShippingAddressQuery()
                ->filterByPrimaryKeys($spyCustomer->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCustomerShippingAddress() only accepts arguments of type \Orm\Zed\Customer\Persistence\SpyCustomer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CustomerShippingAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCustomerShippingAddress(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CustomerShippingAddress');

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
            $this->addJoinObject($join, 'CustomerShippingAddress');
        }

        return $this;
    }

    /**
     * Use the CustomerShippingAddress relation SpyCustomer object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery A secondary query class using the current class as primary query
     */
    public function useCustomerShippingAddressQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCustomerShippingAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CustomerShippingAddress', '\Orm\Zed\Customer\Persistence\SpyCustomerQuery');
    }

    /**
     * Use the CustomerShippingAddress relation SpyCustomer object
     *
     * @param callable(\Orm\Zed\Customer\Persistence\SpyCustomerQuery):\Orm\Zed\Customer\Persistence\SpyCustomerQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCustomerShippingAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCustomerShippingAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the CustomerShippingAddress relation to the SpyCustomer table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery The inner query object of the EXISTS statement
     */
    public function useCustomerShippingAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('CustomerShippingAddress', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the CustomerShippingAddress relation to the SpyCustomer table for a NOT EXISTS query.
     *
     * @see useCustomerShippingAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery The inner query object of the NOT EXISTS statement
     */
    public function useCustomerShippingAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('CustomerShippingAddress', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildSpyCustomerAddress $spyCustomerAddress Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCustomerAddress = null)
    {
        if ($spyCustomerAddress) {
            $this->addUsingAlias(SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS, $spyCustomerAddress->getIdCustomerAddress(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the spy_customer_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerAddressTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCustomerAddressTableMap::clearInstancePool();
            SpyCustomerAddressTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerAddressTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCustomerAddressTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCustomerAddressTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCustomerAddressTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyCustomerAddressTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyCustomerAddressTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyCustomerAddressTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyCustomerAddressTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyCustomerAddressTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyCustomerAddressTableMap::COL_CREATED_AT);

        return $this;
    }

}
