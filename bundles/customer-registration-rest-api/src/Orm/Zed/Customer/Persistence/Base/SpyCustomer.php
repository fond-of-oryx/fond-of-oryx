<?php

namespace Orm\Zed\Customer\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\Customer\Persistence\SpyCustomer as ChildSpyCustomer;
use Orm\Zed\Customer\Persistence\SpyCustomerAddress as ChildSpyCustomerAddress;
use Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery as ChildSpyCustomerAddressQuery;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery as ChildSpyCustomerQuery;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerAddressTableMap;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Orm\Zed\Locale\Persistence\SpyLocale;
use Orm\Zed\Locale\Persistence\SpyLocaleQuery;
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
 * Base class that represents a row from the 'spy_customer' table.
 *
 *
 *
 * @package    propel.generator.Orm.Zed.Customer.Persistence.Base
 */
abstract class SpyCustomer implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Customer\\Persistence\\Map\\SpyCustomerTableMap';


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
     * The value for the id_customer field.
     *
     * @var        int
     */
    protected $id_customer;

    /**
     * The value for the fk_locale field.
     *
     * @var        int|null
     */
    protected $fk_locale;

    /**
     * The value for the anonymized_at field.
     *
     * @var        DateTime|null
     */
    protected $anonymized_at;

    /**
     * The value for the company field.
     *
     * @var        string|null
     */
    protected $company;

    /**
     * The value for the customer_reference field.
     *
     * @var        string
     */
    protected $customer_reference;

    /**
     * The value for the date_of_birth field.
     *
     * @var        DateTime|null
     */
    protected $date_of_birth;

    /**
     * The value for the default_billing_address field.
     *
     * @var        int|null
     */
    protected $default_billing_address;

    /**
     * The value for the default_shipping_address field.
     *
     * @var        int|null
     */
    protected $default_shipping_address;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the first_name field.
     *
     * @var        string|null
     */
    protected $first_name;

    /**
     * The value for the gdpr_accepted field.
     *
     * @var        boolean|null
     */
    protected $gdpr_accepted;

    /**
     * The value for the gender field.
     *
     * @var        int|null
     */
    protected $gender;

    /**
     * The value for the is_verified field.
     *
     * @var        boolean|null
     */
    protected $is_verified;

    /**
     * The value for the is_welcome_send field.
     *
     * @var        boolean|null
     */
    protected $is_welcome_send;

    /**
     * The value for the last_name field.
     *
     * @var        string|null
     */
    protected $last_name;

    /**
     * The value for the password field.
     *
     * @var        string|null
     */
    protected $password;

    /**
     * The value for the phone field.
     *
     * @var        string|null
     */
    protected $phone;

    /**
     * The value for the registered field.
     *
     * @var        DateTime|null
     */
    protected $registered;

    /**
     * The value for the registration_key field.
     *
     * @var        string|null
     */
    protected $registration_key;

    /**
     * The value for the restore_password_date field.
     *
     * @var        DateTime|null
     */
    protected $restore_password_date;

    /**
     * The value for the restore_password_key field.
     *
     * @var        string|null
     */
    protected $restore_password_key;

    /**
     * The value for the salutation field.
     *
     * @var        int|null
     */
    protected $salutation;

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
     * @var        ChildSpyCustomerAddress
     */
    protected $aBillingAddress;

    /**
     * @var        ChildSpyCustomerAddress
     */
    protected $aShippingAddress;

    /**
     * @var        SpyLocale
     */
    protected $aLocale;

    /**
     * @var        ObjectCollection|ChildSpyCustomerAddress[] Collection to store aggregation of ChildSpyCustomerAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCustomerAddress> Collection to store aggregation of ChildSpyCustomerAddress objects.
     */
    protected $collAddresses;
    protected $collAddressesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyCustomerAddress[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyCustomerAddress>
     */
    protected $addressesScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\Customer\Persistence\Base\SpyCustomer object.
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
     * Compares this with another <code>SpyCustomer</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyCustomer</code>, delegates to
     * <code>equals(SpyCustomer)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_customer] column value.
     *
     * @return int
     */
    public function getIdCustomer()
    {
        return $this->id_customer;
    }

    /**
     * Get the [fk_locale] column value.
     *
     * @return int|null
     */
    public function getFkLocale()
    {
        return $this->fk_locale;
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
     * Get the [company] column value.
     *
     * @return string|null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Get the [customer_reference] column value.
     *
     * @return string
     */
    public function getCustomerReference()
    {
        return $this->customer_reference;
    }

    /**
     * Get the [optionally formatted] temporal [date_of_birth] column value.
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
    public function getDateOfBirth($format = null)
    {
        if ($format === null) {
            return $this->date_of_birth;
        } else {
            return $this->date_of_birth instanceof \DateTimeInterface ? $this->date_of_birth->format($format) : null;
        }
    }

    /**
     * Get the [default_billing_address] column value.
     *
     * @return int|null
     */
    public function getDefaultBillingAddress()
    {
        return $this->default_billing_address;
    }

    /**
     * Get the [default_shipping_address] column value.
     *
     * @return int|null
     */
    public function getDefaultShippingAddress()
    {
        return $this->default_shipping_address;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [first_name] column value.
     *
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Get the [gdpr_accepted] column value.
     *
     * @return boolean|null
     */
    public function getGdprAccepted()
    {
        return $this->gdpr_accepted;
    }

    /**
     * Get the [gdpr_accepted] column value.
     *
     * @return boolean|null
     */
    public function isGdprAccepted()
    {
        return $this->getGdprAccepted();
    }

    /**
     * Get the [gender] column value.
     *
     * @return string|null
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getGender()
    {
        if (null === $this->gender) {
            return null;
        }
        $valueSet = SpyCustomerTableMap::getValueSet(SpyCustomerTableMap::COL_GENDER);
        if (!isset($valueSet[$this->gender])) {
            throw new PropelException('Unknown stored enum key: ' . $this->gender);
        }

        return $valueSet[$this->gender];
    }

    /**
     * Get the [is_verified] column value.
     *
     * @return boolean|null
     */
    public function getIsVerified()
    {
        return $this->is_verified;
    }

    /**
     * Get the [is_verified] column value.
     *
     * @return boolean|null
     */
    public function isVerified()
    {
        return $this->getIsVerified();
    }

    /**
     * Get the [is_welcome_send] column value.
     *
     * @return boolean|null
     */
    public function getIsWelcomeSend()
    {
        return $this->is_welcome_send;
    }

    /**
     * Get the [is_welcome_send] column value.
     *
     * @return boolean|null
     */
    public function isWelcomeSend()
    {
        return $this->getIsWelcomeSend();
    }

    /**
     * Get the [last_name] column value.
     *
     * @return string|null
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Get the [password] column value.
     *
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
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
     * Get the [optionally formatted] temporal [registered] column value.
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
    public function getRegistered($format = null)
    {
        if ($format === null) {
            return $this->registered;
        } else {
            return $this->registered instanceof \DateTimeInterface ? $this->registered->format($format) : null;
        }
    }

    /**
     * Get the [registration_key] column value.
     *
     * @return string|null
     */
    public function getRegistrationKey()
    {
        return $this->registration_key;
    }

    /**
     * Get the [optionally formatted] temporal [restore_password_date] column value.
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
    public function getRestorePasswordDate($format = null)
    {
        if ($format === null) {
            return $this->restore_password_date;
        } else {
            return $this->restore_password_date instanceof \DateTimeInterface ? $this->restore_password_date->format($format) : null;
        }
    }

    /**
     * Get the [restore_password_key] column value.
     *
     * @return string|null
     */
    public function getRestorePasswordKey()
    {
        return $this->restore_password_key;
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
        $valueSet = SpyCustomerTableMap::getValueSet(SpyCustomerTableMap::COL_SALUTATION);
        if (!isset($valueSet[$this->salutation])) {
            throw new PropelException('Unknown stored enum key: ' . $this->salutation);
        }

        return $valueSet[$this->salutation];
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
     * Set the value of [id_customer] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdCustomer($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_customer !== $v) {
            $this->id_customer = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_ID_CUSTOMER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_locale] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkLocale($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fk_locale !== $v) {
            $this->fk_locale = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_FK_LOCALE] = true;
        }

        if ($this->aLocale !== null && $this->aLocale->getIdLocale() !== $v) {
            $this->aLocale = null;
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
                $this->modifiedColumns[SpyCustomerTableMap::COL_ANONYMIZED_AT] = true;
            }
        } // if either are not null

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
            $this->modifiedColumns[SpyCustomerTableMap::COL_COMPANY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [customer_reference] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setCustomerReference($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->customer_reference !== $v) {
            $this->customer_reference = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_CUSTOMER_REFERENCE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [date_of_birth] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setDateOfBirth($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_of_birth !== null || $dt !== null) {
            if ($this->date_of_birth === null || $dt === null || $dt->format("Y-m-d") !== $this->date_of_birth->format("Y-m-d")) {
                $this->date_of_birth = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyCustomerTableMap::COL_DATE_OF_BIRTH] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [default_billing_address] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDefaultBillingAddress($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->default_billing_address !== $v) {
            $this->default_billing_address = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_DEFAULT_BILLING_ADDRESS] = true;
        }

        if ($this->aBillingAddress !== null && $this->aBillingAddress->getIdCustomerAddress() !== $v) {
            $this->aBillingAddress = null;
        }

        return $this;
    }

    /**
     * Set the value of [default_shipping_address] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDefaultShippingAddress($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->default_shipping_address !== $v) {
            $this->default_shipping_address = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_DEFAULT_SHIPPING_ADDRESS] = true;
        }

        if ($this->aShippingAddress !== null && $this->aShippingAddress->getIdCustomerAddress() !== $v) {
            $this->aShippingAddress = null;
        }

        return $this;
    }

    /**
     * Set the value of [email] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [first_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->first_name !== $v) {
            $this->first_name = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_FIRST_NAME] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [gdpr_accepted] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setGdprAccepted($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->gdpr_accepted !== $v) {
            $this->gdpr_accepted = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_GDPR_ACCEPTED] = true;
        }

        return $this;
    }

    /**
     * Set the value of [gender] column.
     *
     * @param string|null $v new value
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setGender($v)
    {
        if ($v !== null) {
            $valueSet = SpyCustomerTableMap::getValueSet(SpyCustomerTableMap::COL_GENDER);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->gender !== $v) {
            $this->gender = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_GENDER] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_verified] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsVerified($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_verified !== $v) {
            $this->is_verified = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_IS_VERIFIED] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_welcome_send] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsWelcomeSend($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_welcome_send !== $v) {
            $this->is_welcome_send = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_IS_WELCOME_SEND] = true;
        }

        return $this;
    }

    /**
     * Set the value of [last_name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_name !== $v) {
            $this->last_name = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_LAST_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [password] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_PASSWORD] = true;
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
            $this->modifiedColumns[SpyCustomerTableMap::COL_PHONE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [registered] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setRegistered($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->registered !== null || $dt !== null) {
            if ($this->registered === null || $dt === null || $dt->format("Y-m-d") !== $this->registered->format("Y-m-d")) {
                $this->registered = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyCustomerTableMap::COL_REGISTERED] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [registration_key] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRegistrationKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->registration_key !== $v) {
            $this->registration_key = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_REGISTRATION_KEY] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [restore_password_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setRestorePasswordDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->restore_password_date !== null || $dt !== null) {
            if ($this->restore_password_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->restore_password_date->format("Y-m-d H:i:s.u")) {
                $this->restore_password_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyCustomerTableMap::COL_RESTORE_PASSWORD_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [restore_password_key] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRestorePasswordKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->restore_password_key !== $v) {
            $this->restore_password_key = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_RESTORE_PASSWORD_KEY] = true;
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
            $valueSet = SpyCustomerTableMap::getValueSet(SpyCustomerTableMap::COL_SALUTATION);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->salutation !== $v) {
            $this->salutation = $v;
            $this->modifiedColumns[SpyCustomerTableMap::COL_SALUTATION] = true;
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
                $this->modifiedColumns[SpyCustomerTableMap::COL_CREATED_AT] = true;
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
                $this->modifiedColumns[SpyCustomerTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyCustomerTableMap::translateFieldName('IdCustomer', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_customer = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyCustomerTableMap::translateFieldName('FkLocale', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_locale = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyCustomerTableMap::translateFieldName('AnonymizedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->anonymized_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyCustomerTableMap::translateFieldName('Company', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyCustomerTableMap::translateFieldName('CustomerReference', TableMap::TYPE_PHPNAME, $indexType)];
            $this->customer_reference = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyCustomerTableMap::translateFieldName('DateOfBirth', TableMap::TYPE_PHPNAME, $indexType)];
            $this->date_of_birth = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyCustomerTableMap::translateFieldName('DefaultBillingAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->default_billing_address = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyCustomerTableMap::translateFieldName('DefaultShippingAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->default_shipping_address = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyCustomerTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyCustomerTableMap::translateFieldName('FirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->first_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : SpyCustomerTableMap::translateFieldName('GdprAccepted', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gdpr_accepted = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : SpyCustomerTableMap::translateFieldName('Gender', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gender = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : SpyCustomerTableMap::translateFieldName('IsVerified', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_verified = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : SpyCustomerTableMap::translateFieldName('IsWelcomeSend', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_welcome_send = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : SpyCustomerTableMap::translateFieldName('LastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : SpyCustomerTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : SpyCustomerTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : SpyCustomerTableMap::translateFieldName('Registered', TableMap::TYPE_PHPNAME, $indexType)];
            $this->registered = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : SpyCustomerTableMap::translateFieldName('RegistrationKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->registration_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : SpyCustomerTableMap::translateFieldName('RestorePasswordDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->restore_password_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : SpyCustomerTableMap::translateFieldName('RestorePasswordKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->restore_password_key = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : SpyCustomerTableMap::translateFieldName('Salutation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->salutation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : SpyCustomerTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : SpyCustomerTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 24; // 24 = SpyCustomerTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Customer\\Persistence\\SpyCustomer'), 0, $e);
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
        if ($this->aLocale !== null && $this->fk_locale !== $this->aLocale->getIdLocale()) {
            $this->aLocale = null;
        }
        if ($this->aBillingAddress !== null && $this->default_billing_address !== $this->aBillingAddress->getIdCustomerAddress()) {
            $this->aBillingAddress = null;
        }
        if ($this->aShippingAddress !== null && $this->default_shipping_address !== $this->aShippingAddress->getIdCustomerAddress()) {
            $this->aShippingAddress = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyCustomerTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyCustomerQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBillingAddress = null;
            $this->aShippingAddress = null;
            $this->aLocale = null;
            $this->collAddresses = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyCustomer::setDeleted()
     * @see SpyCustomer::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyCustomerQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyCustomerTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyCustomerTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt($highPrecision);
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(SpyCustomerTableMap::COL_UPDATED_AT)) {
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
                SpyCustomerTableMap::addInstanceToPool($this);
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

            if ($this->aBillingAddress !== null) {
                if ($this->aBillingAddress->isModified() || $this->aBillingAddress->isNew()) {
                    $affectedRows += $this->aBillingAddress->save($con);
                }
                $this->setBillingAddress($this->aBillingAddress);
            }

            if ($this->aShippingAddress !== null) {
                if ($this->aShippingAddress->isModified() || $this->aShippingAddress->isNew()) {
                    $affectedRows += $this->aShippingAddress->save($con);
                }
                $this->setShippingAddress($this->aShippingAddress);
            }

            if ($this->aLocale !== null) {
                if ($this->aLocale->isModified() || $this->aLocale->isNew()) {
                    $affectedRows += $this->aLocale->save($con);
                }
                $this->setLocale($this->aLocale);
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

            if ($this->addressesScheduledForDeletion !== null) {
                if (!$this->addressesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery::create()
                        ->filterByPrimaryKeys($this->addressesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->addressesScheduledForDeletion = null;
                }
            }

            if ($this->collAddresses !== null) {
                foreach ($this->collAddresses as $referrerFK) {
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

        $this->modifiedColumns[SpyCustomerTableMap::COL_ID_CUSTOMER] = true;
        if (null !== $this->id_customer) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyCustomerTableMap::COL_ID_CUSTOMER . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyCustomerTableMap::COL_ID_CUSTOMER)) {
            $modifiedColumns[':p' . $index++]  = 'id_customer';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_FK_LOCALE)) {
            $modifiedColumns[':p' . $index++]  = 'fk_locale';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_ANONYMIZED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'anonymized_at';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_COMPANY)) {
            $modifiedColumns[':p' . $index++]  = 'company';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_CUSTOMER_REFERENCE)) {
            $modifiedColumns[':p' . $index++]  = 'customer_reference';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_DATE_OF_BIRTH)) {
            $modifiedColumns[':p' . $index++]  = 'date_of_birth';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_DEFAULT_BILLING_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'default_billing_address';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_DEFAULT_SHIPPING_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'default_shipping_address';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'first_name';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_GDPR_ACCEPTED)) {
            $modifiedColumns[':p' . $index++]  = 'gdpr_accepted';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_GENDER)) {
            $modifiedColumns[':p' . $index++]  = 'gender';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_IS_VERIFIED)) {
            $modifiedColumns[':p' . $index++]  = 'is_verified';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_IS_WELCOME_SEND)) {
            $modifiedColumns[':p' . $index++]  = 'is_welcome_send';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'last_name';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'password';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = 'phone';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_REGISTERED)) {
            $modifiedColumns[':p' . $index++]  = 'registered';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_REGISTRATION_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'registration_key';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_RESTORE_PASSWORD_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'restore_password_date';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_RESTORE_PASSWORD_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'restore_password_key';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_SALUTATION)) {
            $modifiedColumns[':p' . $index++]  = 'salutation';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_customer (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_customer':
                        $stmt->bindValue($identifier, $this->id_customer, PDO::PARAM_INT);
                        break;
                    case 'fk_locale':
                        $stmt->bindValue($identifier, $this->fk_locale, PDO::PARAM_INT);
                        break;
                    case 'anonymized_at':
                        $stmt->bindValue($identifier, $this->anonymized_at ? $this->anonymized_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'company':
                        $stmt->bindValue($identifier, $this->company, PDO::PARAM_STR);
                        break;
                    case 'customer_reference':
                        $stmt->bindValue($identifier, $this->customer_reference, PDO::PARAM_STR);
                        break;
                    case 'date_of_birth':
                        $stmt->bindValue($identifier, $this->date_of_birth ? $this->date_of_birth->format("Y-m-d") : null, PDO::PARAM_STR);
                        break;
                    case 'default_billing_address':
                        $stmt->bindValue($identifier, $this->default_billing_address, PDO::PARAM_INT);
                        break;
                    case 'default_shipping_address':
                        $stmt->bindValue($identifier, $this->default_shipping_address, PDO::PARAM_INT);
                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'first_name':
                        $stmt->bindValue($identifier, $this->first_name, PDO::PARAM_STR);
                        break;
                    case 'gdpr_accepted':
                        $stmt->bindValue($identifier, $this->gdpr_accepted, PDO::PARAM_BOOL);
                        break;
                    case 'gender':
                        $stmt->bindValue($identifier, $this->gender, PDO::PARAM_INT);
                        break;
                    case 'is_verified':
                        $stmt->bindValue($identifier, $this->is_verified, PDO::PARAM_BOOL);
                        break;
                    case 'is_welcome_send':
                        $stmt->bindValue($identifier, $this->is_welcome_send, PDO::PARAM_BOOL);
                        break;
                    case 'last_name':
                        $stmt->bindValue($identifier, $this->last_name, PDO::PARAM_STR);
                        break;
                    case 'password':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case 'phone':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
                        break;
                    case 'registered':
                        $stmt->bindValue($identifier, $this->registered ? $this->registered->format("Y-m-d") : null, PDO::PARAM_STR);
                        break;
                    case 'registration_key':
                        $stmt->bindValue($identifier, $this->registration_key, PDO::PARAM_STR);
                        break;
                    case 'restore_password_date':
                        $stmt->bindValue($identifier, $this->restore_password_date ? $this->restore_password_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'restore_password_key':
                        $stmt->bindValue($identifier, $this->restore_password_key, PDO::PARAM_STR);
                        break;
                    case 'salutation':
                        $stmt->bindValue($identifier, $this->salutation, PDO::PARAM_INT);
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
            $pk = $con->lastInsertId('spy_customer_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdCustomer($pk);

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
        $pos = SpyCustomerTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdCustomer();

            case 1:
                return $this->getFkLocale();

            case 2:
                return $this->getAnonymizedAt();

            case 3:
                return $this->getCompany();

            case 4:
                return $this->getCustomerReference();

            case 5:
                return $this->getDateOfBirth();

            case 6:
                return $this->getDefaultBillingAddress();

            case 7:
                return $this->getDefaultShippingAddress();

            case 8:
                return $this->getEmail();

            case 9:
                return $this->getFirstName();

            case 10:
                return $this->getGdprAccepted();

            case 11:
                return $this->getGender();

            case 12:
                return $this->getIsVerified();

            case 13:
                return $this->getIsWelcomeSend();

            case 14:
                return $this->getLastName();

            case 15:
                return $this->getPassword();

            case 16:
                return $this->getPhone();

            case 17:
                return $this->getRegistered();

            case 18:
                return $this->getRegistrationKey();

            case 19:
                return $this->getRestorePasswordDate();

            case 20:
                return $this->getRestorePasswordKey();

            case 21:
                return $this->getSalutation();

            case 22:
                return $this->getCreatedAt();

            case 23:
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
        if (isset($alreadyDumpedObjects['SpyCustomer'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyCustomer'][$this->hashCode()] = true;
        $keys = SpyCustomerTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdCustomer(),
            $keys[1] => $this->getFkLocale(),
            $keys[2] => $this->getAnonymizedAt(),
            $keys[3] => $this->getCompany(),
            $keys[4] => $this->getCustomerReference(),
            $keys[5] => $this->getDateOfBirth(),
            $keys[6] => $this->getDefaultBillingAddress(),
            $keys[7] => $this->getDefaultShippingAddress(),
            $keys[8] => $this->getEmail(),
            $keys[9] => $this->getFirstName(),
            $keys[10] => $this->getGdprAccepted(),
            $keys[11] => $this->getGender(),
            $keys[12] => $this->getIsVerified(),
            $keys[13] => $this->getIsWelcomeSend(),
            $keys[14] => $this->getLastName(),
            $keys[15] => $this->getPassword(),
            $keys[16] => $this->getPhone(),
            $keys[17] => $this->getRegistered(),
            $keys[18] => $this->getRegistrationKey(),
            $keys[19] => $this->getRestorePasswordDate(),
            $keys[20] => $this->getRestorePasswordKey(),
            $keys[21] => $this->getSalutation(),
            $keys[22] => $this->getCreatedAt(),
            $keys[23] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d');
        }

        if ($result[$keys[17]] instanceof \DateTimeInterface) {
            $result[$keys[17]] = $result[$keys[17]]->format('Y-m-d');
        }

        if ($result[$keys[19]] instanceof \DateTimeInterface) {
            $result[$keys[19]] = $result[$keys[19]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[22]] instanceof \DateTimeInterface) {
            $result[$keys[22]] = $result[$keys[22]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[23]] instanceof \DateTimeInterface) {
            $result[$keys[23]] = $result[$keys[23]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aBillingAddress) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomerAddress';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer_address';
                        break;
                    default:
                        $key = 'BillingAddress';
                }

                $result[$key] = $this->aBillingAddress->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aShippingAddress) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomerAddress';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer_address';
                        break;
                    default:
                        $key = 'ShippingAddress';
                }

                $result[$key] = $this->aShippingAddress->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLocale) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyLocale';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_locale';
                        break;
                    default:
                        $key = 'Locale';
                }

                $result[$key] = $this->aLocale->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomerAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer_addresses';
                        break;
                    default:
                        $key = 'Addresses';
                }

                $result[$key] = $this->collAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyCustomerTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdCustomer($value);
                break;
            case 1:
                $this->setFkLocale($value);
                break;
            case 2:
                $this->setAnonymizedAt($value);
                break;
            case 3:
                $this->setCompany($value);
                break;
            case 4:
                $this->setCustomerReference($value);
                break;
            case 5:
                $this->setDateOfBirth($value);
                break;
            case 6:
                $this->setDefaultBillingAddress($value);
                break;
            case 7:
                $this->setDefaultShippingAddress($value);
                break;
            case 8:
                $this->setEmail($value);
                break;
            case 9:
                $this->setFirstName($value);
                break;
            case 10:
                $this->setGdprAccepted($value);
                break;
            case 11:
                $valueSet = SpyCustomerTableMap::getValueSet(SpyCustomerTableMap::COL_GENDER);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setGender($value);
                break;
            case 12:
                $this->setIsVerified($value);
                break;
            case 13:
                $this->setIsWelcomeSend($value);
                break;
            case 14:
                $this->setLastName($value);
                break;
            case 15:
                $this->setPassword($value);
                break;
            case 16:
                $this->setPhone($value);
                break;
            case 17:
                $this->setRegistered($value);
                break;
            case 18:
                $this->setRegistrationKey($value);
                break;
            case 19:
                $this->setRestorePasswordDate($value);
                break;
            case 20:
                $this->setRestorePasswordKey($value);
                break;
            case 21:
                $valueSet = SpyCustomerTableMap::getValueSet(SpyCustomerTableMap::COL_SALUTATION);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setSalutation($value);
                break;
            case 22:
                $this->setCreatedAt($value);
                break;
            case 23:
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
        $keys = SpyCustomerTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdCustomer($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkLocale($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAnonymizedAt($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCompany($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCustomerReference($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setDateOfBirth($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDefaultBillingAddress($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDefaultShippingAddress($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setEmail($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setFirstName($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setGdprAccepted($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setGender($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setIsVerified($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setIsWelcomeSend($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setLastName($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setPassword($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setPhone($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setRegistered($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setRegistrationKey($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setRestorePasswordDate($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setRestorePasswordKey($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setSalutation($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setCreatedAt($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setUpdatedAt($arr[$keys[23]]);
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
        $criteria = new Criteria(SpyCustomerTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyCustomerTableMap::COL_ID_CUSTOMER)) {
            $criteria->add(SpyCustomerTableMap::COL_ID_CUSTOMER, $this->id_customer);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_FK_LOCALE)) {
            $criteria->add(SpyCustomerTableMap::COL_FK_LOCALE, $this->fk_locale);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_ANONYMIZED_AT)) {
            $criteria->add(SpyCustomerTableMap::COL_ANONYMIZED_AT, $this->anonymized_at);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_COMPANY)) {
            $criteria->add(SpyCustomerTableMap::COL_COMPANY, $this->company);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_CUSTOMER_REFERENCE)) {
            $criteria->add(SpyCustomerTableMap::COL_CUSTOMER_REFERENCE, $this->customer_reference);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_DATE_OF_BIRTH)) {
            $criteria->add(SpyCustomerTableMap::COL_DATE_OF_BIRTH, $this->date_of_birth);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_DEFAULT_BILLING_ADDRESS)) {
            $criteria->add(SpyCustomerTableMap::COL_DEFAULT_BILLING_ADDRESS, $this->default_billing_address);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_DEFAULT_SHIPPING_ADDRESS)) {
            $criteria->add(SpyCustomerTableMap::COL_DEFAULT_SHIPPING_ADDRESS, $this->default_shipping_address);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_EMAIL)) {
            $criteria->add(SpyCustomerTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_FIRST_NAME)) {
            $criteria->add(SpyCustomerTableMap::COL_FIRST_NAME, $this->first_name);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_GDPR_ACCEPTED)) {
            $criteria->add(SpyCustomerTableMap::COL_GDPR_ACCEPTED, $this->gdpr_accepted);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_GENDER)) {
            $criteria->add(SpyCustomerTableMap::COL_GENDER, $this->gender);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_IS_VERIFIED)) {
            $criteria->add(SpyCustomerTableMap::COL_IS_VERIFIED, $this->is_verified);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_IS_WELCOME_SEND)) {
            $criteria->add(SpyCustomerTableMap::COL_IS_WELCOME_SEND, $this->is_welcome_send);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_LAST_NAME)) {
            $criteria->add(SpyCustomerTableMap::COL_LAST_NAME, $this->last_name);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_PASSWORD)) {
            $criteria->add(SpyCustomerTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_PHONE)) {
            $criteria->add(SpyCustomerTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_REGISTERED)) {
            $criteria->add(SpyCustomerTableMap::COL_REGISTERED, $this->registered);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_REGISTRATION_KEY)) {
            $criteria->add(SpyCustomerTableMap::COL_REGISTRATION_KEY, $this->registration_key);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_RESTORE_PASSWORD_DATE)) {
            $criteria->add(SpyCustomerTableMap::COL_RESTORE_PASSWORD_DATE, $this->restore_password_date);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_RESTORE_PASSWORD_KEY)) {
            $criteria->add(SpyCustomerTableMap::COL_RESTORE_PASSWORD_KEY, $this->restore_password_key);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_SALUTATION)) {
            $criteria->add(SpyCustomerTableMap::COL_SALUTATION, $this->salutation);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyCustomerTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyCustomerTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyCustomerTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildSpyCustomerQuery::create();
        $criteria->add(SpyCustomerTableMap::COL_ID_CUSTOMER, $this->id_customer);

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
        $validPk = null !== $this->getIdCustomer();

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
        return $this->getIdCustomer();
    }

    /**
     * Generic method to set the primary key (id_customer column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdCustomer($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdCustomer();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Customer\Persistence\SpyCustomer (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkLocale($this->getFkLocale());
        $copyObj->setAnonymizedAt($this->getAnonymizedAt());
        $copyObj->setCompany($this->getCompany());
        $copyObj->setCustomerReference($this->getCustomerReference());
        $copyObj->setDateOfBirth($this->getDateOfBirth());
        $copyObj->setDefaultBillingAddress($this->getDefaultBillingAddress());
        $copyObj->setDefaultShippingAddress($this->getDefaultShippingAddress());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setGdprAccepted($this->getGdprAccepted());
        $copyObj->setGender($this->getGender());
        $copyObj->setIsVerified($this->getIsVerified());
        $copyObj->setIsWelcomeSend($this->getIsWelcomeSend());
        $copyObj->setLastName($this->getLastName());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setRegistered($this->getRegistered());
        $copyObj->setRegistrationKey($this->getRegistrationKey());
        $copyObj->setRestorePasswordDate($this->getRestorePasswordDate());
        $copyObj->setRestorePasswordKey($this->getRestorePasswordKey());
        $copyObj->setSalutation($this->getSalutation());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAddress($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCustomer(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Customer\Persistence\SpyCustomer Clone of current object.
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
     * Declares an association between this object and a ChildSpyCustomerAddress object.
     *
     * @param ChildSpyCustomerAddress|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setBillingAddress(ChildSpyCustomerAddress $v = null)
    {
        if ($v === null) {
            $this->setDefaultBillingAddress(NULL);
        } else {
            $this->setDefaultBillingAddress($v->getIdCustomerAddress());
        }

        $this->aBillingAddress = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyCustomerAddress object, it will not be re-added.
        if ($v !== null) {
            $v->addCustomerBillingAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyCustomerAddress object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyCustomerAddress|null The associated ChildSpyCustomerAddress object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getBillingAddress(?ConnectionInterface $con = null)
    {
        if ($this->aBillingAddress === null && ($this->default_billing_address != 0)) {
            $this->aBillingAddress = ChildSpyCustomerAddressQuery::create()->findPk($this->default_billing_address, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBillingAddress->addCustomerBillingAddresses($this);
             */
        }

        return $this->aBillingAddress;
    }

    /**
     * Declares an association between this object and a ChildSpyCustomerAddress object.
     *
     * @param ChildSpyCustomerAddress|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setShippingAddress(ChildSpyCustomerAddress $v = null)
    {
        if ($v === null) {
            $this->setDefaultShippingAddress(NULL);
        } else {
            $this->setDefaultShippingAddress($v->getIdCustomerAddress());
        }

        $this->aShippingAddress = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSpyCustomerAddress object, it will not be re-added.
        if ($v !== null) {
            $v->addCustomerShippingAddress($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSpyCustomerAddress object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return ChildSpyCustomerAddress|null The associated ChildSpyCustomerAddress object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getShippingAddress(?ConnectionInterface $con = null)
    {
        if ($this->aShippingAddress === null && ($this->default_shipping_address != 0)) {
            $this->aShippingAddress = ChildSpyCustomerAddressQuery::create()->findPk($this->default_shipping_address, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aShippingAddress->addCustomerShippingAddresses($this);
             */
        }

        return $this->aShippingAddress;
    }

    /**
     * Declares an association between this object and a SpyLocale object.
     *
     * @param SpyLocale|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setLocale(SpyLocale $v = null)
    {
        if ($v === null) {
            $this->setFkLocale(NULL);
        } else {
            $this->setFkLocale($v->getIdLocale());
        }

        $this->aLocale = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyLocale object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyCustomer($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyLocale object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyLocale|null The associated SpyLocale object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getLocale(?ConnectionInterface $con = null)
    {
        if ($this->aLocale === null && ($this->fk_locale != 0)) {
            $this->aLocale = SpyLocaleQuery::create()->findPk($this->fk_locale, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLocale->addSpyCustomers($this);
             */
        }

        return $this->aLocale;
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
        if ('Address' === $relationName) {
            $this->initAddresses();
            return;
        }
    }

    /**
     * Clears out the collAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addAddresses()
     */
    public function clearAddresses()
    {
        $this->collAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialAddresses($v = true): void
    {
        $this->collAddressesPartial = $v;
    }

    /**
     * Initializes the collAddresses collection.
     *
     * By default this just sets the collAddresses collection to an empty array (like clearcollAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCustomerAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collAddresses = new $collectionClassName;
        $this->collAddresses->setModel('\Orm\Zed\Customer\Persistence\SpyCustomerAddress');
    }

    /**
     * Gets an array of ChildSpyCustomerAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCustomer is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyCustomerAddress[] List of ChildSpyCustomerAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCustomerAddress> List of ChildSpyCustomerAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collAddressesPartial && !$this->isNew();
        if (null === $this->collAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collAddresses) {
                    $this->initAddresses();
                } else {
                    $collectionClassName = SpyCustomerAddressTableMap::getTableMap()->getCollectionClassName();

                    $collAddresses = new $collectionClassName;
                    $collAddresses->setModel('\Orm\Zed\Customer\Persistence\SpyCustomerAddress');

                    return $collAddresses;
                }
            } else {
                $collAddresses = ChildSpyCustomerAddressQuery::create(null, $criteria)
                    ->filterByCustomer($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAddressesPartial && count($collAddresses)) {
                        $this->initAddresses(false);

                        foreach ($collAddresses as $obj) {
                            if (false == $this->collAddresses->contains($obj)) {
                                $this->collAddresses->append($obj);
                            }
                        }

                        $this->collAddressesPartial = true;
                    }

                    return $collAddresses;
                }

                if ($partial && $this->collAddresses) {
                    foreach ($this->collAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collAddresses[] = $obj;
                        }
                    }
                }

                $this->collAddresses = $collAddresses;
                $this->collAddressesPartial = false;
            }
        }

        return $this->collAddresses;
    }

    /**
     * Sets a collection of ChildSpyCustomerAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $addresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setAddresses(Collection $addresses, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyCustomerAddress[] $addressesToDelete */
        $addressesToDelete = $this->getAddresses(new Criteria(), $con)->diff($addresses);


        $this->addressesScheduledForDeletion = $addressesToDelete;

        foreach ($addressesToDelete as $addressRemoved) {
            $addressRemoved->setCustomer(null);
        }

        $this->collAddresses = null;
        foreach ($addresses as $address) {
            $this->addAddress($address);
        }

        $this->collAddresses = $addresses;
        $this->collAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyCustomerAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyCustomerAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collAddressesPartial && !$this->isNew();
        if (null === $this->collAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAddresses());
            }

            $query = ChildSpyCustomerAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCustomer($this)
                ->count($con);
        }

        return count($this->collAddresses);
    }

    /**
     * Method called to associate a ChildSpyCustomerAddress object to this object
     * through the ChildSpyCustomerAddress foreign key attribute.
     *
     * @param ChildSpyCustomerAddress $l ChildSpyCustomerAddress
     * @return $this The current object (for fluent API support)
     */
    public function addAddress(ChildSpyCustomerAddress $l)
    {
        if ($this->collAddresses === null) {
            $this->initAddresses();
            $this->collAddressesPartial = true;
        }

        if (!$this->collAddresses->contains($l)) {
            $this->doAddAddress($l);

            if ($this->addressesScheduledForDeletion and $this->addressesScheduledForDeletion->contains($l)) {
                $this->addressesScheduledForDeletion->remove($this->addressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyCustomerAddress $address The ChildSpyCustomerAddress object to add.
     */
    protected function doAddAddress(ChildSpyCustomerAddress $address): void
    {
        $this->collAddresses[]= $address;
        $address->setCustomer($this);
    }

    /**
     * @param ChildSpyCustomerAddress $address The ChildSpyCustomerAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeAddress(ChildSpyCustomerAddress $address)
    {
        if ($this->getAddresses()->contains($address)) {
            $pos = $this->collAddresses->search($address);
            $this->collAddresses->remove($pos);
            if (null === $this->addressesScheduledForDeletion) {
                $this->addressesScheduledForDeletion = clone $this->collAddresses;
                $this->addressesScheduledForDeletion->clear();
            }
            $this->addressesScheduledForDeletion[]= clone $address;
            $address->setCustomer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCustomer is new, it will return
     * an empty collection; or if this SpyCustomer has previously
     * been saved, it will retrieve related Addresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCustomer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCustomerAddress[] List of ChildSpyCustomerAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCustomerAddress}> List of ChildSpyCustomerAddress objects
     */
    public function getAddressesJoinRegion(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCustomerAddressQuery::create(null, $criteria);
        $query->joinWith('Region', $joinBehavior);

        return $this->getAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCustomer is new, it will return
     * an empty collection; or if this SpyCustomer has previously
     * been saved, it will retrieve related Addresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCustomer.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyCustomerAddress[] List of ChildSpyCustomerAddress objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyCustomerAddress}> List of ChildSpyCustomerAddress objects
     */
    public function getAddressesJoinCountry(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyCustomerAddressQuery::create(null, $criteria);
        $query->joinWith('Country', $joinBehavior);

        return $this->getAddresses($query, $con);
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
        if (null !== $this->aBillingAddress) {
            $this->aBillingAddress->removeCustomerBillingAddress($this);
        }
        if (null !== $this->aShippingAddress) {
            $this->aShippingAddress->removeCustomerShippingAddress($this);
        }
        if (null !== $this->aLocale) {
            $this->aLocale->removeSpyCustomer($this);
        }
        $this->id_customer = null;
        $this->fk_locale = null;
        $this->anonymized_at = null;
        $this->company = null;
        $this->customer_reference = null;
        $this->date_of_birth = null;
        $this->default_billing_address = null;
        $this->default_shipping_address = null;
        $this->email = null;
        $this->first_name = null;
        $this->gdpr_accepted = null;
        $this->gender = null;
        $this->is_verified = null;
        $this->is_welcome_send = null;
        $this->last_name = null;
        $this->password = null;
        $this->phone = null;
        $this->registered = null;
        $this->registration_key = null;
        $this->restore_password_date = null;
        $this->restore_password_key = null;
        $this->salutation = null;
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
            if ($this->collAddresses) {
                foreach ($this->collAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAddresses = null;
        $this->aBillingAddress = null;
        $this->aShippingAddress = null;
        $this->aLocale = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyCustomerTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyCustomerTableMap::COL_UPDATED_AT] = true;

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
