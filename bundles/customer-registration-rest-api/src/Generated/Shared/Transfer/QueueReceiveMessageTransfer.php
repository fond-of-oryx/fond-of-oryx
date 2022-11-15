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
class QueueReceiveMessageTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const QUEUE_NAME = 'queueName';

    /**
     * @var string
     */
    public const QUEUE_MESSAGE = 'queueMessage';

    /**
     * @var string
     */
    public const ACKNOWLEDGE = 'acknowledge';

    /**
     * @var string
     */
    public const REJECT = 'reject';

    /**
     * @var string
     */
    public const HAS_ERROR = 'hasError';

    /**
     * @var string
     */
    public const DELIVERY_TAG = 'deliveryTag';

    /**
     * @var string
     */
    public const ROUTING_KEY = 'routingKey';

    /**
     * @var string|null
     */
    protected $queueName;

    /**
     * @var \Generated\Shared\Transfer\QueueSendMessageTransfer|null
     */
    protected $queueMessage;

    /**
     * @var bool|null
     */
    protected $acknowledge;

    /**
     * @var bool|null
     */
    protected $reject;

    /**
     * @var bool|null
     */
    protected $hasError;

    /**
     * @var string|null
     */
    protected $deliveryTag;

    /**
     * @var string|null
     */
    protected $routingKey;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'queue_name' => 'queueName',
        'queueName' => 'queueName',
        'QueueName' => 'queueName',
        'queue_message' => 'queueMessage',
        'queueMessage' => 'queueMessage',
        'QueueMessage' => 'queueMessage',
        'acknowledge' => 'acknowledge',
        'Acknowledge' => 'acknowledge',
        'reject' => 'reject',
        'Reject' => 'reject',
        'has_error' => 'hasError',
        'hasError' => 'hasError',
        'HasError' => 'hasError',
        'delivery_tag' => 'deliveryTag',
        'deliveryTag' => 'deliveryTag',
        'DeliveryTag' => 'deliveryTag',
        'routing_key' => 'routingKey',
        'routingKey' => 'routingKey',
        'RoutingKey' => 'routingKey',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::QUEUE_NAME => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'queue_name',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::QUEUE_MESSAGE => [
            'type' => 'Generated\Shared\Transfer\QueueSendMessageTransfer',
            'type_shim' => null,
            'name_underscore' => 'queue_message',
            'is_collection' => false,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::ACKNOWLEDGE => [
            'type' => 'bool',
            'type_shim' => null,
            'name_underscore' => 'acknowledge',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::REJECT => [
            'type' => 'bool',
            'type_shim' => null,
            'name_underscore' => 'reject',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::HAS_ERROR => [
            'type' => 'bool',
            'type_shim' => null,
            'name_underscore' => 'has_error',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::DELIVERY_TAG => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'delivery_tag',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::ROUTING_KEY => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'routing_key',
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
     * @module Queue|Synchronization
     *
     * @param string|null $queueName
     *
     * @return $this
     */
    public function setQueueName($queueName)
    {
        $this->queueName = $queueName;
        $this->modifiedProperties[self::QUEUE_NAME] = true;

        return $this;
    }

    /**
     * @module Queue|Synchronization
     *
     * @return string|null
     */
    public function getQueueName()
    {
        return $this->queueName;
    }

    /**
     * @module Queue|Synchronization
     *
     * @param string|null $queueName
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setQueueNameOrFail($queueName)
    {
        if ($queueName === null) {
            $this->throwNullValueException(static::QUEUE_NAME);
        }

        return $this->setQueueName($queueName);
    }

    /**
     * @module Queue|Synchronization
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getQueueNameOrFail()
    {
        if ($this->queueName === null) {
            $this->throwNullValueException(static::QUEUE_NAME);
        }

        return $this->queueName;
    }

    /**
     * @module Queue|Synchronization
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireQueueName()
    {
        $this->assertPropertyIsSet(self::QUEUE_NAME);

        return $this;
    }

    /**
     * @module Queue|Synchronization
     *
     * @param \Generated\Shared\Transfer\QueueSendMessageTransfer|null $queueMessage
     *
     * @return $this
     */
    public function setQueueMessage(QueueSendMessageTransfer $queueMessage = null)
    {
        $this->queueMessage = $queueMessage;
        $this->modifiedProperties[self::QUEUE_MESSAGE] = true;

        return $this;
    }

    /**
     * @module Queue|Synchronization
     *
     * @return \Generated\Shared\Transfer\QueueSendMessageTransfer|null
     */
    public function getQueueMessage()
    {
        return $this->queueMessage;
    }

    /**
     * @module Queue|Synchronization
     *
     * @param \Generated\Shared\Transfer\QueueSendMessageTransfer $queueMessage
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setQueueMessageOrFail(QueueSendMessageTransfer $queueMessage)
    {
        return $this->setQueueMessage($queueMessage);
    }

    /**
     * @module Queue|Synchronization
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\QueueSendMessageTransfer
     */
    public function getQueueMessageOrFail()
    {
        if ($this->queueMessage === null) {
            $this->throwNullValueException(static::QUEUE_MESSAGE);
        }

        return $this->queueMessage;
    }

    /**
     * @module Queue|Synchronization
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireQueueMessage()
    {
        $this->assertPropertyIsSet(self::QUEUE_MESSAGE);

        return $this;
    }

    /**
     * @module Queue|Synchronization
     *
     * @param bool|null $acknowledge
     *
     * @return $this
     */
    public function setAcknowledge($acknowledge)
    {
        $this->acknowledge = $acknowledge;
        $this->modifiedProperties[self::ACKNOWLEDGE] = true;

        return $this;
    }

    /**
     * @module Queue|Synchronization
     *
     * @return bool|null
     */
    public function getAcknowledge()
    {
        return $this->acknowledge;
    }

    /**
     * @module Queue|Synchronization
     *
     * @param bool|null $acknowledge
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setAcknowledgeOrFail($acknowledge)
    {
        if ($acknowledge === null) {
            $this->throwNullValueException(static::ACKNOWLEDGE);
        }

        return $this->setAcknowledge($acknowledge);
    }

    /**
     * @module Queue|Synchronization
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return bool
     */
    public function getAcknowledgeOrFail()
    {
        if ($this->acknowledge === null) {
            $this->throwNullValueException(static::ACKNOWLEDGE);
        }

        return $this->acknowledge;
    }

    /**
     * @module Queue|Synchronization
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireAcknowledge()
    {
        $this->assertPropertyIsSet(self::ACKNOWLEDGE);

        return $this;
    }

    /**
     * @module Queue|Synchronization
     *
     * @param bool|null $reject
     *
     * @return $this
     */
    public function setReject($reject)
    {
        $this->reject = $reject;
        $this->modifiedProperties[self::REJECT] = true;

        return $this;
    }

    /**
     * @module Queue|Synchronization
     *
     * @return bool|null
     */
    public function getReject()
    {
        return $this->reject;
    }

    /**
     * @module Queue|Synchronization
     *
     * @param bool|null $reject
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setRejectOrFail($reject)
    {
        if ($reject === null) {
            $this->throwNullValueException(static::REJECT);
        }

        return $this->setReject($reject);
    }

    /**
     * @module Queue|Synchronization
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return bool
     */
    public function getRejectOrFail()
    {
        if ($this->reject === null) {
            $this->throwNullValueException(static::REJECT);
        }

        return $this->reject;
    }

    /**
     * @module Queue|Synchronization
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireReject()
    {
        $this->assertPropertyIsSet(self::REJECT);

        return $this;
    }

    /**
     * @module Queue|Synchronization
     *
     * @param bool|null $hasError
     *
     * @return $this
     */
    public function setHasError($hasError)
    {
        $this->hasError = $hasError;
        $this->modifiedProperties[self::HAS_ERROR] = true;

        return $this;
    }

    /**
     * @module Queue|Synchronization
     *
     * @return bool|null
     */
    public function getHasError()
    {
        return $this->hasError;
    }

    /**
     * @module Queue|Synchronization
     *
     * @param bool|null $hasError
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setHasErrorOrFail($hasError)
    {
        if ($hasError === null) {
            $this->throwNullValueException(static::HAS_ERROR);
        }

        return $this->setHasError($hasError);
    }

    /**
     * @module Queue|Synchronization
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return bool
     */
    public function getHasErrorOrFail()
    {
        if ($this->hasError === null) {
            $this->throwNullValueException(static::HAS_ERROR);
        }

        return $this->hasError;
    }

    /**
     * @module Queue|Synchronization
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireHasError()
    {
        $this->assertPropertyIsSet(self::HAS_ERROR);

        return $this;
    }

    /**
     * @module Synchronization
     *
     * @param string|null $deliveryTag
     *
     * @return $this
     */
    public function setDeliveryTag($deliveryTag)
    {
        $this->deliveryTag = $deliveryTag;
        $this->modifiedProperties[self::DELIVERY_TAG] = true;

        return $this;
    }

    /**
     * @module Synchronization
     *
     * @return string|null
     */
    public function getDeliveryTag()
    {
        return $this->deliveryTag;
    }

    /**
     * @module Synchronization
     *
     * @param string|null $deliveryTag
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setDeliveryTagOrFail($deliveryTag)
    {
        if ($deliveryTag === null) {
            $this->throwNullValueException(static::DELIVERY_TAG);
        }

        return $this->setDeliveryTag($deliveryTag);
    }

    /**
     * @module Synchronization
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getDeliveryTagOrFail()
    {
        if ($this->deliveryTag === null) {
            $this->throwNullValueException(static::DELIVERY_TAG);
        }

        return $this->deliveryTag;
    }

    /**
     * @module Synchronization
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireDeliveryTag()
    {
        $this->assertPropertyIsSet(self::DELIVERY_TAG);

        return $this;
    }

    /**
     * @module Synchronization
     *
     * @param string|null $routingKey
     *
     * @return $this
     */
    public function setRoutingKey($routingKey)
    {
        $this->routingKey = $routingKey;
        $this->modifiedProperties[self::ROUTING_KEY] = true;

        return $this;
    }

    /**
     * @module Synchronization
     *
     * @return string|null
     */
    public function getRoutingKey()
    {
        return $this->routingKey;
    }

    /**
     * @module Synchronization
     *
     * @param string|null $routingKey
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setRoutingKeyOrFail($routingKey)
    {
        if ($routingKey === null) {
            $this->throwNullValueException(static::ROUTING_KEY);
        }

        return $this->setRoutingKey($routingKey);
    }

    /**
     * @module Synchronization
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getRoutingKeyOrFail()
    {
        if ($this->routingKey === null) {
            $this->throwNullValueException(static::ROUTING_KEY);
        }

        return $this->routingKey;
    }

    /**
     * @module Synchronization
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireRoutingKey()
    {
        $this->assertPropertyIsSet(self::ROUTING_KEY);

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
                case 'queueName':
                case 'acknowledge':
                case 'reject':
                case 'hasError':
                case 'deliveryTag':
                case 'routingKey':
                    $this->$normalizedPropertyName = $value;
                    $this->modifiedProperties[$normalizedPropertyName] = true;

                    break;
                case 'queueMessage':
                    if (is_array($value)) {
                        $type = $this->transferMetadata[$normalizedPropertyName]['type'];
                        /** @var \Spryker\Shared\Kernel\Transfer\TransferInterface $value */
                        $value = (new $type())->fromArray($value, $ignoreMissingProperty);
                    }

                    if ($value !== null && $this->isPropertyStrict($normalizedPropertyName)) {
                        $this->assertInstanceOfTransfer($normalizedPropertyName, $value);
                    }
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
                case 'queueName':
                case 'acknowledge':
                case 'reject':
                case 'hasError':
                case 'deliveryTag':
                case 'routingKey':
                    $values[$arrayKey] = $value;

                    break;
                case 'queueMessage':
                    $values[$arrayKey] = $value instanceof AbstractTransfer ? $value->modifiedToArray(true, true) : $value;

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
                case 'queueName':
                case 'acknowledge':
                case 'reject':
                case 'hasError':
                case 'deliveryTag':
                case 'routingKey':
                    $values[$arrayKey] = $value;

                    break;
                case 'queueMessage':
                    $values[$arrayKey] = $value instanceof AbstractTransfer ? $value->modifiedToArray(true, false) : $value;

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
            'queueName' => $this->queueName,
            'acknowledge' => $this->acknowledge,
            'reject' => $this->reject,
            'hasError' => $this->hasError,
            'deliveryTag' => $this->deliveryTag,
            'routingKey' => $this->routingKey,
            'queueMessage' => $this->queueMessage,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'queue_name' => $this->queueName,
            'acknowledge' => $this->acknowledge,
            'reject' => $this->reject,
            'has_error' => $this->hasError,
            'delivery_tag' => $this->deliveryTag,
            'routing_key' => $this->routingKey,
            'queue_message' => $this->queueMessage,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'queue_name' => $this->queueName instanceof AbstractTransfer ? $this->queueName->toArray(true, false) : $this->queueName,
            'acknowledge' => $this->acknowledge instanceof AbstractTransfer ? $this->acknowledge->toArray(true, false) : $this->acknowledge,
            'reject' => $this->reject instanceof AbstractTransfer ? $this->reject->toArray(true, false) : $this->reject,
            'has_error' => $this->hasError instanceof AbstractTransfer ? $this->hasError->toArray(true, false) : $this->hasError,
            'delivery_tag' => $this->deliveryTag instanceof AbstractTransfer ? $this->deliveryTag->toArray(true, false) : $this->deliveryTag,
            'routing_key' => $this->routingKey instanceof AbstractTransfer ? $this->routingKey->toArray(true, false) : $this->routingKey,
            'queue_message' => $this->queueMessage instanceof AbstractTransfer ? $this->queueMessage->toArray(true, false) : $this->queueMessage,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'queueName' => $this->queueName instanceof AbstractTransfer ? $this->queueName->toArray(true, true) : $this->queueName,
            'acknowledge' => $this->acknowledge instanceof AbstractTransfer ? $this->acknowledge->toArray(true, true) : $this->acknowledge,
            'reject' => $this->reject instanceof AbstractTransfer ? $this->reject->toArray(true, true) : $this->reject,
            'hasError' => $this->hasError instanceof AbstractTransfer ? $this->hasError->toArray(true, true) : $this->hasError,
            'deliveryTag' => $this->deliveryTag instanceof AbstractTransfer ? $this->deliveryTag->toArray(true, true) : $this->deliveryTag,
            'routingKey' => $this->routingKey instanceof AbstractTransfer ? $this->routingKey->toArray(true, true) : $this->routingKey,
            'queueMessage' => $this->queueMessage instanceof AbstractTransfer ? $this->queueMessage->toArray(true, true) : $this->queueMessage,
        ];
    }
}
