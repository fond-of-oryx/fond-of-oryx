<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Generated\Shared\Transfer;

use ArrayObject;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

/**
 * !!! THIS FILE IS AUTO-GENERATED, EVERY CHANGE WILL BE LOST WITH THE NEXT RUN OF TRANSFER GENERATOR
 * !!! DO NOT CHANGE ANYTHING IN THIS FILE
 */
class MailTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const CUSTOMER = 'customer';

    /**
     * @var string
     */
    public const TYPE = 'type';

    /**
     * @var string
     */
    public const LOCALE = 'locale';

    /**
     * @var string
     */
    public const SENDER = 'sender';

    /**
     * @var string
     */
    public const RECIPIENTS = 'recipients';

    /**
     * @var string
     */
    public const RECIPIENT_BCCS = 'recipientBccs';

    /**
     * @var string
     */
    public const SUBJECT = 'subject';

    /**
     * @var string
     */
    public const TEMPLATES = 'templates';

    /**
     * @var string
     */
    public const HEADERS = 'headers';

    /**
     * @var string
     */
    public const ATTACHMENTS = 'attachments';

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|null
     */
    protected $customer;

    /**
     * @var string|null
     */
    protected $type;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|null
     */
    protected $locale;

    /**
     * @var \Generated\Shared\Transfer\MailSenderTransfer|null
     */
    protected $sender;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\MailRecipientTransfer[]
     */
    protected $recipients;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\MailRecipientTransfer[]
     */
    protected $recipientBccs;

    /**
     * @var string|null
     */
    protected $subject;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\MailTemplateTransfer[]
     */
    protected $templates;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\MailHeaderTransfer[]
     */
    protected $headers;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\MailAttachmentTransfer[]
     */
    protected $attachments;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'customer' => 'customer',
        'Customer' => 'customer',
        'type' => 'type',
        'Type' => 'type',
        'locale' => 'locale',
        'Locale' => 'locale',
        'sender' => 'sender',
        'Sender' => 'sender',
        'recipients' => 'recipients',
        'Recipients' => 'recipients',
        'recipient_bccs' => 'recipientBccs',
        'recipientBccs' => 'recipientBccs',
        'RecipientBccs' => 'recipientBccs',
        'subject' => 'subject',
        'Subject' => 'subject',
        'templates' => 'templates',
        'Templates' => 'templates',
        'headers' => 'headers',
        'Headers' => 'headers',
        'attachments' => 'attachments',
        'Attachments' => 'attachments',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::CUSTOMER => [
            'type' => 'Generated\Shared\Transfer\CustomerTransfer',
            'type_shim' => null,
            'name_underscore' => 'customer',
            'is_collection' => false,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::TYPE => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'type',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::LOCALE => [
            'type' => 'Generated\Shared\Transfer\LocaleTransfer',
            'type_shim' => null,
            'name_underscore' => 'locale',
            'is_collection' => false,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::SENDER => [
            'type' => 'Generated\Shared\Transfer\MailSenderTransfer',
            'type_shim' => null,
            'name_underscore' => 'sender',
            'is_collection' => false,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::RECIPIENTS => [
            'type' => 'Generated\Shared\Transfer\MailRecipientTransfer',
            'type_shim' => null,
            'name_underscore' => 'recipients',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::RECIPIENT_BCCS => [
            'type' => 'Generated\Shared\Transfer\MailRecipientTransfer',
            'type_shim' => null,
            'name_underscore' => 'recipient_bccs',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::SUBJECT => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'subject',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::TEMPLATES => [
            'type' => 'Generated\Shared\Transfer\MailTemplateTransfer',
            'type_shim' => null,
            'name_underscore' => 'templates',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::HEADERS => [
            'type' => 'Generated\Shared\Transfer\MailHeaderTransfer',
            'type_shim' => null,
            'name_underscore' => 'headers',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::ATTACHMENTS => [
            'type' => 'Generated\Shared\Transfer\MailAttachmentTransfer',
            'type_shim' => null,
            'name_underscore' => 'attachments',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
    ];

    /**
     * @module Customer
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer|null $customer
     *
     * @return $this
     */
    public function setCustomer(CustomerTransfer $customer = null)
    {
        $this->customer = $customer;
        $this->modifiedProperties[self::CUSTOMER] = true;

        return $this;
    }

    /**
     * @module Customer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @module Customer
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customer
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setCustomerOrFail(CustomerTransfer $customer)
    {
        return $this->setCustomer($customer);
    }

    /**
     * @module Customer
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function getCustomerOrFail()
    {
        if ($this->customer === null) {
            $this->throwNullValueException(static::CUSTOMER);
        }

        return $this->customer;
    }

    /**
     * @module Customer
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireCustomer()
    {
        $this->assertPropertyIsSet(self::CUSTOMER);

        return $this;
    }

    /**
     * @module Customer|Mail
     *
     * @param string|null $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        $this->modifiedProperties[self::TYPE] = true;

        return $this;
    }

    /**
     * @module Customer|Mail
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @module Customer|Mail
     *
     * @param string|null $type
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setTypeOrFail($type)
    {
        if ($type === null) {
            $this->throwNullValueException(static::TYPE);
        }

        return $this->setType($type);
    }

    /**
     * @module Customer|Mail
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getTypeOrFail()
    {
        if ($this->type === null) {
            $this->throwNullValueException(static::TYPE);
        }

        return $this->type;
    }

    /**
     * @module Customer|Mail
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireType()
    {
        $this->assertPropertyIsSet(self::TYPE);

        return $this;
    }

    /**
     * @module Customer|Mail
     *
     * @param \Generated\Shared\Transfer\LocaleTransfer|null $locale
     *
     * @return $this
     */
    public function setLocale(LocaleTransfer $locale = null)
    {
        $this->locale = $locale;
        $this->modifiedProperties[self::LOCALE] = true;

        return $this;
    }

    /**
     * @module Customer|Mail
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer|null
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @module Customer|Mail
     *
     * @param \Generated\Shared\Transfer\LocaleTransfer $locale
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setLocaleOrFail(LocaleTransfer $locale)
    {
        return $this->setLocale($locale);
    }

    /**
     * @module Customer|Mail
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getLocaleOrFail()
    {
        if ($this->locale === null) {
            $this->throwNullValueException(static::LOCALE);
        }

        return $this->locale;
    }

    /**
     * @module Customer|Mail
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireLocale()
    {
        $this->assertPropertyIsSet(self::LOCALE);

        return $this;
    }

    /**
     * @module Mail
     *
     * @param \Generated\Shared\Transfer\MailSenderTransfer|null $sender
     *
     * @return $this
     */
    public function setSender(MailSenderTransfer $sender = null)
    {
        $this->sender = $sender;
        $this->modifiedProperties[self::SENDER] = true;

        return $this;
    }

    /**
     * @module Mail
     *
     * @return \Generated\Shared\Transfer\MailSenderTransfer|null
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @module Mail
     *
     * @param \Generated\Shared\Transfer\MailSenderTransfer $sender
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setSenderOrFail(MailSenderTransfer $sender)
    {
        return $this->setSender($sender);
    }

    /**
     * @module Mail
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\MailSenderTransfer
     */
    public function getSenderOrFail()
    {
        if ($this->sender === null) {
            $this->throwNullValueException(static::SENDER);
        }

        return $this->sender;
    }

    /**
     * @module Mail
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSender()
    {
        $this->assertPropertyIsSet(self::SENDER);

        return $this;
    }

    /**
     * @module Mail
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\MailRecipientTransfer[] $recipients
     *
     * @return $this
     */
    public function setRecipients(ArrayObject $recipients)
    {
        $this->recipients = $recipients;
        $this->modifiedProperties[self::RECIPIENTS] = true;

        return $this;
    }

    /**
     * @module Mail
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\MailRecipientTransfer[]
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @module Mail
     *
     * @param \Generated\Shared\Transfer\MailRecipientTransfer $recipient
     *
     * @return $this
     */
    public function addRecipient(MailRecipientTransfer $recipient)
    {
        $this->recipients[] = $recipient;
        $this->modifiedProperties[self::RECIPIENTS] = true;

        return $this;
    }

    /**
     * @module Mail
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireRecipients()
    {
        $this->assertCollectionPropertyIsSet(self::RECIPIENTS);

        return $this;
    }

    /**
     * @module Mail
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\MailRecipientTransfer[] $recipientBccs
     *
     * @return $this
     */
    public function setRecipientBccs(ArrayObject $recipientBccs)
    {
        $this->recipientBccs = $recipientBccs;
        $this->modifiedProperties[self::RECIPIENT_BCCS] = true;

        return $this;
    }

    /**
     * @module Mail
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\MailRecipientTransfer[]
     */
    public function getRecipientBccs()
    {
        return $this->recipientBccs;
    }

    /**
     * @module Mail
     *
     * @param \Generated\Shared\Transfer\MailRecipientTransfer $recipientBcc
     *
     * @return $this
     */
    public function addRecipientBcc(MailRecipientTransfer $recipientBcc)
    {
        $this->recipientBccs[] = $recipientBcc;
        $this->modifiedProperties[self::RECIPIENT_BCCS] = true;

        return $this;
    }

    /**
     * @module Mail
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireRecipientBccs()
    {
        $this->assertCollectionPropertyIsSet(self::RECIPIENT_BCCS);

        return $this;
    }

    /**
     * @module Mail
     *
     * @param string|null $subject
     *
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        $this->modifiedProperties[self::SUBJECT] = true;

        return $this;
    }

    /**
     * @module Mail
     *
     * @return string|null
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @module Mail
     *
     * @param string|null $subject
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setSubjectOrFail($subject)
    {
        if ($subject === null) {
            $this->throwNullValueException(static::SUBJECT);
        }

        return $this->setSubject($subject);
    }

    /**
     * @module Mail
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getSubjectOrFail()
    {
        if ($this->subject === null) {
            $this->throwNullValueException(static::SUBJECT);
        }

        return $this->subject;
    }

    /**
     * @module Mail
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSubject()
    {
        $this->assertPropertyIsSet(self::SUBJECT);

        return $this;
    }

    /**
     * @module Mail
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\MailTemplateTransfer[] $templates
     *
     * @return $this
     */
    public function setTemplates(ArrayObject $templates)
    {
        $this->templates = $templates;
        $this->modifiedProperties[self::TEMPLATES] = true;

        return $this;
    }

    /**
     * @module Mail
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\MailTemplateTransfer[]
     */
    public function getTemplates()
    {
        return $this->templates;
    }

    /**
     * @module Mail
     *
     * @param \Generated\Shared\Transfer\MailTemplateTransfer $template
     *
     * @return $this
     */
    public function addTemplate(MailTemplateTransfer $template)
    {
        $this->templates[] = $template;
        $this->modifiedProperties[self::TEMPLATES] = true;

        return $this;
    }

    /**
     * @module Mail
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireTemplates()
    {
        $this->assertCollectionPropertyIsSet(self::TEMPLATES);

        return $this;
    }

    /**
     * @module Mail
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\MailHeaderTransfer[] $headers
     *
     * @return $this
     */
    public function setHeaders(ArrayObject $headers)
    {
        $this->headers = $headers;
        $this->modifiedProperties[self::HEADERS] = true;

        return $this;
    }

    /**
     * @module Mail
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\MailHeaderTransfer[]
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @module Mail
     *
     * @param \Generated\Shared\Transfer\MailHeaderTransfer $header
     *
     * @return $this
     */
    public function addHeader(MailHeaderTransfer $header)
    {
        $this->headers[] = $header;
        $this->modifiedProperties[self::HEADERS] = true;

        return $this;
    }

    /**
     * @module Mail
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireHeaders()
    {
        $this->assertCollectionPropertyIsSet(self::HEADERS);

        return $this;
    }

    /**
     * @module Mail
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\MailAttachmentTransfer[] $attachments
     *
     * @return $this
     */
    public function setAttachments(ArrayObject $attachments)
    {
        $this->attachments = $attachments;
        $this->modifiedProperties[self::ATTACHMENTS] = true;

        return $this;
    }

    /**
     * @module Mail
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\MailAttachmentTransfer[]
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @module Mail
     *
     * @param \Generated\Shared\Transfer\MailAttachmentTransfer $attachment
     *
     * @return $this
     */
    public function addAttachment(MailAttachmentTransfer $attachment)
    {
        $this->attachments[] = $attachment;
        $this->modifiedProperties[self::ATTACHMENTS] = true;

        return $this;
    }

    /**
     * @module Mail
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireAttachments()
    {
        $this->assertCollectionPropertyIsSet(self::ATTACHMENTS);

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
                case 'type':
                case 'subject':
                    $this->$normalizedPropertyName = $value;
                    $this->modifiedProperties[$normalizedPropertyName] = true;

                    break;
                case 'customer':
                case 'locale':
                case 'sender':
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
                case 'recipients':
                case 'recipientBccs':
                case 'templates':
                case 'headers':
                case 'attachments':
                    $elementType = $this->transferMetadata[$normalizedPropertyName]['type'];
                    $this->$normalizedPropertyName = $this->processArrayObject($elementType, $value, $ignoreMissingProperty);
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
                case 'type':
                case 'subject':
                    $values[$arrayKey] = $value;

                    break;
                case 'customer':
                case 'locale':
                case 'sender':
                    $values[$arrayKey] = $value instanceof AbstractTransfer ? $value->modifiedToArray(true, true) : $value;

                    break;
                case 'recipients':
                case 'recipientBccs':
                case 'templates':
                case 'headers':
                case 'attachments':
                    $values[$arrayKey] = $value ? $this->addValuesToCollectionModified($value, true, true) : $value;

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
                case 'type':
                case 'subject':
                    $values[$arrayKey] = $value;

                    break;
                case 'customer':
                case 'locale':
                case 'sender':
                    $values[$arrayKey] = $value instanceof AbstractTransfer ? $value->modifiedToArray(true, false) : $value;

                    break;
                case 'recipients':
                case 'recipientBccs':
                case 'templates':
                case 'headers':
                case 'attachments':
                    $values[$arrayKey] = $value ? $this->addValuesToCollectionModified($value, true, false) : $value;

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
        $this->recipients = $this->recipients ?: new ArrayObject();
        $this->recipientBccs = $this->recipientBccs ?: new ArrayObject();
        $this->templates = $this->templates ?: new ArrayObject();
        $this->headers = $this->headers ?: new ArrayObject();
        $this->attachments = $this->attachments ?: new ArrayObject();
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveCamelCased(): array
    {
        return [
            'type' => $this->type,
            'subject' => $this->subject,
            'customer' => $this->customer,
            'locale' => $this->locale,
            'sender' => $this->sender,
            'recipients' => $this->recipients,
            'recipientBccs' => $this->recipientBccs,
            'templates' => $this->templates,
            'headers' => $this->headers,
            'attachments' => $this->attachments,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'type' => $this->type,
            'subject' => $this->subject,
            'customer' => $this->customer,
            'locale' => $this->locale,
            'sender' => $this->sender,
            'recipients' => $this->recipients,
            'recipient_bccs' => $this->recipientBccs,
            'templates' => $this->templates,
            'headers' => $this->headers,
            'attachments' => $this->attachments,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'type' => $this->type instanceof AbstractTransfer ? $this->type->toArray(true, false) : $this->type,
            'subject' => $this->subject instanceof AbstractTransfer ? $this->subject->toArray(true, false) : $this->subject,
            'customer' => $this->customer instanceof AbstractTransfer ? $this->customer->toArray(true, false) : $this->customer,
            'locale' => $this->locale instanceof AbstractTransfer ? $this->locale->toArray(true, false) : $this->locale,
            'sender' => $this->sender instanceof AbstractTransfer ? $this->sender->toArray(true, false) : $this->sender,
            'recipients' => $this->recipients instanceof AbstractTransfer ? $this->recipients->toArray(true, false) : $this->addValuesToCollection($this->recipients, true, false),
            'recipient_bccs' => $this->recipientBccs instanceof AbstractTransfer ? $this->recipientBccs->toArray(true, false) : $this->addValuesToCollection($this->recipientBccs, true, false),
            'templates' => $this->templates instanceof AbstractTransfer ? $this->templates->toArray(true, false) : $this->addValuesToCollection($this->templates, true, false),
            'headers' => $this->headers instanceof AbstractTransfer ? $this->headers->toArray(true, false) : $this->addValuesToCollection($this->headers, true, false),
            'attachments' => $this->attachments instanceof AbstractTransfer ? $this->attachments->toArray(true, false) : $this->addValuesToCollection($this->attachments, true, false),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'type' => $this->type instanceof AbstractTransfer ? $this->type->toArray(true, true) : $this->type,
            'subject' => $this->subject instanceof AbstractTransfer ? $this->subject->toArray(true, true) : $this->subject,
            'customer' => $this->customer instanceof AbstractTransfer ? $this->customer->toArray(true, true) : $this->customer,
            'locale' => $this->locale instanceof AbstractTransfer ? $this->locale->toArray(true, true) : $this->locale,
            'sender' => $this->sender instanceof AbstractTransfer ? $this->sender->toArray(true, true) : $this->sender,
            'recipients' => $this->recipients instanceof AbstractTransfer ? $this->recipients->toArray(true, true) : $this->addValuesToCollection($this->recipients, true, true),
            'recipientBccs' => $this->recipientBccs instanceof AbstractTransfer ? $this->recipientBccs->toArray(true, true) : $this->addValuesToCollection($this->recipientBccs, true, true),
            'templates' => $this->templates instanceof AbstractTransfer ? $this->templates->toArray(true, true) : $this->addValuesToCollection($this->templates, true, true),
            'headers' => $this->headers instanceof AbstractTransfer ? $this->headers->toArray(true, true) : $this->addValuesToCollection($this->headers, true, true),
            'attachments' => $this->attachments instanceof AbstractTransfer ? $this->attachments->toArray(true, true) : $this->addValuesToCollection($this->attachments, true, true),
        ];
    }
}
