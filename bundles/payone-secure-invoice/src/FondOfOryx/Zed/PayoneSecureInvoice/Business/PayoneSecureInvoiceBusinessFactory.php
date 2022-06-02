<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Business;

use FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\ClearingTypeMapper;
use FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\ClearingTypeMapperInterface;
use FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\CredentialsMapper;
use FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\CredentialsMapperInterface;
use FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\TransactionIdMapper;
use FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\TransactionIdMapperInterface;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\PayoneSecureInvoice\PayoneSecureInvoiceConfig getConfig()
 * @method \FondOfOryx\Zed\PayoneSecureInvoice\Persistence\PayoneSecureInvoiceRepositoryInterface getRepository()
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
            $this->createClearingTypeMapper(),
            $this->createTransactionIdMapper(),
            $this->getConfig(),
            $this->getLogger(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\ClearingTypeMapperInterface
     */
    protected function createClearingTypeMapper(): ClearingTypeMapperInterface
    {
        return new ClearingTypeMapper();
    }

    /**
     * @return \FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\TransactionIdMapperInterface
     */
    protected function createTransactionIdMapper(): TransactionIdMapperInterface
    {
        return new TransactionIdMapper(
            $this->getRepository(),
        );
    }
}
