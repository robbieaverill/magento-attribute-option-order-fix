<?php
/**
 * Overridden to re-enable the attribute option sorting by relevance rather than by ID as changed
 * in the Magento core class. This class is to re-enable the ordering for swatches, since it extends
 * the attribute collection by class name.
 *
 * @category Mage
 * @package  RobbieAverill_AttributeFix
 * @author   Robbie Averill <robbie@averill.co.nz>
 */
class RobbieAverill_AttributeFix_Model_Resource_Catalog_Product_Attribute_Super_Collection
    extends Mage_ConfigurableSwatches_Model_Resource_Catalog_Product_Attribute_Super_Collection
{
    /**
     * Get the override functionality - it's in a trait for re-usability
     */
    use RobbieAverill_AttributeFix_Model_Resource_Product_Type_Configurable_Attribute_CollectionCommon;
}
