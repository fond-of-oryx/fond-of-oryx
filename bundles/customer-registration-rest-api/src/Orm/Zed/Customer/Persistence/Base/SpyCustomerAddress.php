<?php

namespace Orm\Zed\Customer\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\Country\Persistence\SpyCountry;
use Orm\Zed\Country\Persistence\SpyCountryQuery;
use Orm\Zed\Country\Persistence\SpyRegion;
use Orm\Zed\Country\Persistence\SpyRegionQuery;
use Orm\Zed\Customer\Persistence\SpyCustomer as ChildSpyCustomer;
use Orm\Zed\Customer\Persistence\SpyCustomerAddress as ChildSpyCustomerAddress;
use Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery as ChildSpyCustomerAddressQuery;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery as ChildSpyCustomerQuery;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerAddressTableMap;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'spy_customer_address' table.
 *
 *
 *
 * @package    propel.generator.Orm.Zed.Customer.Persistence.Base
 */
abstract class SpyCustomerAddress implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Customer\\Persistence\\Map\\SpyCustomerAddressTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var bool
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = [];

    /**
     * The value for the id_customer_address field.
     *
     * @var        int
     */
    protected $id_customer_address;

    /**
     * The value for the fk_country field.
     *
     * @var        int
     */
    protected $fk_country;

    /**
     * The value for the fk_customer field.
     *
     * @var        int
     */
    protected $fk_customer;

    /**
     * The value for the fk_region field.
     *
     * @var        int|null
     */
    protected $fk_region;

    /**
     * The value for the address1 field.
     *
     * @var        string|null
     */
    protected $address1;

    /**
     * The value for the address2 field.
     *
     * @var        string|null
     */
    protected $address2;

    /**
     * The value for the address3 field.
     *
     * @var        string|null
     */
    protected $address3;

    /**
     * The value for the anonymized_at field.
     *
     * @var        DateTime|null
     */
    protected $anonymized_at;

    /**
     * The value for the city field.
     *
     * @var        string|null
     */
    protected $city;

    /**
     * The value for the comment field.
     *
     * @var        string|null
     */
    protected $comment;

    /**
     * The value for the company field.
     *
     * @var        string|null
     */
    protected $company;

    /**
     * The value for the deleted_at field.
     *
     * @var        DateTime|null
     */
    protected $deleted_at;

    /**
     * The value for the first_name field.
     *
     * @var        string
     */
    protected $first_name;

    /**
     * The value for the last_name field.
     *
     * @var        string
     */
    protected $last_name;

    /**
     * The value for the phone field.
     *
     * @var        string|null
     */
    protected $phone;

    /**
     * The value for the salutation field.
     *
     * @var        int|null
     */
    protected $salutation;

    /**
     * The value for the zip_code field.
     *
     * @var        string|null
     */
    protected $zip_code;

    /**
     * The value for the created_at field.
     *
     * @var        DateTime|null
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime|null
     */
    protected $updated_at;

    /**
     * @var        ChildSpyCustomer
     */
    protected $aCustomer;

    /**
     * @var        SpyRegion
     */
    protected $aRegion;

    /**
     * @var        SpyCountry
     */
    protected $aCountry;

    /**
     * @var        ObjectCollection|ChildSpyCustomer[] Collection to store aggregation of ChildSpyCustomer objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCustomer> Collection to store aggregation of ChildSpyCustomer objects.
     */
    protected $collCustomerBillingAddresses;
    protected $collCustomerBillingAddressesPartial;

    /**
     * @var        ObjectCollection|ChildSpyCustomer[] Collection to store aggregation of ChildSpyCustomer objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCustomer> Collection to store aggregation of ChildSpyCustomer objects.
     */
    protected $collCustomerShippingAddresses;
    protected $collCustomerShippingAddressesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCustomer[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCustomer>
     */
    protected $customerBillingAddressesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCustomer[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCustomer>
     */
    protected $customerShippingAddressesScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\Customer\Persistence\Base\SpyCustomerAddress object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return bool True if the object has been modified.
     */
    public function isModified(): bool
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return bool True if $col has been modified.
     */
    public function isColumnModified(string $col): bool
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return bool True, if the object has never been persisted.
     */
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     */
    public function setNew(bool $b): void
    {
        $this->new = $b;
    }

    /**
     * Whether this object has been deleted.
     * @return bool The deleted state of this object.
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param bool $b The deleted state of this object.
     * @return void
     */
    public function setDeleted(bool $b): void
    {
        $this->deleted = $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified(?string $col = null): void
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>SpyCustomerAddress</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyCustomerAddress</code>, delegates to
     * <code>equals(SpyCustomerAddress)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     * @return bool Whether equal to the object specified.
     */
    public function equals($obj): bool
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns(): array
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return bool
     */
    public function hasVirtualColumn(string $name): bool
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return mixed
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn(string $name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of nonexistent virtual column `%s`.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @param mixed $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn(string $name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param string $msg
     * @param int $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log(string $msg, int $priority = Propel::LOG_INFO): void
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param \Propel\Runtime\Parser\AbstractParser|string $parser An AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME): string
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     *
     * @return array<string>
     */
    public function __sleep(): array
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id_customer_address] column value.
     *
     * @return int
     */
    public function getIdCustomerAddress()
    {
        return $this->id_customer_address;
    }

    /**
     * Get the [fk_country] column value.
     *
     * @return int
     */
    public function getFkCountry()
    {
        return $this->fk_country;
    }

    /**
     * Get the [fk_customer] column value.
     *
     * @return int
     */
    public function getFkCustomer()
    {
        return $this->fk_customer;
    }

    /**
     * Get the [fk_region] column value.
     *
     * @return int|null
     */
    public function getFkRegion()
    {
        return $this->fk_region;
    }

    /**
     * Get the [address1] column value.
     *
     * @return string|null
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Get the [address2] column value.
     *
     * @return string|null
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Get the [address3] column value.
     *
     * @return string|null
     */
    public function getAddress3()
    {
        return $this->address3;
    }

    /**
     * Get the [optionally formatted] temporal [anonymized_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getAnonymizedAt($format = null)
    {
        if ($format === null) {
            return $this->anonymized_at;
        } else {
            return $this->anonymized_at instanceof \DateTimeInterface ? $this->anonymized_at->format($format) : null;
        }
    }

    /**
     * Get the [city] column value.
     *
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the [comment] column value.
     *
     * @return string|null
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Get the [company] column value.
     *
     * @return string|null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Get the [optionally formatted] temporal [deleted_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getDeletedAt($format = null)
    {
        if ($format === null) {
            return $this->deleted_at;
        } else {
            return $this->deleted_at instanceof \DateTimeInterface ? $this->deleted_at->format($format) : null;
        }
    }

    /**
     * Get the [first_name] column value.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Get the [last_name] column value.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Get the [phone] column value.
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the [salutation] column value.
     *
     * @return string|null
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSalutation()
    {
        if (null === $this->salutation) {
            return null;
        }
        $valueSet = SpyCustomerAddressTableMap::getValueSet(SpyCustomerAddressTableMap::COL_SALUTATION);
        if (!isset($valueSet[$this->salutation])) {
            throw new PropelException('Unknown stored enum key: ' . $this->salutation);
        }

        return $valueSet[$this->salutation];
    }

    /**
     * Get the [zip_code] column value.
     *
     * @return string|null
     */
    public function getZipCode()
    {
        return $this->zip_code;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getCreatedAt($format = null)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getUpdatedAt($format = null)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id_customer_address] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdCustomerAddress($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_customer_address !== $v) {
            $this->id_customer_address = $v;
            $this->modifiedColumns[SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_country] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkCountry($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fk_country !== $v) {
            $this->fk_country = $v;
            $this->modifiedColumns[SpyCustomerAddressTableMap::COL_FK_COUNTRY] = true;
        }

        if ($this->aCountry !== null && $this->aCountry->getIdCountry() !== $v) {
            $this->aCountry = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_customer] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkCustomer($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fk_customer !== $v) {
            $this->fk_customer = $v;
            $this->modifiedColumns[SpyCustomerAddressTableMap::COL_FK_CUSTOMER] = true;
        }

        if ($this->aCustomer !== null && $this->aCustomer->getIdCustomer() !== $v) {
            $this->aCustomer = null;
        }

        return $this;
    }

    /**
     * Set the value of [fk_region] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkRegion($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fk_region !== $v) {
            $this->fk_region = $v;
            $this->modifiedColumns[SpyCustomerAddressTableMap::COL_FK_REGION] = true;
        }

        if ($this->aRegion !== null && $this->aRegion->getIdRegion() !== $v) {
            $this->aRegion = null;
        }

        return $this;
    }

    /**
     * Set the value of [address1] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAddress1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address1 !== $v) {
            $this->address1 = $v;
            $this->modifiedColumns[SpyCustomerAddressTableMap::COL_ADDRESS1] = true;
        }

        return $this;
    }

    /**
     * Set the value of [address2] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAddress2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address2 !== $v) {
            $this->address2 = $v;
            $this->modifiedColumns[SpyCustomerAddressTableMap::COL_ADDRESS2] = true;
        }

        return $this;
    }

    /**
     * Set the value of [address3] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAddress3($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address3 !== $v) {
            $this->address3 = $v;
            $this->modifiedColumns[SpyCustomerAddressTableMap::COL_ADDRESS3] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [anonymized_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setAnonymizedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->anonymized_at !== null || $dt !== null) {
            if ($this->anonymized_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->anonymized_at->format("Y-m-d H:i:s.u")) {
                $this->anonymized_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyCustomerAddressTableMap::COL_ANONYMIZED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [city] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[SpyCustomerAddressTableMap::COL_CITY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [comment] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setComment($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->comment !== $v) {
            $this->comment = $v;
            $this->modifiedColumns[SpyCustomerAddressTableMap::COL_COMMENT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [company] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCompany($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->company !== $v) {
            $this->company = $v;
            $this->modifiedColumns[SpyCustomerAddressTableMap::COL_COMPANY] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [deleted_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setDeletedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->deleted_at !== null || $dt !== null) {
            if ($this->deleted_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->deleted_at->format("Y-m-d H:i:s.u")) {
                $this->deleted_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyCustomerAddressTableMap::COL_DELETED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [first_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->first_name !== $v) {
            $this->first_name = $v;
            $this->modifiedColumns[SpyCustomerAddressTableMap::COL_FIRST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [last_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_name !== $v) {
            $this->last_name = $v;
            $this->modifiedColumns[SpyCustomerAddressTableMap::COL_LAST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [phone] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[SpyCustomerAddressTableMap::COL_PHONE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [salutation] column.
     *
     * @param string|null $v new value
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSalutation($v)
    {
        if ($v !== null) {
            $valueSet = SpyCustomerAddressTableMap::getValueSet(SpyCustomerAddressTableMap::COL_SALUTATION);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->salutation !== $v) {
            $this->salutation = $v;
            $this->modifiedColumns[SpyCustomerAddressTableMap::COL_SALUTATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [zip_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setZipCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zip_code !== $v) {
            $this->zip_code = $v;
            $this->modifiedColumns[SpyCustomerAddressTableMap::COL_ZIP_CODE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyCustomerAddressTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyCustomerAddressTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return bool Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues(): bool
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by DataFetcher->fetch().
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param bool $rehydrate Whether this object is being re-hydrated from the database.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int next starting column
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyCustomerAddressTableMap::translateFieldName('IdCustomerAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_customer_address = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyCustomerAddressTableMap::translateFieldName('FkCountry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_country = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyCustomerAddressTableMap::translateFieldName('FkCustomer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_customer = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyCustomerAddressTableMap::translateFieldName('FkRegion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_region = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyCustomerAddressTableMap::translateFieldName('Address1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address1 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyCustomerAddressTableMap::translateFieldName('Address2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address2 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyCustomerAddressTableMap::translateFieldName('Address3', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address3 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyCustomerAddressTableMap::translateFieldName('AnonymizedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->anonymized_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyCustomerAddressTableMap::translateFieldName('City', TableMap::TYPE_PHPNAME, $indexType)];
            $this->city = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyCustomerAddressTableMap::translateFieldName('Comment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comment = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpyCustomerAddressTableMap::translateFieldName('Company', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SpyCustomerAddressTableMap::translateFieldName('DeletedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->deleted_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SpyCustomerAddressTableMap::translateFieldName('FirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->first_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SpyCustomerAddressTableMap::translateFieldName('LastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SpyCustomerAddressTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SpyCustomerAddressTableMap::translateFieldName('Salutation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->salutation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : SpyCustomerAddressTableMap::translateFieldName('ZipCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->zip_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : SpyCustomerAddressTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : SpyCustomerAddressTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 19; // 19 = SpyCustomerAddressTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Customer\\Persistence\\SpyCustomerAddress'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function ensureConsistency(): void
    {
        if ($this->aCountry !== null && $this->fk_country !== $this->aCountry->getIdCountry()) {
            $this->aCountry = null;
        }
        if ($this->aCustomer !== null && $this->fk_customer !== $this->aCustomer->getIdCustomer()) {
            $this->aCustomer = null;
        }
        if ($this->aRegion !== null && $this->fk_region !== $this->aRegion->getIdRegion()) {
            $this->aRegion = null;
        }
    }

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param bool $deep (optional) Whether to also de-associated any related objects.
     * @param ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SpyCustomerAddressTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyCustomerAddressQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCustomer = null;
            $this->aRegion = null;
            $this->aCountry = null;
            $this->collCustomerBillingAddresses = null;

            $this->collCustomerShippingAddresses = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyCustomerAddress::setDeleted()
     * @see SpyCustomerAddress::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerAddressTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyCustomerAddressQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    public function save(?ConnectionInterface $con = null): int
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerAddressTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyCustomerAddressTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyCustomerAddressTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt($highPrecision);
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(SpyCustomerAddressTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(\Propel\Runtime\Util\PropelDateTime::createHighPrecision());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                SpyCustomerAddressTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con): int
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCustomer !== null) {
                if ($this->aCustomer->isModified() || $this->aCustomer->isNew()) {
                    $affectedRows += $this->aCustomer->save($con);
                }
                $this->setCustomer($this->aCustomer);
            }

            if ($this->aRegion !== null) {
                if ($this->aRegion->isModified() || $this->aRegion->isNew()) {
                    $affectedRows += $this->aRegion->save($con);
                }
                $this->setRegion($this->aRegion);
            }

            if ($this->aCountry !== null) {
                if ($this->aCountry->isModified() || $this->aCountry->isNew()) {
                    $affectedRows += $this->aCountry->save($con);
                }
                $this->setCountry($this->aCountry);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->customerBillingAddressesScheduledForDeletion !== null) {
                if (!$this->customerBillingAddressesScheduledForDeletion->isEmpty()) {
                    foreach ($this->customerBillingAddressesScheduledForDeletion as $customerBillingAddress) {
                        // need to save related object because we set the relation to null
                        $customerBillingAddress->save($con);
                    }
                    $this->customerBillingAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collCustomerBillingAddresses !== null) {
                foreach ($this->collCustomerBillingAddresses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->customerShippingAddressesScheduledForDeletion !== null) {
                if (!$this->customerShippingAddressesScheduledForDeletion->isEmpty()) {
                    foreach ($this->customerShippingAddressesScheduledForDeletion as $customerShippingAddress) {
                        // need to save related object because we set the relation to null
                        $customerShippingAddress->save($con);
                    }
                    $this->customerShippingAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collCustomerShippingAddresses !== null) {
                foreach ($this->collCustomerShippingAddresses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    }

    /**
     * Insert the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con): void
    {
        $modifiedColumns = [];
        $index = 0;

        $this->modifiedColumns[SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS] = true;
        if (null !== $this->id_customer_address) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'id_customer_address';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_FK_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = 'fk_country';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_FK_CUSTOMER)) {
            $modifiedColumns[':p' . $index++]  = 'fk_customer';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_FK_REGION)) {
            $modifiedColumns[':p' . $index++]  = 'fk_region';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_ADDRESS1)) {
            $modifiedColumns[':p' . $index++]  = 'address1';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_ADDRESS2)) {
            $modifiedColumns[':p' . $index++]  = 'address2';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_ADDRESS3)) {
            $modifiedColumns[':p' . $index++]  = 'address3';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_ANONYMIZED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'anonymized_at';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_CITY)) {
            $modifiedColumns[':p' . $index++]  = 'city';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = 'comment';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_COMPANY)) {
            $modifiedColumns[':p' . $index++]  = 'company';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_DELETED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'deleted_at';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'first_name';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'last_name';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = 'phone';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_SALUTATION)) {
            $modifiedColumns[':p' . $index++]  = 'salutation';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_ZIP_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'zip_code';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_customer_address (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_customer_address':
                        $stmt->bindValue($identifier, $this->id_customer_address, PDO::PARAM_INT);
                        break;
                    case 'fk_country':
                        $stmt->bindValue($identifier, $this->fk_country, PDO::PARAM_INT);
                        break;
                    case 'fk_customer':
                        $stmt->bindValue($identifier, $this->fk_customer, PDO::PARAM_INT);
                        break;
                    case 'fk_region':
                        $stmt->bindValue($identifier, $this->fk_region, PDO::PARAM_INT);
                        break;
                    case 'address1':
                        $stmt->bindValue($identifier, $this->address1, PDO::PARAM_STR);
                        break;
                    case 'address2':
                        $stmt->bindValue($identifier, $this->address2, PDO::PARAM_STR);
                        break;
                    case 'address3':
                        $stmt->bindValue($identifier, $this->address3, PDO::PARAM_STR);
                        break;
                    case 'anonymized_at':
                        $stmt->bindValue($identifier, $this->anonymized_at ? $this->anonymized_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'city':
                        $stmt->bindValue($identifier, $this->city, PDO::PARAM_STR);
                        break;
                    case 'comment':
                        $stmt->bindValue($identifier, $this->comment, PDO::PARAM_STR);
                        break;
                    case 'company':
                        $stmt->bindValue($identifier, $this->company, PDO::PARAM_STR);
                        break;
                    case 'deleted_at':
                        $stmt->bindValue($identifier, $this->deleted_at ? $this->deleted_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'first_name':
                        $stmt->bindValue($identifier, $this->first_name, PDO::PARAM_STR);
                        break;
                    case 'last_name':
                        $stmt->bindValue($identifier, $this->last_name, PDO::PARAM_STR);
                        break;
                    case 'phone':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
                        break;
                    case 'salutation':
                        $stmt->bindValue($identifier, $this->salutation, PDO::PARAM_INT);
                        break;
                    case 'zip_code':
                        $stmt->bindValue($identifier, $this->zip_code, PDO::PARAM_STR);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_customer_address_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdCustomerAddress($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @return int Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con): int
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SpyCustomerAddressTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIdCustomerAddress();

            case 1:
                return $this->getFkCountry();

            case 2:
                return $this->getFkCustomer();

            case 3:
                return $this->getFkRegion();

            case 4:
                return $this->getAddress1();

            case 5:
                return $this->getAddress2();

            case 6:
                return $this->getAddress3();

            case 7:
                return $this->getAnonymizedAt();

            case 8:
                return $this->getCity();

            case 9:
                return $this->getComment();

            case 10:
                return $this->getCompany();

            case 11:
                return $this->getDeletedAt();

            case 12:
                return $this->getFirstName();

            case 13:
                return $this->getLastName();

            case 14:
                return $this->getPhone();

            case 15:
                return $this->getSalutation();

            case 16:
                return $this->getZipCode();

            case 17:
                return $this->getCreatedAt();

            case 18:
                return $this->getUpdatedAt();

            default:
                return null;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param bool $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = [], bool $includeForeignObjects = false): array
    {
        if (isset($alreadyDumpedObjects['SpyCustomerAddress'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyCustomerAddress'][$this->hashCode()] = true;
        $keys = SpyCustomerAddressTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdCustomerAddress(),
            $keys[1] => $this->getFkCountry(),
            $keys[2] => $this->getFkCustomer(),
            $keys[3] => $this->getFkRegion(),
            $keys[4] => $this->getAddress1(),
            $keys[5] => $this->getAddress2(),
            $keys[6] => $this->getAddress3(),
            $keys[7] => $this->getAnonymizedAt(),
            $keys[8] => $this->getCity(),
            $keys[9] => $this->getComment(),
            $keys[10] => $this->getCompany(),
            $keys[11] => $this->getDeletedAt(),
            $keys[12] => $this->getFirstName(),
            $keys[13] => $this->getLastName(),
            $keys[14] => $this->getPhone(),
            $keys[15] => $this->getSalutation(),
            $keys[16] => $this->getZipCode(),
            $keys[17] => $this->getCreatedAt(),
            $keys[18] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[17]] instanceof \DateTimeInterface) {
            $result[$keys[17]] = $result[$keys[17]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[18]] instanceof \DateTimeInterface) {
            $result[$keys[18]] = $result[$keys[18]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCustomer) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomer';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer';
                        break;
                    default:
                        $key = 'Customer';
                }

                $result[$key] = $this->aCustomer->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aRegion) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyRegion';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_region';
                        break;
                    default:
                        $key = 'Region';
                }

                $result[$key] = $this->aRegion->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCountry) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCountry';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_country';
                        break;
                    default:
                        $key = 'Country';
                }

                $result[$key] = $this->aCountry->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collCustomerBillingAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customers';
                        break;
                    default:
                        $key = 'CustomerBillingAddresses';
                }

                $result[$key] = $this->collCustomerBillingAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCustomerShippingAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customers';
                        break;
                    default:
                        $key = 'CustomerShippingAddresses';
                }

                $result[$key] = $this->collCustomerShippingAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SpyCustomerAddressTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return $this
     */
    public function setByPosition(int $pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdCustomerAddress($value);
                break;
            case 1:
                $this->setFkCountry($value);
                break;
            case 2:
                $this->setFkCustomer($value);
                break;
            case 3:
                $this->setFkRegion($value);
                break;
            case 4:
                $this->setAddress1($value);
                break;
            case 5:
                $this->setAddress2($value);
                break;
            case 6:
                $this->setAddress3($value);
                break;
            case 7:
                $this->setAnonymizedAt($value);
                break;
            case 8:
                $this->setCity($value);
                break;
            case 9:
                $this->setComment($value);
                break;
            case 10:
                $this->setCompany($value);
                break;
            case 11:
                $this->setDeletedAt($value);
                break;
            case 12:
                $this->setFirstName($value);
                break;
            case 13:
                $this->setLastName($value);
                break;
            case 14:
                $this->setPhone($value);
                break;
            case 15:
                $valueSet = SpyCustomerAddressTableMap::getValueSet(SpyCustomerAddressTableMap::COL_SALUTATION);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setSalutation($value);
                break;
            case 16:
                $this->setZipCode($value);
                break;
            case 17:
                $this->setCreatedAt($value);
                break;
            case 18:
                $this->setUpdatedAt($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param array $arr An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = SpyCustomerAddressTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdCustomerAddress($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkCountry($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFkCustomer($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFkRegion($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAddress1($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAddress2($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAddress3($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setAnonymizedAt($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCity($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setComment($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCompany($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setDeletedAt($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setFirstName($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setLastName($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setPhone($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setSalutation($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setZipCode($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setCreatedAt($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setUpdatedAt($arr[$keys[18]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this The current object, for fluid interface
     */
    public function importFrom($parser, string $data, string $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(SpyCustomerAddressTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS, $this->id_customer_address);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_FK_COUNTRY)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_FK_COUNTRY, $this->fk_country);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_FK_CUSTOMER)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_FK_CUSTOMER, $this->fk_customer);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_FK_REGION)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_FK_REGION, $this->fk_region);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_ADDRESS1)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_ADDRESS1, $this->address1);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_ADDRESS2)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_ADDRESS2, $this->address2);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_ADDRESS3)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_ADDRESS3, $this->address3);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_ANONYMIZED_AT)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_ANONYMIZED_AT, $this->anonymized_at);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_CITY)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_CITY, $this->city);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_COMMENT)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_COMMENT, $this->comment);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_COMPANY)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_COMPANY, $this->company);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_DELETED_AT)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_DELETED_AT, $this->deleted_at);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_FIRST_NAME)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_FIRST_NAME, $this->first_name);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_LAST_NAME)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_LAST_NAME, $this->last_name);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_PHONE)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_SALUTATION)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_SALUTATION, $this->salutation);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_ZIP_CODE)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_ZIP_CODE, $this->zip_code);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyCustomerAddressTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyCustomerAddressTableMap::COL_UPDATED_AT, $this->updated_at);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $criteria = ChildSpyCustomerAddressQuery::create();
        $criteria->add(SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS, $this->id_customer_address);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int|string Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getIdCustomerAddress();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdCustomerAddress();
    }

    /**
     * Generic method to set the primary key (id_customer_address column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdCustomerAddress($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdCustomerAddress();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Customer\Persistence\SpyCustomerAddress (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkCountry($this->getFkCountry());
        $copyObj->setFkCustomer($this->getFkCustomer());
        $copyObj->setFkRegion($this->getFkRegion());
        $copyObj->setAddress1($this->getAddress1());
        $copyObj->setAddress2($this->getAddress2());
        $copyObj->setAddress3($this->getAddress3());
        $copyObj->setAnonymizedAt($this->getAnonymizedAt());
        $copyObj->setCity($this->getCity());
        $copyObj->setComment($this->getComment());
        $copyObj->setCompany($this->getCompany());
        $copyObj->setDeletedAt($this->getDeletedAt());
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setLastName($this->getLastName());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setSalutation($this->getSalutation());
        $copyObj->setZipCode($this->getZipCode());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getCustomerBillingAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCustomerBillingAddress($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCustomerShippingAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCustomerShippingAddress($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCustomerAddress(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerAddress Clone of current object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function copy(bool $deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildSpyCustomer object.
     *
     * @param ChildSpyCustomer $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCustomer(ChildSpyCustomer $v = null)
    {
        if ($v === null) {
            $this->setFkCustomer(NULL);
        } else {
            $this->setFkCustomer($v->getIdCustomer());
        }

        $this->aCustomer = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyCustomer object, it will not be re-added.
        if ($v !== null) {
            $v->addAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyCustomer object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyCustomer The associated ChildSpyCustomer object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCustomer(?ConnectionInterface $con = null)
    {
        if ($this->aCustomer === null && ($this->fk_customer != 0)) {
            $this->aCustomer = ChildSpyCustomerQuery::create()->findPk($this->fk_customer, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCustomer->addAddresses($this);
             */
        }

        return $this->aCustomer;
    }

    /**
     * Declares an association between this object and a SpyRegion object.
     *
     * @param SpyRegion|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setRegion(SpyRegion $v = null)
    {
        if ($v === null) {
            $this->setFkRegion(NULL);
        } else {
            $this->setFkRegion($v->getIdRegion());
        }

        $this->aRegion = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyRegion object, it will not be re-added.
        if ($v !== null) {
            $v->addCustomerAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyRegion object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyRegion|null The associated SpyRegion object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getRegion(?ConnectionInterface $con = null)
    {
        if ($this->aRegion === null && ($this->fk_region != 0)) {
            $this->aRegion = SpyRegionQuery::create()->findPk($this->fk_region, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aRegion->addCustomerAddresses($this);
             */
        }

        return $this->aRegion;
    }

    /**
     * Declares an association between this object and a SpyCountry object.
     *
     * @param SpyCountry $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setCountry(SpyCountry $v = null)
    {
        if ($v === null) {
            $this->setFkCountry(NULL);
        } else {
            $this->setFkCountry($v->getIdCountry());
        }

        $this->aCountry = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyCountry object, it will not be re-added.
        if ($v !== null) {
            $v->addCustomerAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyCountry object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyCountry The associated SpyCountry object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCountry(?ConnectionInterface $con = null)
    {
        if ($this->aCountry === null && ($this->fk_country != 0)) {
            $this->aCountry = SpyCountryQuery::create()->findPk($this->fk_country, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCountry->addCustomerAddresses($this);
             */
        }

        return $this->aCountry;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('CustomerBillingAddress' === $relationName) {
            $this->initCustomerBillingAddresses();
            return;
        }
        if ('CustomerShippingAddress' === $relationName) {
            $this->initCustomerShippingAddresses();
            return;
        }
    }

    /**
     * Clears out the collCustomerBillingAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCustomerBillingAddresses()
     */
    public function clearCustomerBillingAddresses()
    {
        $this->collCustomerBillingAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCustomerBillingAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCustomerBillingAddresses($v = true): void
    {
        $this->collCustomerBillingAddressesPartial = $v;
    }

    /**
     * Initializes the collCustomerBillingAddresses collection.
     *
     * By default this just sets the collCustomerBillingAddresses collection to an empty array (like clearcollCustomerBillingAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCustomerBillingAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collCustomerBillingAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCustomerTableMap::getTableMap()->getCollectionClassName();

        $this->collCustomerBillingAddresses = new $collectionClassName;
        $this->collCustomerBillingAddresses->setModel('\Orm\Zed\Customer\Persistence\SpyCustomer');
    }

    /**
     * Gets an array of ChildSpyCustomer objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCustomerAddress is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCustomer[] List of ChildSpyCustomer objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCustomer> List of ChildSpyCustomer objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCustomerBillingAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCustomerBillingAddressesPartial && !$this->isNew();
        if (null === $this->collCustomerBillingAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCustomerBillingAddresses) {
                    $this->initCustomerBillingAddresses();
                } else {
                    $collectionClassName = SpyCustomerTableMap::getTableMap()->getCollectionClassName();

                    $collCustomerBillingAddresses = new $collectionClassName;
                    $collCustomerBillingAddresses->setModel('\Orm\Zed\Customer\Persistence\SpyCustomer');

                    return $collCustomerBillingAddresses;
                }
            } else {
                $collCustomerBillingAddresses = ChildSpyCustomerQuery::create(null, $criteria)
                    ->filterByBillingAddress($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCustomerBillingAddressesPartial && count($collCustomerBillingAddresses)) {
                        $this->initCustomerBillingAddresses(false);

                        foreach ($collCustomerBillingAddresses as $obj) {
                            if (false == $this->collCustomerBillingAddresses->contains($obj)) {
                                $this->collCustomerBillingAddresses->append($obj);
                            }
                        }

                        $this->collCustomerBillingAddressesPartial = true;
                    }

                    return $collCustomerBillingAddresses;
                }

                if ($partial && $this->collCustomerBillingAddresses) {
                    foreach ($this->collCustomerBillingAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collCustomerBillingAddresses[] = $obj;
                        }
                    }
                }

                $this->collCustomerBillingAddresses = $collCustomerBillingAddresses;
                $this->collCustomerBillingAddressesPartial = false;
            }
        }

        return $this->collCustomerBillingAddresses;
    }

    /**
     * Sets a collection of ChildSpyCustomer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $customerBillingAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCustomerBillingAddresses(Collection $customerBillingAddresses, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCustomer[] $customerBillingAddressesToDelete */
        $customerBillingAddressesToDelete = $this->getCustomerBillingAddresses(new Criteria(), $con)->diff($customerBillingAddresses);


        $this->customerBillingAddressesScheduledForDeletion = $customerBillingAddressesToDelete;

        foreach ($customerBillingAddressesToDelete as $customerBillingAddressRemoved) {
            $customerBillingAddressRemoved->setBillingAddress(null);
        }

        $this->collCustomerBillingAddresses = null;
        foreach ($customerBillingAddresses as $customerBillingAddress) {
            $this->addCustomerBillingAddress($customerBillingAddress);
        }

        $this->collCustomerBillingAddresses = $customerBillingAddresses;
        $this->collCustomerBillingAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCustomer objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCustomer objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCustomerBillingAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCustomerBillingAddressesPartial && !$this->isNew();
        if (null === $this->collCustomerBillingAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCustomerBillingAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCustomerBillingAddresses());
            }

            $query = ChildSpyCustomerQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBillingAddress($this)
                ->count($con);
        }

        return count($this->collCustomerBillingAddresses);
    }

    /**
     * Method called to associate a ChildSpyCustomer object to this object
     * through the ChildSpyCustomer foreign key attribute.
     *
     * @param ChildSpyCustomer $l ChildSpyCustomer
     * @return $this The current object (for fluent API support)
     */
    public function addCustomerBillingAddress(ChildSpyCustomer $l)
    {
        if ($this->collCustomerBillingAddresses === null) {
            $this->initCustomerBillingAddresses();
            $this->collCustomerBillingAddressesPartial = true;
        }

        if (!$this->collCustomerBillingAddresses->contains($l)) {
            $this->doAddCustomerBillingAddress($l);

            if ($this->customerBillingAddressesScheduledForDeletion and $this->customerBillingAddressesScheduledForDeletion->contains($l)) {
                $this->customerBillingAddressesScheduledForDeletion->remove($this->customerBillingAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCustomer $customerBillingAddress The ChildSpyCustomer object to add.
     */
    protected function doAddCustomerBillingAddress(ChildSpyCustomer $customerBillingAddress): void
    {
        $this->collCustomerBillingAddresses[]= $customerBillingAddress;
        $customerBillingAddress->setBillingAddress($this);
    }

    /**
     * @param ChildSpyCustomer $customerBillingAddress The ChildSpyCustomer object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCustomerBillingAddress(ChildSpyCustomer $customerBillingAddress)
    {
        if ($this->getCustomerBillingAddresses()->contains($customerBillingAddress)) {
            $pos = $this->collCustomerBillingAddresses->search($customerBillingAddress);
            $this->collCustomerBillingAddresses->remove($pos);
            if (null === $this->customerBillingAddressesScheduledForDeletion) {
                $this->customerBillingAddressesScheduledForDeletion = clone $this->collCustomerBillingAddresses;
                $this->customerBillingAddressesScheduledForDeletion->clear();
            }
            $this->customerBillingAddressesScheduledForDeletion[]= $customerBillingAddress;
            $customerBillingAddress->setBillingAddress(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCustomerAddress is new, it will return
     * an empty collection; or if this SpyCustomerAddress has previously
     * been saved, it will retrieve related CustomerBillingAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCustomerAddress.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCustomer[] List of ChildSpyCustomer objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCustomer}> List of ChildSpyCustomer objects
     */
    public function getCustomerBillingAddressesJoinLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCustomerQuery::create(null, $criteria);
        $query->joinWith('Locale', $joinBehavior);

        return $this->getCustomerBillingAddresses($query, $con);
    }

    /**
     * Clears out the collCustomerShippingAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCustomerShippingAddresses()
     */
    public function clearCustomerShippingAddresses()
    {
        $this->collCustomerShippingAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCustomerShippingAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCustomerShippingAddresses($v = true): void
    {
        $this->collCustomerShippingAddressesPartial = $v;
    }

    /**
     * Initializes the collCustomerShippingAddresses collection.
     *
     * By default this just sets the collCustomerShippingAddresses collection to an empty array (like clearcollCustomerShippingAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCustomerShippingAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collCustomerShippingAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCustomerTableMap::getTableMap()->getCollectionClassName();

        $this->collCustomerShippingAddresses = new $collectionClassName;
        $this->collCustomerShippingAddresses->setModel('\Orm\Zed\Customer\Persistence\SpyCustomer');
    }

    /**
     * Gets an array of ChildSpyCustomer objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCustomerAddress is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCustomer[] List of ChildSpyCustomer objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCustomer> List of ChildSpyCustomer objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCustomerShippingAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCustomerShippingAddressesPartial && !$this->isNew();
        if (null === $this->collCustomerShippingAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCustomerShippingAddresses) {
                    $this->initCustomerShippingAddresses();
                } else {
                    $collectionClassName = SpyCustomerTableMap::getTableMap()->getCollectionClassName();

                    $collCustomerShippingAddresses = new $collectionClassName;
                    $collCustomerShippingAddresses->setModel('\Orm\Zed\Customer\Persistence\SpyCustomer');

                    return $collCustomerShippingAddresses;
                }
            } else {
                $collCustomerShippingAddresses = ChildSpyCustomerQuery::create(null, $criteria)
                    ->filterByShippingAddress($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCustomerShippingAddressesPartial && count($collCustomerShippingAddresses)) {
                        $this->initCustomerShippingAddresses(false);

                        foreach ($collCustomerShippingAddresses as $obj) {
                            if (false == $this->collCustomerShippingAddresses->contains($obj)) {
                                $this->collCustomerShippingAddresses->append($obj);
                            }
                        }

                        $this->collCustomerShippingAddressesPartial = true;
                    }

                    return $collCustomerShippingAddresses;
                }

                if ($partial && $this->collCustomerShippingAddresses) {
                    foreach ($this->collCustomerShippingAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collCustomerShippingAddresses[] = $obj;
                        }
                    }
                }

                $this->collCustomerShippingAddresses = $collCustomerShippingAddresses;
                $this->collCustomerShippingAddressesPartial = false;
            }
        }

        return $this->collCustomerShippingAddresses;
    }

    /**
     * Sets a collection of ChildSpyCustomer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $customerShippingAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCustomerShippingAddresses(Collection $customerShippingAddresses, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCustomer[] $customerShippingAddressesToDelete */
        $customerShippingAddressesToDelete = $this->getCustomerShippingAddresses(new Criteria(), $con)->diff($customerShippingAddresses);


        $this->customerShippingAddressesScheduledForDeletion = $customerShippingAddressesToDelete;

        foreach ($customerShippingAddressesToDelete as $customerShippingAddressRemoved) {
            $customerShippingAddressRemoved->setShippingAddress(null);
        }

        $this->collCustomerShippingAddresses = null;
        foreach ($customerShippingAddresses as $customerShippingAddress) {
            $this->addCustomerShippingAddress($customerShippingAddress);
        }

        $this->collCustomerShippingAddresses = $customerShippingAddresses;
        $this->collCustomerShippingAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCustomer objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCustomer objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCustomerShippingAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCustomerShippingAddressesPartial && !$this->isNew();
        if (null === $this->collCustomerShippingAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCustomerShippingAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCustomerShippingAddresses());
            }

            $query = ChildSpyCustomerQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByShippingAddress($this)
                ->count($con);
        }

        return count($this->collCustomerShippingAddresses);
    }

    /**
     * Method called to associate a ChildSpyCustomer object to this object
     * through the ChildSpyCustomer foreign key attribute.
     *
     * @param ChildSpyCustomer $l ChildSpyCustomer
     * @return $this The current object (for fluent API support)
     */
    public function addCustomerShippingAddress(ChildSpyCustomer $l)
    {
        if ($this->collCustomerShippingAddresses === null) {
            $this->initCustomerShippingAddresses();
            $this->collCustomerShippingAddressesPartial = true;
        }

        if (!$this->collCustomerShippingAddresses->contains($l)) {
            $this->doAddCustomerShippingAddress($l);

            if ($this->customerShippingAddressesScheduledForDeletion and $this->customerShippingAddressesScheduledForDeletion->contains($l)) {
                $this->customerShippingAddressesScheduledForDeletion->remove($this->customerShippingAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCustomer $customerShippingAddress The ChildSpyCustomer object to add.
     */
    protected function doAddCustomerShippingAddress(ChildSpyCustomer $customerShippingAddress): void
    {
        $this->collCustomerShippingAddresses[]= $customerShippingAddress;
        $customerShippingAddress->setShippingAddress($this);
    }

    /**
     * @param ChildSpyCustomer $customerShippingAddress The ChildSpyCustomer object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCustomerShippingAddress(ChildSpyCustomer $customerShippingAddress)
    {
        if ($this->getCustomerShippingAddresses()->contains($customerShippingAddress)) {
            $pos = $this->collCustomerShippingAddresses->search($customerShippingAddress);
            $this->collCustomerShippingAddresses->remove($pos);
            if (null === $this->customerShippingAddressesScheduledForDeletion) {
                $this->customerShippingAddressesScheduledForDeletion = clone $this->collCustomerShippingAddresses;
                $this->customerShippingAddressesScheduledForDeletion->clear();
            }
            $this->customerShippingAddressesScheduledForDeletion[]= $customerShippingAddress;
            $customerShippingAddress->setShippingAddress(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCustomerAddress is new, it will return
     * an empty collection; or if this SpyCustomerAddress has previously
     * been saved, it will retrieve related CustomerShippingAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCustomerAddress.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCustomer[] List of ChildSpyCustomer objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCustomer}> List of ChildSpyCustomer objects
     */
    public function getCustomerShippingAddressesJoinLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCustomerQuery::create(null, $criteria);
        $query->joinWith('Locale', $joinBehavior);

        return $this->getCustomerShippingAddresses($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        if (null !== $this->aCustomer) {
            $this->aCustomer->removeAddress($this);
        }
        if (null !== $this->aRegion) {
            $this->aRegion->removeCustomerAddress($this);
        }
        if (null !== $this->aCountry) {
            $this->aCountry->removeCustomerAddress($this);
        }
        $this->id_customer_address = null;
        $this->fk_country = null;
        $this->fk_customer = null;
        $this->fk_region = null;
        $this->address1 = null;
        $this->address2 = null;
        $this->address3 = null;
        $this->anonymized_at = null;
        $this->city = null;
        $this->comment = null;
        $this->company = null;
        $this->deleted_at = null;
        $this->first_name = null;
        $this->last_name = null;
        $this->phone = null;
        $this->salutation = null;
        $this->zip_code = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);

        return $this;
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param bool $deep Whether to also clear the references on all referrer objects.
     * @return $this
     */
    public function clearAllReferences(bool $deep = false)
    {
        if ($deep) {
            if ($this->collCustomerBillingAddresses) {
                foreach ($this->collCustomerBillingAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCustomerShippingAddresses) {
                foreach ($this->collCustomerShippingAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collCustomerBillingAddresses = null;
        $this->collCustomerShippingAddresses = null;
        $this->aCustomer = null;
        $this->aRegion = null;
        $this->aCountry = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyCustomerAddressTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyCustomerAddressTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    /**
     * Code to be run before persisting the object
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preSave(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postSave(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before inserting to database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postInsert(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postUpdate(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postDelete(?ConnectionInterface $con = null): void
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
