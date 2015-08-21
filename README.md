# magento-attribute-option-order-fix

A module to re-apply the relevance order for configurable attribute options in Magento CE 1.9.1, 1.9.2 or EE 1.14.2.

The logic was changed in the recent version to avoid nested `foreach` statements, but in turn lost the relevance ordering in favour of ordering by ID.

You can use this extension module to restore to relevance ordering until the core resource model has been updated by Magento.

## Notes:

* Updated to work correctly on Magento CE 1.9.2
* Conflict possible with the ConfigurableSwatches module recently introduced since it references the collection resource class directly via hierarchy