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
class GlueResourceMethodCollectionTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const GET = 'get';

    /**
     * @var string
     */
    public const GET_COLLECTION = 'getCollection';

    /**
     * @var string
     */
    public const POST = 'post';

    /**
     * @var string
     */
    public const PATCH = 'patch';

    /**
     * @var string
     */
    public const DELETE = 'delete';

    /**
     * @var string
     */
    public const OPTIONS = 'options';

    /**
     * @var \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null
     */
    protected $get;

    /**
     * @var \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null
     */
    protected $getCollection;

    /**
     * @var \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null
     */
    protected $post;

    /**
     * @var \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null
     */
    protected $patch;

    /**
     * @var \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null
     */
    protected $delete;

    /**
     * @var \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null
     */
    protected $options;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'get' => 'get',
        'Get' => 'get',
        'get_collection' => 'getCollection',
        'getCollection' => 'getCollection',
        'GetCollection' => 'getCollection',
        'post' => 'post',
        'Post' => 'post',
        'patch' => 'patch',
        'Patch' => 'patch',
        'delete' => 'delete',
        'Delete' => 'delete',
        'options' => 'options',
        'Options' => 'options',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::GET => [
            'type' => 'Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer',
            'type_shim' => null,
            'name_underscore' => 'get',
            'is_collection' => false,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::GET_COLLECTION => [
            'type' => 'Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer',
            'type_shim' => null,
            'name_underscore' => 'get_collection',
            'is_collection' => false,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::POST => [
            'type' => 'Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer',
            'type_shim' => null,
            'name_underscore' => 'post',
            'is_collection' => false,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::PATCH => [
            'type' => 'Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer',
            'type_shim' => null,
            'name_underscore' => 'patch',
            'is_collection' => false,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::DELETE => [
            'type' => 'Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer',
            'type_shim' => null,
            'name_underscore' => 'delete',
            'is_collection' => false,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::OPTIONS => [
            'type' => 'Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer',
            'type_shim' => null,
            'name_underscore' => 'options',
            'is_collection' => false,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
    ];

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null $get
     *
     * @return $this
     */
    public function setGet(GlueResourceMethodConfigurationTransfer $get = null)
    {
        $this->get = $get;
        $this->modifiedProperties[self::GET] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer $get
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setGetOrFail(GlueResourceMethodConfigurationTransfer $get)
    {
        return $this->setGet($get);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer
     */
    public function getGetOrFail()
    {
        if ($this->get === null) {
            $this->throwNullValueException(static::GET);
        }

        return $this->get;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireGet()
    {
        $this->assertPropertyIsSet(self::GET);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null $getCollection
     *
     * @return $this
     */
    public function setGetCollection(GlueResourceMethodConfigurationTransfer $getCollection = null)
    {
        $this->getCollection = $getCollection;
        $this->modifiedProperties[self::GET_COLLECTION] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null
     */
    public function getGetCollection()
    {
        return $this->getCollection;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer $getCollection
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setGetCollectionOrFail(GlueResourceMethodConfigurationTransfer $getCollection)
    {
        return $this->setGetCollection($getCollection);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer
     */
    public function getGetCollectionOrFail()
    {
        if ($this->getCollection === null) {
            $this->throwNullValueException(static::GET_COLLECTION);
        }

        return $this->getCollection;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireGetCollection()
    {
        $this->assertPropertyIsSet(self::GET_COLLECTION);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null $post
     *
     * @return $this
     */
    public function setPost(GlueResourceMethodConfigurationTransfer $post = null)
    {
        $this->post = $post;
        $this->modifiedProperties[self::POST] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer $post
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setPostOrFail(GlueResourceMethodConfigurationTransfer $post)
    {
        return $this->setPost($post);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer
     */
    public function getPostOrFail()
    {
        if ($this->post === null) {
            $this->throwNullValueException(static::POST);
        }

        return $this->post;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requirePost()
    {
        $this->assertPropertyIsSet(self::POST);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null $patch
     *
     * @return $this
     */
    public function setPatch(GlueResourceMethodConfigurationTransfer $patch = null)
    {
        $this->patch = $patch;
        $this->modifiedProperties[self::PATCH] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null
     */
    public function getPatch()
    {
        return $this->patch;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer $patch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setPatchOrFail(GlueResourceMethodConfigurationTransfer $patch)
    {
        return $this->setPatch($patch);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer
     */
    public function getPatchOrFail()
    {
        if ($this->patch === null) {
            $this->throwNullValueException(static::PATCH);
        }

        return $this->patch;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requirePatch()
    {
        $this->assertPropertyIsSet(self::PATCH);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null $delete
     *
     * @return $this
     */
    public function setDelete(GlueResourceMethodConfigurationTransfer $delete = null)
    {
        $this->delete = $delete;
        $this->modifiedProperties[self::DELETE] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null
     */
    public function getDelete()
    {
        return $this->delete;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer $delete
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setDeleteOrFail(GlueResourceMethodConfigurationTransfer $delete)
    {
        return $this->setDelete($delete);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer
     */
    public function getDeleteOrFail()
    {
        if ($this->delete === null) {
            $this->throwNullValueException(static::DELETE);
        }

        return $this->delete;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireDelete()
    {
        $this->assertPropertyIsSet(self::DELETE);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null $options
     *
     * @return $this
     */
    public function setOptions(GlueResourceMethodConfigurationTransfer $options = null)
    {
        $this->options = $options;
        $this->modifiedProperties[self::OPTIONS] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer|null
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer $options
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setOptionsOrFail(GlueResourceMethodConfigurationTransfer $options)
    {
        return $this->setOptions($options);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer
     */
    public function getOptionsOrFail()
    {
        if ($this->options === null) {
            $this->throwNullValueException(static::OPTIONS);
        }

        return $this->options;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireOptions()
    {
        $this->assertPropertyIsSet(self::OPTIONS);

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
                case 'get':
                case 'getCollection':
                case 'post':
                case 'patch':
                case 'delete':
                case 'options':
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
                case 'get':
                case 'getCollection':
                case 'post':
                case 'patch':
                case 'delete':
                case 'options':
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
                case 'get':
                case 'getCollection':
                case 'post':
                case 'patch':
                case 'delete':
                case 'options':
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
            'get' => $this->get,
            'getCollection' => $this->getCollection,
            'post' => $this->post,
            'patch' => $this->patch,
            'delete' => $this->delete,
            'options' => $this->options,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'get' => $this->get,
            'get_collection' => $this->getCollection,
            'post' => $this->post,
            'patch' => $this->patch,
            'delete' => $this->delete,
            'options' => $this->options,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'get' => $this->get instanceof AbstractTransfer ? $this->get->toArray(true, false) : $this->get,
            'get_collection' => $this->getCollection instanceof AbstractTransfer ? $this->getCollection->toArray(true, false) : $this->getCollection,
            'post' => $this->post instanceof AbstractTransfer ? $this->post->toArray(true, false) : $this->post,
            'patch' => $this->patch instanceof AbstractTransfer ? $this->patch->toArray(true, false) : $this->patch,
            'delete' => $this->delete instanceof AbstractTransfer ? $this->delete->toArray(true, false) : $this->delete,
            'options' => $this->options instanceof AbstractTransfer ? $this->options->toArray(true, false) : $this->options,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'get' => $this->get instanceof AbstractTransfer ? $this->get->toArray(true, true) : $this->get,
            'getCollection' => $this->getCollection instanceof AbstractTransfer ? $this->getCollection->toArray(true, true) : $this->getCollection,
            'post' => $this->post instanceof AbstractTransfer ? $this->post->toArray(true, true) : $this->post,
            'patch' => $this->patch instanceof AbstractTransfer ? $this->patch->toArray(true, true) : $this->patch,
            'delete' => $this->delete instanceof AbstractTransfer ? $this->delete->toArray(true, true) : $this->delete,
            'options' => $this->options instanceof AbstractTransfer ? $this->options->toArray(true, true) : $this->options,
        ];
    }
}
