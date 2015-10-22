# Magento configurable product attribute order fix

A module to re-apply the relevance ordering for configurable attribute options in Magento CE 1.9.1, 1.9.2 or EE 1.14.2.

Why? The logic was changed in the recent version of core Magento to avoid nested `foreach` statements, but in turn lost the relevance ordering in favour of ordering by the attribute IDs.

You can use this extension module to restore to relevance ordering until the core resource model has been updated by Magento.

## Notes:

* Updated to work correctly on Magento CE 1.9.2
* Conflict possible with the ConfigurableSwatches module recently introduced since it references the collection resource class directly via hierarchy

## Changelog:

### 0.1.2

* Updated docblocks and readme
* Return `self` instead of the full class name
* Added `modman` config file (@ngongoll)

### 0.1.1

* Compatibility check against Magento CE 1.9.2

### 0.1.0

* Initial module added
* Use rewrite of configurable attribute collection model
