# Magento configurable product attribute order fix

i[![Build Status](https://travis-ci.org/robbieaverill/magento-attribute-option-order-fix.svg?branch=master)](https://travis-ci.org/robbieaverill/magento-attribute-option-order-fix) [![Packagist](https://img.shields.io/packagist/v/robbieaverill/magento-attribute-option-order-fix.svg)](https://packagist.org/packages/robbieaverill/magento-attribute-option-order-fix)

## Information

A module to re-apply the relevance ordering for configurable attribute options in Magento CE 1.9.1, 1.9.2 or EE 1.14.2.

Why? The logic was changed in the recent version of core Magento to avoid nested `foreach` statements, but in turn lost the relevance ordering in favour of ordering by the attribute IDs.

You can use this extension module to restore to relevance ordering until the core resource model has been updated by Magento.

## Installation

#### Install using composer

```
$ composer require robbieaverill/magento-attribute-option-order-fix
```

#### Install using modman

This is the preferred installation method, unless installing manually.

```
$ modman init
$ modman clone https://github.com/robbieaverill/magento-attribute-option-order-fix
```

#### Manual installation

* Clone this repository
* Copy the `app/code/local` files into your Magento codebase
* Copy the `app/etc/modules/RobbieAverill_AttributeFix.xml` file into your `app/etc/modules` folder
* Clear your cache

## Notes:

* Updated to work correctly on Magento CE 1.9.2
* Uses traits, so no longer supports PHP 5.3 or lower. Minimum 5.4 required.

## Changelog:

### 1.1.4

* Added Packagist support. Updated composer PHP version requirement to 5.4.

### 1.1.3

* Fix #11 - prices cleared when creating simple products in admin

### 1.1.2

* Fix #12 - hot fix for empty attribute option arrays in the helper

### 1.1.1

* Fix #12 - added support for ordering swatch options
* Removed support for PHP 5.3 as we use traits now

### 1.0.1

* #10 - added `composer.json` for composer installation.

### 1.0.0

* Fix #9 - clash between keys and values (thanks @bincani)

### 0.1.3

* Added configuration unit tests
* Added Travis CI build configuration

### 0.1.2

* Updated docblocks and readme
* Return `self` instead of the full class name
* Added `modman` config file (@ngongoll)

### 0.1.1

* Compatibility check against Magento CE 1.9.2

### 0.1.0

* Initial module added
* Use rewrite of configurable attribute collection model
