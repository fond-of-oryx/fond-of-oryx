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
class GlueResponseTransfer extends AbstractTransfer
{
    /**
     * @deprecated Use `httpStatus` property for HTTP status.
     */
    public const STATUS = 'status';

    /**
     * @var string
     */
    public const HTTP_STATUS = 'httpStatus';

    /**
     * @var string
     */
    public const META = 'meta';

    /**
     * @var string
     */
    public const CONTENT = 'content';

    /**
     * @var string
     */
    public const ALTERNATIVE_PATH = 'alternativePath';

    /**
     * @var string
     */
    public const REQUEST_VALIDATION = 'requestValidation';

    /**
     * @var string
     */
    public const ERRORS = 'errors';

    /**
     * @var string
     */
    public const FILTERS = 'filters';

    /**
     * @var string
     */
    public const SORTINGS = 'sortings';

    /**
     * @var string
     */
    public const PAGINATION = 'pagination';

    /**
     * @var string
     */
    public const RESOURCES = 'resources';

    /**
     * @var string
     */
    public const FORMAT = 'format';

    /**
     * @var string|null
     */
    protected $status;

    /**
     * @var int|null
     */
    protected $httpStatus;

    /**
     * @var array
     */
    protected $meta = [];

    /**
     * @var string|null
     */
    protected $content;

    /**
     * @var string|null
     */
    protected $alternativePath;

    /**
     * @var \Generated\Shared\Transfer\GlueRequestValidationTransfer|null
     */
    protected $requestValidation;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\GlueErrorTransfer[]
     */
    protected $errors;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\GlueFilterTransfer[]
     */
    protected $filters;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\SortTransfer[]
     */
    protected $sortings;

    /**
     * @var \Generated\Shared\Transfer\PaginationTransfer|null
     */
    protected $pagination;

    /**
     * @var \ArrayObject|\Generated\Shared\Transfer\GlueResourceTransfer[]
     */
    protected $resources;

    /**
     * @var string|null
     */
    protected $format;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'status' => 'status',
        'Status' => 'status',
        'http_status' => 'httpStatus',
        'httpStatus' => 'httpStatus',
        'HttpStatus' => 'httpStatus',
        'meta' => 'meta',
        'Meta' => 'meta',
        'content' => 'content',
        'Content' => 'content',
        'alternative_path' => 'alternativePath',
        'alternativePath' => 'alternativePath',
        'AlternativePath' => 'alternativePath',
        'request_validation' => 'requestValidation',
        'requestValidation' => 'requestValidation',
        'RequestValidation' => 'requestValidation',
        'errors' => 'errors',
        'Errors' => 'errors',
        'filters' => 'filters',
        'Filters' => 'filters',
        'sortings' => 'sortings',
        'Sortings' => 'sortings',
        'pagination' => 'pagination',
        'Pagination' => 'pagination',
        'resources' => 'resources',
        'Resources' => 'resources',
        'format' => 'format',
        'Format' => 'format',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::STATUS => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'status',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::HTTP_STATUS => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'http_status',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::META => [
            'type' => 'array',
            'type_shim' => null,
            'name_underscore' => 'meta',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => true,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::CONTENT => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'content',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::ALTERNATIVE_PATH => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'alternative_path',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::REQUEST_VALIDATION => [
            'type' => 'Generated\Shared\Transfer\GlueRequestValidationTransfer',
            'type_shim' => null,
            'name_underscore' => 'request_validation',
            'is_collection' => false,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::ERRORS => [
            'type' => 'Generated\Shared\Transfer\GlueErrorTransfer',
            'type_shim' => null,
            'name_underscore' => 'errors',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::FILTERS => [
            'type' => 'Generated\Shared\Transfer\GlueFilterTransfer',
            'type_shim' => null,
            'name_underscore' => 'filters',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::SORTINGS => [
            'type' => 'Generated\Shared\Transfer\SortTransfer',
            'type_shim' => null,
            'name_underscore' => 'sortings',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::PAGINATION => [
            'type' => 'Generated\Shared\Transfer\PaginationTransfer',
            'type_shim' => null,
            'name_underscore' => 'pagination',
            'is_collection' => false,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::RESOURCES => [
            'type' => 'Generated\Shared\Transfer\GlueResourceTransfer',
            'type_shim' => null,
            'name_underscore' => 'resources',
            'is_collection' => true,
            'is_transfer' => true,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::FORMAT => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'format',
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
     * @module GlueApplication
     *
     * @deprecated Use `httpStatus` property for HTTP status.
     *
     * @param string|null $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        $this->modifiedProperties[self::STATUS] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @deprecated Use `httpStatus` property for HTTP status.
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @module GlueApplication
     *
     * @deprecated Use `httpStatus` property for HTTP status.
     *
     * @param string|null $status
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setStatusOrFail($status)
    {
        if ($status === null) {
            $this->throwNullValueException(static::STATUS);
        }

        return $this->setStatus($status);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @deprecated Use `httpStatus` property for HTTP status.
     *
     * @return string
     */
    public function getStatusOrFail()
    {
        if ($this->status === null) {
            $this->throwNullValueException(static::STATUS);
        }

        return $this->status;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @deprecated Use `httpStatus` property for HTTP status.
     *
     * @return $this
     */
    public function requireStatus()
    {
        $this->assertPropertyIsSet(self::STATUS);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param int|null $httpStatus
     *
     * @return $this
     */
    public function setHttpStatus($httpStatus)
    {
        $this->httpStatus = $httpStatus;
        $this->modifiedProperties[self::HTTP_STATUS] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return int|null
     */
    public function getHttpStatus()
    {
        return $this->httpStatus;
    }

    /**
     * @module GlueApplication
     *
     * @param int|null $httpStatus
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setHttpStatusOrFail($httpStatus)
    {
        if ($httpStatus === null) {
            $this->throwNullValueException(static::HTTP_STATUS);
        }

        return $this->setHttpStatus($httpStatus);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getHttpStatusOrFail()
    {
        if ($this->httpStatus === null) {
            $this->throwNullValueException(static::HTTP_STATUS);
        }

        return $this->httpStatus;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireHttpStatus()
    {
        $this->assertPropertyIsSet(self::HTTP_STATUS);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param array $meta
     *
     * @return $this
     */
    public function setMeta($meta)
    {
        if ($meta === null) {
            $meta = [];
        }

        $this->meta = $meta;
        $this->modifiedProperties[self::META] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @module GlueApplication
     *
     * @param string|int $metaKey
     * @param mixed $metaValue
     *
     * @return $this
     */
    public function addMeta($metaKey, $metaValue)
    {
        $this->meta[$metaKey] = $metaValue;
        $this->modifiedProperties[self::META] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireMeta()
    {
        $this->assertPropertyIsSet(self::META);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param string|null $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;
        $this->modifiedProperties[self::CONTENT] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @module GlueApplication
     *
     * @param string|null $content
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setContentOrFail($content)
    {
        if ($content === null) {
            $this->throwNullValueException(static::CONTENT);
        }

        return $this->setContent($content);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getContentOrFail()
    {
        if ($this->content === null) {
            $this->throwNullValueException(static::CONTENT);
        }

        return $this->content;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireContent()
    {
        $this->assertPropertyIsSet(self::CONTENT);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param string|null $alternativePath
     *
     * @return $this
     */
    public function setAlternativePath($alternativePath)
    {
        $this->alternativePath = $alternativePath;
        $this->modifiedProperties[self::ALTERNATIVE_PATH] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return string|null
     */
    public function getAlternativePath()
    {
        return $this->alternativePath;
    }

    /**
     * @module GlueApplication
     *
     * @param string|null $alternativePath
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setAlternativePathOrFail($alternativePath)
    {
        if ($alternativePath === null) {
            $this->throwNullValueException(static::ALTERNATIVE_PATH);
        }

        return $this->setAlternativePath($alternativePath);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getAlternativePathOrFail()
    {
        if ($this->alternativePath === null) {
            $this->throwNullValueException(static::ALTERNATIVE_PATH);
        }

        return $this->alternativePath;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireAlternativePath()
    {
        $this->assertPropertyIsSet(self::ALTERNATIVE_PATH);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\GlueRequestValidationTransfer|null $requestValidation
     *
     * @return $this
     */
    public function setRequestValidation(GlueRequestValidationTransfer $requestValidation = null)
    {
        $this->requestValidation = $requestValidation;
        $this->modifiedProperties[self::REQUEST_VALIDATION] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return \Generated\Shared\Transfer\GlueRequestValidationTransfer|null
     */
    public function getRequestValidation()
    {
        return $this->requestValidation;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\GlueRequestValidationTransfer $requestValidation
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setRequestValidationOrFail(GlueRequestValidationTransfer $requestValidation)
    {
        return $this->setRequestValidation($requestValidation);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\GlueRequestValidationTransfer
     */
    public function getRequestValidationOrFail()
    {
        if ($this->requestValidation === null) {
            $this->throwNullValueException(static::REQUEST_VALIDATION);
        }

        return $this->requestValidation;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireRequestValidation()
    {
        $this->assertPropertyIsSet(self::REQUEST_VALIDATION);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\GlueErrorTransfer[] $errors
     *
     * @return $this
     */
    public function setErrors(ArrayObject $errors)
    {
        $this->errors = $errors;
        $this->modifiedProperties[self::ERRORS] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\GlueErrorTransfer[]
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\GlueErrorTransfer $error
     *
     * @return $this
     */
    public function addError(GlueErrorTransfer $error)
    {
        $this->errors[] = $error;
        $this->modifiedProperties[self::ERRORS] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireErrors()
    {
        $this->assertCollectionPropertyIsSet(self::ERRORS);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\GlueFilterTransfer[] $filters
     *
     * @return $this
     */
    public function setFilters(ArrayObject $filters)
    {
        $this->filters = $filters;
        $this->modifiedProperties[self::FILTERS] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\GlueFilterTransfer[]
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\GlueFilterTransfer $filter
     *
     * @return $this
     */
    public function addFilter(GlueFilterTransfer $filter)
    {
        $this->filters[] = $filter;
        $this->modifiedProperties[self::FILTERS] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireFilters()
    {
        $this->assertCollectionPropertyIsSet(self::FILTERS);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\SortTransfer[] $sortings
     *
     * @return $this
     */
    public function setSortings(ArrayObject $sortings)
    {
        $this->sortings = $sortings;
        $this->modifiedProperties[self::SORTINGS] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\SortTransfer[]
     */
    public function getSortings()
    {
        return $this->sortings;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\SortTransfer $sorting
     *
     * @return $this
     */
    public function addSorting(SortTransfer $sorting)
    {
        $this->sortings[] = $sorting;
        $this->modifiedProperties[self::SORTINGS] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireSortings()
    {
        $this->assertCollectionPropertyIsSet(self::SORTINGS);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\PaginationTransfer|null $pagination
     *
     * @return $this
     */
    public function setPagination(PaginationTransfer $pagination = null)
    {
        $this->pagination = $pagination;
        $this->modifiedProperties[self::PAGINATION] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return \Generated\Shared\Transfer\PaginationTransfer|null
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\PaginationTransfer $pagination
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setPaginationOrFail(PaginationTransfer $pagination)
    {
        return $this->setPagination($pagination);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return \Generated\Shared\Transfer\PaginationTransfer
     */
    public function getPaginationOrFail()
    {
        if ($this->pagination === null) {
            $this->throwNullValueException(static::PAGINATION);
        }

        return $this->pagination;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requirePagination()
    {
        $this->assertPropertyIsSet(self::PAGINATION);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param \ArrayObject|\Generated\Shared\Transfer\GlueResourceTransfer[] $resources
     *
     * @return $this
     */
    public function setResources(ArrayObject $resources)
    {
        $this->resources = $resources;
        $this->modifiedProperties[self::RESOURCES] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\GlueResourceTransfer[]
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * @module GlueApplication
     *
     * @param \Generated\Shared\Transfer\GlueResourceTransfer $resource
     *
     * @return $this
     */
    public function addResource(GlueResourceTransfer $resource)
    {
        $this->resources[] = $resource;
        $this->modifiedProperties[self::RESOURCES] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireResources()
    {
        $this->assertCollectionPropertyIsSet(self::RESOURCES);

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @param string|null $format
     *
     * @return $this
     */
    public function setFormat($format)
    {
        $this->format = $format;
        $this->modifiedProperties[self::FORMAT] = true;

        return $this;
    }

    /**
     * @module GlueApplication
     *
     * @return string|null
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @module GlueApplication
     *
     * @param string|null $format
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setFormatOrFail($format)
    {
        if ($format === null) {
            $this->throwNullValueException(static::FORMAT);
        }

        return $this->setFormat($format);
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getFormatOrFail()
    {
        if ($this->format === null) {
            $this->throwNullValueException(static::FORMAT);
        }

        return $this->format;
    }

    /**
     * @module GlueApplication
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireFormat()
    {
        $this->assertPropertyIsSet(self::FORMAT);

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
                case 'status':
                case 'httpStatus':
                case 'meta':
                case 'content':
                case 'alternativePath':
                case 'format':
                    $this->$normalizedPropertyName = $value;
                    $this->modifiedProperties[$normalizedPropertyName] = true;

                    break;
                case 'requestValidation':
                case 'pagination':
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
                case 'errors':
                case 'filters':
                case 'sortings':
                case 'resources':
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
                case 'status':
                case 'httpStatus':
                case 'meta':
                case 'content':
                case 'alternativePath':
                case 'format':
                    $values[$arrayKey] = $value;

                    break;
                case 'requestValidation':
                case 'pagination':
                    $values[$arrayKey] = $value instanceof AbstractTransfer ? $value->modifiedToArray(true, true) : $value;

                    break;
                case 'errors':
                case 'filters':
                case 'sortings':
                case 'resources':
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
                case 'status':
                case 'httpStatus':
                case 'meta':
                case 'content':
                case 'alternativePath':
                case 'format':
                    $values[$arrayKey] = $value;

                    break;
                case 'requestValidation':
                case 'pagination':
                    $values[$arrayKey] = $value instanceof AbstractTransfer ? $value->modifiedToArray(true, false) : $value;

                    break;
                case 'errors':
                case 'filters':
                case 'sortings':
                case 'resources':
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
        $this->errors = $this->errors ?: new ArrayObject();
        $this->filters = $this->filters ?: new ArrayObject();
        $this->sortings = $this->sortings ?: new ArrayObject();
        $this->resources = $this->resources ?: new ArrayObject();
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveCamelCased(): array
    {
        return [
            'status' => $this->status,
            'httpStatus' => $this->httpStatus,
            'meta' => $this->meta,
            'content' => $this->content,
            'alternativePath' => $this->alternativePath,
            'format' => $this->format,
            'requestValidation' => $this->requestValidation,
            'pagination' => $this->pagination,
            'errors' => $this->errors,
            'filters' => $this->filters,
            'sortings' => $this->sortings,
            'resources' => $this->resources,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'status' => $this->status,
            'http_status' => $this->httpStatus,
            'meta' => $this->meta,
            'content' => $this->content,
            'alternative_path' => $this->alternativePath,
            'format' => $this->format,
            'request_validation' => $this->requestValidation,
            'pagination' => $this->pagination,
            'errors' => $this->errors,
            'filters' => $this->filters,
            'sortings' => $this->sortings,
            'resources' => $this->resources,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'status' => $this->status instanceof AbstractTransfer ? $this->status->toArray(true, false) : $this->status,
            'http_status' => $this->httpStatus instanceof AbstractTransfer ? $this->httpStatus->toArray(true, false) : $this->httpStatus,
            'meta' => $this->meta instanceof AbstractTransfer ? $this->meta->toArray(true, false) : $this->meta,
            'content' => $this->content instanceof AbstractTransfer ? $this->content->toArray(true, false) : $this->content,
            'alternative_path' => $this->alternativePath instanceof AbstractTransfer ? $this->alternativePath->toArray(true, false) : $this->alternativePath,
            'format' => $this->format instanceof AbstractTransfer ? $this->format->toArray(true, false) : $this->format,
            'request_validation' => $this->requestValidation instanceof AbstractTransfer ? $this->requestValidation->toArray(true, false) : $this->requestValidation,
            'pagination' => $this->pagination instanceof AbstractTransfer ? $this->pagination->toArray(true, false) : $this->pagination,
            'errors' => $this->errors instanceof AbstractTransfer ? $this->errors->toArray(true, false) : $this->addValuesToCollection($this->errors, true, false),
            'filters' => $this->filters instanceof AbstractTransfer ? $this->filters->toArray(true, false) : $this->addValuesToCollection($this->filters, true, false),
            'sortings' => $this->sortings instanceof AbstractTransfer ? $this->sortings->toArray(true, false) : $this->addValuesToCollection($this->sortings, true, false),
            'resources' => $this->resources instanceof AbstractTransfer ? $this->resources->toArray(true, false) : $this->addValuesToCollection($this->resources, true, false),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'status' => $this->status instanceof AbstractTransfer ? $this->status->toArray(true, true) : $this->status,
            'httpStatus' => $this->httpStatus instanceof AbstractTransfer ? $this->httpStatus->toArray(true, true) : $this->httpStatus,
            'meta' => $this->meta instanceof AbstractTransfer ? $this->meta->toArray(true, true) : $this->meta,
            'content' => $this->content instanceof AbstractTransfer ? $this->content->toArray(true, true) : $this->content,
            'alternativePath' => $this->alternativePath instanceof AbstractTransfer ? $this->alternativePath->toArray(true, true) : $this->alternativePath,
            'format' => $this->format instanceof AbstractTransfer ? $this->format->toArray(true, true) : $this->format,
            'requestValidation' => $this->requestValidation instanceof AbstractTransfer ? $this->requestValidation->toArray(true, true) : $this->requestValidation,
            'pagination' => $this->pagination instanceof AbstractTransfer ? $this->pagination->toArray(true, true) : $this->pagination,
            'errors' => $this->errors instanceof AbstractTransfer ? $this->errors->toArray(true, true) : $this->addValuesToCollection($this->errors, true, true),
            'filters' => $this->filters instanceof AbstractTransfer ? $this->filters->toArray(true, true) : $this->addValuesToCollection($this->filters, true, true),
            'sortings' => $this->sortings instanceof AbstractTransfer ? $this->sortings->toArray(true, true) : $this->addValuesToCollection($this->sortings, true, true),
            'resources' => $this->resources instanceof AbstractTransfer ? $this->resources->toArray(true, true) : $this->addValuesToCollection($this->resources, true, true),
        ];
    }
}
