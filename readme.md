# App twig provider

[![Build Status](https://img.shields.io/travis/weew/app-twig.svg)](https://travis-ci.org/weew/app-twig)
[![Code Quality](https://img.shields.io/scrutinizer/g/weew/app-twig.svg)](https://scrutinizer-ci.com/g/weew/app-twig)
[![Test Coverage](https://img.shields.io/coveralls/weew/app-twig.svg)](https://coveralls.io/github/weew/app-twig)
[![Version](https://img.shields.io/packagist/v/weew/app-twig.svg)](https://packagist.org/packages/weew/app-twig)
[![Licence](https://img.shields.io/packagist/l/weew/app-twig.svg)](https://packagist.org/packages/weew/app-twig)

## Table of contents

- [Installation](#installation)
- [Introduction](#introduction)
- [Usage](#usage)
- [Example config](#example-config)
- [Doctrine console](#twig-console)

## Installation

`composer require weew/app-twig`

## Introduction

This package integrates [twig/twig](https://github.com/twigphp/Twig) into the [weew/app](https://github.com/weew/app) framework.

## Usage

Simply register the `TwigProvider` class on the application kernel:

```php
$app = new App();
$app->getKernel()->addProviders([
    TwigProvider::class,
]);
```

## Example config

This is how your config *might* look like in yaml:

```yaml
twig:
  debug: true
  charset: utf-8
  base_template_class: SomeClass
  cache: /cache/path
  auto_reload: true
  auto_escape: true
  strict_variables: false
  optimizations: -1

  paths:
    - /path/to/views
    - /another/path/to/views

  namespaces:
    namespace: /path/to/namespaced/views
    another_namespace: /another/path/to/namespaced/views
```

The only required setting is `twig.debug`, all the other are optional and should be used when needed. Fur further information about twig configuration please take a look at twig [documentation](http://twig.sensiolabs.org/doc/api.html#environment-options).
