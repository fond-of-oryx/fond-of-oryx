<?php

namespace FondOfOryx\Zed\CompanyUserApi\Business\Model;

use FondOfOryx\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeInterface;
use FondOfOryx\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryContainerInterface;
use FondOfOryx\Zed\CompanyUserApi\Persistence\CompanyUserApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;

class CompanyUserApi implements CompanyUserApiInterface
{
    /**
     * @var string
     */
    protected const KEY_ID_COMPANY_USER = 'id_company_user';

    /**
     * @var \FondOfOryx\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryContainerInterface
     */
    protected $apiQueryContainer;

    /**
     * @var \FondOfOryx\Zed\CompanyUserApi\Persistence\CompanyUserApiRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeInterface
     */
    protected $companyUserFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryContainerInterface $apiQueryContainer
     * @param \FondOfOryx\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeInterface $companyUserFacade
     * @param \FondOfOryx\Zed\CompanyUserApi\Persistence\CompanyUserApiRepositoryInterface $repository
     */
    public function __construct(
        CompanyUserApiToApiQueryContainerInterface $apiQueryContainer,
        CompanyUserApiToCompanyUserFacadeInterface $companyUserFacade,
        CompanyUserApiRepositoryInterface $repository
    ) {
        $this->apiQueryContainer = $apiQueryContainer;
        $this->companyUserFacade = $companyUserFacade;
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
        $companyUserTransfer = (new CompanyUserTransfer())->fromArray($apiDataTransfer->getData(), true);
        $companyUserResponseTransfer = $this->companyUserFacade->create($companyUserTransfer);
        $companyUserTransfer = $companyUserResponseTransfer->getCompanyUser();

        if ($companyUserTransfer === null || !$companyUserResponseTransfer->getIsSuccessful()) {
            throw new EntityNotSavedException(
                'Could not create company user.',
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiQueryContainer->createApiItem($companyUserTransfer, $companyUserTransfer->getIdCompanyUser());
    }

    /**
     * @param int $idCompanyUser
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $idCompanyUser): ApiItemTransfer
    {
        $companyUserTransfer = $this->getByIdCompanyUser($idCompanyUser);

        return $this->apiQueryContainer->createApiItem($companyUserTransfer, $idCompanyUser);
    }

    /**
     * @param int $idCompanyUser
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $idCompanyUser, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $companyUserTransfer = $this->getByIdCompanyUser($idCompanyUser);

        $companyUserTransfer = $companyUserTransfer->fromArray($apiDataTransfer->getData(), true);
        $companyUserResponseTransfer = $this->companyUserFacade->update($companyUserTransfer);
        $companyUserTransfer = $companyUserResponseTransfer->getCompanyUser();

        if ($companyUserTransfer === null || !$companyUserResponseTransfer->getIsSuccessful()) {
            throw new EntityNotSavedException(
                'Could not update company user.',
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiQueryContainer->createApiItem($companyUserTransfer, $companyUserTransfer->getIdCompanyUser());
    }

    /**
     * @param int $idCompanyUser
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function remove(int $idCompanyUser): ApiItemTransfer
    {
        $companyUserTransfer = (new CompanyUserTransfer())->setIdCompanyUser($idCompanyUser);

        $this->companyUserFacade->delete($companyUserTransfer);

        return $this->apiQueryContainer->createApiItem([], $idCompanyUser);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        $data = [];
        $apiCollectionTransfer = $this->repository->find($apiRequestTransfer);

        foreach ($apiCollectionTransfer->getData() as $index => $item) {
            if (!isset($item[static::KEY_ID_COMPANY_USER])) {
                continue;
            }

            $data[$index] = $this->getByIdCompanyUser($item[static::KEY_ID_COMPANY_USER])->toArray();
        }

        return $apiCollectionTransfer->setData($data);
    }

    /**
     * @param int $idCompanyUser
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected function getByIdCompanyUser(int $idCompanyUser): CompanyUserTransfer
    {
        $companyUserTransfer = $this->companyUserFacade->getCompanyUserById($idCompanyUser);

        if ($companyUserTransfer->getIdCompanyUser() === null) {
            throw new EntityNotFoundException(
                sprintf('Could not found company user.'),
                ApiConfig::HTTP_CODE_NOT_FOUND,
            );
        }

        return $companyUserTransfer;
    }
}
