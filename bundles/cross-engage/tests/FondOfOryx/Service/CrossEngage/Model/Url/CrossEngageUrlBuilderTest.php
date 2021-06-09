<?php

namespace FondOfOryx\Service\CrossEngage\Model\Url;

use Codeception\Test\Unit;
use FondOfOryx\Service\CrossEngage\CrossEngageConfig;
use FondOfOryx\Shared\CrossEngage\CrossEngageConstants;

class CrossEngageUrlBuilderTest extends Unit
{
    /**
     * @var \FondOfOryx\Service\CrossEngage\CrossEngageConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Service\CrossEngage\Model\Url\CrossEngageUrlBuilderInterface
     */
    protected $url;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(CrossEngageConfig::class)->disableOriginalConstructor()->getMock();

        $this->url = new CrossEngageUrlBuilder($this->configMock);
    }

    /**
     * @return void
     */
    public function testBuildOptInUrl(): void
    {
        $params = ['a', 'b', 'c'];
        $host = 'YVESHOST';
        $this->configMock->expects(static::once())->method('getOptInPathPattern')->willReturn(CrossEngageConstants::OPT_IN_PATH_PATTERN_DEFAULT);
        $this->configMock->expects(static::once())->method('getHostYves')->willReturn($host);

        static::assertSame($host . '/' . vsprintf(CrossEngageConstants::OPT_IN_PATH_PATTERN_DEFAULT, $params), $this->url->buildOptInUrl($params));
    }

    /**
     * @return void
     */
    public function testBuildOptOutUrl(): void
    {
        $params = ['a', 'b', 'c'];
        $host = 'YVESHOST';
        $this->configMock->expects(static::once())->method('getOptoutPathPattern')->willReturn(CrossEngageConstants::OPT_OUT_PATH_PATTERN_DEFAULT);
        $this->configMock->expects(static::once())->method('getHostYves')->willReturn($host);

        static::assertSame($host . '/' . vsprintf(CrossEngageConstants::OPT_OUT_PATH_PATTERN_DEFAULT, $params), $this->url->buildOptOutUrl($params));
    }

    /**
     * @return void
     */
    public function testBuildRedirectUrlIntern(): void
    {
        $queryString = 'QUERY';
        $paramsFull = ['a', 'b', 'c', CrossEngageConstants::QUERY_STRING => $queryString];
        $params = ['a', 'b', 'c'];
        $this->configMock->expects(static::once())->method('getCrossEngageRedirectPattern')->willReturn(CrossEngageConstants::CROSSENGAGE_REDIRECT_PATTERN_DEFAULT);
        $this->configMock->expects(static::never())->method('getHostYves');

        static::assertSame('/' . vsprintf(CrossEngageConstants::CROSSENGAGE_REDIRECT_PATTERN_DEFAULT, $params) . '?' . $queryString, $this->url->buildRedirectUrl($paramsFull, false));
    }

    /**
     * @return void
     */
    public function testBuildRedirectUrlExternal(): void
    {
        $queryString = 'QUERY';
        $paramsFull = ['a', 'b', 'c', CrossEngageConstants::QUERY_STRING => $queryString];
        $params = ['a', 'b', 'c'];
        $host = 'YVESHOST';
        $this->configMock->expects(static::once())->method('getCrossEngageRedirectPattern')->willReturn(CrossEngageConstants::CROSSENGAGE_REDIRECT_PATTERN_DEFAULT);
        $this->configMock->expects(static::once())->method('getHostYves')->willReturn($host);

        static::assertSame($host . '/' . vsprintf(CrossEngageConstants::CROSSENGAGE_REDIRECT_PATTERN_DEFAULT, $params) . '?' . $queryString, $this->url->buildRedirectUrl($paramsFull, true));
    }
}
