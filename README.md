# magento-attribute-option-order-fix

A module to re-apply the relevance order for configurable attribute options in Magento CE 1.9.1 or EE 1.14.2.

The logic was changed in the recent version to avoid nested `foreach` statements, but in turn lost the relevance ordering in favour of ordering by ID.

You can use this extension module to restore to relevance ordering until the core resource model has been updated by Magento.
