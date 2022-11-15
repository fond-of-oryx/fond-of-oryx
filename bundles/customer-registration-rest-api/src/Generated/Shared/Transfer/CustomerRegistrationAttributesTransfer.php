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
class CustomerRegistrationAttributesTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const EMAIL = 'email';

    /**
     * @var string
     */
    public const LANGUAGE = 'language';

    /**
     * @var string
     */
    public const TOKEN = 'token';

    /**
     * @var string
     */
    public const VERIFY_EMAIL = 'verifyEmail';

    /**
     * @var string
     */
    public const SUBSCRIBE = 'subscribe';

    /**
     * @var string
     */
    public const ACCEPT_GDPR = 'acceptGdpr';

    /**
     * @var string|null
     */
    protected $email;

    /**
     * @var string|null
     */
    protected $language;

    /**
     * @var string|null
     */
    protected $token;

    /**
     * @var bool|null
     */
    protected $verifyEmail;

    /**
     * @var bool|null
     */
    protected $subscribe;

    /**
     * @var bool|null
     */
    protected $acceptGdpr;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'email' => 'email',
        'Email' => 'email',
        'language' => 'language',
        'Language' => 'language',
        'token' => 'token',
        'Token' => 'token',
        'verify_email' => 'verifyEmail',
        'verifyEmail' => 'verifyEmail',
        'VerifyEmail' => 'verifyEmail',
        'subscribe' => 'subscribe',
        'Subscribe' => 'subscribe',
        'accept_gdpr' => 'acceptGdpr',
        'acceptGdpr' => 'acceptGdpr',
        'AcceptGdpr' => 'acceptGdpr',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::EMAIL => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'email',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::LANGUAGE => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'language',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::TOKEN => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'token',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::VERIFY_EMAIL => [
            'type' => 'bool',
            'type_shim' => null,
            'name_underscore' => 'verify_email',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::SUBSCRIBE => [
            'type' => 'bool',
            'type_shim' => null,
            'name_underscore' => 'subscribe',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::ACCEPT_GDPR => [
            'type' => 'bool',
            'type_shim' => null,
            'name_underscore' => 'accept_gdpr',
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
     * @param string|null $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        $this->modifiedProperties[self::EMAIL] = true;

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @module CustomerRegistration
     *
     * @param string|null $email
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setEmailOrFail($email)
    {
        if ($email === null) {
            $this->throwNullValueException(static::EMAIL);
        }

        return $this->setEmail($email);
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getEmailOrFail()
    {
        if ($this->email === null) {
            $this->throwNullValueException(static::EMAIL);
        }

        return $this->email;
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireEmail()
    {
        $this->assertPropertyIsSet(self::EMAIL);

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @param string|null $language
     *
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        $this->modifiedProperties[self::LANGUAGE] = true;

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @return string|null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @module CustomerRegistration
     *
     * @param string|null $language
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setLanguageOrFail($language)
    {
        if ($language === null) {
            $this->throwNullValueException(static::LANGUAGE);
        }

        return $this->setLanguage($language);
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getLanguageOrFail()
    {
        if ($this->language === null) {
            $this->throwNullValueException(static::LANGUAGE);
        }

        return $this->language;
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireLanguage()
    {
        $this->assertPropertyIsSet(self::LANGUAGE);

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @param string|null $token
     *
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;
        $this->modifiedProperties[self::TOKEN] = true;

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @return string|null
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @module CustomerRegistration
     *
     * @param string|null $token
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setTokenOrFail($token)
    {
        if ($token === null) {
            $this->throwNullValueException(static::TOKEN);
        }

        return $this->setToken($token);
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getTokenOrFail()
    {
        if ($this->token === null) {
            $this->throwNullValueException(static::TOKEN);
        }

        return $this->token;
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireToken()
    {
        $this->assertPropertyIsSet(self::TOKEN);

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @param bool|null $verifyEmail
     *
     * @return $this
     */
    public function setVerifyEmail($verifyEmail)
    {
        $this->verifyEmail = $verifyEmail;
        $this->modifiedProperties[self::VERIFY_EMAIL] = true;

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @return bool|null
     */
    public function getVerifyEmail()
    {
        return $this->verifyEmail;
    }

    /**
     * @module CustomerRegistration
     *
     * @param bool|null $verifyEmail
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setVerifyEmailOrFail($verifyEmail)
    {
        if ($verifyEmail === null) {
            $this->throwNullValueException(static::VERIFY_EMAIL);
        }

        return $this->setVerifyEmail($verifyEmail);
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return bool
     */
    public function getVerifyEmailOrFail()
    {
        if ($this->verifyEmail === null) {
            $this->throwNullValueException(static::VERIFY_EMAIL);
        }

        return $this->verifyEmail;
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireVerifyEmail()
    {
        $this->assertPropertyIsSet(self::VERIFY_EMAIL);

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @param bool|null $subscribe
     *
     * @return $this
     */
    public function setSubscribe($subscribe)
    {
        $this->subscribe = $subscribe;
        $this->modifiedProperties[self::SUBSCRIBE] = true;

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @return bool|null
     */
    public function getSubscribe()
    {
        return $this->subscribe;
    }

    /**
     * @module CustomerRegistration
     *
     * @param bool|null $subscribe
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setSubscribeOrFail($subscribe)
    {
        if ($subscribe === null) {
            $this->throwNullValueException(static::SUBSCRIBE);
        }

        return $this->setSubscribe($subscribe);
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return bool
     */
    public function getSubscribeOrFail()
    {
        if ($this->subscribe === null) {
            $this->throwNullValueException(static::SUBSCRIBE);
        }

        return $this->subscribe;
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSubscribe()
    {
        $this->assertPropertyIsSet(self::SUBSCRIBE);

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @param bool|null $acceptGdpr
     *
     * @return $this
     */
    public function setAcceptGdpr($acceptGdpr)
    {
        $this->acceptGdpr = $acceptGdpr;
        $this->modifiedProperties[self::ACCEPT_GDPR] = true;

        return $this;
    }

    /**
     * @module CustomerRegistration
     *
     * @return bool|null
     */
    public function getAcceptGdpr()
    {
        return $this->acceptGdpr;
    }

    /**
     * @module CustomerRegistration
     *
     * @param bool|null $acceptGdpr
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setAcceptGdprOrFail($acceptGdpr)
    {
        if ($acceptGdpr === null) {
            $this->throwNullValueException(static::ACCEPT_GDPR);
        }

        return $this->setAcceptGdpr($acceptGdpr);
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return bool
     */
    public function getAcceptGdprOrFail()
    {
        if ($this->acceptGdpr === null) {
            $this->throwNullValueException(static::ACCEPT_GDPR);
        }

        return $this->acceptGdpr;
    }

    /**
     * @module CustomerRegistration
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireAcceptGdpr()
    {
        $this->assertPropertyIsSet(self::ACCEPT_GDPR);

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
                case 'email':
                case 'language':
                case 'token':
                case 'verifyEmail':
                case 'subscribe':
                case 'acceptGdpr':
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
                case 'email':
                case 'language':
                case 'token':
                case 'verifyEmail':
                case 'subscribe':
                case 'acceptGdpr':
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
                case 'email':
                case 'language':
                case 'token':
                case 'verifyEmail':
                case 'subscribe':
                case 'acceptGdpr':
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
            'email' => $this->email,
            'language' => $this->language,
            'token' => $this->token,
            'verifyEmail' => $this->verifyEmail,
            'subscribe' => $this->subscribe,
            'acceptGdpr' => $this->acceptGdpr,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'email' => $this->email,
            'language' => $this->language,
            'token' => $this->token,
            'verify_email' => $this->verifyEmail,
            'subscribe' => $this->subscribe,
            'accept_gdpr' => $this->acceptGdpr,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'email' => $this->email instanceof AbstractTransfer ? $this->email->toArray(true, false) : $this->email,
            'language' => $this->language instanceof AbstractTransfer ? $this->language->toArray(true, false) : $this->language,
            'token' => $this->token instanceof AbstractTransfer ? $this->token->toArray(true, false) : $this->token,
            'verify_email' => $this->verifyEmail instanceof AbstractTransfer ? $this->verifyEmail->toArray(true, false) : $this->verifyEmail,
            'subscribe' => $this->subscribe instanceof AbstractTransfer ? $this->subscribe->toArray(true, false) : $this->subscribe,
            'accept_gdpr' => $this->acceptGdpr instanceof AbstractTransfer ? $this->acceptGdpr->toArray(true, false) : $this->acceptGdpr,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'email' => $this->email instanceof AbstractTransfer ? $this->email->toArray(true, true) : $this->email,
            'language' => $this->language instanceof AbstractTransfer ? $this->language->toArray(true, true) : $this->language,
            'token' => $this->token instanceof AbstractTransfer ? $this->token->toArray(true, true) : $this->token,
            'verifyEmail' => $this->verifyEmail instanceof AbstractTransfer ? $this->verifyEmail->toArray(true, true) : $this->verifyEmail,
            'subscribe' => $this->subscribe instanceof AbstractTransfer ? $this->subscribe->toArray(true, true) : $this->subscribe,
            'acceptGdpr' => $this->acceptGdpr instanceof AbstractTransfer ? $this->acceptGdpr->toArray(true, true) : $this->acceptGdpr,
        ];
    }
}
