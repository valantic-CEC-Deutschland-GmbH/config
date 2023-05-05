<?php

declare(strict_types = 1);

namespace ValanticSpryker\Shared\Kernel;

use Spryker\Shared\Kernel\AbstractBundleConfig as SprykerAbstractBundleConfig;
use ValanticSpryker\Shared\Config\Config;

abstract class AbstractBundleConfig extends SprykerAbstractBundleConfig
{
    /**
     * @param string $key
     * @param string|null $default
     * @param string|null $storeName
     *
     * @return mixed
     */
    protected function getByStore(string $key, ?string $default = null, ?string $storeName = null)
    {
        return $this->getConfig()->get($key, $default, $storeName);
    }

    /**
     * @return \ValanticSpryker\Shared\Config\Config
     */
    protected function getConfig(): Config
    {
        return Config::getInstance();
    }
}
