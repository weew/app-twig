<?php

namespace Weew\App\Twig;

use Twig_Environment;
use Twig_Error_Loader;
use Twig_Loader_Filesystem;
use Weew\Container\IContainer;

class TwigProvider {
    /**
     * @param IContainer $container
     */
    public function initialize(IContainer $container) {
        $container->set(Twig_Loader_Filesystem::class, [$this, 'createTwigLoaderFilesystem'])->singleton();
        $container->set([Twig::class, Twig_Environment::class], [$this, 'createTwigEnvironment'])->singleton();
    }

    /**
     * @param TwigConfig $config
     *
     * @return Twig_Loader_Filesystem
     * @throws Twig_Error_Loader
     */
    public function createTwigLoaderFilesystem(TwigConfig $config) {
        $loader = new Twig_Loader_Filesystem();

        foreach ($config->getPaths() as $path) {
            $loader->addPath($path);
        }

        foreach ($config->getNamespaces() as $namespace => $path) {
            $loader->addPath($path, $namespace);
        }

        return $loader;
    }

    /**
     * @param TwigConfig $config
     * @param Twig_Loader_Filesystem $loader
     *
     * @return Twig
     */
    public function createTwigEnvironment(
        TwigConfig $config,
        Twig_Loader_Filesystem $loader
    ) {
        return new Twig($loader, $this->buildTwigEnvironmentOptions($config));
    }

    /**
     * @param TwigConfig $config
     *
     * @return array
     */
    public function buildTwigEnvironmentOptions(TwigConfig $config) {
        $options = [
            'debug' => $config->getDebug(),
        ];

        if ($config->getCharset() !== null) {
            $options['charset'] = $config->getCharset();
        }

        if ($config->getBaseTemplateClass() !== null) {
            $options['base_template_class'] = $config->getBaseTemplateClass();
        }

        if ($config->getCache() !== null) {
            $options['cache'] = $config->getCache();
        }

        if ($config->getAutoReload() !== null) {
            $options['auto_reload'] = $config->getAutoReload();
        }

        if ($config->getAutoEscape() !== null) {
            $options['autoescape'] = $config->getAutoEscape();
        }

        if ($config->getStrictVariables() !== null) {
            $options['strict_variables'] = $config->getStrictVariables();
        }

        if ($config->getOptimizations() !== null) {
            $options['optimizations'] = $config->getOptimizations();
        }

        return $options;
    }
}
