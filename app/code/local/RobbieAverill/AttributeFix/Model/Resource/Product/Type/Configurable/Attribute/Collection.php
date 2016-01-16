<?php
/**
 * Catalog Configurable Product Attribute Collection - overridden to re-enable the attribute option
 * sorting by relevance rather than by ID as changed in the Magento core class
 *
 * @category Mage
 * @package  RobbieAverill_AttributeFix
 * @author   Robbie Averill <robbie@averill.co.nz>
 */
class RobbieAverill_AttributeFix_Model_Resource_Product_Type_Configurable_Attribute_Collection
    extends Mage_Catalog_Model_Resource_Product_Type_Configurable_Attribute_Collection
{
    /**
     * Get the override functionality - it's in a trait for re-usability
     */
    use RobbieAverill_AttributeFix_Model_Resource_Product_Type_Configurable_Attribute_CollectionCommon;
}
