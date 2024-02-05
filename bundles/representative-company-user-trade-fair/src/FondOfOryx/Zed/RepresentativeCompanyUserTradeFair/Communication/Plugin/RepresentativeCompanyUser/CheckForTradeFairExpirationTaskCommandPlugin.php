<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Communication\Plugin\RepresentativeCompanyUser;

use FondOfOryx\Zed\RepresentativeCompanyUserExtension\Dependency\Plugin\RepresentativeCompanyUserTaskCommandPluginInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserRepositoryInterface getRepository()
 */
class CheckForTradeFairExpirationTaskCommandPlugin extends AbstractPlugin implements RepresentativeCompanyUserTaskCommandPluginInterface
{
    /**
     * @var string
     */
    public const NAME = 'CheckForTradeFairExpiration';

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filter
     *
     * @return void
     */
    public function run(RepresentativeCompanyUserFilterTransfer $filter): void
    {
        $this->getFacade()->checkForTradeFairExpiration($filter);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }
}
