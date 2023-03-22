<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model;

use Exception;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToApiFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;

class CompanyBusinessUnitApi implements CompanyBusinessUnitApiInterface
{
    /**
     * @var string
     */
    protected const KEY_ID_COMPANY_BUSINESS_UNIT = 'id_company_business_unit';

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToApiFacadeInterface
     */
    protected $apiFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToApiFacadeInterface $apiFacade
     * @param \FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
     * @param \FondOfOryx\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiRepositoryInterface $repository
     */
    public function __construct(
        CompanyBusinessUnitApiToApiFacadeInterface $apiFacade,
        CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade,
        CompanyBusinessUnitApiRepositoryInterface $repository
    ) {
        $this->apiFacade = $apiFacade;
        $this->companyBusinessUnitFacade = $companyBusinessUnitFacade;
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
        $companyBusinessUnitTransfer = (new CompanyBusinessUnitTransfer())
            ->fromArray($apiDataTransfer->getData(), true);
        $companyBusinessUnitResponseTransfer = $this->companyBusinessUnitFacade->create($companyBusinessUnitTransfer);
        $companyBusinessUnitTransfer = $companyBusinessUnitResponseTransfer->getCompanyBusinessUnitTransfer();

        if ($companyBusinessUnitTransfer === null || !$companyBusinessUnitResponseTransfer->getIsSuccessful()) {
            throw new EntityNotSavedException(
                sprintf('Could not create company business unit.'),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiFacade->createApiItem(
            $companyBusinessUnitTransfer,
            (string)$companyBusinessUnitTransfer->getIdCompanyBusinessUnit(),
        );
    }

    /**
     * @param int $idCompanyBusinessUnit
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $idCompanyBusinessUnit): ApiItemTransfer
    {
        $companyBusinessUnitTransfer = $this->getByIdCompanyBusinessUnit($idCompanyBusinessUnit);

        return $this->apiFacade->createApiItem(
            $companyBusinessUnitTransfer,
            (string)$companyBusinessUnitTransfer->getIdCompanyBusinessUnit(),
        );
    }

    /**
     * @param int $idCompanyBusinessUnit
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $idCompanyBusinessUnit, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $companyBusinessUnitTransfer = $this->getByIdCompanyBusinessUnit($idCompanyBusinessUnit);

        $companyBusinessUnitTransfer->fromArray($apiDataTransfer->getData(), true);

        $companyBusinessUnitResponseTransfer = $this->companyBusinessUnitFacade->update($companyBusinessUnitTransfer);

        $companyBusinessUnitTransfer = $companyBusinessUnitResponseTransfer->getCompanyBusinessUnitTransfer();

        if ($companyBusinessUnitTransfer === null || !$companyBusinessUnitResponseTransfer->getIsSuccessful()) {
            throw new EntityNotSavedException(
                sprintf('Could not update company business unit.'),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiFacade->createApiItem(
            $companyBusinessUnitTransfer,
            (string)$companyBusinessUnitTransfer->getIdCompanyBusinessUnit(),
        );
    }

    /**
     * @param int $idCompanyBusinessUnit
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function remove(int $idCompanyBusinessUnit): ApiItemTransfer
    {
        $companyBusinessUnitTransfer = (new CompanyBusinessUnitTransfer())
            ->setIdCompanyBusinessUnit($idCompanyBusinessUnit);

        $this->companyBusinessUnitFacade->delete($companyBusinessUnitTransfer);

        return $this->apiFacade->createApiItem(null, (string)$idCompanyBusinessUnit);
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
            if (!isset($item[static::KEY_ID_COMPANY_BUSINESS_UNIT])) {
                continue;
            }

            $data[$index] = $this->getByIdCompanyBusinessUnit($item[static::KEY_ID_COMPANY_BUSINESS_UNIT])->toArray();
        }

        return $apiCollectionTransfer->setData($data);
    }

    /**
     * @param int $idCompanyBusinessUnit
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected function getByIdCompanyBusinessUnit(int $idCompanyBusinessUnit): CompanyBusinessUnitTransfer
    {
        try {
            $companyBusinessUnitTransfer = (new CompanyBusinessUnitTransfer())
                ->setIdCompanyBusinessUnit($idCompanyBusinessUnit);

            return $this->companyBusinessUnitFacade->getCompanyBusinessUnitById(
                $companyBusinessUnitTransfer,
            );
        } catch (Exception $exception) {
            throw new EntityNotFoundException(
                sprintf('Could not find company business unit.'),
                ApiConfig::HTTP_CODE_NOT_FOUND,
            );
        }
    }
}
