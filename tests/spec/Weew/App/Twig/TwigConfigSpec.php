<?php

namespace tests\spec\Weew\App\Twig;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Weew\App\Twig\TwigConfig;
use Weew\Config\Config;
use Weew\Config\Exceptions\InvalidConfigValueException;
use Weew\Config\Exceptions\MissingConfigException;

/**
 * @mixin TwigConfig
 */
class TwigConfigSpec extends ObjectBehavior {
    private function createConfig() {
        $config = new Config();
        $config->set(TwigConfig::DEBUG, true);

        return $config;
    }

    function it_is_initializable() {
        $this->beConstructedWith($this->createConfig());
        $this->shouldHaveType(TwigConfig::class);
    }

    function it_throws_an_error_if_debug_setting_is_missing() {
        $this->beConstructedWith(new Config());

        $this->shouldThrow(MissingConfigException::class)
            ->duringInstantiation();
    }

    function it_returns_debug_setting() {
        $config = $this->createConfig();
        $this->beConstructedWith($config);
        $this->getDebug()->shouldBe(true);
    }

    function it_returns_charset_setting() {
        $config = $this->createConfig();
        $config->set(TwigConfig::CHARSET, 'charset');

        $this->beConstructedWith($config);

        $this->getCharset()->shouldBe('charset');
    }

    function it_returns_base_template_class_setting() {
        $config = $this->createConfig();
        $config->set(TwigConfig::BASE_TEMPLATE_CLASS, 'base_template_class');

        $this->beConstructedWith($config);

        $this->getBaseTemplateClass()->shouldBe('base_template_class');
    }

    function it_returns_cache_setting() {
        $config = $this->createConfig();
        $config->set(TwigConfig::CACHE, 'cache');

        $this->beConstructedWith($config);

        $this->getCache()->shouldBe('cache');
    }

    function it_returns_auto_reload_setting() {
        $config = $this->createConfig();
        $config->set(TwigConfig::AUTO_RELOAD, 'auto_reload');

        $this->beConstructedWith($config);

        $this->getAutoReload()->shouldBe('auto_reload');
    }

    function it_returns_auto_escape_setting() {
        $config = $this->createConfig();
        $config->set(TwigConfig::AUTO_ESCAPE, 'auto_escape');

        $this->beConstructedWith($config);

        $this->getAutoEscape()->shouldBe('auto_escape');
    }

    function it_returns_strict_variables_setting() {
        $config = $this->createConfig();
        $config->set(TwigConfig::STRICT_VARIABLES, 'strict_variables');

        $this->beConstructedWith($config);

        $this->getStrictVariables()->shouldBe('strict_variables');
    }

    function it_returns_optimizations_setting() {
        $config = $this->createConfig();
        $config->set(TwigConfig::OPTIMIZATIONS, 'optimizations');

        $this->beConstructedWith($config);

        $this->getOptimizations()->shouldBe('optimizations');
    }

    function it_throws_an_error_if_paths_is_not_an_array() {
        $config = $this->createConfig();
        $config->set(TwigConfig::PATHS, 'paths');

        $this->beConstructedWith($config);

        $this->shouldThrow(InvalidConfigValueException::class)
            ->duringInstantiation();
    }

    function it_returns_paths_setting() {
        $config = $this->createConfig();
        $config->set(TwigConfig::PATHS, ['path']);

        $this->beConstructedWith($config);
        $this->getPaths()->shouldBe(['path']);
    }

    function it_has_a_default_value_for_paths() {
        $config = $this->createConfig();

        $this->beConstructedWith($config);
        $this->getPaths()->shouldBe([]);
    }

    function it_throws_an_error_if_namespaces_is_not_an_array() {
        $config = $this->createConfig();
        $config->set(TwigConfig::NAMESPACES, 'namespaces');

        $this->beConstructedWith($config);

        $this->shouldThrow(InvalidConfigValueException::class)
            ->duringInstantiation();
    }

    function it_returns_namespaces_setting() {
        $config = $this->createConfig();
        $config->set(TwigConfig::NAMESPACES, ['namespace' => 'path']);

        $this->beConstructedWith($config);
        $this->getNamespaces()->shouldBe(['namespace' => 'path']);
    }

    function it_has_a_default_value_for_namespaces() {
        $config = $this->createConfig();

        $this->beConstructedWith($config);
        $this->getNamespaces()->shouldBe([]);
    }
}
