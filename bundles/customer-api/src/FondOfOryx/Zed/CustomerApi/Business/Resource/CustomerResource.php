<?php

namespace FondOfOryx\Zed\CustomerApi\Business\Resource;

use FondOfOryx\Zed\CustomerApi\Business\Mapper\CustomerApiMapperInterface;
use FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToApiFacadeInterface;
use FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerApi\Persistence\CustomerApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;

class CustomerResource implements CustomerResourceInterface
{
    /**
     * @var string
     */
    protected const KEY_ID_CUSTOMER = 'id_customer';

    /**
     * @var \FondOfOryx\Zed\CustomerApi\Business\Mapper\CustomerApiMapperInterface
     */
    protected CustomerApiMapperInterface $customerApiMapper;

    /**
     * @var \FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToApiFacadeInterface
     */
    protected CustomerApiToApiFacadeInterface $apiFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToCustomerFacadeInterface
     */
    protected CustomerApiToCustomerFacadeInterface $customerFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerApi\Persistence\CustomerApiRepositoryInterface
     */
    protected CustomerApiRepositoryInterface $repository;

    /**
     * @param \FondOfOryx\Zed\CustomerApi\Business\Mapper\CustomerApiMapperInterface $customerApiMapper
     * @param \FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToApiFacadeInterface $apiFacade
     * @param \FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToCustomerFacadeInterface $customerFacade
     * @param \FondOfOryx\Zed\CustomerApi\Persistence\CustomerApiRepositoryInterface $repository
     */
    public function __construct(
        CustomerApiMapperInterface $customerApiMapper,
        CustomerApiToApiFacadeInterface $apiFacade,
        CustomerApiToCustomerFacadeInterface $customerFacade,
        CustomerApiRepositoryInterface $repository
    ) {
        $this->customerApiMapper = $customerApiMapper;
        $this->apiFacade = $apiFacade;
        $this->customerFacade = $customerFacade;
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $customerTransfer = (new CustomerTransfer())->fromArray($apiDataTransfer->getData(), true);
        $customerResponseTransfer = $this->customerFacade->addCustomer($customerTransfer);
        $customerTransfer = $customerResponseTransfer->getCustomerTransfer();

        if ($customerTransfer === null || !$customerResponseTransfer->getIsSuccess()) {
            throw new EntityNotSavedException(
                sprintf('Could not create customer.'),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiFacade->createApiItem(
            $this->customerApiMapper->fromCustomer($customerTransfer),
            (string)$customerTransfer->getIdCustomer(),
        );
    }

    /**
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $id): ApiItemTransfer
    {
        $customerTransfer = $this->getCustomerById($id);

        return $this->apiFacade->createApiItem(
            $this->customerApiMapper->fromCustomer($customerTransfer),
            (string)$customerTransfer->getIdCustomer(),
        );
    }

    /**
     * @param int $id
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $id, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $customerTransfer = $this->getCustomerById($id);
        $customerTransfer = $customerTransfer->fromArray($apiDataTransfer->getData(), true);
        $customerResponseTransfer = $this->customerFacade->updateCustomer($customerTransfer);
        $customerTransfer = $customerResponseTransfer->getCustomerTransfer();

        if ($customerTransfer === null || !$customerResponseTransfer->getIsSuccess()) {
            throw new EntityNotSavedException(
                sprintf('Could not update customer.'),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiFacade->createApiItem(
            $this->customerApiMapper->fromCustomer($customerTransfer),
            (string)$customerTransfer->getIdCustomer(),
        );
    }

    /**
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function remove(int $id): ApiItemTransfer
    {
        $customerTransfer = (new CustomerTransfer())->setIdCustomer($id);

        $this->customerFacade->deleteCustomer($customerTransfer);

        return $this->apiFacade->createApiItem(null, (string)$id);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        $data = [];
        $apiCollectionTransfer = $this->repository->findCustomersByApiRequest($apiRequestTransfer);

        foreach ($apiCollectionTransfer->getData() as $index => $item) {
            if (!isset($item[static::KEY_ID_CUSTOMER])) {
                continue;
            }

            $customerApiTransfer = $this->customerApiMapper->fromCustomer(
                $this->getCustomerById($item[static::KEY_ID_CUSTOMER]),
            );

            $data[$index] = $customerApiTransfer->toArray();
        }

        return $apiCollectionTransfer->setData($data);
    }

    /**
     * @param int $id
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    protected function getCustomerById(int $id): CustomerTransfer
    {
        $customerTransfer = (new CustomerTransfer())->setIdCustomer($id);

        $customerTransfer = $this->customerFacade->findCustomerById($customerTransfer);

        if ($customerTransfer === null || $customerTransfer->getIdCustomer() === null) {
            throw new EntityNotFoundException(
                sprintf('Could not found customer.'),
                ApiConfig::HTTP_CODE_NOT_FOUND,
            );
        }

        return $customerTransfer;
    }
}
