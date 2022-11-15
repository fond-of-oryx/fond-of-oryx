<?php

namespace Orm\Zed\Customer\Persistence\Map;

use Orm\Zed\Customer\Persistence\SpyCustomerAddress;
use Orm\Zed\Customer\Persistence\SpyCustomerAddressQuery;
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
 * This class defines the structure of the 'spy_customer_address' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCustomerAddressTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'Orm.Zed.Customer.Persistence.Map.SpyCustomerAddressTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_customer_address';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Customer\\Persistence\\SpyCustomerAddress';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'Orm.Zed.Customer.Persistence.SpyCustomerAddress';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 19;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 19;

    /**
     * the column name for the id_customer_address field
     */
    public const COL_ID_CUSTOMER_ADDRESS = 'spy_customer_address.id_customer_address';

    /**
     * the column name for the fk_country field
     */
    public const COL_FK_COUNTRY = 'spy_customer_address.fk_country';

    /**
     * the column name for the fk_customer field
     */
    public const COL_FK_CUSTOMER = 'spy_customer_address.fk_customer';

    /**
     * the column name for the fk_region field
     */
    public const COL_FK_REGION = 'spy_customer_address.fk_region';

    /**
     * the column name for the address1 field
     */
    public const COL_ADDRESS1 = 'spy_customer_address.address1';

    /**
     * the column name for the address2 field
     */
    public const COL_ADDRESS2 = 'spy_customer_address.address2';

    /**
     * the column name for the address3 field
     */
    public const COL_ADDRESS3 = 'spy_customer_address.address3';

    /**
     * the column name for the anonymized_at field
     */
    public const COL_ANONYMIZED_AT = 'spy_customer_address.anonymized_at';

    /**
     * the column name for the city field
     */
    public const COL_CITY = 'spy_customer_address.city';

    /**
     * the column name for the comment field
     */
    public const COL_COMMENT = 'spy_customer_address.comment';

    /**
     * the column name for the company field
     */
    public const COL_COMPANY = 'spy_customer_address.company';

    /**
     * the column name for the deleted_at field
     */
    public const COL_DELETED_AT = 'spy_customer_address.deleted_at';

    /**
     * the column name for the first_name field
     */
    public const COL_FIRST_NAME = 'spy_customer_address.first_name';

    /**
     * the column name for the last_name field
     */
    public const COL_LAST_NAME = 'spy_customer_address.last_name';

    /**
     * the column name for the phone field
     */
    public const COL_PHONE = 'spy_customer_address.phone';

    /**
     * the column name for the salutation field
     */
    public const COL_SALUTATION = 'spy_customer_address.salutation';

    /**
     * the column name for the zip_code field
     */
    public const COL_ZIP_CODE = 'spy_customer_address.zip_code';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_customer_address.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_customer_address.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the salutation field */
    public const COL_SALUTATION_MR = 'Mr';
    public const COL_SALUTATION_MRS = 'Mrs';
    public const COL_SALUTATION_DR = 'Dr';
    public const COL_SALUTATION_MS = 'Ms';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdCustomerAddress', 'FkCountry', 'FkCustomer', 'FkRegion', 'Address1', 'Address2', 'Address3', 'AnonymizedAt', 'City', 'Comment', 'Company', 'DeletedAt', 'FirstName', 'LastName', 'Phone', 'Salutation', 'ZipCode', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idCustomerAddress', 'fkCountry', 'fkCustomer', 'fkRegion', 'address1', 'address2', 'address3', 'anonymizedAt', 'city', 'comment', 'company', 'deletedAt', 'firstName', 'lastName', 'phone', 'salutation', 'zipCode', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS, SpyCustomerAddressTableMap::COL_FK_COUNTRY, SpyCustomerAddressTableMap::COL_FK_CUSTOMER, SpyCustomerAddressTableMap::COL_FK_REGION, SpyCustomerAddressTableMap::COL_ADDRESS1, SpyCustomerAddressTableMap::COL_ADDRESS2, SpyCustomerAddressTableMap::COL_ADDRESS3, SpyCustomerAddressTableMap::COL_ANONYMIZED_AT, SpyCustomerAddressTableMap::COL_CITY, SpyCustomerAddressTableMap::COL_COMMENT, SpyCustomerAddressTableMap::COL_COMPANY, SpyCustomerAddressTableMap::COL_DELETED_AT, SpyCustomerAddressTableMap::COL_FIRST_NAME, SpyCustomerAddressTableMap::COL_LAST_NAME, SpyCustomerAddressTableMap::COL_PHONE, SpyCustomerAddressTableMap::COL_SALUTATION, SpyCustomerAddressTableMap::COL_ZIP_CODE, SpyCustomerAddressTableMap::COL_CREATED_AT, SpyCustomerAddressTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_customer_address', 'fk_country', 'fk_customer', 'fk_region', 'address1', 'address2', 'address3', 'anonymized_at', 'city', 'comment', 'company', 'deleted_at', 'first_name', 'last_name', 'phone', 'salutation', 'zip_code', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, ]
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
        self::TYPE_PHPNAME       => ['IdCustomerAddress' => 0, 'FkCountry' => 1, 'FkCustomer' => 2, 'FkRegion' => 3, 'Address1' => 4, 'Address2' => 5, 'Address3' => 6, 'AnonymizedAt' => 7, 'City' => 8, 'Comment' => 9, 'Company' => 10, 'DeletedAt' => 11, 'FirstName' => 12, 'LastName' => 13, 'Phone' => 14, 'Salutation' => 15, 'ZipCode' => 16, 'CreatedAt' => 17, 'UpdatedAt' => 18, ],
        self::TYPE_CAMELNAME     => ['idCustomerAddress' => 0, 'fkCountry' => 1, 'fkCustomer' => 2, 'fkRegion' => 3, 'address1' => 4, 'address2' => 5, 'address3' => 6, 'anonymizedAt' => 7, 'city' => 8, 'comment' => 9, 'company' => 10, 'deletedAt' => 11, 'firstName' => 12, 'lastName' => 13, 'phone' => 14, 'salutation' => 15, 'zipCode' => 16, 'createdAt' => 17, 'updatedAt' => 18, ],
        self::TYPE_COLNAME       => [SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS => 0, SpyCustomerAddressTableMap::COL_FK_COUNTRY => 1, SpyCustomerAddressTableMap::COL_FK_CUSTOMER => 2, SpyCustomerAddressTableMap::COL_FK_REGION => 3, SpyCustomerAddressTableMap::COL_ADDRESS1 => 4, SpyCustomerAddressTableMap::COL_ADDRESS2 => 5, SpyCustomerAddressTableMap::COL_ADDRESS3 => 6, SpyCustomerAddressTableMap::COL_ANONYMIZED_AT => 7, SpyCustomerAddressTableMap::COL_CITY => 8, SpyCustomerAddressTableMap::COL_COMMENT => 9, SpyCustomerAddressTableMap::COL_COMPANY => 10, SpyCustomerAddressTableMap::COL_DELETED_AT => 11, SpyCustomerAddressTableMap::COL_FIRST_NAME => 12, SpyCustomerAddressTableMap::COL_LAST_NAME => 13, SpyCustomerAddressTableMap::COL_PHONE => 14, SpyCustomerAddressTableMap::COL_SALUTATION => 15, SpyCustomerAddressTableMap::COL_ZIP_CODE => 16, SpyCustomerAddressTableMap::COL_CREATED_AT => 17, SpyCustomerAddressTableMap::COL_UPDATED_AT => 18, ],
        self::TYPE_FIELDNAME     => ['id_customer_address' => 0, 'fk_country' => 1, 'fk_customer' => 2, 'fk_region' => 3, 'address1' => 4, 'address2' => 5, 'address3' => 6, 'anonymized_at' => 7, 'city' => 8, 'comment' => 9, 'company' => 10, 'deleted_at' => 11, 'first_name' => 12, 'last_name' => 13, 'phone' => 14, 'salutation' => 15, 'zip_code' => 16, 'created_at' => 17, 'updated_at' => 18, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCustomerAddress' => 'ID_CUSTOMER_ADDRESS',
        'SpyCustomerAddress.IdCustomerAddress' => 'ID_CUSTOMER_ADDRESS',
        'idCustomerAddress' => 'ID_CUSTOMER_ADDRESS',
        'spyCustomerAddress.idCustomerAddress' => 'ID_CUSTOMER_ADDRESS',
        'SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS' => 'ID_CUSTOMER_ADDRESS',
        'COL_ID_CUSTOMER_ADDRESS' => 'ID_CUSTOMER_ADDRESS',
        'id_customer_address' => 'ID_CUSTOMER_ADDRESS',
        'spy_customer_address.id_customer_address' => 'ID_CUSTOMER_ADDRESS',
        'FkCountry' => 'FK_COUNTRY',
        'SpyCustomerAddress.FkCountry' => 'FK_COUNTRY',
        'fkCountry' => 'FK_COUNTRY',
        'spyCustomerAddress.fkCountry' => 'FK_COUNTRY',
        'SpyCustomerAddressTableMap::COL_FK_COUNTRY' => 'FK_COUNTRY',
        'COL_FK_COUNTRY' => 'FK_COUNTRY',
        'fk_country' => 'FK_COUNTRY',
        'spy_customer_address.fk_country' => 'FK_COUNTRY',
        'FkCustomer' => 'FK_CUSTOMER',
        'SpyCustomerAddress.FkCustomer' => 'FK_CUSTOMER',
        'fkCustomer' => 'FK_CUSTOMER',
        'spyCustomerAddress.fkCustomer' => 'FK_CUSTOMER',
        'SpyCustomerAddressTableMap::COL_FK_CUSTOMER' => 'FK_CUSTOMER',
        'COL_FK_CUSTOMER' => 'FK_CUSTOMER',
        'fk_customer' => 'FK_CUSTOMER',
        'spy_customer_address.fk_customer' => 'FK_CUSTOMER',
        'FkRegion' => 'FK_REGION',
        'SpyCustomerAddress.FkRegion' => 'FK_REGION',
        'fkRegion' => 'FK_REGION',
        'spyCustomerAddress.fkRegion' => 'FK_REGION',
        'SpyCustomerAddressTableMap::COL_FK_REGION' => 'FK_REGION',
        'COL_FK_REGION' => 'FK_REGION',
        'fk_region' => 'FK_REGION',
        'spy_customer_address.fk_region' => 'FK_REGION',
        'Address1' => 'ADDRESS1',
        'SpyCustomerAddress.Address1' => 'ADDRESS1',
        'address1' => 'ADDRESS1',
        'spyCustomerAddress.address1' => 'ADDRESS1',
        'SpyCustomerAddressTableMap::COL_ADDRESS1' => 'ADDRESS1',
        'COL_ADDRESS1' => 'ADDRESS1',
        'spy_customer_address.address1' => 'ADDRESS1',
        'Address2' => 'ADDRESS2',
        'SpyCustomerAddress.Address2' => 'ADDRESS2',
        'address2' => 'ADDRESS2',
        'spyCustomerAddress.address2' => 'ADDRESS2',
        'SpyCustomerAddressTableMap::COL_ADDRESS2' => 'ADDRESS2',
        'COL_ADDRESS2' => 'ADDRESS2',
        'spy_customer_address.address2' => 'ADDRESS2',
        'Address3' => 'ADDRESS3',
        'SpyCustomerAddress.Address3' => 'ADDRESS3',
        'address3' => 'ADDRESS3',
        'spyCustomerAddress.address3' => 'ADDRESS3',
        'SpyCustomerAddressTableMap::COL_ADDRESS3' => 'ADDRESS3',
        'COL_ADDRESS3' => 'ADDRESS3',
        'spy_customer_address.address3' => 'ADDRESS3',
        'AnonymizedAt' => 'ANONYMIZED_AT',
        'SpyCustomerAddress.AnonymizedAt' => 'ANONYMIZED_AT',
        'anonymizedAt' => 'ANONYMIZED_AT',
        'spyCustomerAddress.anonymizedAt' => 'ANONYMIZED_AT',
        'SpyCustomerAddressTableMap::COL_ANONYMIZED_AT' => 'ANONYMIZED_AT',
        'COL_ANONYMIZED_AT' => 'ANONYMIZED_AT',
        'anonymized_at' => 'ANONYMIZED_AT',
        'spy_customer_address.anonymized_at' => 'ANONYMIZED_AT',
        'City' => 'CITY',
        'SpyCustomerAddress.City' => 'CITY',
        'city' => 'CITY',
        'spyCustomerAddress.city' => 'CITY',
        'SpyCustomerAddressTableMap::COL_CITY' => 'CITY',
        'COL_CITY' => 'CITY',
        'spy_customer_address.city' => 'CITY',
        'Comment' => 'COMMENT',
        'SpyCustomerAddress.Comment' => 'COMMENT',
        'comment' => 'COMMENT',
        'spyCustomerAddress.comment' => 'COMMENT',
        'SpyCustomerAddressTableMap::COL_COMMENT' => 'COMMENT',
        'COL_COMMENT' => 'COMMENT',
        'spy_customer_address.comment' => 'COMMENT',
        'Company' => 'COMPANY',
        'SpyCustomerAddress.Company' => 'COMPANY',
        'company' => 'COMPANY',
        'spyCustomerAddress.company' => 'COMPANY',
        'SpyCustomerAddressTableMap::COL_COMPANY' => 'COMPANY',
        'COL_COMPANY' => 'COMPANY',
        'spy_customer_address.company' => 'COMPANY',
        'DeletedAt' => 'DELETED_AT',
        'SpyCustomerAddress.DeletedAt' => 'DELETED_AT',
        'deletedAt' => 'DELETED_AT',
        'spyCustomerAddress.deletedAt' => 'DELETED_AT',
        'SpyCustomerAddressTableMap::COL_DELETED_AT' => 'DELETED_AT',
        'COL_DELETED_AT' => 'DELETED_AT',
        'deleted_at' => 'DELETED_AT',
        'spy_customer_address.deleted_at' => 'DELETED_AT',
        'FirstName' => 'FIRST_NAME',
        'SpyCustomerAddress.FirstName' => 'FIRST_NAME',
        'firstName' => 'FIRST_NAME',
        'spyCustomerAddress.firstName' => 'FIRST_NAME',
        'SpyCustomerAddressTableMap::COL_FIRST_NAME' => 'FIRST_NAME',
        'COL_FIRST_NAME' => 'FIRST_NAME',
        'first_name' => 'FIRST_NAME',
        'spy_customer_address.first_name' => 'FIRST_NAME',
        'LastName' => 'LAST_NAME',
        'SpyCustomerAddress.LastName' => 'LAST_NAME',
        'lastName' => 'LAST_NAME',
        'spyCustomerAddress.lastName' => 'LAST_NAME',
        'SpyCustomerAddressTableMap::COL_LAST_NAME' => 'LAST_NAME',
        'COL_LAST_NAME' => 'LAST_NAME',
        'last_name' => 'LAST_NAME',
        'spy_customer_address.last_name' => 'LAST_NAME',
        'Phone' => 'PHONE',
        'SpyCustomerAddress.Phone' => 'PHONE',
        'phone' => 'PHONE',
        'spyCustomerAddress.phone' => 'PHONE',
        'SpyCustomerAddressTableMap::COL_PHONE' => 'PHONE',
        'COL_PHONE' => 'PHONE',
        'spy_customer_address.phone' => 'PHONE',
        'Salutation' => 'SALUTATION',
        'SpyCustomerAddress.Salutation' => 'SALUTATION',
        'salutation' => 'SALUTATION',
        'spyCustomerAddress.salutation' => 'SALUTATION',
        'SpyCustomerAddressTableMap::COL_SALUTATION' => 'SALUTATION',
        'COL_SALUTATION' => 'SALUTATION',
        'spy_customer_address.salutation' => 'SALUTATION',
        'ZipCode' => 'ZIP_CODE',
        'SpyCustomerAddress.ZipCode' => 'ZIP_CODE',
        'zipCode' => 'ZIP_CODE',
        'spyCustomerAddress.zipCode' => 'ZIP_CODE',
        'SpyCustomerAddressTableMap::COL_ZIP_CODE' => 'ZIP_CODE',
        'COL_ZIP_CODE' => 'ZIP_CODE',
        'zip_code' => 'ZIP_CODE',
        'spy_customer_address.zip_code' => 'ZIP_CODE',
        'CreatedAt' => 'CREATED_AT',
        'SpyCustomerAddress.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyCustomerAddress.createdAt' => 'CREATED_AT',
        'SpyCustomerAddressTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_customer_address.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyCustomerAddress.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyCustomerAddress.updatedAt' => 'UPDATED_AT',
        'SpyCustomerAddressTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_customer_address.updated_at' => 'UPDATED_AT',
    ];

    /**
     * The enumerated values for this table
     *
     * @var array<string, array<string>>
     */
    protected static $enumValueSets = [
                SpyCustomerAddressTableMap::COL_SALUTATION => [
                            self::COL_SALUTATION_MR,
            self::COL_SALUTATION_MRS,
            self::COL_SALUTATION_DR,
            self::COL_SALUTATION_MS,
        ],
    ];

    /**
     * Gets the list of values for all ENUM and SET columns
     * @return array
     */
    public static function getValueSets(): array
    {
      return static::$enumValueSets;
    }

    /**
     * Gets the list of values for an ENUM or SET column
     * @param string $colname
     * @return array list of possible values for the column
     */
    public static function getValueSet(string $colname): array
    {
        $valueSets = self::getValueSets();

        return $valueSets[$colname];
    }

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
        $this->setName('spy_customer_address');
        $this->setPhpName('SpyCustomerAddress');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Customer\\Persistence\\SpyCustomerAddress');
        $this->setPackage('Orm.Zed.Customer.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_customer_address_pk_seq');
        // columns
        $this->addPrimaryKey('id_customer_address', 'IdCustomerAddress', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_country', 'FkCountry', 'INTEGER', 'spy_country', 'id_country', true, null, null);
        $this->addForeignKey('fk_customer', 'FkCustomer', 'INTEGER', 'spy_customer', 'id_customer', true, null, null);
        $this->addForeignKey('fk_region', 'FkRegion', 'INTEGER', 'spy_region', 'id_region', false, null, null);
        $this->addColumn('address1', 'Address1', 'VARCHAR', false, 255, null);
        $this->addColumn('address2', 'Address2', 'VARCHAR', false, 255, null);
        $this->addColumn('address3', 'Address3', 'VARCHAR', false, 255, null);
        $this->addColumn('anonymized_at', 'AnonymizedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('city', 'City', 'VARCHAR', false, 255, null);
        $this->addColumn('comment', 'Comment', 'VARCHAR', false, 255, null);
        $this->addColumn('company', 'Company', 'VARCHAR', false, 255, null);
        $this->addColumn('deleted_at', 'DeletedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', true, 100, null);
        $this->addColumn('last_name', 'LastName', 'VARCHAR', true, 100, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, 255, null);
        $this->addColumn('salutation', 'Salutation', 'ENUM', false, null, null);
        $this->getColumn('salutation')->setValueSet(array (
  0 => 'Mr',
  1 => 'Mrs',
  2 => 'Dr',
  3 => 'Ms',
));
        $this->addColumn('zip_code', 'ZipCode', 'VARCHAR', false, 15, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Customer', '\\Orm\\Zed\\Customer\\Persistence\\SpyCustomer', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_customer',
    1 => ':id_customer',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Region', '\\Orm\\Zed\\Country\\Persistence\\SpyRegion', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_region',
    1 => ':id_region',
  ),
), null, null, null, false);
        $this->addRelation('Country', '\\Orm\\Zed\\Country\\Persistence\\SpyCountry', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_country',
    1 => ':id_country',
  ),
), null, null, null, false);
        $this->addRelation('CustomerBillingAddress', '\\Orm\\Zed\\Customer\\Persistence\\SpyCustomer', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':default_billing_address',
    1 => ':id_customer_address',
  ),
), 'SET NULL', null, 'CustomerBillingAddresses', false);
        $this->addRelation('CustomerShippingAddress', '\\Orm\\Zed\\Customer\\Persistence\\SpyCustomer', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':default_shipping_address',
    1 => ':id_customer_address',
  ),
), 'SET NULL', null, 'CustomerShippingAddresses', false);
    }

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array<string, array> Associative array (name => parameters) of behaviors
     */
    public function getBehaviors(): array
    {
        return [
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false'],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_customer_address     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyCustomerTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerAddress', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerAddress', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerAddress', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerAddress', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerAddress', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerAddress', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCustomerAddress', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCustomerAddressTableMap::CLASS_DEFAULT : SpyCustomerAddressTableMap::OM_CLASS;
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
     * @return array (SpyCustomerAddress object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCustomerAddressTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCustomerAddressTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCustomerAddressTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCustomerAddressTableMap::OM_CLASS;
            /** @var SpyCustomerAddress $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCustomerAddressTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCustomerAddressTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCustomerAddressTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCustomerAddress $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCustomerAddressTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_FK_COUNTRY);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_FK_CUSTOMER);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_FK_REGION);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_ADDRESS1);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_ADDRESS2);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_ADDRESS3);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_ANONYMIZED_AT);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_CITY);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_COMMENT);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_COMPANY);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_DELETED_AT);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_PHONE);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_SALUTATION);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_ZIP_CODE);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyCustomerAddressTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_customer_address');
            $criteria->addSelectColumn($alias . '.fk_country');
            $criteria->addSelectColumn($alias . '.fk_customer');
            $criteria->addSelectColumn($alias . '.fk_region');
            $criteria->addSelectColumn($alias . '.address1');
            $criteria->addSelectColumn($alias . '.address2');
            $criteria->addSelectColumn($alias . '.address3');
            $criteria->addSelectColumn($alias . '.anonymized_at');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.comment');
            $criteria->addSelectColumn($alias . '.company');
            $criteria->addSelectColumn($alias . '.deleted_at');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.last_name');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.salutation');
            $criteria->addSelectColumn($alias . '.zip_code');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
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
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_FK_COUNTRY);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_FK_CUSTOMER);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_FK_REGION);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_ADDRESS1);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_ADDRESS2);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_ADDRESS3);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_ANONYMIZED_AT);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_CITY);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_COMMENT);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_COMPANY);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_DELETED_AT);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_FIRST_NAME);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_LAST_NAME);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_PHONE);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_SALUTATION);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_ZIP_CODE);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyCustomerAddressTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_customer_address');
            $criteria->removeSelectColumn($alias . '.fk_country');
            $criteria->removeSelectColumn($alias . '.fk_customer');
            $criteria->removeSelectColumn($alias . '.fk_region');
            $criteria->removeSelectColumn($alias . '.address1');
            $criteria->removeSelectColumn($alias . '.address2');
            $criteria->removeSelectColumn($alias . '.address3');
            $criteria->removeSelectColumn($alias . '.anonymized_at');
            $criteria->removeSelectColumn($alias . '.city');
            $criteria->removeSelectColumn($alias . '.comment');
            $criteria->removeSelectColumn($alias . '.company');
            $criteria->removeSelectColumn($alias . '.deleted_at');
            $criteria->removeSelectColumn($alias . '.first_name');
            $criteria->removeSelectColumn($alias . '.last_name');
            $criteria->removeSelectColumn($alias . '.phone');
            $criteria->removeSelectColumn($alias . '.salutation');
            $criteria->removeSelectColumn($alias . '.zip_code');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCustomerAddressTableMap::DATABASE_NAME)->getTable(SpyCustomerAddressTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCustomerAddress or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCustomerAddress object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerAddressTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Customer\Persistence\SpyCustomerAddress) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCustomerAddressTableMap::DATABASE_NAME);
            $criteria->add(SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS, (array) $values, Criteria::IN);
        }

        $query = SpyCustomerAddressQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCustomerAddressTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCustomerAddressTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_customer_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCustomerAddressQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCustomerAddress or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCustomerAddress object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerAddressTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCustomerAddress object
        }

        if ($criteria->containsKey(SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS) && $criteria->keyContainsValue(SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCustomerAddressTableMap::COL_ID_CUSTOMER_ADDRESS.')');
        }


        // Set the correct dbName
        $query = SpyCustomerAddressQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
