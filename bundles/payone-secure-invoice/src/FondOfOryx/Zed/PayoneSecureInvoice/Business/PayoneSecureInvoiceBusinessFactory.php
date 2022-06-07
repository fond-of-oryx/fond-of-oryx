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
use SprykerEco\Shared\Payone\Dependency\HashInterface;
use SprykerEco\Zed\Payone\Business\Key\HashGenerator;
use SprykerEco\Zed\Payone\Business\Key\HashGeneratorInterface;
use SprykerEco\Zed\Payone\Business\Key\HashProvider;

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
        return new ClearingTypeMapper(
            $this->createHashGenerator(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\PayoneSecureInvoice\Business\Mapper\TransactionIdMapperInterface
     */
    protected function createTransactionIdMapper(): TransactionIdMapperInterface
    {
        return new TransactionIdMapper(
            $this->getRepository(),
            $this->createHashGenerator(),
        );
    }

    /**
     * @return \SprykerEco\Shared\Payone\Dependency\HashInterface
     */
    protected function createHashProvider(): HashInterface
    {
        return new HashProvider();
    }

    /**
     * @return \SprykerEco\Zed\Payone\Business\Key\HashGeneratorInterface
     */
    protected function createHashGenerator(): HashGeneratorInterface
    {
        return new HashGenerator(
            $this->createHashProvider(),
        );
    }
}
