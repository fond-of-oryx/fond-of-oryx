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
class QueueProcessTransfer extends AbstractTransfer
{
    /**
     * @var string
     */
    public const ID_QUEUE_PROCESS = 'idQueueProcess';

    /**
     * @var string
     */
    public const SERVER_ID = 'serverId';

    /**
     * @var string
     */
    public const PROCESS_PID = 'processPid';

    /**
     * @var string
     */
    public const WORKER_PID = 'workerPid';

    /**
     * @var string
     */
    public const QUEUE_NAME = 'queueName';

    /**
     * @var int|null
     */
    protected $idQueueProcess;

    /**
     * @var string|null
     */
    protected $serverId;

    /**
     * @var int|null
     */
    protected $processPid;

    /**
     * @var int|null
     */
    protected $workerPid;

    /**
     * @var string|null
     */
    protected $queueName;

    /**
     * @var array<string, string>
     */
    protected $transferPropertyNameMap = [
        'id_queue_process' => 'idQueueProcess',
        'idQueueProcess' => 'idQueueProcess',
        'IdQueueProcess' => 'idQueueProcess',
        'server_id' => 'serverId',
        'serverId' => 'serverId',
        'ServerId' => 'serverId',
        'process_pid' => 'processPid',
        'processPid' => 'processPid',
        'ProcessPid' => 'processPid',
        'worker_pid' => 'workerPid',
        'workerPid' => 'workerPid',
        'WorkerPid' => 'workerPid',
        'queue_name' => 'queueName',
        'queueName' => 'queueName',
        'QueueName' => 'queueName',
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected $transferMetadata = [
        self::ID_QUEUE_PROCESS => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'id_queue_process',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::SERVER_ID => [
            'type' => 'string',
            'type_shim' => null,
            'name_underscore' => 'server_id',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::PROCESS_PID => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'process_pid',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
        self::WORKER_PID => [
            'type' => 'int',
            'type_shim' => null,
            'name_underscore' => 'worker_pid',
            'is_collection' => false,
            'is_transfer' => false,
            'is_value_object' => false,
            'rest_request_parameter' => 'no',
            'is_associative' => false,
            'is_nullable' => false,
            'is_strict' => false,
        ],
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
    ];

    /**
     * @module Queue
     *
     * @param int|null $idQueueProcess
     *
     * @return $this
     */
    public function setIdQueueProcess($idQueueProcess)
    {
        $this->idQueueProcess = $idQueueProcess;
        $this->modifiedProperties[self::ID_QUEUE_PROCESS] = true;

        return $this;
    }

    /**
     * @module Queue
     *
     * @return int|null
     */
    public function getIdQueueProcess()
    {
        return $this->idQueueProcess;
    }

    /**
     * @module Queue
     *
     * @param int|null $idQueueProcess
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setIdQueueProcessOrFail($idQueueProcess)
    {
        if ($idQueueProcess === null) {
            $this->throwNullValueException(static::ID_QUEUE_PROCESS);
        }

        return $this->setIdQueueProcess($idQueueProcess);
    }

    /**
     * @module Queue
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getIdQueueProcessOrFail()
    {
        if ($this->idQueueProcess === null) {
            $this->throwNullValueException(static::ID_QUEUE_PROCESS);
        }

        return $this->idQueueProcess;
    }

    /**
     * @module Queue
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireIdQueueProcess()
    {
        $this->assertPropertyIsSet(self::ID_QUEUE_PROCESS);

        return $this;
    }

    /**
     * @module Queue
     *
     * @param string|null $serverId
     *
     * @return $this
     */
    public function setServerId($serverId)
    {
        $this->serverId = $serverId;
        $this->modifiedProperties[self::SERVER_ID] = true;

        return $this;
    }

    /**
     * @module Queue
     *
     * @return string|null
     */
    public function getServerId()
    {
        return $this->serverId;
    }

    /**
     * @module Queue
     *
     * @param string|null $serverId
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setServerIdOrFail($serverId)
    {
        if ($serverId === null) {
            $this->throwNullValueException(static::SERVER_ID);
        }

        return $this->setServerId($serverId);
    }

    /**
     * @module Queue
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return string
     */
    public function getServerIdOrFail()
    {
        if ($this->serverId === null) {
            $this->throwNullValueException(static::SERVER_ID);
        }

        return $this->serverId;
    }

    /**
     * @module Queue
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireServerId()
    {
        $this->assertPropertyIsSet(self::SERVER_ID);

        return $this;
    }

    /**
     * @module Queue
     *
     * @param int|null $processPid
     *
     * @return $this
     */
    public function setProcessPid($processPid)
    {
        $this->processPid = $processPid;
        $this->modifiedProperties[self::PROCESS_PID] = true;

        return $this;
    }

    /**
     * @module Queue
     *
     * @return int|null
     */
    public function getProcessPid()
    {
        return $this->processPid;
    }

    /**
     * @module Queue
     *
     * @param int|null $processPid
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setProcessPidOrFail($processPid)
    {
        if ($processPid === null) {
            $this->throwNullValueException(static::PROCESS_PID);
        }

        return $this->setProcessPid($processPid);
    }

    /**
     * @module Queue
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getProcessPidOrFail()
    {
        if ($this->processPid === null) {
            $this->throwNullValueException(static::PROCESS_PID);
        }

        return $this->processPid;
    }

    /**
     * @module Queue
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireProcessPid()
    {
        $this->assertPropertyIsSet(self::PROCESS_PID);

        return $this;
    }

    /**
     * @module Queue
     *
     * @param int|null $workerPid
     *
     * @return $this
     */
    public function setWorkerPid($workerPid)
    {
        $this->workerPid = $workerPid;
        $this->modifiedProperties[self::WORKER_PID] = true;

        return $this;
    }

    /**
     * @module Queue
     *
     * @return int|null
     */
    public function getWorkerPid()
    {
        return $this->workerPid;
    }

    /**
     * @module Queue
     *
     * @param int|null $workerPid
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return $this
     */
    public function setWorkerPidOrFail($workerPid)
    {
        if ($workerPid === null) {
            $this->throwNullValueException(static::WORKER_PID);
        }

        return $this->setWorkerPid($workerPid);
    }

    /**
     * @module Queue
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     *
     * @return int
     */
    public function getWorkerPidOrFail()
    {
        if ($this->workerPid === null) {
            $this->throwNullValueException(static::WORKER_PID);
        }

        return $this->workerPid;
    }

    /**
     * @module Queue
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return $this
     */
    public function requireWorkerPid()
    {
        $this->assertPropertyIsSet(self::WORKER_PID);

        return $this;
    }

    /**
     * @module Queue
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
     * @module Queue
     *
     * @return string|null
     */
    public function getQueueName()
    {
        return $this->queueName;
    }

    /**
     * @module Queue
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
     * @module Queue
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
     * @module Queue
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
                case 'idQueueProcess':
                case 'serverId':
                case 'processPid':
                case 'workerPid':
                case 'queueName':
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
                case 'idQueueProcess':
                case 'serverId':
                case 'processPid':
                case 'workerPid':
                case 'queueName':
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
                case 'idQueueProcess':
                case 'serverId':
                case 'processPid':
                case 'workerPid':
                case 'queueName':
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
            'idQueueProcess' => $this->idQueueProcess,
            'serverId' => $this->serverId,
            'processPid' => $this->processPid,
            'workerPid' => $this->workerPid,
            'queueName' => $this->queueName,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayNotRecursiveNotCamelCased(): array
    {
        return [
            'id_queue_process' => $this->idQueueProcess,
            'server_id' => $this->serverId,
            'process_pid' => $this->processPid,
            'worker_pid' => $this->workerPid,
            'queue_name' => $this->queueName,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveNotCamelCased(): array
    {
        return [
            'id_queue_process' => $this->idQueueProcess instanceof AbstractTransfer ? $this->idQueueProcess->toArray(true, false) : $this->idQueueProcess,
            'server_id' => $this->serverId instanceof AbstractTransfer ? $this->serverId->toArray(true, false) : $this->serverId,
            'process_pid' => $this->processPid instanceof AbstractTransfer ? $this->processPid->toArray(true, false) : $this->processPid,
            'worker_pid' => $this->workerPid instanceof AbstractTransfer ? $this->workerPid->toArray(true, false) : $this->workerPid,
            'queue_name' => $this->queueName instanceof AbstractTransfer ? $this->queueName->toArray(true, false) : $this->queueName,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayRecursiveCamelCased(): array
    {
        return [
            'idQueueProcess' => $this->idQueueProcess instanceof AbstractTransfer ? $this->idQueueProcess->toArray(true, true) : $this->idQueueProcess,
            'serverId' => $this->serverId instanceof AbstractTransfer ? $this->serverId->toArray(true, true) : $this->serverId,
            'processPid' => $this->processPid instanceof AbstractTransfer ? $this->processPid->toArray(true, true) : $this->processPid,
            'workerPid' => $this->workerPid instanceof AbstractTransfer ? $this->workerPid->toArray(true, true) : $this->workerPid,
            'queueName' => $this->queueName instanceof AbstractTransfer ? $this->queueName->toArray(true, true) : $this->queueName,
        ];
    }
}
