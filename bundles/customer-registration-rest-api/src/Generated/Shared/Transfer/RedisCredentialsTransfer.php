<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Generated\Shared\Transfer;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

/**
 * !!! THIS FILE IS AUTO-GENERATED, EVERY CHANGE WILL BE LOST WITH THE NEXT RUN OF TRANSFER GENERATOR
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 */
class RedisCredentialsTransfer extends AbstractTransfer
{
    /**
     * @deprecated Use scheme property instead
     */
    public const PROTOCOL = 'protocol';

    /**
     * @var string
     */
    public const SCHEME = 'scheme';

    /**
     * @var string
     */
    public const HOST = 'host';

    /**
     * @var string
     */
    public const PORT = 'port';

    /**
     * @var string
     */
    public const PASSWORD = 'password';

    /**
     * @var string
     */
    public const DATABASE = 'database';

    /**
     * @var string
     */
    public const IS_PERSISTENT = 'isPersistent';

    /**
     * @var string|null
     */
    protected $protocol;

    /**
     * @var string|null
     */
    protected $scheme;

    /**
     * @var string|null
     */
    protected $host;

    /**
     * @var string|null
     */
    protected $port;

    /**
     * @var string|null
     */
    protected $password;

    /**
     * @var int|null
     */
    protected $database;

    /**
     * @var bool|null
     */
    protected $isPersistent;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'protocol' => 'protocol',
        'Protocol' => 'protocol',
        'scheme' => 'scheme',
        'Scheme' => 'scheme',
        'host' => 'host',
        'Host' => 'host',
        'port' => 'port',
        'Port' => 'port',
        'password' => 'password',
        'Password' => 'password',
        'database' => 'database',
        'Database' => 'database',
        'is_persistent' => 'isPersistent',
        'isPersistent' => 'isPersistent',
        'IsPersistent' => 'isPersistent',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::PROTOCOL => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'protocol',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::SCHEME => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'scheme',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::HOST => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'host',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::PORT => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'port',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::PASSWORD => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'password',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::DATABASE => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'database',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::IS_PERSISTENT => [
            'type' => 'bool',
            'type_shim' => null,
            'name_underscore' => 'is_persistent',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
    ];

    /**
     * @module Redis
     *
     * @deprecated Use scheme property instead
     *
     * @param string|null $protocol
     *
     * @return $this
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
        $this->modifiedProperties[self::PROTOCOL] = true;

        return $this;
    }

    /**
     * @module Redis
     *
     * @deprecated Use scheme property instead
     *
     * @return string|null
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @module Redis
     *
     * @deprecated Use scheme property instead
     *
     * @param string|null $protocol
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setProtocolOrFail($protocol)
    {
        if ($protocol === null) {
            $this->throwNullValueException(static::PROTOCOL);
        }

        return $this->setProtocol($protocol);
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @deprecated Use scheme property instead
     *
     * @return string
     */
    public function getProtocolOrFail()
    {
        if ($this->protocol === null) {
            $this->throwNullValueException(static::PROTOCOL);
        }

        return $this->protocol;
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @deprecated Use scheme property instead
     *
     * @return $this
     */
    public function requireProtocol()
    {
        $this->assertPropertyIsSet(self::PROTOCOL);

        return $this;
    }

    /**
     * @module Redis
     *
     * @param string|null $scheme
     *
     * @return $this
     */
    public function setScheme($scheme)
    {
        $this->scheme = $scheme;
        $this->modifiedProperties[self::SCHEME] = true;

        return $this;
    }

    /**
     * @module Redis
     *
     * @return string|null
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * @module Redis
     *
     * @param string|null $scheme
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setSchemeOrFail($scheme)
    {
        if ($scheme === null) {
            $this->throwNullValueException(static::SCHEME);
        }

        return $this->setScheme($scheme);
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getSchemeOrFail()
    {
        if ($this->scheme === null) {
            $this->throwNullValueException(static::SCHEME);
        }

        return $this->scheme;
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireScheme()
    {
        $this->assertPropertyIsSet(self::SCHEME);

        return $this;
    }

    /**
     * @module Redis
     *
     * @param string|null $host
     *
     * @return $this
     */
    public function setHost($host)
    {
        $this->host = $host;
        $this->modifiedProperties[self::HOST] = true;

        return $this;
    }

    /**
     * @module Redis
     *
     * @return string|null
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @module Redis
     *
     * @param string|null $host
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setHostOrFail($host)
    {
        if ($host === null) {
            $this->throwNullValueException(static::HOST);
        }

        return $this->setHost($host);
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getHostOrFail()
    {
        if ($this->host === null) {
            $this->throwNullValueException(static::HOST);
        }

        return $this->host;
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireHost()
    {
        $this->assertPropertyIsSet(self::HOST);

        return $this;
    }

    /**
     * @module Redis
     *
     * @param string|null $port
     *
     * @return $this
     */
    public function setPort($port)
    {
        $this->port = $port;
        $this->modifiedProperties[self::PORT] = true;

        return $this;
    }

    /**
     * @module Redis
     *
     * @return string|null
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @module Redis
     *
     * @param string|null $port
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setPortOrFail($port)
    {
        if ($port === null) {
            $this->throwNullValueException(static::PORT);
        }

        return $this->setPort($port);
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getPortOrFail()
    {
        if ($this->port === null) {
            $this->throwNullValueException(static::PORT);
        }

        return $this->port;
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requirePort()
    {
        $this->assertPropertyIsSet(self::PORT);

        return $this;
    }

    /**
     * @module Redis
     *
     * @param string|null $password
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        $this->modifiedProperties[self::PASSWORD] = true;

        return $this;
    }

    /**
     * @module Redis
     *
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @module Redis
     *
     * @param string|null $password
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setPasswordOrFail($password)
    {
        if ($password === null) {
            $this->throwNullValueException(static::PASSWORD);
        }

        return $this->setPassword($password);
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getPasswordOrFail()
    {
        if ($this->password === null) {
            $this->throwNullValueException(static::PASSWORD);
        }

        return $this->password;
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requirePassword()
    {
        $this->assertPropertyIsSet(self::PASSWORD);

        return $this;
    }

    /**
     * @module Redis
     *
     * @param int|null $database
     *
     * @return $this
     */
    public function setDatabase($database)
    {
        $this->database = $database;
        $this->modifiedProperties[self::DATABASE] = true;

        return $this;
    }

    /**
     * @module Redis
     *
     * @return int|null
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * @module Redis
     *
     * @param int|null $database
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setDatabaseOrFail($database)
    {
        if ($database === null) {
            $this->throwNullValueException(static::DATABASE);
        }

        return $this->setDatabase($database);
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getDatabaseOrFail()
    {
        if ($this->database === null) {
            $this->throwNullValueException(static::DATABASE);
        }

        return $this->database;
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireDatabase()
    {
        $this->assertPropertyIsSet(self::DATABASE);

        return $this;
    }

    /**
     * @module Redis
     *
     * @param bool|null $isPersistent
     *
     * @return $this
     */
    public function setIsPersistent($isPersistent)
    {
        $this->isPersistent = $isPersistent;
        $this->modifiedProperties[self::IS_PERSISTENT] = true;

        return $this;
    }

    /**
     * @module Redis
     *
     * @return bool|null
     */
    public function getIsPersistent()
    {
        return $this->isPersistent;
    }

    /**
     * @module Redis
     *
     * @param bool|null $isPersistent
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setIsPersistentOrFail($isPersistent)
    {
        if ($isPersistent === null) {
            $this->throwNullValueException(static::IS_PERSISTENT);
        }

        return $this->setIsPersistent($isPersistent);
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return bool
     */
    public function getIsPersistentOrFail()
    {
        if ($this->isPersistent === null) {
            $this->throwNullValueException(static::IS_PERSISTENT);
        }

        return $this->isPersistent;
    }

    /**
     * @module Redis
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireIsPersistent()
    {
        $this->assertPropertyIsSet(self::IS_PERSISTENT);

        return $this;
    }

    /**
     * @param array<string, mixed> $data
     * @param bool $ignoreMissingProperty
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function fromArray(array $data, $ignoreMissingProperty = false)
    {
        foreach ($data as $property => $value) {
            $normalizedPropertyName = $this->transferPropertyNameMap[$property] ?? null;

            switch ($normalizedPropertyName) {
                case 'protocol':
                case 'scheme':
                case 'host':
                case 'port':
                case 'password':
                case 'database':
                case 'isPersistent':
                    $this->$normalizedPropertyName = $value;
                    $this->modifiedProperties[$normalizedPropertyName] = true;

                    break;
                default:
                    if (!$ignoreMissingProperty) {
                        throw new \InvalidArgumentException(sprintf('Missing property `%s` in `%s`', $property, static::class));
                    }
            }
        }

        return $this;
    }

    /**
     * @param bool $isRecursive
     * @param bool $camelCasedKeys
     *
     * @return array<string, mixed>
     */
    public function modifiedToArray($isRecursive = true, $camelCasedKeys = false): array
    {
        if ($isRecursive && !$camelCasedKeys) {
            return $this->modifiedToArrayRecursiveNotCamelCased();
        }
        if ($isRecursive && $camelCasedKeys) {
            return $this->modifiedToArrayRecursiveCamelCased();
        }
        if (!$isRecursive && $camelCasedKeys) {
            return $this->modifiedToArrayNotRecursiveCamelCased();
        }
        if (!$isRecursive && !$camelCasedKeys) {
            return $this->modifiedToArrayNotRecursiveNotCamelCased();
        }
    }

    /**
     * @param bool $isRecursive
     * @param bool $camelCasedKeys
     *
     * @return array<string, mixed>
     */
    public function toArray($isRecursive = true, $camelCasedKeys = false): array
    {
        if ($isRecursive && !$camelCasedKeys) {
            return $this->toArrayRecursiveNotCamelCased();
        }
        if ($isRecursive && $camelCasedKeys) {
            return $this->toArrayRecursiveCamelCased();
        }
        if (!$isRecursive && !$camelCasedKeys) {
            return $this->toArrayNotRecursiveNotCamelCased();
        }
        if (!$isRecursive && $camelCasedKeys) {
            return $this->toArrayNotRecursiveCamelCased();
        }
    }

    /**
     * @param array<string, mixed>|\ArrayObject<string, mixed> $value
     * @param bool $isRecursive
     * @param bool $camelCasedKeys
     *
     * @return array<string, mixed>
     */
    protected function addValuesToCollectionModified($value, $isRecursive, $camelCasedKeys): array
    {
        $result = [];
        foreach ($value as $elementKey => $arrayElement) {
            if ($arrayElement instanceof AbstractTransfer) {
                $result[$elementKey] = $arrayElement->modifiedToArray($isRecursive, $camelCasedKeys);

                continue;
            }
            $result[$elementKey] = $arrayElement;
        }

        return $result;
    }

    /**
     * @param array<string, mixed>|\ArrayObject<string, mixed> $value
     * @param bool $isRecursive
     * @param bool $camelCasedKeys
     *
     * @return array<string, mixed>
     */
    protected function addValuesToCollection($value, $isRecursive, $camelCasedKeys): array
    {
        $result = [];
        foreach ($value as $elementKey => $arrayElement) {
            if ($arrayElement instanceof AbstractTransfer) {
                $result[$elementKey] = $arrayElement->toArray($isRecursive, $camelCasedKeys);

                continue;
            }
            $result[$elementKey] = $arrayElement;
        }

        return $result;
    }

    /**
     * @return array<string, mixed>
     */
    public function modifiedToArrayRecursiveCamelCased(): array
    {
        $values = [];
        foreach ($this->modifiedProperties as $property => $_) {
            $value = $this->$property;

            $arrayKey = $property;

            if ($value instanceof AbstractTransfer) {
                $values[$arrayKey] = $value->modifiedToArray(true, true);

                continue;
            }
            switch ($property) {
                case 'protocol':
                case 'scheme':
                case 'host':
                case 'port':
                case 'password':
                case 'database':
                case 'isPersistent':
                    $values[$arrayKey] = $value;

                    break;
            }
        }

        return $values;
    }

    /**
     * @return array<string, mixed>
     */
    public function modifiedToArrayRecursiveNotCamelCased(): array
    {
        $values = [];
        foreach ($this->modifiedProperties as $property => $_) {
            $value = $this->$property;

            $arrayKey = $this->transferMetadata[$property]['name_underscore'];

            if ($value instanceof AbstractTransfer) {
                $values[$arrayKey] = $value->modifiedToArray(true, false);

                continue;
            }
            switch ($property) {
                case 'protocol':
                case 'scheme':
                case 'host':
                case 'port':
                case 'password':
                case 'database':
                case 'isPersistent':
                    $values[$arrayKey] = $value;

                    break;
            }
        }

        return $values;
    }

    /**
     * @return array<string, mixed>
     */
    public function modifiedToArrayNotRecursiveNotCamelCased(): array
    {
        $values = [];
        foreach ($this->modifiedProperties as $property => $_) {
            $value = $this->$property;

            $arrayKey = $this->transferMetadata[$property]['name_underscore'];

            $values[$arrayKey] = $value;
        }

        return $values;
    }

    /**
     * @return array<string, mixed>
     */
    public function modifiedToArrayNotRecursiveCamelCased(): array
    {
        $values = [];
        foreach ($this->modifiedProperties as $property => $_) {
            $value = $this->$property;

            $arrayKey = $property;

            $values[$arrayKey] = $value;
        }

        return $values;
    }

    /**
     * @return void
     */
    protected function initCollectionProperties(): void
    {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveCamelCased(): array
    {
        return [
            'protocol' => $this->protocol,
            'scheme' => $this->scheme,
            'host' => $this->host,
            'port' => $this->port,
            'password' => $this->password,
            'database' => $this->database,
            'isPersistent' => $this->isPersistent,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'protocol' => $this->protocol,
            'scheme' => $this->scheme,
            'host' => $this->host,
            'port' => $this->port,
            'password' => $this->password,
            'database' => $this->database,
            'is_persistent' => $this->isPersistent,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'protocol' => $this->protocol instanceof AbstractTransfer ? $this->protocol->toArray(true, false) : $this->protocol,
            'scheme' => $this->scheme instanceof AbstractTransfer ? $this->scheme->toArray(true, false) : $this->scheme,
            'host' => $this->host instanceof AbstractTransfer ? $this->host->toArray(true, false) : $this->host,
            'port' => $this->port instanceof AbstractTransfer ? $this->port->toArray(true, false) : $this->port,
            'password' => $this->password instanceof AbstractTransfer ? $this->password->toArray(true, false) : $this->password,
            'database' => $this->database instanceof AbstractTransfer ? $this->database->toArray(true, false) : $this->database,
            'is_persistent' => $this->isPersistent instanceof AbstractTransfer ? $this->isPersistent->toArray(true, false) : $this->isPersistent,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'protocol' => $this->protocol instanceof AbstractTransfer ? $this->protocol->toArray(true, true) : $this->protocol,
            'scheme' => $this->scheme instanceof AbstractTransfer ? $this->scheme->toArray(true, true) : $this->scheme,
            'host' => $this->host instanceof AbstractTransfer ? $this->host->toArray(true, true) : $this->host,
            'port' => $this->port instanceof AbstractTransfer ? $this->port->toArray(true, true) : $this->port,
            'password' => $this->password instanceof AbstractTransfer ? $this->password->toArray(true, true) : $this->password,
            'database' => $this->database instanceof AbstractTransfer ? $this->database->toArray(true, true) : $this->database,
            'isPersistent' => $this->isPersistent instanceof AbstractTransfer ? $this->isPersistent->toArray(true, true) : $this->isPersistent,
        ];
    }
}
