<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Business;

use FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\ClearingTypeMapper;
use FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\ClearingTypeMapperInterface;
use FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\CredentialsMapper;
use FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\CredentialsMapperInterface;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\PayoneSecureInvoice\PayoneSecureInvoiceConfig getConfig()
 */
class PayoneSecureInvoiceBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\CredentialsMapperInterface
     */
    public function createCredentialsMapper(): CredentialsMapperInterface
    {
        return new CredentialsMapper(
            $this->getConfig()->getCredentials(),
            $this->getLogger(),
            $this->createClearingTypeMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\ClearingTypeMapperInterface
     */
    protected function createClearingTypeMapper(): ClearingTypeMapperInterface
    {
        return new ClearingTypeMapper();
    }
}
