<?php

namespace tests\spec\Weew\App\Twig;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Twig_Environment;
use Twig_Loader_Filesystem;
use Weew\App\Twig\Twig;
use Weew\App\Twig\TwigConfig;
use Weew\App\Twig\TwigLoader;
use Weew\App\Twig\TwigProvider;
use Weew\Container\Container;

/**
 * @mixin TwigProvider
 */
class TwigProviderSpec extends ObjectBehavior {
    function let(TwigConfig $config) {
        $config->getPaths()->willReturn([__DIR__ . '/path1', __DIR__ . '/path2']);
        $config->getNamespaces()->willReturn(['namespace1' => __DIR__ . '/path1', 'namespace2' => __DIR__ . '/path2']);
        $config->getDebug()->willReturn(true);
        $config->getCharset()->willReturn('utf-8');
        $config->getCache()->willReturn(false);
        $config->getBaseTemplateClass()->willReturn('class');
        $config->getAutoReload()->willReturn(true);
        $config->getAutoEscape()->willReturn(true);
        $config->getOptimizations()->willReturn(-1);
        $config->getStrictVariables()->willReturn(true);

        directory_create(__DIR__ . '/path1');
        directory_create(__DIR__ . '/path2');
    }

    function letgo() {
        directory_delete(__DIR__ . '/path1');
        directory_delete(__DIR__ . '/path2');
    }

    function it_is_initializable() {
        $this->shouldHaveType(TwigProvider::class);
    }

    function it_initializes() {
        $container = new Container();
        $this->initialize($container);

        it($container->has(TwigLoader::class))->shouldBe(true);
        it($container->has(Twig_Loader_Filesystem::class))->shouldBe(true);
        it($container->has(Twig::class))->shouldBe(true);
        it($container->has(Twig_Environment::class))->shouldBe(true);
    }

    function it_creates_twig_filesystem_loader(TwigConfig $config) {
        $loader = $this->createTwigLoaderFilesystem($config);
        $loader->shouldHaveType(Twig_Loader_Filesystem::class);
        $loader->shouldHaveType(TwigLoader::class);
        $loader->getPaths()->shouldBe([__DIR__ . '/path1', __DIR__ . '/path2']);
        $loader->getPaths('namespace1')->shouldBe([__DIR__ . '/path1']);
        $loader->getPaths('namespace2')->shouldBe([__DIR__ . '/path2']);
    }

    function it_build_twig_environment_options(TwigConfig $config) {
        $options = $this->buildTwigEnvironmentOptions($config);
        $options->shouldBe([
            'debug' => true,
            'charset' => 'utf-8',
            'base_template_class' => 'class',
            'cache' => false,
            'auto_reload' => true,
            'autoescape' => true,
            'strict_variables' => true,
            'optimizations' => -1,
        ]);
    }

    function it_creates_twig_environment(
        TwigConfig $config,
        TwigLoader $loader
    ) {
        $twig = $this->createTwigEnvironment($config, $loader);
        $twig->shouldHaveType(Twig::class);
        $twig->shouldHaveType(Twig_Environment::class);
    }
}
