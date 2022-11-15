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
class QueueTaskResponseTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const MESSAGE = 'message';

    /**
     * @var string
     */
    public const RECEIVED_MESSAGE_COUNT = 'receivedMessageCount';

    /**
     * @var string
     */
    public const PROCESSED_MESSAGE_COUNT = 'processedMessageCount';

    /**
     * @var string
     */
    public const IS_SUCCESFUL = 'isSuccesful';

    /**
     * @var string|null
     */
    protected $message;

    /**
     * @var int|null
     */
    protected $receivedMessageCount;

    /**
     * @var int|null
     */
    protected $processedMessageCount;

    /**
     * @var bool|null
     */
    protected $isSuccesful;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'message' => 'message',
        'Message' => 'message',
        'received_message_count' => 'receivedMessageCount',
        'receivedMessageCount' => 'receivedMessageCount',
        'ReceivedMessageCount' => 'receivedMessageCount',
        'processed_message_count' => 'processedMessageCount',
        'processedMessageCount' => 'processedMessageCount',
        'ProcessedMessageCount' => 'processedMessageCount',
        'is_succesful' => 'isSuccesful',
        'isSuccesful' => 'isSuccesful',
        'IsSuccesful' => 'isSuccesful',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::MESSAGE => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'message',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::RECEIVED_MESSAGE_COUNT => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'received_message_count',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::PROCESSED_MESSAGE_COUNT => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'processed_message_count',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::IS_SUCCESFUL => [
            'type' => 'bool',
            'type_shim' => null,
            'name_underscore' => 'is_succesful',
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
     * @module Queue
     *
     * @param string|null $message
     *
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        $this->modifiedProperties[self::MESSAGE] = true;

        return $this;
    }

    /**
     * @module Queue
     *
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @module Queue
     *
     * @param string|null $message
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setMessageOrFail($message)
    {
        if ($message === null) {
            $this->throwNullValueException(static::MESSAGE);
        }

        return $this->setMessage($message);
    }

    /**
     * @module Queue
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getMessageOrFail()
    {
        if ($this->message === null) {
            $this->throwNullValueException(static::MESSAGE);
        }

        return $this->message;
    }

    /**
     * @module Queue
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireMessage()
    {
        $this->assertPropertyIsSet(self::MESSAGE);

        return $this;
    }

    /**
     * @module Queue
     *
     * @param int|null $receivedMessageCount
     *
     * @return $this
     */
    public function setReceivedMessageCount($receivedMessageCount)
    {
        $this->receivedMessageCount = $receivedMessageCount;
        $this->modifiedProperties[self::RECEIVED_MESSAGE_COUNT] = true;

        return $this;
    }

    /**
     * @module Queue
     *
     * @return int|null
     */
    public function getReceivedMessageCount()
    {
        return $this->receivedMessageCount;
    }

    /**
     * @module Queue
     *
     * @param int|null $receivedMessageCount
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setReceivedMessageCountOrFail($receivedMessageCount)
    {
        if ($receivedMessageCount === null) {
            $this->throwNullValueException(static::RECEIVED_MESSAGE_COUNT);
        }

        return $this->setReceivedMessageCount($receivedMessageCount);
    }

    /**
     * @module Queue
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getReceivedMessageCountOrFail()
    {
        if ($this->receivedMessageCount === null) {
            $this->throwNullValueException(static::RECEIVED_MESSAGE_COUNT);
        }

        return $this->receivedMessageCount;
    }

    /**
     * @module Queue
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireReceivedMessageCount()
    {
        $this->assertPropertyIsSet(self::RECEIVED_MESSAGE_COUNT);

        return $this;
    }

    /**
     * @module Queue
     *
     * @param int|null $processedMessageCount
     *
     * @return $this
     */
    public function setProcessedMessageCount($processedMessageCount)
    {
        $this->processedMessageCount = $processedMessageCount;
        $this->modifiedProperties[self::PROCESSED_MESSAGE_COUNT] = true;

        return $this;
    }

    /**
     * @module Queue
     *
     * @return int|null
     */
    public function getProcessedMessageCount()
    {
        return $this->processedMessageCount;
    }

    /**
     * @module Queue
     *
     * @param int|null $processedMessageCount
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setProcessedMessageCountOrFail($processedMessageCount)
    {
        if ($processedMessageCount === null) {
            $this->throwNullValueException(static::PROCESSED_MESSAGE_COUNT);
        }

        return $this->setProcessedMessageCount($processedMessageCount);
    }

    /**
     * @module Queue
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getProcessedMessageCountOrFail()
    {
        if ($this->processedMessageCount === null) {
            $this->throwNullValueException(static::PROCESSED_MESSAGE_COUNT);
        }

        return $this->processedMessageCount;
    }

    /**
     * @module Queue
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireProcessedMessageCount()
    {
        $this->assertPropertyIsSet(self::PROCESSED_MESSAGE_COUNT);

        return $this;
    }

    /**
     * @module Queue
     *
     * @param bool|null $isSuccesful
     *
     * @return $this
     */
    public function setIsSuccesful($isSuccesful)
    {
        $this->isSuccesful = $isSuccesful;
        $this->modifiedProperties[self::IS_SUCCESFUL] = true;

        return $this;
    }

    /**
     * @module Queue
     *
     * @return bool|null
     */
    public function getIsSuccesful()
    {
        return $this->isSuccesful;
    }

    /**
     * @module Queue
     *
     * @param bool|null $isSuccesful
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setIsSuccesfulOrFail($isSuccesful)
    {
        if ($isSuccesful === null) {
            $this->throwNullValueException(static::IS_SUCCESFUL);
        }

        return $this->setIsSuccesful($isSuccesful);
    }

    /**
     * @module Queue
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return bool
     */
    public function getIsSuccesfulOrFail()
    {
        if ($this->isSuccesful === null) {
            $this->throwNullValueException(static::IS_SUCCESFUL);
        }

        return $this->isSuccesful;
    }

    /**
     * @module Queue
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireIsSuccesful()
    {
        $this->assertPropertyIsSet(self::IS_SUCCESFUL);

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
                case 'message':
                case 'receivedMessageCount':
                case 'processedMessageCount':
                case 'isSuccesful':
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
                case 'message':
                case 'receivedMessageCount':
                case 'processedMessageCount':
                case 'isSuccesful':
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
                case 'message':
                case 'receivedMessageCount':
                case 'processedMessageCount':
                case 'isSuccesful':
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
            'message' => $this->message,
            'receivedMessageCount' => $this->receivedMessageCount,
            'processedMessageCount' => $this->processedMessageCount,
            'isSuccesful' => $this->isSuccesful,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'message' => $this->message,
            'received_message_count' => $this->receivedMessageCount,
            'processed_message_count' => $this->processedMessageCount,
            'is_succesful' => $this->isSuccesful,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'message' => $this->message instanceof AbstractTransfer ? $this->message->toArray(true, false) : $this->message,
            'received_message_count' => $this->receivedMessageCount instanceof AbstractTransfer ? $this->receivedMessageCount->toArray(true, false) : $this->receivedMessageCount,
            'processed_message_count' => $this->processedMessageCount instanceof AbstractTransfer ? $this->processedMessageCount->toArray(true, false) : $this->processedMessageCount,
            'is_succesful' => $this->isSuccesful instanceof AbstractTransfer ? $this->isSuccesful->toArray(true, false) : $this->isSuccesful,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'message' => $this->message instanceof AbstractTransfer ? $this->message->toArray(true, true) : $this->message,
            'receivedMessageCount' => $this->receivedMessageCount instanceof AbstractTransfer ? $this->receivedMessageCount->toArray(true, true) : $this->receivedMessageCount,
            'processedMessageCount' => $this->processedMessageCount instanceof AbstractTransfer ? $this->processedMessageCount->toArray(true, true) : $this->processedMessageCount,
            'isSuccesful' => $this->isSuccesful instanceof AbstractTransfer ? $this->isSuccesful->toArray(true, true) : $this->isSuccesful,
        ];
    }
}
