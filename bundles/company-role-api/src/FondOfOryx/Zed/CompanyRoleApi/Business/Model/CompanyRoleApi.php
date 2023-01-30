<?php

namespace FondOfOryx\Zed\CompanyRoleApi\Business\Model;

use FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade\CompanyRoleApiToApiFacadeInterface;
use FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade\CompanyRoleApiToCompanyRoleFacadeInterface;
use FondOfOryx\Zed\CompanyRoleApi\Persistence\CompanyRoleApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Throwable;

class CompanyRoleApi implements CompanyRoleApiInterface
{
    /**
     * @var string
     */
    public const KEY_ID_COMPANY_ROLE = 'id_company_role';

    /**
     * @var \FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade\CompanyRoleApiToApiFacadeInterface
     */
    protected $apiFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade\CompanyRoleApiToCompanyRoleFacadeInterface
     */
    protected $companyRoleFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyRoleApi\Persistence\CompanyRoleApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade\CompanyRoleApiToApiFacadeInterface $apiFacade
     * @param \FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade\CompanyRoleApiToCompanyRoleFacadeInterface $companyRoleFacade
     * @param \FondOfOryx\Zed\CompanyRoleApi\Persistence\CompanyRoleApiRepositoryInterface $repository
     */
    public function __construct(
        CompanyRoleApiToApiFacadeInterface $apiFacade,
        CompanyRoleApiToCompanyRoleFacadeInterface $companyRoleFacade,
        CompanyRoleApiRepositoryInterface $repository
    ) {
        $this->apiFacade = $apiFacade;
        $this->companyRoleFacade = $companyRoleFacade;
        $this->repository = $repository;
    }

    /**
     * @param int $idCompanyRole
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $idCompanyRole): ApiItemTransfer
    {
        $companyRoleTransfer = $this->getByIdCompanyRole($idCompanyRole);

        return $this->apiFacade->createApiItem($companyRoleTransfer, (string)$idCompanyRole);
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
            if (!isset($item[static::KEY_ID_COMPANY_ROLE])) {
                continue;
            }

            $data[$index] = $this->getByIdCompanyRole($item[static::KEY_ID_COMPANY_ROLE])->toArray();
        }

        return $apiCollectionTransfer->setData($data);
    }

    /**
     * @param int $idCompanyRole
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     *
     * @return \Generated\Shared\Transfer\CompanyRoleTransfer
     */
    protected function getByIdCompanyRole(int $idCompanyRole): CompanyRoleTransfer
    {
        $companyRoleTransfer = (new CompanyRoleTransfer())->setIdCompanyRole($idCompanyRole);

        try {
            return $this->companyRoleFacade->getCompanyRoleById($companyRoleTransfer);
        } catch (Throwable $exception) {
            throw new EntityNotFoundException(
                sprintf('Could not find company role.'),
                ApiConfig::HTTP_CODE_NOT_FOUND,
            );
        }
    }
}
