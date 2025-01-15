<?php

namespace FondOfOryx\Zed\ApiAuth\Communication\Plugin\Bootstrap;

use Closure;
use Codeception\Test\Unit;
use FondOfOryx\Zed\ApiAuth\Business\ApiAuthFacade;
use Silex\Application;

class ApiAuthBootstrapProviderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ApiAuth\Communication\Plugin\Bootstrap\ApiAuthBootstrapProvider|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiAuthBoostrapProvider;

    /**
     * @var \FondOfOryx\Zed\ApiAuth\Business\ApiAuthFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiAuthFacadeMock;

    /**
     * @var \Silex\Application|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $applicationMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $apiAuthBoostrapProvider = $this->getMockBuilder(ApiAuthBootstrapProvider::class);

        /** @phpstan-ignore-next-line */
        if (method_exists($apiAuthBoostrapProvider, 'setMethods')) {
            /** @phpstan-ignore-next-line */
            $apiAuthBoostrapProvider->setMethods(['getFacade']);
        } else {
            /** @phpstan-ignore-next-line */
            $apiAuthBoostrapProvider->onlyMethods(['getFacade'])->enableOriginalClone();
        }

        $this->apiAuthBoostrapProvider = $apiAuthBoostrapProvider->getMock();

        $this->apiAuthFacadeMock = $this->getMockBuilder(ApiAuthFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->applicationMock = $this->getMockBuilder(Application::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return void
     */
    public function testBoot(): void
    {
        $this->apiAuthBoostrapProvider->expects($this->atLeastOnce())
            ->method('getFacade')
            ->willReturn($this->apiAuthFacadeMock);

        $this->applicationMock->expects($this->atLeastOnce())
            ->method('before')
            ->with($this->isInstanceOf(Closure::class), Application::EARLY_EVENT);

        $this->apiAuthBoostrapProvider->boot($this->applicationMock);
    }

    /**
     * @return void
     */
    public function testRegister(): void
    {
        $this->apiAuthBoostrapProvider->register($this->applicationMock);
    }
}
