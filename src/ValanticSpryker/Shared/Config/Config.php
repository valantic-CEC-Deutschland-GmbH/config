<?php

declare(strict_types = 1);

namespace ValanticSpryker\Shared\Config;

use ArrayObject;
use Spryker\Shared\Config\Config as SprykerConfig;

class Config extends SprykerConfig
{
    /**
     * @var self|null
     */
    private static $instance;

    /**
     * @return \ValanticSpryker\Shared\Config\Config
     */
    public static function getInstance(): self
    {
        // @phpstan-ignore-next-line
        if (static::$instance === null) {
            static::$instance = new static(); // @phpstan-ignore-line
        }

        return static::$instance; // @phpstan-ignore-line
    }

    /**
     * @param string|null $environmentName
     * @param string|null $storeName
     *
     * @return void
     */
    public static function init(?string $environmentName = null, ?string $storeName = null): void
    {
        $config = new ArrayObject();
        $environmentName = $environmentName ?? static::getEnvironmentName(); // @phpstan-ignore-line
        static::defineCodeBucket();
        $storeName = $storeName ?? APPLICATION_CODE_BUCKET;

        /*
         * e.g. config_default.php
         */
        static::buildConfig('default', $config);

        /*
         * e.g. config_default-production.php
         */
        static::buildConfig('default-' . $environmentName, $config);

        /*
         * e.g. config_default_DE.php
         */
        if ($storeName !== '') {
            static::buildConfig('default_' . $storeName, $config);
        }

        /*
         * e.g. config_default-production_DE.php
         */
        if ($storeName !== '') {
            static::buildConfig('default-' . $environmentName . '_' . $storeName, $config);
        }

        /*
         * e.g. config_local_test.php
         */
        static::buildConfig('local_test', $config);

        /*
         * e.g. config_local.php
         */
        static::buildConfig('local', $config);

        /*
         * e.g. config_local_DE.php
         */
        if ($storeName !== '') {
            static::buildConfig('local_' . $storeName, $config);
        }

        /*
         * e.g. config_propel.php
         */
        static::buildConfig('propel', $config);

        static::$config = $config;
    }

    /**
     * @param string $key
     * @param mixed|null $default
     * @param string|null $storeName
     *
     * @return mixed
     */
    public static function get($key, $default = null, ?string $storeName = null)
    {
        $previousConfig = static::$config;
        if ($storeName) {
            self::init(storeName: $storeName);
        }

        $configValue = parent::get($key, $default);
        if ($storeName && $previousConfig) {
            static::$config = $previousConfig;
        }

        return $configValue;
    }

    /**
     * @return string
     */
    private static function getEnvironmentName(): string
    {
        return APPLICATION_ENV;
    }
}
