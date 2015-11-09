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
     * Ensure that the resource model is correctly rewritten
     */
    public function testResourceModelShouldBeResolved()
    {
        $this->assertResourceModelAlias(
            'catalog_resource/product_type_configurable_attribute_collection',
            'RobbieAverill_AttributeFix_Model_Resource_Product_Type_Configurable_Attribute_Collection'
        );
    }
}
