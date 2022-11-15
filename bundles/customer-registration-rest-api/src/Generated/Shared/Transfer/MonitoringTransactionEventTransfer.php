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
class MonitoringTransactionEventTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const COMMAND_NAME = 'commandName';

    /**
     * @var string
     */
    public const ARGUMENTS = 'arguments';

    /**
     * @var string
     */
    public const TRANSACTION_NAME_PREFIX = 'transactionNamePrefix';

    /**
     * @var string|null
     */
    protected $commandName;

    /**
     * @var array
     */
    protected $arguments = [];

    /**
     * @var string|null
     */
    protected $transactionNamePrefix;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'command_name' => 'commandName',
        'commandName' => 'commandName',
        'CommandName' => 'commandName',
        'arguments' => 'arguments',
        'Arguments' => 'arguments',
        'transaction_name_prefix' => 'transactionNamePrefix',
        'transactionNamePrefix' => 'transactionNamePrefix',
        'TransactionNamePrefix' => 'transactionNamePrefix',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::COMMAND_NAME => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'command_name',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::ARGUMENTS => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'arguments',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::TRANSACTION_NAME_PREFIX => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'transaction_name_prefix',
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
     * @module Monitoring
     *
     * @param string|null $commandName
     *
     * @return $this
     */
    public function setCommandName($commandName)
    {
        $this->commandName = $commandName;
        $this->modifiedProperties[self::COMMAND_NAME] = true;

        return $this;
    }

    /**
     * @module Monitoring
     *
     * @return string|null
     */
    public function getCommandName()
    {
        return $this->commandName;
    }

    /**
     * @module Monitoring
     *
     * @param string|null $commandName
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setCommandNameOrFail($commandName)
    {
        if ($commandName === null) {
            $this->throwNullValueException(static::COMMAND_NAME);
        }

        return $this->setCommandName($commandName);
    }

    /**
     * @module Monitoring
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getCommandNameOrFail()
    {
        if ($this->commandName === null) {
            $this->throwNullValueException(static::COMMAND_NAME);
        }

        return $this->commandName;
    }

    /**
     * @module Monitoring
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireCommandName()
    {
        $this->assertPropertyIsSet(self::COMMAND_NAME);

        return $this;
    }

    /**
     * @module Monitoring
     *
     * @param array|null $arguments
     *
     * @return $this
     */
    public function setArguments(array $arguments = null)
    {
        if ($arguments === null) {
            $arguments = [];
        }

        $this->arguments = $arguments;
        $this->modifiedProperties[self::ARGUMENTS] = true;

        return $this;
    }

    /**
     * @module Monitoring
     *
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @module Monitoring
     *
     * @param mixed $argument
     *
     * @return $this
     */
    public function addArgument($argument)
    {
        $this->arguments[] = $argument;
        $this->modifiedProperties[self::ARGUMENTS] = true;

        return $this;
    }

    /**
     * @module Monitoring
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireArguments()
    {
        $this->assertPropertyIsSet(self::ARGUMENTS);

        return $this;
    }

    /**
     * @module Monitoring
     *
     * @param string|null $transactionNamePrefix
     *
     * @return $this
     */
    public function setTransactionNamePrefix($transactionNamePrefix)
    {
        $this->transactionNamePrefix = $transactionNamePrefix;
        $this->modifiedProperties[self::TRANSACTION_NAME_PREFIX] = true;

        return $this;
    }

    /**
     * @module Monitoring
     *
     * @return string|null
     */
    public function getTransactionNamePrefix()
    {
        return $this->transactionNamePrefix;
    }

    /**
     * @module Monitoring
     *
     * @param string|null $transactionNamePrefix
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setTransactionNamePrefixOrFail($transactionNamePrefix)
    {
        if ($transactionNamePrefix === null) {
            $this->throwNullValueException(static::TRANSACTION_NAME_PREFIX);
        }

        return $this->setTransactionNamePrefix($transactionNamePrefix);
    }

    /**
     * @module Monitoring
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getTransactionNamePrefixOrFail()
    {
        if ($this->transactionNamePrefix === null) {
            $this->throwNullValueException(static::TRANSACTION_NAME_PREFIX);
        }

        return $this->transactionNamePrefix;
    }

    /**
     * @module Monitoring
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireTransactionNamePrefix()
    {
        $this->assertPropertyIsSet(self::TRANSACTION_NAME_PREFIX);

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
                case 'commandName':
                case 'arguments':
                case 'transactionNamePrefix':
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
                case 'commandName':
                case 'arguments':
                case 'transactionNamePrefix':
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
                case 'commandName':
                case 'arguments':
                case 'transactionNamePrefix':
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
            'commandName' => $this->commandName,
            'arguments' => $this->arguments,
            'transactionNamePrefix' => $this->transactionNamePrefix,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'command_name' => $this->commandName,
            'arguments' => $this->arguments,
            'transaction_name_prefix' => $this->transactionNamePrefix,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'command_name' => $this->commandName instanceof AbstractTransfer ? $this->commandName->toArray(true, false) : $this->commandName,
            'arguments' => $this->arguments instanceof AbstractTransfer ? $this->arguments->toArray(true, false) : $this->arguments,
            'transaction_name_prefix' => $this->transactionNamePrefix instanceof AbstractTransfer ? $this->transactionNamePrefix->toArray(true, false) : $this->transactionNamePrefix,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'commandName' => $this->commandName instanceof AbstractTransfer ? $this->commandName->toArray(true, true) : $this->commandName,
            'arguments' => $this->arguments instanceof AbstractTransfer ? $this->arguments->toArray(true, true) : $this->arguments,
            'transactionNamePrefix' => $this->transactionNamePrefix instanceof AbstractTransfer ? $this->transactionNamePrefix->toArray(true, true) : $this->transactionNamePrefix,
        ];
    }
}
