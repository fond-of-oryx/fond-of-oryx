<?php

namespace FondOfOryx\Zed\CustomerStatistic\Plugin\AuthRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerStatistic\Business\CustomerStatisticFacade;
use FondOfOryx\Zed\CustomerStatistic\Communication\Plugin\AuthRestApiExtension\CustomerStatisticPostAuthPlugin;
use FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticRepository;
use Generated\Shared\Transfer\CustomerStatisticResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OauthResponseTransfer;

class CustomerStatisticPostAuthPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\CustomerStatisticFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticRepositoryMock;

    /**
     * @var \Generated\Shared\Transfer\OauthResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oauthResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerStatisticResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticResponseTransfer;

    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Communication\Plugin\AuthRestApiExtension\CustomerStatisticPostAuthPlugin
     */
    protected $customerStatisticPostAuthPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerStatisticFacadeMock = $this->getMockBuilder(CustomerStatisticFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticRepositoryMock = $this->getMockBuilder(CustomerStatisticRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oauthResponseTransferMock = $this->getMockBuilder(OauthResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticResponseTransfer = $this->getMockBuilder(CustomerStatisticResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticPostAuthPlugin = new CustomerStatisticPostAuthPlugin();
        $this->customerStatisticPostAuthPlugin->setFacade($this->customerStatisticFacadeMock);
        $this->customerStatisticPostAuthPlugin->setRepository($this->customerStatisticRepositoryMock);
    }

    /**
     * @return void
     */
    public function testPostAuth(): void
    {
        $idCustomer = 1;
        $customerReference = sprintf('SOTRE-%s', $idCustomer);

        $this->oauthResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->customerStatisticRepositoryMock->expects(static::atLeastOnce())
            ->method('getIdCustomerByCustomerReference')
            ->with($customerReference)
            ->willReturn($idCustomer);

        $this->customerStatisticFacadeMock->expects(static::atLeastOnce())
            ->method('incrementLoginCount')
            ->with(
                static::callback(
                    static function (CustomerTransfer $customerTransfer) use ($idCustomer) {
                        return $customerTransfer->getIdCustomer() === $idCustomer;
                    },
                ),
            )->willReturn($this->customerStatisticResponseTransfer);

        $this->customerStatisticPostAuthPlugin->postAuth($this->oauthResponseTransferMock);
    }

    /**
     * @return void
     */
    public function testPostAuthWithoutCustomerReference(): void
    {
        $customerReference = null;

        $this->oauthResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->customerStatisticRepositoryMock->expects(static::never())
            ->method('getIdCustomerByCustomerReference');

        $this->customerStatisticFacadeMock->expects(static::never())
            ->method('incrementLoginCount');

        $this->customerStatisticPostAuthPlugin->postAuth($this->oauthResponseTransferMock);
    }

    /**
     * @return void
     */
    public function testPostAuthWithoutIdCustomer(): void
    {
        $idCustomer = null;
        $customerReference = sprintf('SOTRE-%s', $idCustomer);

        $this->oauthResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->customerStatisticRepositoryMock->expects(static::atLeastOnce())
            ->method('getIdCustomerByCustomerReference')
            ->with($customerReference)
            ->willReturn(null);

        $this->customerStatisticFacadeMock->expects(static::never())
            ->method('incrementLoginCount');

        $this->customerStatisticPostAuthPlugin->postAuth($this->oauthResponseTransferMock);
    }
}
