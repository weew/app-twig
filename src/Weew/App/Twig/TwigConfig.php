<?php

namespace Weew\App\Twig;

use Weew\Config\IConfig;

class TwigConfig {
    const DEBUG = 'twig.debug';
    const CHARSET = 'twig.charset';
    const BASE_TEMPLATE_CLASS = 'twig.base_template_class';
    const CACHE = 'twig.cache';
    const AUTO_RELOAD = 'twig.auto_reload';
    const STRICT_VARIABLES = 'twig.strict_variables';
    const AUTO_ESCAPE = 'twig.autoescape';
    const OPTIMIZATIONS = 'twig.optimizations';
    const PATHS = 'twig.paths';
    const NAMESPACES = 'twig.namespaces';

    /**
     * @var IConfig
     */
    private $config;

    /**
     * TwigConfig constructor.
     *
     * @param IConfig $config
     */
    public function __construct(IConfig $config) {
        $this->config = $config;

        $config
            ->ensure(self::DEBUG, 'Missing debug setting.');

        if ($config->has(self::PATHS)) {
            $config->ensure(self::PATHS, 'Missing a list of view directories.', 'array');
        }

        if ($config->has(self::NAMESPACES)) {
            $config->ensure(self::NAMESPACES, 'Missing a list of view namespaces.', 'array');
        }
    }

    /**
     * @return bool
     */
    public function getDebug() {
        return $this->config->get(self::DEBUG);
    }

    /**
     * @return string
     */
    public function getCharset() {
        return $this->config->get(self::CHARSET);
    }

    /**
     * @return string
     */
    public function getBaseTemplateClass() {
        return $this->config->get(self::BASE_TEMPLATE_CLASS);
    }

    /**
     * @return bool|string
     */
    public function getCache() {
        return $this->config->get(self::CACHE);
    }

    /**
     * @return bool
     */
    public function getAutoReload() {
        return $this->config->get(self::AUTO_RELOAD);
    }

    /**
     * @return bool
     */
    public function getStrictVariables() {
        return $this->config->get(self::STRICT_VARIABLES);
    }

    /**
     * @return bool|string
     */
    public function getAutoEscape() {
        return $this->config->get(self::AUTO_ESCAPE);
    }

    /**
     * @return int
     */
    public function getOptimizations() {
        return $this->config->get(self::OPTIMIZATIONS);
    }

    /**
     * @return array
     */
    public function getPaths() {
        return $this->config->get(self::PATHS, []);
    }

    /**
     * @return array
     */
    public function getNamespaces() {
        return $this->config->get(self::NAMESPACES, []);
    }
}
