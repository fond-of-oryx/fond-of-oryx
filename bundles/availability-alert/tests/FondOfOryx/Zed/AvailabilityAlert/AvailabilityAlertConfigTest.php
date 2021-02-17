<?php

namespace FondOfOryx\Zed\AvailabilityAlert;

use Codeception\Test\Unit;
use org\bovigo\vfs\vfsStream;
use Spryker\Shared\Config\Config;

class AvailabilityAlertConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\AvailabilityAlertConfig
     */
    protected $availabilityAlertConfig;

    /**
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    protected $vfsStreamDirectory;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->vfsStreamDirectory = vfsStream::setup('root', null, [
            'config' => [
                'Shared' => [
                    'stores.php' => file_get_contents(codecept_data_dir('stores.php')),
                    'config_default.php' => file_get_contents(codecept_data_dir('empty_config_default.php')),
                ],
            ],
        ]);

        $this->availabilityAlertConfig = new AvailabilityAlertConfig();
    }

    /**
     * @return void
     */
    public function testGetMinimalPercentageDifference()
    {
        Config::getInstance()->init();

        $this->assertEquals(50, $this->availabilityAlertConfig->getMinimalPercentageDifference());
    }

    /**
     * @return void
     */
    public function testGetCustomDefaultMinQty()
    {
        $fileUrl = vfsStream::url('root/config/Shared/config_default.php');
        $newFileContent = file_get_contents(codecept_data_dir('config_default.php'));
        file_put_contents($fileUrl, $newFileContent);

        Config::getInstance()->init();

        $this->assertEquals(10, $this->availabilityAlertConfig->getMinimalPercentageDifference());
    }
}
