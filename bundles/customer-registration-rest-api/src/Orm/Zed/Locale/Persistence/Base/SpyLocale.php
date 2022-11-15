<?php

namespace Orm\Zed\Locale\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Customer\Persistence\SpyCustomer;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Orm\Zed\Customer\Persistence\Base\SpyCustomer as BaseSpyCustomer;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation;
use Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery;
use Orm\Zed\Glossary\Persistence\Base\SpyGlossaryTranslation as BaseSpyGlossaryTranslation;
use Orm\Zed\Glossary\Persistence\Map\SpyGlossaryTranslationTableMap;
use Orm\Zed\Locale\Persistence\SpyLocale as ChildSpyLocale;
use Orm\Zed\Locale\Persistence\SpyLocaleQuery as ChildSpyLocaleQuery;
use Orm\Zed\Locale\Persistence\Map\SpyLocaleTableMap;
use Orm\Zed\Touch\Persistence\SpyTouchSearch;
use Orm\Zed\Touch\Persistence\SpyTouchSearchQuery;
use Orm\Zed\Touch\Persistence\SpyTouchStorage;
use Orm\Zed\Touch\Persistence\SpyTouchStorageQuery;
use Orm\Zed\Touch\Persistence\Base\SpyTouchSearch as BaseSpyTouchSearch;
use Orm\Zed\Touch\Persistence\Base\SpyTouchStorage as BaseSpyTouchStorage;
use Orm\Zed\Touch\Persistence\Map\SpyTouchSearchTableMap;
use Orm\Zed\Touch\Persistence\Map\SpyTouchStorageTableMap;
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
 * Base class that represents a row from the 'spy_locale' table.
 *
 *
 *
 * @package    propel.generator.Orm.Zed.Locale.Persistence.Base
 */
abstract class SpyLocale implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Locale\\Persistence\\Map\\SpyLocaleTableMap';


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
     * The value for the id_locale field.
     *
     * @var        int
     */
    protected $id_locale;

    /**
     * The value for the locale_name field.
     *
     * @var        string
     */
    protected $locale_name;

    /**
     * The value for the is_active field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $is_active;

    /**
     * @var        ObjectCollection|SpyCustomer[] Collection to store aggregation of SpyCustomer objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomer> Collection to store aggregation of SpyCustomer objects.
     */
    protected $collSpyCustomers;
    protected $collSpyCustomersPartial;

    /**
     * @var        ObjectCollection|SpyGlossaryTranslation[] Collection to store aggregation of SpyGlossaryTranslation objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyGlossaryTranslation> Collection to store aggregation of SpyGlossaryTranslation objects.
     */
    protected $collSpyGlossaryTranslations;
    protected $collSpyGlossaryTranslationsPartial;

    /**
     * @var        ObjectCollection|SpyTouchStorage[] Collection to store aggregation of SpyTouchStorage objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyTouchStorage> Collection to store aggregation of SpyTouchStorage objects.
     */
    protected $collTouchStorages;
    protected $collTouchStoragesPartial;

    /**
     * @var        ObjectCollection|SpyTouchSearch[] Collection to store aggregation of SpyTouchSearch objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyTouchSearch> Collection to store aggregation of SpyTouchSearch objects.
     */
    protected $collTouchSearches;
    protected $collTouchSearchesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCustomer[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCustomer>
     */
    protected $spyCustomersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyGlossaryTranslation[]
     * @phpstan-var ObjectCollection&\Traversable<SpyGlossaryTranslation>
     */
    protected $spyGlossaryTranslationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyTouchStorage[]
     * @phpstan-var ObjectCollection&\Traversable<SpyTouchStorage>
     */
    protected $touchStoragesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyTouchSearch[]
     * @phpstan-var ObjectCollection&\Traversable<SpyTouchSearch>
     */
    protected $touchSearchesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->is_active = true;
    }

    /**
     * Initializes internal state of Orm\Zed\Locale\Persistence\Base\SpyLocale object.
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
     * Compares this with another <code>SpyLocale</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyLocale</code>, delegates to
     * <code>equals(SpyLocale)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_locale] column value.
     *
     * @return int
     */
    public function getIdLocale()
    {
        return $this->id_locale;
    }

    /**
     * Get the [locale_name] column value.
     *
     * @return string
     */
    public function getLocaleName()
    {
        return $this->locale_name;
    }

    /**
     * Get the [is_active] column value.
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Get the [is_active] column value.
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->getIsActive();
    }

    /**
     * Set the value of [id_locale] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdLocale($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_locale !== $v) {
            $this->id_locale = $v;
            $this->modifiedColumns[SpyLocaleTableMap::COL_ID_LOCALE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [locale_name] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLocaleName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->locale_name !== $v) {
            $this->locale_name = $v;
            $this->modifiedColumns[SpyLocaleTableMap::COL_LOCALE_NAME] = true;
        }

        return $this;
    }

    /**
     * Sets the value of the [is_active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param bool|integer|string $v The new value
     * @return $this The current object (for fluent API support)
     */
    public function setIsActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_active !== $v) {
            $this->is_active = $v;
            $this->modifiedColumns[SpyLocaleTableMap::COL_IS_ACTIVE] = true;
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
            if ($this->is_active !== true) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyLocaleTableMap::translateFieldName('IdLocale', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_locale = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyLocaleTableMap::translateFieldName('LocaleName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->locale_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyLocaleTableMap::translateFieldName('IsActive', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_active = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = SpyLocaleTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Locale\\Persistence\\SpyLocale'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(SpyLocaleTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyLocaleQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collSpyCustomers = null;

            $this->collSpyGlossaryTranslations = null;

            $this->collTouchStorages = null;

            $this->collTouchSearches = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyLocale::setDeleted()
     * @see SpyLocale::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyLocaleTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyLocaleQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyLocaleTableMap::DATABASE_NAME);
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
                SpyLocaleTableMap::addInstanceToPool($this);
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

            if ($this->spyCustomersScheduledForDeletion !== null) {
                if (!$this->spyCustomersScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyCustomersScheduledForDeletion as $spyCustomer) {
                        // need to save related object because we set the relation to null
                        $spyCustomer->save($con);
                    }
                    $this->spyCustomersScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCustomers !== null) {
                foreach ($this->collSpyCustomers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyGlossaryTranslationsScheduledForDeletion !== null) {
                if (!$this->spyGlossaryTranslationsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery::create()
                        ->filterByPrimaryKeys($this->spyGlossaryTranslationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyGlossaryTranslationsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyGlossaryTranslations !== null) {
                foreach ($this->collSpyGlossaryTranslations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->touchStoragesScheduledForDeletion !== null) {
                if (!$this->touchStoragesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery::create()
                        ->filterByPrimaryKeys($this->touchStoragesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->touchStoragesScheduledForDeletion = null;
                }
            }

            if ($this->collTouchStorages !== null) {
                foreach ($this->collTouchStorages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->touchSearchesScheduledForDeletion !== null) {
                if (!$this->touchSearchesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery::create()
                        ->filterByPrimaryKeys($this->touchSearchesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->touchSearchesScheduledForDeletion = null;
                }
            }

            if ($this->collTouchSearches !== null) {
                foreach ($this->collTouchSearches as $referrerFK) {
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

        $this->modifiedColumns[SpyLocaleTableMap::COL_ID_LOCALE] = true;
        if (null !== $this->id_locale) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . SpyLocaleTableMap::COL_ID_LOCALE . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyLocaleTableMap::COL_ID_LOCALE)) {
            $modifiedColumns[':p' . $index++]  = 'id_locale';
        }
        if ($this->isColumnModified(SpyLocaleTableMap::COL_LOCALE_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'locale_name';
        }
        if ($this->isColumnModified(SpyLocaleTableMap::COL_IS_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'is_active';
        }

        $sql = sprintf(
            'INSERT INTO spy_locale (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_locale':
                        $stmt->bindValue($identifier, $this->id_locale, PDO::PARAM_INT);
                        break;
                    case 'locale_name':
                        $stmt->bindValue($identifier, $this->locale_name, PDO::PARAM_STR);
                        break;
                    case 'is_active':
                        $stmt->bindValue($identifier, $this->is_active, PDO::PARAM_BOOL);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_locale_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdLocale($pk);

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
        $pos = SpyLocaleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdLocale();

            case 1:
                return $this->getLocaleName();

            case 2:
                return $this->getIsActive();

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
        if (isset($alreadyDumpedObjects['SpyLocale'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyLocale'][$this->hashCode()] = true;
        $keys = SpyLocaleTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdLocale(),
            $keys[1] => $this->getLocaleName(),
            $keys[2] => $this->getIsActive(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collSpyCustomers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCustomers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_customers';
                        break;
                    default:
                        $key = 'SpyCustomers';
                }

                $result[$key] = $this->collSpyCustomers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyGlossaryTranslations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyGlossaryTranslations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_glossary_translations';
                        break;
                    default:
                        $key = 'SpyGlossaryTranslations';
                }

                $result[$key] = $this->collSpyGlossaryTranslations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTouchStorages) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyTouchStorages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_touch_storages';
                        break;
                    default:
                        $key = 'TouchStorages';
                }

                $result[$key] = $this->collTouchStorages->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTouchSearches) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyTouchSearches';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_touch_searches';
                        break;
                    default:
                        $key = 'TouchSearches';
                }

                $result[$key] = $this->collTouchSearches->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SpyLocaleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

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
                $this->setIdLocale($value);
                break;
            case 1:
                $this->setLocaleName($value);
                break;
            case 2:
                $this->setIsActive($value);
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
        $keys = SpyLocaleTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdLocale($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setLocaleName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIsActive($arr[$keys[2]]);
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
        $criteria = new Criteria(SpyLocaleTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyLocaleTableMap::COL_ID_LOCALE)) {
            $criteria->add(SpyLocaleTableMap::COL_ID_LOCALE, $this->id_locale);
        }
        if ($this->isColumnModified(SpyLocaleTableMap::COL_LOCALE_NAME)) {
            $criteria->add(SpyLocaleTableMap::COL_LOCALE_NAME, $this->locale_name);
        }
        if ($this->isColumnModified(SpyLocaleTableMap::COL_IS_ACTIVE)) {
            $criteria->add(SpyLocaleTableMap::COL_IS_ACTIVE, $this->is_active);
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
        $criteria = ChildSpyLocaleQuery::create();
        $criteria->add(SpyLocaleTableMap::COL_ID_LOCALE, $this->id_locale);

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
        $validPk = null !== $this->getIdLocale();

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
        return $this->getIdLocale();
    }

    /**
     * Generic method to set the primary key (id_locale column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdLocale($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdLocale();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Locale\Persistence\SpyLocale (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setLocaleName($this->getLocaleName());
        $copyObj->setIsActive($this->getIsActive());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyCustomers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCustomer($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyGlossaryTranslations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyGlossaryTranslation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTouchStorages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTouchStorage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTouchSearches() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTouchSearch($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdLocale(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Orm\Zed\Locale\Persistence\SpyLocale Clone of current object.
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
        if ('SpyCustomer' === $relationName) {
            $this->initSpyCustomers();
            return;
        }
        if ('SpyGlossaryTranslation' === $relationName) {
            $this->initSpyGlossaryTranslations();
            return;
        }
        if ('TouchStorage' === $relationName) {
            $this->initTouchStorages();
            return;
        }
        if ('TouchSearch' === $relationName) {
            $this->initTouchSearches();
            return;
        }
    }

    /**
     * Clears out the collSpyCustomers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCustomers()
     */
    public function clearSpyCustomers()
    {
        $this->collSpyCustomers = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCustomers collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCustomers($v = true): void
    {
        $this->collSpyCustomersPartial = $v;
    }

    /**
     * Initializes the collSpyCustomers collection.
     *
     * By default this just sets the collSpyCustomers collection to an empty array (like clearcollSpyCustomers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCustomers(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCustomers && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCustomerTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCustomers = new $collectionClassName;
        $this->collSpyCustomers->setModel('\Orm\Zed\Customer\Persistence\SpyCustomer');
    }

    /**
     * Gets an array of SpyCustomer objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCustomer[] List of SpyCustomer objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomer> List of SpyCustomer objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCustomers(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCustomersPartial && !$this->isNew();
        if (null === $this->collSpyCustomers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCustomers) {
                    $this->initSpyCustomers();
                } else {
                    $collectionClassName = SpyCustomerTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCustomers = new $collectionClassName;
                    $collSpyCustomers->setModel('\Orm\Zed\Customer\Persistence\SpyCustomer');

                    return $collSpyCustomers;
                }
            } else {
                $collSpyCustomers = SpyCustomerQuery::create(null, $criteria)
                    ->filterByLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCustomersPartial && count($collSpyCustomers)) {
                        $this->initSpyCustomers(false);

                        foreach ($collSpyCustomers as $obj) {
                            if (false == $this->collSpyCustomers->contains($obj)) {
                                $this->collSpyCustomers->append($obj);
                            }
                        }

                        $this->collSpyCustomersPartial = true;
                    }

                    return $collSpyCustomers;
                }

                if ($partial && $this->collSpyCustomers) {
                    foreach ($this->collSpyCustomers as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCustomers[] = $obj;
                        }
                    }
                }

                $this->collSpyCustomers = $collSpyCustomers;
                $this->collSpyCustomersPartial = false;
            }
        }

        return $this->collSpyCustomers;
    }

    /**
     * Sets a collection of SpyCustomer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCustomers A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCustomers(Collection $spyCustomers, ?ConnectionInterface $con = null)
    {
        /** @var SpyCustomer[] $spyCustomersToDelete */
        $spyCustomersToDelete = $this->getSpyCustomers(new Criteria(), $con)->diff($spyCustomers);


        $this->spyCustomersScheduledForDeletion = $spyCustomersToDelete;

        foreach ($spyCustomersToDelete as $spyCustomerRemoved) {
            $spyCustomerRemoved->setLocale(null);
        }

        $this->collSpyCustomers = null;
        foreach ($spyCustomers as $spyCustomer) {
            $this->addSpyCustomer($spyCustomer);
        }

        $this->collSpyCustomers = $spyCustomers;
        $this->collSpyCustomersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCustomer objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCustomer objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCustomers(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCustomersPartial && !$this->isNew();
        if (null === $this->collSpyCustomers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCustomers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCustomers());
            }

            $query = SpyCustomerQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLocale($this)
                ->count($con);
        }

        return count($this->collSpyCustomers);
    }

    /**
     * Method called to associate a SpyCustomer object to this object
     * through the SpyCustomer foreign key attribute.
     *
     * @param SpyCustomer $l SpyCustomer
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCustomer(SpyCustomer $l)
    {
        if ($this->collSpyCustomers === null) {
            $this->initSpyCustomers();
            $this->collSpyCustomersPartial = true;
        }

        if (!$this->collSpyCustomers->contains($l)) {
            $this->doAddSpyCustomer($l);

            if ($this->spyCustomersScheduledForDeletion and $this->spyCustomersScheduledForDeletion->contains($l)) {
                $this->spyCustomersScheduledForDeletion->remove($this->spyCustomersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCustomer $spyCustomer The SpyCustomer object to add.
     */
    protected function doAddSpyCustomer(SpyCustomer $spyCustomer): void
    {
        $this->collSpyCustomers[]= $spyCustomer;
        $spyCustomer->setLocale($this);
    }

    /**
     * @param SpyCustomer $spyCustomer The SpyCustomer object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCustomer(SpyCustomer $spyCustomer)
    {
        if ($this->getSpyCustomers()->contains($spyCustomer)) {
            $pos = $this->collSpyCustomers->search($spyCustomer);
            $this->collSpyCustomers->remove($pos);
            if (null === $this->spyCustomersScheduledForDeletion) {
                $this->spyCustomersScheduledForDeletion = clone $this->collSpyCustomers;
                $this->spyCustomersScheduledForDeletion->clear();
            }
            $this->spyCustomersScheduledForDeletion[]= $spyCustomer;
            $spyCustomer->setLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyCustomers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCustomer[] List of SpyCustomer objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomer}> List of SpyCustomer objects
     */
    public function getSpyCustomersJoinBillingAddress(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCustomerQuery::create(null, $criteria);
        $query->joinWith('BillingAddress', $joinBehavior);

        return $this->getSpyCustomers($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyCustomers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCustomer[] List of SpyCustomer objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCustomer}> List of SpyCustomer objects
     */
    public function getSpyCustomersJoinShippingAddress(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCustomerQuery::create(null, $criteria);
        $query->joinWith('ShippingAddress', $joinBehavior);

        return $this->getSpyCustomers($query, $con);
    }

    /**
     * Clears out the collSpyGlossaryTranslations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyGlossaryTranslations()
     */
    public function clearSpyGlossaryTranslations()
    {
        $this->collSpyGlossaryTranslations = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyGlossaryTranslations collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyGlossaryTranslations($v = true): void
    {
        $this->collSpyGlossaryTranslationsPartial = $v;
    }

    /**
     * Initializes the collSpyGlossaryTranslations collection.
     *
     * By default this just sets the collSpyGlossaryTranslations collection to an empty array (like clearcollSpyGlossaryTranslations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyGlossaryTranslations(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyGlossaryTranslations && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyGlossaryTranslationTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyGlossaryTranslations = new $collectionClassName;
        $this->collSpyGlossaryTranslations->setModel('\Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation');
    }

    /**
     * Gets an array of SpyGlossaryTranslation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyGlossaryTranslation[] List of SpyGlossaryTranslation objects
     * @phpstan-return ObjectCollection&\Traversable<SpyGlossaryTranslation> List of SpyGlossaryTranslation objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyGlossaryTranslations(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyGlossaryTranslationsPartial && !$this->isNew();
        if (null === $this->collSpyGlossaryTranslations || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyGlossaryTranslations) {
                    $this->initSpyGlossaryTranslations();
                } else {
                    $collectionClassName = SpyGlossaryTranslationTableMap::getTableMap()->getCollectionClassName();

                    $collSpyGlossaryTranslations = new $collectionClassName;
                    $collSpyGlossaryTranslations->setModel('\Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation');

                    return $collSpyGlossaryTranslations;
                }
            } else {
                $collSpyGlossaryTranslations = SpyGlossaryTranslationQuery::create(null, $criteria)
                    ->filterByLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyGlossaryTranslationsPartial && count($collSpyGlossaryTranslations)) {
                        $this->initSpyGlossaryTranslations(false);

                        foreach ($collSpyGlossaryTranslations as $obj) {
                            if (false == $this->collSpyGlossaryTranslations->contains($obj)) {
                                $this->collSpyGlossaryTranslations->append($obj);
                            }
                        }

                        $this->collSpyGlossaryTranslationsPartial = true;
                    }

                    return $collSpyGlossaryTranslations;
                }

                if ($partial && $this->collSpyGlossaryTranslations) {
                    foreach ($this->collSpyGlossaryTranslations as $obj) {
                        if ($obj->isNew()) {
                            $collSpyGlossaryTranslations[] = $obj;
                        }
                    }
                }

                $this->collSpyGlossaryTranslations = $collSpyGlossaryTranslations;
                $this->collSpyGlossaryTranslationsPartial = false;
            }
        }

        return $this->collSpyGlossaryTranslations;
    }

    /**
     * Sets a collection of SpyGlossaryTranslation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyGlossaryTranslations A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyGlossaryTranslations(Collection $spyGlossaryTranslations, ?ConnectionInterface $con = null)
    {
        /** @var SpyGlossaryTranslation[] $spyGlossaryTranslationsToDelete */
        $spyGlossaryTranslationsToDelete = $this->getSpyGlossaryTranslations(new Criteria(), $con)->diff($spyGlossaryTranslations);


        $this->spyGlossaryTranslationsScheduledForDeletion = $spyGlossaryTranslationsToDelete;

        foreach ($spyGlossaryTranslationsToDelete as $spyGlossaryTranslationRemoved) {
            $spyGlossaryTranslationRemoved->setLocale(null);
        }

        $this->collSpyGlossaryTranslations = null;
        foreach ($spyGlossaryTranslations as $spyGlossaryTranslation) {
            $this->addSpyGlossaryTranslation($spyGlossaryTranslation);
        }

        $this->collSpyGlossaryTranslations = $spyGlossaryTranslations;
        $this->collSpyGlossaryTranslationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyGlossaryTranslation objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyGlossaryTranslation objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyGlossaryTranslations(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyGlossaryTranslationsPartial && !$this->isNew();
        if (null === $this->collSpyGlossaryTranslations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyGlossaryTranslations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyGlossaryTranslations());
            }

            $query = SpyGlossaryTranslationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLocale($this)
                ->count($con);
        }

        return count($this->collSpyGlossaryTranslations);
    }

    /**
     * Method called to associate a SpyGlossaryTranslation object to this object
     * through the SpyGlossaryTranslation foreign key attribute.
     *
     * @param SpyGlossaryTranslation $l SpyGlossaryTranslation
     * @return $this The current object (for fluent API support)
     */
    public function addSpyGlossaryTranslation(SpyGlossaryTranslation $l)
    {
        if ($this->collSpyGlossaryTranslations === null) {
            $this->initSpyGlossaryTranslations();
            $this->collSpyGlossaryTranslationsPartial = true;
        }

        if (!$this->collSpyGlossaryTranslations->contains($l)) {
            $this->doAddSpyGlossaryTranslation($l);

            if ($this->spyGlossaryTranslationsScheduledForDeletion and $this->spyGlossaryTranslationsScheduledForDeletion->contains($l)) {
                $this->spyGlossaryTranslationsScheduledForDeletion->remove($this->spyGlossaryTranslationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyGlossaryTranslation $spyGlossaryTranslation The SpyGlossaryTranslation object to add.
     */
    protected function doAddSpyGlossaryTranslation(SpyGlossaryTranslation $spyGlossaryTranslation): void
    {
        $this->collSpyGlossaryTranslations[]= $spyGlossaryTranslation;
        $spyGlossaryTranslation->setLocale($this);
    }

    /**
     * @param SpyGlossaryTranslation $spyGlossaryTranslation The SpyGlossaryTranslation object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyGlossaryTranslation(SpyGlossaryTranslation $spyGlossaryTranslation)
    {
        if ($this->getSpyGlossaryTranslations()->contains($spyGlossaryTranslation)) {
            $pos = $this->collSpyGlossaryTranslations->search($spyGlossaryTranslation);
            $this->collSpyGlossaryTranslations->remove($pos);
            if (null === $this->spyGlossaryTranslationsScheduledForDeletion) {
                $this->spyGlossaryTranslationsScheduledForDeletion = clone $this->collSpyGlossaryTranslations;
                $this->spyGlossaryTranslationsScheduledForDeletion->clear();
            }
            $this->spyGlossaryTranslationsScheduledForDeletion[]= clone $spyGlossaryTranslation;
            $spyGlossaryTranslation->setLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related SpyGlossaryTranslations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyGlossaryTranslation[] List of SpyGlossaryTranslation objects
     * @phpstan-return ObjectCollection&\Traversable<SpyGlossaryTranslation}> List of SpyGlossaryTranslation objects
     */
    public function getSpyGlossaryTranslationsJoinGlossaryKey(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyGlossaryTranslationQuery::create(null, $criteria);
        $query->joinWith('GlossaryKey', $joinBehavior);

        return $this->getSpyGlossaryTranslations($query, $con);
    }

    /**
     * Clears out the collTouchStorages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTouchStorages()
     */
    public function clearTouchStorages()
    {
        $this->collTouchStorages = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTouchStorages collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTouchStorages($v = true): void
    {
        $this->collTouchStoragesPartial = $v;
    }

    /**
     * Initializes the collTouchStorages collection.
     *
     * By default this just sets the collTouchStorages collection to an empty array (like clearcollTouchStorages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTouchStorages(bool $overrideExisting = true): void
    {
        if (null !== $this->collTouchStorages && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyTouchStorageTableMap::getTableMap()->getCollectionClassName();

        $this->collTouchStorages = new $collectionClassName;
        $this->collTouchStorages->setModel('\Orm\Zed\Touch\Persistence\SpyTouchStorage');
    }

    /**
     * Gets an array of SpyTouchStorage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyTouchStorage[] List of SpyTouchStorage objects
     * @phpstan-return ObjectCollection&\Traversable<SpyTouchStorage> List of SpyTouchStorage objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTouchStorages(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTouchStoragesPartial && !$this->isNew();
        if (null === $this->collTouchStorages || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTouchStorages) {
                    $this->initTouchStorages();
                } else {
                    $collectionClassName = SpyTouchStorageTableMap::getTableMap()->getCollectionClassName();

                    $collTouchStorages = new $collectionClassName;
                    $collTouchStorages->setModel('\Orm\Zed\Touch\Persistence\SpyTouchStorage');

                    return $collTouchStorages;
                }
            } else {
                $collTouchStorages = SpyTouchStorageQuery::create(null, $criteria)
                    ->filterByLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTouchStoragesPartial && count($collTouchStorages)) {
                        $this->initTouchStorages(false);

                        foreach ($collTouchStorages as $obj) {
                            if (false == $this->collTouchStorages->contains($obj)) {
                                $this->collTouchStorages->append($obj);
                            }
                        }

                        $this->collTouchStoragesPartial = true;
                    }

                    return $collTouchStorages;
                }

                if ($partial && $this->collTouchStorages) {
                    foreach ($this->collTouchStorages as $obj) {
                        if ($obj->isNew()) {
                            $collTouchStorages[] = $obj;
                        }
                    }
                }

                $this->collTouchStorages = $collTouchStorages;
                $this->collTouchStoragesPartial = false;
            }
        }

        return $this->collTouchStorages;
    }

    /**
     * Sets a collection of SpyTouchStorage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $touchStorages A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTouchStorages(Collection $touchStorages, ?ConnectionInterface $con = null)
    {
        /** @var SpyTouchStorage[] $touchStoragesToDelete */
        $touchStoragesToDelete = $this->getTouchStorages(new Criteria(), $con)->diff($touchStorages);


        $this->touchStoragesScheduledForDeletion = $touchStoragesToDelete;

        foreach ($touchStoragesToDelete as $touchStorageRemoved) {
            $touchStorageRemoved->setLocale(null);
        }

        $this->collTouchStorages = null;
        foreach ($touchStorages as $touchStorage) {
            $this->addTouchStorage($touchStorage);
        }

        $this->collTouchStorages = $touchStorages;
        $this->collTouchStoragesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyTouchStorage objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyTouchStorage objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTouchStorages(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTouchStoragesPartial && !$this->isNew();
        if (null === $this->collTouchStorages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTouchStorages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTouchStorages());
            }

            $query = SpyTouchStorageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLocale($this)
                ->count($con);
        }

        return count($this->collTouchStorages);
    }

    /**
     * Method called to associate a SpyTouchStorage object to this object
     * through the SpyTouchStorage foreign key attribute.
     *
     * @param SpyTouchStorage $l SpyTouchStorage
     * @return $this The current object (for fluent API support)
     */
    public function addTouchStorage(SpyTouchStorage $l)
    {
        if ($this->collTouchStorages === null) {
            $this->initTouchStorages();
            $this->collTouchStoragesPartial = true;
        }

        if (!$this->collTouchStorages->contains($l)) {
            $this->doAddTouchStorage($l);

            if ($this->touchStoragesScheduledForDeletion and $this->touchStoragesScheduledForDeletion->contains($l)) {
                $this->touchStoragesScheduledForDeletion->remove($this->touchStoragesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyTouchStorage $touchStorage The SpyTouchStorage object to add.
     */
    protected function doAddTouchStorage(SpyTouchStorage $touchStorage): void
    {
        $this->collTouchStorages[]= $touchStorage;
        $touchStorage->setLocale($this);
    }

    /**
     * @param SpyTouchStorage $touchStorage The SpyTouchStorage object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTouchStorage(SpyTouchStorage $touchStorage)
    {
        if ($this->getTouchStorages()->contains($touchStorage)) {
            $pos = $this->collTouchStorages->search($touchStorage);
            $this->collTouchStorages->remove($pos);
            if (null === $this->touchStoragesScheduledForDeletion) {
                $this->touchStoragesScheduledForDeletion = clone $this->collTouchStorages;
                $this->touchStoragesScheduledForDeletion->clear();
            }
            $this->touchStoragesScheduledForDeletion[]= clone $touchStorage;
            $touchStorage->setLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related TouchStorages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyTouchStorage[] List of SpyTouchStorage objects
     * @phpstan-return ObjectCollection&\Traversable<SpyTouchStorage}> List of SpyTouchStorage objects
     */
    public function getTouchStoragesJoinTouch(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyTouchStorageQuery::create(null, $criteria);
        $query->joinWith('Touch', $joinBehavior);

        return $this->getTouchStorages($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related TouchStorages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyTouchStorage[] List of SpyTouchStorage objects
     * @phpstan-return ObjectCollection&\Traversable<SpyTouchStorage}> List of SpyTouchStorage objects
     */
    public function getTouchStoragesJoinStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyTouchStorageQuery::create(null, $criteria);
        $query->joinWith('Store', $joinBehavior);

        return $this->getTouchStorages($query, $con);
    }

    /**
     * Clears out the collTouchSearches collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addTouchSearches()
     */
    public function clearTouchSearches()
    {
        $this->collTouchSearches = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collTouchSearches collection loaded partially.
     *
     * @return void
     */
    public function resetPartialTouchSearches($v = true): void
    {
        $this->collTouchSearchesPartial = $v;
    }

    /**
     * Initializes the collTouchSearches collection.
     *
     * By default this just sets the collTouchSearches collection to an empty array (like clearcollTouchSearches());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTouchSearches(bool $overrideExisting = true): void
    {
        if (null !== $this->collTouchSearches && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyTouchSearchTableMap::getTableMap()->getCollectionClassName();

        $this->collTouchSearches = new $collectionClassName;
        $this->collTouchSearches->setModel('\Orm\Zed\Touch\Persistence\SpyTouchSearch');
    }

    /**
     * Gets an array of SpyTouchSearch objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyLocale is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyTouchSearch[] List of SpyTouchSearch objects
     * @phpstan-return ObjectCollection&\Traversable<SpyTouchSearch> List of SpyTouchSearch objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getTouchSearches(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collTouchSearchesPartial && !$this->isNew();
        if (null === $this->collTouchSearches || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collTouchSearches) {
                    $this->initTouchSearches();
                } else {
                    $collectionClassName = SpyTouchSearchTableMap::getTableMap()->getCollectionClassName();

                    $collTouchSearches = new $collectionClassName;
                    $collTouchSearches->setModel('\Orm\Zed\Touch\Persistence\SpyTouchSearch');

                    return $collTouchSearches;
                }
            } else {
                $collTouchSearches = SpyTouchSearchQuery::create(null, $criteria)
                    ->filterByLocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTouchSearchesPartial && count($collTouchSearches)) {
                        $this->initTouchSearches(false);

                        foreach ($collTouchSearches as $obj) {
                            if (false == $this->collTouchSearches->contains($obj)) {
                                $this->collTouchSearches->append($obj);
                            }
                        }

                        $this->collTouchSearchesPartial = true;
                    }

                    return $collTouchSearches;
                }

                if ($partial && $this->collTouchSearches) {
                    foreach ($this->collTouchSearches as $obj) {
                        if ($obj->isNew()) {
                            $collTouchSearches[] = $obj;
                        }
                    }
                }

                $this->collTouchSearches = $collTouchSearches;
                $this->collTouchSearchesPartial = false;
            }
        }

        return $this->collTouchSearches;
    }

    /**
     * Sets a collection of SpyTouchSearch objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $touchSearches A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setTouchSearches(Collection $touchSearches, ?ConnectionInterface $con = null)
    {
        /** @var SpyTouchSearch[] $touchSearchesToDelete */
        $touchSearchesToDelete = $this->getTouchSearches(new Criteria(), $con)->diff($touchSearches);


        $this->touchSearchesScheduledForDeletion = $touchSearchesToDelete;

        foreach ($touchSearchesToDelete as $touchSearchRemoved) {
            $touchSearchRemoved->setLocale(null);
        }

        $this->collTouchSearches = null;
        foreach ($touchSearches as $touchSearch) {
            $this->addTouchSearch($touchSearch);
        }

        $this->collTouchSearches = $touchSearches;
        $this->collTouchSearchesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyTouchSearch objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyTouchSearch objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countTouchSearches(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collTouchSearchesPartial && !$this->isNew();
        if (null === $this->collTouchSearches || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTouchSearches) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTouchSearches());
            }

            $query = SpyTouchSearchQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLocale($this)
                ->count($con);
        }

        return count($this->collTouchSearches);
    }

    /**
     * Method called to associate a SpyTouchSearch object to this object
     * through the SpyTouchSearch foreign key attribute.
     *
     * @param SpyTouchSearch $l SpyTouchSearch
     * @return $this The current object (for fluent API support)
     */
    public function addTouchSearch(SpyTouchSearch $l)
    {
        if ($this->collTouchSearches === null) {
            $this->initTouchSearches();
            $this->collTouchSearchesPartial = true;
        }

        if (!$this->collTouchSearches->contains($l)) {
            $this->doAddTouchSearch($l);

            if ($this->touchSearchesScheduledForDeletion and $this->touchSearchesScheduledForDeletion->contains($l)) {
                $this->touchSearchesScheduledForDeletion->remove($this->touchSearchesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyTouchSearch $touchSearch The SpyTouchSearch object to add.
     */
    protected function doAddTouchSearch(SpyTouchSearch $touchSearch): void
    {
        $this->collTouchSearches[]= $touchSearch;
        $touchSearch->setLocale($this);
    }

    /**
     * @param SpyTouchSearch $touchSearch The SpyTouchSearch object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeTouchSearch(SpyTouchSearch $touchSearch)
    {
        if ($this->getTouchSearches()->contains($touchSearch)) {
            $pos = $this->collTouchSearches->search($touchSearch);
            $this->collTouchSearches->remove($pos);
            if (null === $this->touchSearchesScheduledForDeletion) {
                $this->touchSearchesScheduledForDeletion = clone $this->collTouchSearches;
                $this->touchSearchesScheduledForDeletion->clear();
            }
            $this->touchSearchesScheduledForDeletion[]= clone $touchSearch;
            $touchSearch->setLocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related TouchSearches from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyTouchSearch[] List of SpyTouchSearch objects
     * @phpstan-return ObjectCollection&\Traversable<SpyTouchSearch}> List of SpyTouchSearch objects
     */
    public function getTouchSearchesJoinTouch(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyTouchSearchQuery::create(null, $criteria);
        $query->joinWith('Touch', $joinBehavior);

        return $this->getTouchSearches($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyLocale is new, it will return
     * an empty collection; or if this SpyLocale has previously
     * been saved, it will retrieve related TouchSearches from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyLocale.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyTouchSearch[] List of SpyTouchSearch objects
     * @phpstan-return ObjectCollection&\Traversable<SpyTouchSearch}> List of SpyTouchSearch objects
     */
    public function getTouchSearchesJoinStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyTouchSearchQuery::create(null, $criteria);
        $query->joinWith('Store', $joinBehavior);

        return $this->getTouchSearches($query, $con);
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
        $this->id_locale = null;
        $this->locale_name = null;
        $this->is_active = null;
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
            if ($this->collSpyCustomers) {
                foreach ($this->collSpyCustomers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyGlossaryTranslations) {
                foreach ($this->collSpyGlossaryTranslations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTouchStorages) {
                foreach ($this->collTouchStorages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTouchSearches) {
                foreach ($this->collTouchSearches as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyCustomers = null;
        $this->collSpyGlossaryTranslations = null;
        $this->collTouchStorages = null;
        $this->collTouchSearches = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyLocaleTableMap::DEFAULT_STRING_FORMAT);
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
