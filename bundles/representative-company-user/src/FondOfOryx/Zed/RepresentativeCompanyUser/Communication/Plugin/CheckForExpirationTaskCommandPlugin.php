<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Plugin;

use FondOfOryx\Zed\RepresentativeCompanyUserExtension\Dependency\Plugin\RepresentativeCompanyUserTaskCommandPluginInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserRepositoryInterface getRepository()
 */
class CheckForExpirationTaskCommandPlugin extends AbstractPlugin implements RepresentativeCompanyUserTaskCommandPluginInterface
{
    /**
     * @var string
     */
    public const NAME = 'CheckForExpiration';

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filter
     *
     * @return void
     */
    public function run(RepresentativeCompanyUserFilterTransfer $filter): void
    {
        $this->getFacade()->checkForExpiration($filter);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }
}
