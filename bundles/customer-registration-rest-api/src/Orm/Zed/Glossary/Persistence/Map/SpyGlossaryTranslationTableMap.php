<?php

namespace Orm\Zed\Glossary\Persistence\Map;

use Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation;
use Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'spy_glossary_translation' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyGlossaryTranslationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'Orm.Zed.Glossary.Persistence.Map.SpyGlossaryTranslationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_glossary_translation';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Glossary\\Persistence\\SpyGlossaryTranslation';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Orm.Zed.Glossary.Persistence.SpyGlossaryTranslation';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id_glossary_translation field
     */
    public const COL_ID_GLOSSARY_TRANSLATION = 'spy_glossary_translation.id_glossary_translation';

    /**
     * the column name for the fk_glossary_key field
     */
    public const COL_FK_GLOSSARY_KEY = 'spy_glossary_translation.fk_glossary_key';

    /**
     * the column name for the fk_locale field
     */
    public const COL_FK_LOCALE = 'spy_glossary_translation.fk_locale';

    /**
     * the column name for the value field
     */
    public const COL_VALUE = 'spy_glossary_translation.value';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_glossary_translation.is_active';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdGlossaryTranslation', 'FkGlossaryKey', 'FkLocale', 'Value', 'IsActive', ],
        self::TYPE_CAMELNAME     => ['idGlossaryTranslation', 'fkGlossaryKey', 'fkLocale', 'value', 'isActive', ],
        self::TYPE_COLNAME       => [SpyGlossaryTranslationTableMap::COL_ID_GLOSSARY_TRANSLATION, SpyGlossaryTranslationTableMap::COL_FK_GLOSSARY_KEY, SpyGlossaryTranslationTableMap::COL_FK_LOCALE, SpyGlossaryTranslationTableMap::COL_VALUE, SpyGlossaryTranslationTableMap::COL_IS_ACTIVE, ],
        self::TYPE_FIELDNAME     => ['id_glossary_translation', 'fk_glossary_key', 'fk_locale', 'value', 'is_active', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['IdGlossaryTranslation' => 0, 'FkGlossaryKey' => 1, 'FkLocale' => 2, 'Value' => 3, 'IsActive' => 4, ],
        self::TYPE_CAMELNAME     => ['idGlossaryTranslation' => 0, 'fkGlossaryKey' => 1, 'fkLocale' => 2, 'value' => 3, 'isActive' => 4, ],
        self::TYPE_COLNAME       => [SpyGlossaryTranslationTableMap::COL_ID_GLOSSARY_TRANSLATION => 0, SpyGlossaryTranslationTableMap::COL_FK_GLOSSARY_KEY => 1, SpyGlossaryTranslationTableMap::COL_FK_LOCALE => 2, SpyGlossaryTranslationTableMap::COL_VALUE => 3, SpyGlossaryTranslationTableMap::COL_IS_ACTIVE => 4, ],
        self::TYPE_FIELDNAME     => ['id_glossary_translation' => 0, 'fk_glossary_key' => 1, 'fk_locale' => 2, 'value' => 3, 'is_active' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdGlossaryTranslation' => 'ID_GLOSSARY_TRANSLATION',
        'SpyGlossaryTranslation.IdGlossaryTranslation' => 'ID_GLOSSARY_TRANSLATION',
        'idGlossaryTranslation' => 'ID_GLOSSARY_TRANSLATION',
        'spyGlossaryTranslation.idGlossaryTranslation' => 'ID_GLOSSARY_TRANSLATION',
        'SpyGlossaryTranslationTableMap::COL_ID_GLOSSARY_TRANSLATION' => 'ID_GLOSSARY_TRANSLATION',
        'COL_ID_GLOSSARY_TRANSLATION' => 'ID_GLOSSARY_TRANSLATION',
        'id_glossary_translation' => 'ID_GLOSSARY_TRANSLATION',
        'spy_glossary_translation.id_glossary_translation' => 'ID_GLOSSARY_TRANSLATION',
        'FkGlossaryKey' => 'FK_GLOSSARY_KEY',
        'SpyGlossaryTranslation.FkGlossaryKey' => 'FK_GLOSSARY_KEY',
        'fkGlossaryKey' => 'FK_GLOSSARY_KEY',
        'spyGlossaryTranslation.fkGlossaryKey' => 'FK_GLOSSARY_KEY',
        'SpyGlossaryTranslationTableMap::COL_FK_GLOSSARY_KEY' => 'FK_GLOSSARY_KEY',
        'COL_FK_GLOSSARY_KEY' => 'FK_GLOSSARY_KEY',
        'fk_glossary_key' => 'FK_GLOSSARY_KEY',
        'spy_glossary_translation.fk_glossary_key' => 'FK_GLOSSARY_KEY',
        'FkLocale' => 'FK_LOCALE',
        'SpyGlossaryTranslation.FkLocale' => 'FK_LOCALE',
        'fkLocale' => 'FK_LOCALE',
        'spyGlossaryTranslation.fkLocale' => 'FK_LOCALE',
        'SpyGlossaryTranslationTableMap::COL_FK_LOCALE' => 'FK_LOCALE',
        'COL_FK_LOCALE' => 'FK_LOCALE',
        'fk_locale' => 'FK_LOCALE',
        'spy_glossary_translation.fk_locale' => 'FK_LOCALE',
        'Value' => 'VALUE',
        'SpyGlossaryTranslation.Value' => 'VALUE',
        'value' => 'VALUE',
        'spyGlossaryTranslation.value' => 'VALUE',
        'SpyGlossaryTranslationTableMap::COL_VALUE' => 'VALUE',
        'COL_VALUE' => 'VALUE',
        'spy_glossary_translation.value' => 'VALUE',
        'IsActive' => 'IS_ACTIVE',
        'SpyGlossaryTranslation.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyGlossaryTranslation.isActive' => 'IS_ACTIVE',
        'SpyGlossaryTranslationTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_glossary_translation.is_active' => 'IS_ACTIVE',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('spy_glossary_translation');
        $this->setPhpName('SpyGlossaryTranslation');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Glossary\\Persistence\\SpyGlossaryTranslation');
        $this->setPackage('Orm.Zed.Glossary.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_glossary_translation_pk_seq');
        // columns
        $this->addPrimaryKey('id_glossary_translation', 'IdGlossaryTranslation', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_glossary_key', 'FkGlossaryKey', 'INTEGER', 'spy_glossary_key', 'id_glossary_key', true, null, null);
        $this->addForeignKey('fk_locale', 'FkLocale', 'INTEGER', 'spy_locale', 'id_locale', true, null, null);
        $this->addColumn('value', 'Value', 'LONGVARCHAR', true, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', true, null, true);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('GlossaryKey', '\\Orm\\Zed\\Glossary\\Persistence\\SpyGlossaryKey', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_glossary_key',
    1 => ':id_glossary_key',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Locale', '\\Orm\\Zed\\Locale\\Persistence\\SpyLocale', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_locale',
    1 => ':id_locale',
  ),
), 'CASCADE', null, null, false);
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdGlossaryTranslation', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdGlossaryTranslation', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdGlossaryTranslation', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdGlossaryTranslation', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdGlossaryTranslation', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdGlossaryTranslation', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdGlossaryTranslation', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? SpyGlossaryTranslationTableMap::CLASS_DEFAULT : SpyGlossaryTranslationTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (SpyGlossaryTranslation object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyGlossaryTranslationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyGlossaryTranslationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyGlossaryTranslationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyGlossaryTranslationTableMap::OM_CLASS;
            /** @var SpyGlossaryTranslation $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyGlossaryTranslationTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = SpyGlossaryTranslationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyGlossaryTranslationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyGlossaryTranslation $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyGlossaryTranslationTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(SpyGlossaryTranslationTableMap::COL_ID_GLOSSARY_TRANSLATION);
            $criteria->addSelectColumn(SpyGlossaryTranslationTableMap::COL_FK_GLOSSARY_KEY);
            $criteria->addSelectColumn(SpyGlossaryTranslationTableMap::COL_FK_LOCALE);
            $criteria->addSelectColumn(SpyGlossaryTranslationTableMap::COL_VALUE);
            $criteria->addSelectColumn(SpyGlossaryTranslationTableMap::COL_IS_ACTIVE);
        } else {
            $criteria->addSelectColumn($alias . '.id_glossary_translation');
            $criteria->addSelectColumn($alias . '.fk_glossary_key');
            $criteria->addSelectColumn($alias . '.fk_locale');
            $criteria->addSelectColumn($alias . '.value');
            $criteria->addSelectColumn($alias . '.is_active');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(SpyGlossaryTranslationTableMap::COL_ID_GLOSSARY_TRANSLATION);
            $criteria->removeSelectColumn(SpyGlossaryTranslationTableMap::COL_FK_GLOSSARY_KEY);
            $criteria->removeSelectColumn(SpyGlossaryTranslationTableMap::COL_FK_LOCALE);
            $criteria->removeSelectColumn(SpyGlossaryTranslationTableMap::COL_VALUE);
            $criteria->removeSelectColumn(SpyGlossaryTranslationTableMap::COL_IS_ACTIVE);
        } else {
            $criteria->removeSelectColumn($alias . '.id_glossary_translation');
            $criteria->removeSelectColumn($alias . '.fk_glossary_key');
            $criteria->removeSelectColumn($alias . '.fk_locale');
            $criteria->removeSelectColumn($alias . '.value');
            $criteria->removeSelectColumn($alias . '.is_active');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(SpyGlossaryTranslationTableMap::DATABASE_NAME)->getTable(SpyGlossaryTranslationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyGlossaryTranslation or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyGlossaryTranslation object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyGlossaryTranslationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyGlossaryTranslationTableMap::DATABASE_NAME);
            $criteria->add(SpyGlossaryTranslationTableMap::COL_ID_GLOSSARY_TRANSLATION, (array) $values, Criteria::IN);
        }

        $query = SpyGlossaryTranslationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyGlossaryTranslationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyGlossaryTranslationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_glossary_translation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyGlossaryTranslationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyGlossaryTranslation or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyGlossaryTranslation object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyGlossaryTranslationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyGlossaryTranslation object
        }

        if ($criteria->containsKey(SpyGlossaryTranslationTableMap::COL_ID_GLOSSARY_TRANSLATION) && $criteria->keyContainsValue(SpyGlossaryTranslationTableMap::COL_ID_GLOSSARY_TRANSLATION) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyGlossaryTranslationTableMap::COL_ID_GLOSSARY_TRANSLATION.')');
        }


        // Set the correct dbName
        $query = SpyGlossaryTranslationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
