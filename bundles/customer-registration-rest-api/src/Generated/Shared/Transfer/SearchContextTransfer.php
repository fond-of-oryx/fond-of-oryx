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
class SearchContextTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const ELASTICSEARCH_CONTEXT = 'elasticsearchContext';

    /**
     * @var string
     */
    public const SOURCE_IDENTIFIER = 'sourceIdentifier';

    /**
     * @var \Generated\Shared\Transfer\ElasticsearchSearchContextTransfer|null
     */
    protected $elasticsearchContext;

    /**
     * @var string|null
     */
    protected $sourceIdentifier;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'elasticsearch_context' => 'elasticsearchContext',
        'elasticsearchContext' => 'elasticsearchContext',
        'ElasticsearchContext' => 'elasticsearchContext',
        'source_identifier' => 'sourceIdentifier',
        'sourceIdentifier' => 'sourceIdentifier',
        'SourceIdentifier' => 'sourceIdentifier',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::ELASTICSEARCH_CONTEXT => [
            'type' => 'Generated\Shared\Transfer\ElasticsearchSearchContextTransfer',
            'type_shim' => null,
            'name_underscore' => 'elasticsearch_context',
            'is_collection' => false,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::SOURCE_IDENTIFIER => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'source_identifier',
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
     * @module SearchElasticsearch
     *
     * @param \Generated\Shared\Transfer\ElasticsearchSearchContextTransfer|null $elasticsearchContext
     *
     * @return $this
     */
    public function setElasticsearchContext(ElasticsearchSearchContextTransfer $elasticsearchContext = null)
    {
        $this->elasticsearchContext = $elasticsearchContext;
        $this->modifiedProperties[self::ELASTICSEARCH_CONTEXT] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch
     *
     * @return \Generated\Shared\Transfer\ElasticsearchSearchContextTransfer|null
     */
    public function getElasticsearchContext()
    {
        return $this->elasticsearchContext;
    }

    /**
     * @module SearchElasticsearch
     *
     * @param \Generated\Shared\Transfer\ElasticsearchSearchContextTransfer $elasticsearchContext
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setElasticsearchContextOrFail(ElasticsearchSearchContextTransfer $elasticsearchContext)
    {
        return $this->setElasticsearchContext($elasticsearchContext);
    }

    /**
     * @module SearchElasticsearch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\ElasticsearchSearchContextTransfer
     */
    public function getElasticsearchContextOrFail()
    {
        if ($this->elasticsearchContext === null) {
            $this->throwNullValueException(static::ELASTICSEARCH_CONTEXT);
        }

        return $this->elasticsearchContext;
    }

    /**
     * @module SearchElasticsearch
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireElasticsearchContext()
    {
        $this->assertPropertyIsSet(self::ELASTICSEARCH_CONTEXT);

        return $this;
    }

    /**
     * @module SearchElasticsearch|SearchExtension|Search
     *
     * @param string|null $sourceIdentifier
     *
     * @return $this
     */
    public function setSourceIdentifier($sourceIdentifier)
    {
        $this->sourceIdentifier = $sourceIdentifier;
        $this->modifiedProperties[self::SOURCE_IDENTIFIER] = true;

        return $this;
    }

    /**
     * @module SearchElasticsearch|SearchExtension|Search
     *
     * @return string|null
     */
    public function getSourceIdentifier()
    {
        return $this->sourceIdentifier;
    }

    /**
     * @module SearchElasticsearch|SearchExtension|Search
     *
     * @param string|null $sourceIdentifier
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setSourceIdentifierOrFail($sourceIdentifier)
    {
        if ($sourceIdentifier === null) {
            $this->throwNullValueException(static::SOURCE_IDENTIFIER);
        }

        return $this->setSourceIdentifier($sourceIdentifier);
    }

    /**
     * @module SearchElasticsearch|SearchExtension|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getSourceIdentifierOrFail()
    {
        if ($this->sourceIdentifier === null) {
            $this->throwNullValueException(static::SOURCE_IDENTIFIER);
        }

        return $this->sourceIdentifier;
    }

    /**
     * @module SearchElasticsearch|SearchExtension|Search
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSourceIdentifier()
    {
        $this->assertPropertyIsSet(self::SOURCE_IDENTIFIER);

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
                case 'sourceIdentifier':
                    $this->$normalizedPropertyName = $value;
                    $this->modifiedProperties[$normalizedPropertyName] = true;

                    break;
                case 'elasticsearchContext':
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
                case 'sourceIdentifier':
                    $values[$arrayKey] = $value;

                    break;
                case 'elasticsearchContext':
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
                case 'sourceIdentifier':
                    $values[$arrayKey] = $value;

                    break;
                case 'elasticsearchContext':
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
            'sourceIdentifier' => $this->sourceIdentifier,
            'elasticsearchContext' => $this->elasticsearchContext,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'source_identifier' => $this->sourceIdentifier,
            'elasticsearch_context' => $this->elasticsearchContext,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'source_identifier' => $this->sourceIdentifier instanceof AbstractTransfer ? $this->sourceIdentifier->toArray(true, false) : $this->sourceIdentifier,
            'elasticsearch_context' => $this->elasticsearchContext instanceof AbstractTransfer ? $this->elasticsearchContext->toArray(true, false) : $this->elasticsearchContext,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'sourceIdentifier' => $this->sourceIdentifier instanceof AbstractTransfer ? $this->sourceIdentifier->toArray(true, true) : $this->sourceIdentifier,
            'elasticsearchContext' => $this->elasticsearchContext instanceof AbstractTransfer ? $this->elasticsearchContext->toArray(true, true) : $this->elasticsearchContext,
        ];
    }
}
