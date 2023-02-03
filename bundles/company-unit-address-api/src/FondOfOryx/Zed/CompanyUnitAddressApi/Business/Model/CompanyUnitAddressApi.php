<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model;

use FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToApiFacadeInterface;
use FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface;
use FondOfOryx\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;

class CompanyUnitAddressApi implements CompanyUnitAddressApiInterface
{
    /**
     * @var string
     */
    protected const KEY_ID_COMPANY_UNIT_ADDRESS = 'id_company_unit_address';

    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToApiFacadeInterface
     */
    protected $apiFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToApiFacadeInterface $apiFacade
     * @param \FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade
     * @param \FondOfOryx\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiRepositoryInterface $repository
     */
    public function __construct(
        CompanyUnitAddressApiToApiFacadeInterface $apiFacade,
        CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface $companyUnitAddressFacade,
        CompanyUnitAddressApiRepositoryInterface $repository
    ) {
        $this->apiFacade = $apiFacade;
        $this->companyUnitAddressFacade = $companyUnitAddressFacade;
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
        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())
            ->fromArray($apiDataTransfer->getData(), true);

        $companyUnitAddressResponseTransfer = $this->companyUnitAddressFacade->create($companyUnitAddressTransfer);
        $companyUnitAddressTransfer = $companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer();

        if ($companyUnitAddressTransfer === null || !$companyUnitAddressResponseTransfer->getIsSuccessful()) {
            throw new EntityNotSavedException(
                sprintf('Could not create company unit address.'),
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiFacade->createApiItem(
            $companyUnitAddressTransfer,
            (string)$companyUnitAddressTransfer->getIdCompanyUnitAddress(),
        );
    }

    /**
     * @param int $idCompanyUnitAddress
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $idCompanyUnitAddress): ApiItemTransfer
    {
        $companyUnitAddressTransfer = $this->getByIdCompanyUnitAddress($idCompanyUnitAddress);

        return $this->apiFacade->createApiItem($companyUnitAddressTransfer, (string)$idCompanyUnitAddress);
    }

    /**
     * @param int $idCompanyUnitAddress
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $idCompanyUnitAddress, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $companyUnitAddressTransfer = $this->getByIdCompanyUnitAddress($idCompanyUnitAddress);

        $companyUnitAddressTransfer = $companyUnitAddressTransfer->fromArray(
            $apiDataTransfer->getData(),
            true,
        );

        $companyUnitAddressResponseTransfer = $this->companyUnitAddressFacade->update($companyUnitAddressTransfer);
        $companyUnitAddressTransfer = $companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer();

        if ($companyUnitAddressTransfer === null || !$companyUnitAddressResponseTransfer->getIsSuccessful()) {
            throw new EntityNotSavedException(
                'Could not update company unit address.',
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiFacade->createApiItem(
            $companyUnitAddressTransfer,
            (string)$companyUnitAddressTransfer->getIdCompanyUnitAddress(),
        );
    }

    /**
     * @param int $idCompanyUnitAddress
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function remove(int $idCompanyUnitAddress): ApiItemTransfer
    {
        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())
            ->setIdCompanyUnitAddress($idCompanyUnitAddress);

        $this->companyUnitAddressFacade->delete($companyUnitAddressTransfer);

        return $this->apiFacade->createApiItem(null, (string)$idCompanyUnitAddress);
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
            if (!isset($item[static::KEY_ID_COMPANY_UNIT_ADDRESS])) {
                continue;
            }

            $data[$index] = $this->getByIdCompanyUnitAddress($item[static::KEY_ID_COMPANY_UNIT_ADDRESS])->toArray();
        }

        return $apiCollectionTransfer->setData($data);
    }

    /**
     * @param int $idCompanyUnitAddress
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    protected function getByIdCompanyUnitAddress(int $idCompanyUnitAddress): CompanyUnitAddressTransfer
    {
        $companyUnitAddressTransfer = (new CompanyUnitAddressTransfer())
            ->setIdCompanyUnitAddress($idCompanyUnitAddress);

        $companyUnitAddressTransfer = $this->companyUnitAddressFacade->getCompanyUnitAddressById(
            $companyUnitAddressTransfer,
        );

        if ($companyUnitAddressTransfer->getIdCompanyUnitAddress() === null) {
            throw new EntityNotFoundException(
                sprintf('Could not found company unit address.'),
                ApiConfig::HTTP_CODE_NOT_FOUND,
            );
        }

        return $companyUnitAddressTransfer;
    }
}
