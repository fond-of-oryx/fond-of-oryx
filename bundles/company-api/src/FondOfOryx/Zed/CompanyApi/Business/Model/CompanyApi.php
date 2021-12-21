<?php

namespace FondOfOryx\Zed\CompanyApi\Business\Model;

use FondOfOryx\Zed\CompanyApi\Dependency\Facade\CompanyApiToCompanyFacadeInterface;
use FondOfOryx\Zed\CompanyApi\Dependency\QueryContainer\CompanyApiToApiQueryContainerInterface;
use FondOfOryx\Zed\CompanyApi\Persistence\CompanyApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;

class CompanyApi implements CompanyApiInterface
{
    /**
     * @var string
     */
    protected const KEY_ID_COMPANY = 'id_company';

    /**
     * @var \FondOfOryx\Zed\CompanyApi\Dependency\QueryContainer\CompanyApiToApiQueryContainerInterface
     */
    protected $apiQueryContainer;

    /**
     * @var \FondOfOryx\Zed\CompanyApi\Dependency\Facade\CompanyApiToCompanyFacadeInterface
     */
    protected $companyFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyApi\Persistence\CompanyApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyApi\Dependency\QueryContainer\CompanyApiToApiQueryContainerInterface $apiQueryContainer
     * @param \FondOfOryx\Zed\CompanyApi\Dependency\Facade\CompanyApiToCompanyFacadeInterface $companyFacade
     * @param \FondOfOryx\Zed\CompanyApi\Persistence\CompanyApiRepositoryInterface $repository
     */
    public function __construct(
        CompanyApiToApiQueryContainerInterface $apiQueryContainer,
        CompanyApiToCompanyFacadeInterface $companyFacade,
        CompanyApiRepositoryInterface $repository
    ) {
        $this->apiQueryContainer = $apiQueryContainer;
        $this->companyFacade = $companyFacade;
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
        $companyTransfer = (new CompanyTransfer())->fromArray($apiDataTransfer->getData(), true);
        $companyResponseTransfer = $this->companyFacade->create($companyTransfer);
        $companyTransfer = $companyResponseTransfer->getCompanyTransfer();

        if ($companyTransfer === null || !$companyResponseTransfer->getIsSuccessful()) {
            throw new EntityNotSavedException(
                sprintf('Could not create company.'),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiQueryContainer->createApiItem($companyTransfer, $companyTransfer->getIdCompany());
    }

    /**
     * @param int $idCompany
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $idCompany): ApiItemTransfer
    {
        $companyTransfer = $this->getByIdCompany($idCompany);

        return $this->apiQueryContainer->createApiItem($companyTransfer, $companyTransfer->getIdCompany());
    }

    /**
     * @param int $idCompany
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $idCompany, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $this->getByIdCompany($idCompany);

        $companyTransfer = (new CompanyTransfer())
            ->fromArray($apiDataTransfer->getData(), true)
            ->setIdCompany($idCompany);

        $companyResponseTransfer = $this->companyFacade->update($companyTransfer);
        $companyTransfer = $companyResponseTransfer->getCompanyTransfer();

        if ($companyTransfer === null || !$companyResponseTransfer->getIsSuccessful()) {
            throw new EntityNotSavedException(
                sprintf('Could not update company.'),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiQueryContainer->createApiItem($companyTransfer, $companyTransfer->getIdCompany());
    }

    /**
     * @param int $idCompany
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function remove(int $idCompany): ApiItemTransfer
    {
        $companyTransfer = (new CompanyTransfer())->setIdCompany($idCompany);

        $this->companyFacade->delete($companyTransfer);

        return $this->apiQueryContainer->createApiItem([], $idCompany);
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
            if (!isset($item[static::KEY_ID_COMPANY])) {
                continue;
            }

            $data[$index] = $this->getByIdCompany($item[static::KEY_ID_COMPANY])->toArray();
        }

        return $apiCollectionTransfer->setData($data);
    }

    /**
     * @param int $idCompany
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    protected function getByIdCompany(int $idCompany): CompanyTransfer
    {
        $companyTransfer = $this->companyFacade->findCompanyById($idCompany);

        if ($companyTransfer === null || $companyTransfer->getIdCompany() === null) {
            throw new EntityNotFoundException(
                sprintf('Could not found company.'),
                ApiConfig::HTTP_CODE_NOT_FOUND,
            );
        }

        return $companyTransfer;
    }
}
