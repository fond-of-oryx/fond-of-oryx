<?php

namespace Orm\Zed\Country\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Country\Persistence\SpyCountry as ChildSpyCountry;
use Orm\Zed\Country\Persistence\SpyCountryQuery as ChildSpyCountryQuery;
use Orm\Zed\Country\Persistence\SpyRegion as ChildSpyRegion;
use Orm\Zed\Country\Persistence\SpyRegionQuery as ChildSpyRegionQuery;
use Orm\Zed\Country\Persistence\Map\SpyCountryTableMap;
use Orm\Zed\Country\Persistence\Map\SpyRegionTableMap;
use Orm\Zed\Customer\Persistence\SpyCustomerAddress;
use Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery;
use Orm\Zed\Customer\Persistence\Base\SpyCustomerAddress as BaseSpyCustomerAddress;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerAddressTableMap;
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

/**
 * Base class that represents a row from the 'spy_country' table.
 *
 *
 *
 * @package    propel.generator.Orm.Zed.Country.Persistence.Base
 */
abstract class SpyCountry implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Country\\Persistence\\Map\\SpyCountryTableMap';


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
     * The value for the id_country field.
     *
     * @var        int
     */
    protected $id_country;

    /**
     * The value for the iso2_code field.
     *
     * @var        string
     */
    protected $iso2_code;

    /**
     * The value for the iso3_code field.
     *
     * @var        string|null
     */
    protected $iso3_code;

    /**
     * The value for the name field.
     *
     * @var        string|null
     */
    protected $name;

    /**
     * The value for the postal_code_mandatory field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean|null
     */
    protected $postal_code_mandatory;

    /**
     * The value for the postal_code_regex field.
     *
     * @var        string|null
     */
    protected $postal_code_regex;

    /**
     * @var        ObjectCollection|ChildSpyRegion[] Collection to store aggregation of ChildSpyRegion objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyRegion> Collection to store aggregation of ChildSpyRegion objects.
     */
    protected $collSpyRegions;
    protected $collSpyRegionsPartial;

    /**
     * @var        ObjectCollection|SpyCustomerAddress[] Collection to store aggregation of SpyCustomerAddress objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomerAddress> Collection to store aggregation of SpyCustomerAddress objects.
     */
    protected $collCustomerAddresses;
    protected $collCustomerAddressesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyRegion[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyRegion>
     */
    protected $spyRegionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCustomerAddress[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomerAddress>
     */
    protected $customerAddressesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->postal_code_mandatory = false;
    }

    /**
     * Initializes internal state of Orm\Zed\Country\Persistence\Base\SpyCountry object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
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
     * Compares this with another <code>SpyCountry</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyCountry</code>, delegates to
     * <code>equals(SpyCountry)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_country] column value.
     *
     * @return int
     */
    public function getIdCountry()
    {
        return $this->id_country;
    }

    /**
     * Get the [iso2_code] column value.
     *
     * @return string
     */
    public function getIso2Code()
    {
        return $this->iso2_code;
    }

    /**
     * Get the [iso3_code] column value.
     *
     * @return string|null
     */
    public function getIso3Code()
    {
        return $this->iso3_code;
    }

    /**
     * Get the [name] column value.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [postal_code_mandatory] column value.
     *
     * @return boolean|null
     */
    public function getPostalCodeMandatory()
    {
        return $this->postal_code_mandatory;
    }

    /**
     * Get the [postal_code_mandatory] column value.
     *
     * @return boolean|null
     */
    public function isPostalCodeMandatory()
    {
        return $this->getPostalCodeMandatory();
    }

    /**
     * Get the [postal_code_regex] column value.
     *
     * @return string|null
     */
    public function getPostalCodeRegex()
    {
        return $this->postal_code_regex;
    }

    /**
     * Set the value of [id_country] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdCountry($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_country !== $v) {
            $this->id_country = $v;
            $this->modifiedColumns[SpyCountryTableMap::COL_ID_COUNTRY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [iso2_code] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIso2Code($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->iso2_code !== $v) {
            $this->iso2_code = $v;
            $this->modifiedColumns[SpyCountryTableMap::COL_ISO2_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [iso3_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIso3Code($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->iso3_code !== $v) {
            $this->iso3_code = $v;
            $this->modifiedColumns[SpyCountryTableMap::COL_ISO3_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [name] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[SpyCountryTableMap::COL_NAME] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [postal_code_mandatory] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string|null $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setPostalCodeMandatory($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->postal_code_mandatory !== $v) {
            $this->postal_code_mandatory = $v;
            $this->modifiedColumns[SpyCountryTableMap::COL_POSTAL_CODE_MANDATORY] = true;
        }

        return $this;
    }

    /**
     * Set the value of [postal_code_regex] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPostalCodeRegex($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->postal_code_regex !== $v) {
            $this->postal_code_regex = $v;
            $this->modifiedColumns[SpyCountryTableMap::COL_POSTAL_CODE_REGEX] = true;
        }

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
            if ($this->postal_code_mandatory !== false) {
                return false;
            }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyCountryTableMap::translateFieldName('IdCountry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_country = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyCountryTableMap::translateFieldName('Iso2Code', TableMap::TYPE_PHPNAME, $indexType)];
            $this->iso2_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyCountryTableMap::translateFieldName('Iso3Code', TableMap::TYPE_PHPNAME, $indexType)];
            $this->iso3_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyCountryTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyCountryTableMap::translateFieldName('PostalCodeMandatory', TableMap::TYPE_PHPNAME, $indexType)];
            $this->postal_code_mandatory = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyCountryTableMap::translateFieldName('PostalCodeRegex', TableMap::TYPE_PHPNAME, $indexType)];
            $this->postal_code_regex = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = SpyCountryTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Country\\Persistence\\SpyCountry'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyCountryTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyCountryQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collSpyRegions = null;

            $this->collCustomerAddresses = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyCountry::setDeleted()
     * @see SpyCountry::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCountryTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyCountryQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCountryTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                SpyCountryTableMap::addInstanceToPool($this);
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

            if ($this->spyRegionsScheduledForDeletion !== null) {
                if (!$this->spyRegionsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyRegionsScheduledForDeletion as $spyRegion) {
                        // need to save related object because we set the relation to null
                        $spyRegion->save($con);
                    }
                    $this->spyRegionsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyRegions !== null) {
                foreach ($this->collSpyRegions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->customerAddressesScheduledForDeletion !== null) {
                if (!$this->customerAddressesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery::create()
                        ->filterByPrimaryKeys($this->customerAddressesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->customerAddressesScheduledForDeletion = null;
                }
            }

            if ($this->collCustomerAddresses !== null) {
                foreach ($this->collCustomerAddresses as $referrerFK) {
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

        $this->modifiedColumns[SpyCountryTableMap::COL_ID_COUNTRY] = true;
        if (null !== $this->id_country) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyCountryTableMap::COL_ID_COUNTRY . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyCountryTableMap::COL_ID_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = 'id_country';
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_ISO2_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'iso2_code';
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_ISO3_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'iso3_code';
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_POSTAL_CODE_MANDATORY)) {
            $modifiedColumns[':p' . $index++]  = 'postal_code_mandatory';
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_POSTAL_CODE_REGEX)) {
            $modifiedColumns[':p' . $index++]  = 'postal_code_regex';
        }

        $sql = sprintf(
            'INSERT INTO spy_country (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_country':
                        $stmt->bindValue($identifier, $this->id_country, PDO::PARAM_INT);
                        break;
                    case 'iso2_code':
                        $stmt->bindValue($identifier, $this->iso2_code, PDO::PARAM_STR);
                        break;
                    case 'iso3_code':
                        $stmt->bindValue($identifier, $this->iso3_code, PDO::PARAM_STR);
                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'postal_code_mandatory':
                        $stmt->bindValue($identifier, $this->postal_code_mandatory, PDO::PARAM_BOOL);
                        break;
                    case 'postal_code_regex':
                        $stmt->bindValue($identifier, $this->postal_code_regex, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_country_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdCountry($pk);

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
        $pos = SpyCountryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdCountry();

            case 1:
                return $this->getIso2Code();

            case 2:
                return $this->getIso3Code();

            case 3:
                return $this->getName();

            case 4:
                return $this->getPostalCodeMandatory();

            case 5:
                return $this->getPostalCodeRegex();

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
        if (isset($alreadyDumpedObjects['SpyCountry'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyCountry'][$this->hashCode()] = true;
        $keys = SpyCountryTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdCountry(),
            $keys[1] => $this->getIso2Code(),
            $keys[2] => $this->getIso3Code(),
            $keys[3] => $this->getName(),
            $keys[4] => $this->getPostalCodeMandatory(),
            $keys[5] => $this->getPostalCodeRegex(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collSpyRegions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyRegions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_regions';
                        break;
                    default:
                        $key = 'SpyRegions';
                }

                $result[$key] = $this->collSpyRegions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCustomerAddresses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomerAddresses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customer_addresses';
                        break;
                    default:
                        $key = 'CustomerAddresses';
                }

                $result[$key] = $this->collCustomerAddresses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyCountryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdCountry($value);
                break;
            case 1:
                $this->setIso2Code($value);
                break;
            case 2:
                $this->setIso3Code($value);
                break;
            case 3:
                $this->setName($value);
                break;
            case 4:
                $this->setPostalCodeMandatory($value);
                break;
            case 5:
                $this->setPostalCodeRegex($value);
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
        $keys = SpyCountryTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdCountry($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIso2Code($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIso3Code($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setName($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPostalCodeMandatory($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPostalCodeRegex($arr[$keys[5]]);
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
        $criteria = new Criteria(SpyCountryTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyCountryTableMap::COL_ID_COUNTRY)) {
            $criteria->add(SpyCountryTableMap::COL_ID_COUNTRY, $this->id_country);
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_ISO2_CODE)) {
            $criteria->add(SpyCountryTableMap::COL_ISO2_CODE, $this->iso2_code);
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_ISO3_CODE)) {
            $criteria->add(SpyCountryTableMap::COL_ISO3_CODE, $this->iso3_code);
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_NAME)) {
            $criteria->add(SpyCountryTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_POSTAL_CODE_MANDATORY)) {
            $criteria->add(SpyCountryTableMap::COL_POSTAL_CODE_MANDATORY, $this->postal_code_mandatory);
        }
        if ($this->isColumnModified(SpyCountryTableMap::COL_POSTAL_CODE_REGEX)) {
            $criteria->add(SpyCountryTableMap::COL_POSTAL_CODE_REGEX, $this->postal_code_regex);
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
        $criteria = ChildSpyCountryQuery::create();
        $criteria->add(SpyCountryTableMap::COL_ID_COUNTRY, $this->id_country);

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
        $validPk = null !== $this->getIdCountry();

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
        return $this->getIdCountry();
    }

    /**
     * Generic method to set the primary key (id_country column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdCountry($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdCountry();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Country\Persistence\SpyCountry (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setIso2Code($this->getIso2Code());
        $copyObj->setIso3Code($this->getIso3Code());
        $copyObj->setName($this->getName());
        $copyObj->setPostalCodeMandatory($this->getPostalCodeMandatory());
        $copyObj->setPostalCodeRegex($this->getPostalCodeRegex());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyRegions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyRegion($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCustomerAddresses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCustomerAddress($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCountry(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Country\Persistence\SpyCountry Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('SpyRegion' === $relationName) {
            $this->initSpyRegions();
            return;
        }
        if ('CustomerAddress' === $relationName) {
            $this->initCustomerAddresses();
            return;
        }
    }

    /**
     * Clears out the collSpyRegions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyRegions()
     */
    public function clearSpyRegions()
    {
        $this->collSpyRegions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyRegions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyRegions($v = true): void
    {
        $this->collSpyRegionsPartial = $v;
    }

    /**
     * Initializes the collSpyRegions collection.
     *
     * By default this just sets the collSpyRegions collection to an empty array (like clearcollSpyRegions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyRegions(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyRegions && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyRegionTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyRegions = new $collectionClassName;
        $this->collSpyRegions->setModel('\Orm\Zed\Country\Persistence\SpyRegion');
    }

    /**
     * Gets an array of ChildSpyRegion objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCountry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyRegion[] List of ChildSpyRegion objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyRegion> List of ChildSpyRegion objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyRegions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyRegionsPartial && !$this->isNew();
        if (null === $this->collSpyRegions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyRegions) {
                    $this->initSpyRegions();
                } else {
                    $collectionClassName = SpyRegionTableMap::getTableMap()->getCollectionClassName();

                    $collSpyRegions = new $collectionClassName;
                    $collSpyRegions->setModel('\Orm\Zed\Country\Persistence\SpyRegion');

                    return $collSpyRegions;
                }
            } else {
                $collSpyRegions = ChildSpyRegionQuery::create(null, $criteria)
                    ->filterBySpyCountry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyRegionsPartial && count($collSpyRegions)) {
                        $this->initSpyRegions(false);

                        foreach ($collSpyRegions as $obj) {
                            if (false == $this->collSpyRegions->contains($obj)) {
                                $this->collSpyRegions->append($obj);
                            }
                        }

                        $this->collSpyRegionsPartial = true;
                    }

                    return $collSpyRegions;
                }

                if ($partial && $this->collSpyRegions) {
                    foreach ($this->collSpyRegions as $obj) {
                        if ($obj->isNew()) {
                            $collSpyRegions[] = $obj;
                        }
                    }
                }

                $this->collSpyRegions = $collSpyRegions;
                $this->collSpyRegionsPartial = false;
            }
        }

        return $this->collSpyRegions;
    }

    /**
     * Sets a collection of ChildSpyRegion objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyRegions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyRegions(Collection $spyRegions, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyRegion[] $spyRegionsToDelete */
        $spyRegionsToDelete = $this->getSpyRegions(new Criteria(), $con)->diff($spyRegions);


        $this->spyRegionsScheduledForDeletion = $spyRegionsToDelete;

        foreach ($spyRegionsToDelete as $spyRegionRemoved) {
            $spyRegionRemoved->setSpyCountry(null);
        }

        $this->collSpyRegions = null;
        foreach ($spyRegions as $spyRegion) {
            $this->addSpyRegion($spyRegion);
        }

        $this->collSpyRegions = $spyRegions;
        $this->collSpyRegionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyRegion objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyRegion objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyRegions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyRegionsPartial && !$this->isNew();
        if (null === $this->collSpyRegions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyRegions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyRegions());
            }

            $query = ChildSpyRegionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyCountry($this)
                ->count($con);
        }

        return count($this->collSpyRegions);
    }

    /**
     * Method called to associate a ChildSpyRegion object to this object
     * through the ChildSpyRegion foreign key attribute.
     *
     * @param ChildSpyRegion $l ChildSpyRegion
     * @return $this The current object (for fluent API support)
     */
    public function addSpyRegion(ChildSpyRegion $l)
    {
        if ($this->collSpyRegions === null) {
            $this->initSpyRegions();
            $this->collSpyRegionsPartial = true;
        }

        if (!$this->collSpyRegions->contains($l)) {
            $this->doAddSpyRegion($l);

            if ($this->spyRegionsScheduledForDeletion and $this->spyRegionsScheduledForDeletion->contains($l)) {
                $this->spyRegionsScheduledForDeletion->remove($this->spyRegionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyRegion $spyRegion The ChildSpyRegion object to add.
     */
    protected function doAddSpyRegion(ChildSpyRegion $spyRegion): void
    {
        $this->collSpyRegions[]= $spyRegion;
        $spyRegion->setSpyCountry($this);
    }

    /**
     * @param ChildSpyRegion $spyRegion The ChildSpyRegion object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyRegion(ChildSpyRegion $spyRegion)
    {
        if ($this->getSpyRegions()->contains($spyRegion)) {
            $pos = $this->collSpyRegions->search($spyRegion);
            $this->collSpyRegions->remove($pos);
            if (null === $this->spyRegionsScheduledForDeletion) {
                $this->spyRegionsScheduledForDeletion = clone $this->collSpyRegions;
                $this->spyRegionsScheduledForDeletion->clear();
            }
            $this->spyRegionsScheduledForDeletion[]= $spyRegion;
            $spyRegion->setSpyCountry(null);
        }

        return $this;
    }

    /**
     * Clears out the collCustomerAddresses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addCustomerAddresses()
     */
    public function clearCustomerAddresses()
    {
        $this->collCustomerAddresses = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collCustomerAddresses collection loaded partially.
     *
     * @return void
     */
    public function resetPartialCustomerAddresses($v = true): void
    {
        $this->collCustomerAddressesPartial = $v;
    }

    /**
     * Initializes the collCustomerAddresses collection.
     *
     * By default this just sets the collCustomerAddresses collection to an empty array (like clearcollCustomerAddresses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCustomerAddresses(bool $overrideExisting = true): void
    {
        if (null !== $this->collCustomerAddresses && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCustomerAddressTableMap::getTableMap()->getCollectionClassName();

        $this->collCustomerAddresses = new $collectionClassName;
        $this->collCustomerAddresses->setModel('\Orm\Zed\Customer\Persistence\SpyCustomerAddress');
    }

    /**
     * Gets an array of SpyCustomerAddress objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyCountry is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCustomerAddress[] List of SpyCustomerAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomerAddress> List of SpyCustomerAddress objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getCustomerAddresses(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collCustomerAddressesPartial && !$this->isNew();
        if (null === $this->collCustomerAddresses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCustomerAddresses) {
                    $this->initCustomerAddresses();
                } else {
                    $collectionClassName = SpyCustomerAddressTableMap::getTableMap()->getCollectionClassName();

                    $collCustomerAddresses = new $collectionClassName;
                    $collCustomerAddresses->setModel('\Orm\Zed\Customer\Persistence\SpyCustomerAddress');

                    return $collCustomerAddresses;
                }
            } else {
                $collCustomerAddresses = SpyCustomerAddressQuery::create(null, $criteria)
                    ->filterByCountry($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCustomerAddressesPartial && count($collCustomerAddresses)) {
                        $this->initCustomerAddresses(false);

                        foreach ($collCustomerAddresses as $obj) {
                            if (false == $this->collCustomerAddresses->contains($obj)) {
                                $this->collCustomerAddresses->append($obj);
                            }
                        }

                        $this->collCustomerAddressesPartial = true;
                    }

                    return $collCustomerAddresses;
                }

                if ($partial && $this->collCustomerAddresses) {
                    foreach ($this->collCustomerAddresses as $obj) {
                        if ($obj->isNew()) {
                            $collCustomerAddresses[] = $obj;
                        }
                    }
                }

                $this->collCustomerAddresses = $collCustomerAddresses;
                $this->collCustomerAddressesPartial = false;
            }
        }

        return $this->collCustomerAddresses;
    }

    /**
     * Sets a collection of SpyCustomerAddress objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $customerAddresses A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setCustomerAddresses(Collection $customerAddresses, ?ConnectionInterface $con = null)
    {
        /** @var SpyCustomerAddress[] $customerAddressesToDelete */
        $customerAddressesToDelete = $this->getCustomerAddresses(new Criteria(), $con)->diff($customerAddresses);


        $this->customerAddressesScheduledForDeletion = $customerAddressesToDelete;

        foreach ($customerAddressesToDelete as $customerAddressRemoved) {
            $customerAddressRemoved->setCountry(null);
        }

        $this->collCustomerAddresses = null;
        foreach ($customerAddresses as $customerAddress) {
            $this->addCustomerAddress($customerAddress);
        }

        $this->collCustomerAddresses = $customerAddresses;
        $this->collCustomerAddressesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCustomerAddress objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCustomerAddress objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countCustomerAddresses(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collCustomerAddressesPartial && !$this->isNew();
        if (null === $this->collCustomerAddresses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCustomerAddresses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCustomerAddresses());
            }

            $query = SpyCustomerAddressQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCountry($this)
                ->count($con);
        }

        return count($this->collCustomerAddresses);
    }

    /**
     * Method called to associate a SpyCustomerAddress object to this object
     * through the SpyCustomerAddress foreign key attribute.
     *
     * @param SpyCustomerAddress $l SpyCustomerAddress
     * @return $this The current object (for fluent API support)
     */
    public function addCustomerAddress(SpyCustomerAddress $l)
    {
        if ($this->collCustomerAddresses === null) {
            $this->initCustomerAddresses();
            $this->collCustomerAddressesPartial = true;
        }

        if (!$this->collCustomerAddresses->contains($l)) {
            $this->doAddCustomerAddress($l);

            if ($this->customerAddressesScheduledForDeletion and $this->customerAddressesScheduledForDeletion->contains($l)) {
                $this->customerAddressesScheduledForDeletion->remove($this->customerAddressesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCustomerAddress $customerAddress The SpyCustomerAddress object to add.
     */
    protected function doAddCustomerAddress(SpyCustomerAddress $customerAddress): void
    {
        $this->collCustomerAddresses[]= $customerAddress;
        $customerAddress->setCountry($this);
    }

    /**
     * @param SpyCustomerAddress $customerAddress The SpyCustomerAddress object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeCustomerAddress(SpyCustomerAddress $customerAddress)
    {
        if ($this->getCustomerAddresses()->contains($customerAddress)) {
            $pos = $this->collCustomerAddresses->search($customerAddress);
            $this->collCustomerAddresses->remove($pos);
            if (null === $this->customerAddressesScheduledForDeletion) {
                $this->customerAddressesScheduledForDeletion = clone $this->collCustomerAddresses;
                $this->customerAddressesScheduledForDeletion->clear();
            }
            $this->customerAddressesScheduledForDeletion[]= clone $customerAddress;
            $customerAddress->setCountry(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCountry is new, it will return
     * an empty collection; or if this SpyCountry has previously
     * been saved, it will retrieve related CustomerAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCustomerAddress[] List of SpyCustomerAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomerAddress}> List of SpyCustomerAddress objects
     */
    public function getCustomerAddressesJoinCustomer(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCustomerAddressQuery::create(null, $criteria);
        $query->joinWith('Customer', $joinBehavior);

        return $this->getCustomerAddresses($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyCountry is new, it will return
     * an empty collection; or if this SpyCountry has previously
     * been saved, it will retrieve related CustomerAddresses from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyCountry.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCustomerAddress[] List of SpyCustomerAddress objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomerAddress}> List of SpyCustomerAddress objects
     */
    public function getCustomerAddressesJoinRegion(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCustomerAddressQuery::create(null, $criteria);
        $query->joinWith('Region', $joinBehavior);

        return $this->getCustomerAddresses($query, $con);
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
        $this->id_country = null;
        $this->iso2_code = null;
        $this->iso3_code = null;
        $this->name = null;
        $this->postal_code_mandatory = null;
        $this->postal_code_regex = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
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
            if ($this->collSpyRegions) {
                foreach ($this->collSpyRegions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCustomerAddresses) {
                foreach ($this->collCustomerAddresses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyRegions = null;
        $this->collCustomerAddresses = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyCountryTableMap::DEFAULT_STRING_FORMAT);
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
