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
class CustomerRegistrationResponseTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const IS_NEW_CUSTOMER = 'isNewCustomer';

    /**
     * @var string
     */
    public const IS_VERIFIED = 'isVerified';

    /**
     * @var string
     */
    public const GDPR_ACCEPTED = 'gdprAccepted';

    /**
     * @var string
     */
    public const SUBSCRIBED = 'subscribed';

    /**
     * @var string
     */
    public const MESSAGE = 'message';

    /**
     * @var bool|null
     */
    protected $isNewCustomer;

    /**
     * @var bool|null
     */
    protected $isVerified;

    /**
     * @var bool|null
     */
    protected $gdprAccepted;

    /**
     * @var bool|null
     */
    protected $subscribed;

    /**
     * @var string|null
     */
    protected $message;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'is_new_customer' => 'isNewCustomer',
        'isNewCustomer' => 'isNewCustomer',
        'IsNewCustomer' => 'isNewCustomer',
        'is_verified' => 'isVerified',
        'isVerified' => 'isVerified',
        'IsVerified' => 'isVerified',
        'gdpr_accepted' => 'gdprAccepted',
        'gdprAccepted' => 'gdprAccepted',
        'GdprAccepted' => 'gdprAccepted',
        'subscribed' => 'subscribed',
        'Subscribed' => 'subscribed',
        'message' => 'message',
        'Message' => 'message',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::IS_NEW_CUSTOMER => [
            'type' => 'bool',
            'type_shim' => null,
            'name_underscore' => 'is_new_customer',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::IS_VERIFIED => [
            'type' => 'bool',
            'type_shim' => null,
            'name_underscore' => 'is_verified',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::GDPR_ACCEPTED => [
            'type' => 'bool',
            'type_shim' => null,
            'name_underscore' => 'gdpr_accepted',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::SUBSCRIBED => [
            'type' => 'bool',
            'type_shim' => null,
            'name_underscore' => 'subscribed',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
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
    ];

    /**
     * @module CustomerRegistration
     *
     * @param bool|null $isNewCustomer
     *
     * @return $this
     */
    public function setIsNewCustomer($isNewCustomer)
    {
        $this->isNewCustomer = $isNewCustomer;
        $this->modifiedProperties[self::IS_NEW_CUSTOMER] = true;

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @return bool|null
     */
    public function getIsNewCustomer()
    {
        return $this->isNewCustomer;
    }

    /**
     * @module CustomerRegistration
     *
     * @param bool|null $isNewCustomer
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setIsNewCustomerOrFail($isNewCustomer)
    {
        if ($isNewCustomer === null) {
            $this->throwNullValueException(static::IS_NEW_CUSTOMER);
        }

        return $this->setIsNewCustomer($isNewCustomer);
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return bool
     */
    public function getIsNewCustomerOrFail()
    {
        if ($this->isNewCustomer === null) {
            $this->throwNullValueException(static::IS_NEW_CUSTOMER);
        }

        return $this->isNewCustomer;
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireIsNewCustomer()
    {
        $this->assertPropertyIsSet(self::IS_NEW_CUSTOMER);

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @param bool|null $isVerified
     *
     * @return $this
     */
    public function setIsVerified($isVerified)
    {
        $this->isVerified = $isVerified;
        $this->modifiedProperties[self::IS_VERIFIED] = true;

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @return bool|null
     */
    public function getIsVerified()
    {
        return $this->isVerified;
    }

    /**
     * @module CustomerRegistration
     *
     * @param bool|null $isVerified
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setIsVerifiedOrFail($isVerified)
    {
        if ($isVerified === null) {
            $this->throwNullValueException(static::IS_VERIFIED);
        }

        return $this->setIsVerified($isVerified);
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return bool
     */
    public function getIsVerifiedOrFail()
    {
        if ($this->isVerified === null) {
            $this->throwNullValueException(static::IS_VERIFIED);
        }

        return $this->isVerified;
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireIsVerified()
    {
        $this->assertPropertyIsSet(self::IS_VERIFIED);

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @param bool|null $gdprAccepted
     *
     * @return $this
     */
    public function setGdprAccepted($gdprAccepted)
    {
        $this->gdprAccepted = $gdprAccepted;
        $this->modifiedProperties[self::GDPR_ACCEPTED] = true;

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @return bool|null
     */
    public function getGdprAccepted()
    {
        return $this->gdprAccepted;
    }

    /**
     * @module CustomerRegistration
     *
     * @param bool|null $gdprAccepted
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setGdprAcceptedOrFail($gdprAccepted)
    {
        if ($gdprAccepted === null) {
            $this->throwNullValueException(static::GDPR_ACCEPTED);
        }

        return $this->setGdprAccepted($gdprAccepted);
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return bool
     */
    public function getGdprAcceptedOrFail()
    {
        if ($this->gdprAccepted === null) {
            $this->throwNullValueException(static::GDPR_ACCEPTED);
        }

        return $this->gdprAccepted;
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireGdprAccepted()
    {
        $this->assertPropertyIsSet(self::GDPR_ACCEPTED);

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @param bool|null $subscribed
     *
     * @return $this
     */
    public function setSubscribed($subscribed)
    {
        $this->subscribed = $subscribed;
        $this->modifiedProperties[self::SUBSCRIBED] = true;

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @return bool|null
     */
    public function getSubscribed()
    {
        return $this->subscribed;
    }

    /**
     * @module CustomerRegistration
     *
     * @param bool|null $subscribed
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setSubscribedOrFail($subscribed)
    {
        if ($subscribed === null) {
            $this->throwNullValueException(static::SUBSCRIBED);
        }

        return $this->setSubscribed($subscribed);
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return bool
     */
    public function getSubscribedOrFail()
    {
        if ($this->subscribed === null) {
            $this->throwNullValueException(static::SUBSCRIBED);
        }

        return $this->subscribed;
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSubscribed()
    {
        $this->assertPropertyIsSet(self::SUBSCRIBED);

        return $this;
    }

    /**
     * @module CustomerRegistration
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
     * @module CustomerRegistration
     *
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @module CustomerRegistration
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
     * @module CustomerRegistration
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
     * @module CustomerRegistration
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
                case 'isNewCustomer':
                case 'isVerified':
                case 'gdprAccepted':
                case 'subscribed':
                case 'message':
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
                case 'isNewCustomer':
                case 'isVerified':
                case 'gdprAccepted':
                case 'subscribed':
                case 'message':
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
                case 'isNewCustomer':
                case 'isVerified':
                case 'gdprAccepted':
                case 'subscribed':
                case 'message':
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
            'isNewCustomer' => $this->isNewCustomer,
            'isVerified' => $this->isVerified,
            'gdprAccepted' => $this->gdprAccepted,
            'subscribed' => $this->subscribed,
            'message' => $this->message,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'is_new_customer' => $this->isNewCustomer,
            'is_verified' => $this->isVerified,
            'gdpr_accepted' => $this->gdprAccepted,
            'subscribed' => $this->subscribed,
            'message' => $this->message,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'is_new_customer' => $this->isNewCustomer instanceof AbstractTransfer ? $this->isNewCustomer->toArray(true, false) : $this->isNewCustomer,
            'is_verified' => $this->isVerified instanceof AbstractTransfer ? $this->isVerified->toArray(true, false) : $this->isVerified,
            'gdpr_accepted' => $this->gdprAccepted instanceof AbstractTransfer ? $this->gdprAccepted->toArray(true, false) : $this->gdprAccepted,
            'subscribed' => $this->subscribed instanceof AbstractTransfer ? $this->subscribed->toArray(true, false) : $this->subscribed,
            'message' => $this->message instanceof AbstractTransfer ? $this->message->toArray(true, false) : $this->message,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'isNewCustomer' => $this->isNewCustomer instanceof AbstractTransfer ? $this->isNewCustomer->toArray(true, true) : $this->isNewCustomer,
            'isVerified' => $this->isVerified instanceof AbstractTransfer ? $this->isVerified->toArray(true, true) : $this->isVerified,
            'gdprAccepted' => $this->gdprAccepted instanceof AbstractTransfer ? $this->gdprAccepted->toArray(true, true) : $this->gdprAccepted,
            'subscribed' => $this->subscribed instanceof AbstractTransfer ? $this->subscribed->toArray(true, true) : $this->subscribed,
            'message' => $this->message instanceof AbstractTransfer ? $this->message->toArray(true, true) : $this->message,
        ];
    }
}
