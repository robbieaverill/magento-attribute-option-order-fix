# Magento configurable product attribute order fix

## Builds

[![Build Status](https://travis-ci.org/robbieaverill/magento-attribute-option-order-fix.svg?branch=master)](https://travis-ci.org/robbieaverill/magento-attribute-option-order-fix)

A module to re-apply the relevance ordering for configurable attribute options in Magento CE 1.9.1, 1.9.2 or EE 1.14.2.

Why? The logic was changed in the recent version of core Magento to avoid nested `foreach` statements, but in turn lost the relevance ordering in favour of ordering by the attribute IDs.

You can use this extension module to restore to relevance ordering until the core resource model has been updated by Magento.

## Notes:

* Updated to work correctly on Magento CE 1.9.2
* Uses traits, so no longer supports PHP 5.3 or lower. Minimum 5.4 required.

## Changelog:

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
