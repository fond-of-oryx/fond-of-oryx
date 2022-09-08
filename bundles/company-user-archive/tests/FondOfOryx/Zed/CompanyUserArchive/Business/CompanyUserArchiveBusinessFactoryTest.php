<?php

namespace FondOfOryx\Zed\CompanyUserArchive\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserArchive\Business\Writer\CompanyUserArchiveWriterInterface;
use FondOfOryx\Zed\CompanyUserArchive\Persistence\CompanyUserArchiveEntityManager;
use Psr\Log\LoggerInterface;
use Spryker\Shared\Log\Config\LoggerConfigInterface;

class CompanyUserArchiveBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserArchive\Persistence\CompanyUserArchiveEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserArchive\Business\CompanyUserArchiveBusinessFactory
     */
    protected $businessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Log\LoggerInterface
     */
    protected $loggerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this
            ->getMockBuilder(CompanyUserArchiveEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new class ($this->loggerMock) extends CompanyUserArchiveBusinessFactory {
            /**
             * @var \Psr\Log\LoggerInterface
             */
            protected $logger;

            /**
             * @param \Psr\Log\LoggerInterface $logger
             */
            public function __construct(LoggerInterface $logger)
            {
                $this->logger = $logger;
            }

            /**
             * @param \Spryker\Shared\Log\Config\LoggerConfigInterface|null $loggerConfig
             *
             * @return \Psr\Log\LoggerInterface
             */
            protected function getLogger(?LoggerConfigInterface $loggerConfig = null): LoggerInterface
            {
                return $this->logger;
            }
        };

        $this->businessFactory->setEntityManager($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserArchiveWriter(): void
    {
        static::assertInstanceOf(
            CompanyUserArchiveWriterInterface::class,
            $this->businessFactory->createCompanyUserArchiveWriter(),
        );
    }
}
