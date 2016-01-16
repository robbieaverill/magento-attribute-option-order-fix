<?php
/**
 * Test that the module is configured correctly
 * 
 * @category Mage
 * @package  RobbieAverill_AttributeFix
 * @author   Robbie Averill <robbie@averill.co.nz>
 */
class RobbieAverill_AttributeFix_Test_Config_ConfigTest
    extends EcomDev_PHPUnit_Test_Case_Config
{
    /**
     * Ensure the module is in the right code pool
     */
    public function testShouldBeInLocalPool()
    {
        $this->assertModuleCodePool('local');
    }

    /**
     * Ensure the module depends on Mage_Catalog
     */
    public function testShouldDependOnCatalog()
    {
        $this->assertModuleDepends('Mage_Catalog');
    }

    /**
     * Ensure that the resource model is correctly rewritten for the configurable attribute collection
     */
    public function testConfigurableAttributeCollectionResourceModelShouldBeResolved()
    {
        $this->assertResourceModelAlias(
            'catalog_resource/product_type_configurable_attribute_collection',
            'RobbieAverill_AttributeFix_Model_Resource_Product_Type_Configurable_Attribute_Collection'
        );
    }

    /**
     * Ensure that the resource model is correctly rewritten for the configurable swatch attribute collection
     */
    public function testSwatchAttributeCollectionResourceModelShouldBeResolved()
    {
        $this->assertResourceModelAlias(
            'configurableswatches_resource/catalog_product_attribute_super_collection',
            'RobbieAverill_AttributeFix_Model_Resource_Catalog_Product_Attribute_Super_Collection'
        );
    }

    /**
     * Ensure the mediafallback helper extension is in place for swatches to display in the correct order
     */
    public function testMediaFallbackHelperShouldExtendCore()
    {
        $this->assertHelperAlias(
            'configurableswatches/mediafallback',
            'RobbieAverill_AttributeFix_Helper_Mediafallback'
        );
    }
}
