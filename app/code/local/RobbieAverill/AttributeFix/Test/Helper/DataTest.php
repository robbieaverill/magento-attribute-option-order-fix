<?php
/**
 * Unit tests for the Data helper
 *
 * @category Mage
 * @package  RobbieAverill_AttributeFix
 * @author   Robbie Averill <robbie@averill.co.nz>
 */
class RobbieAverill_AttributeFix_Test_Helper_DataTest extends EcomDev_PHPUnit_Test_Case
{
    /**
     * Ensure that attributes have their order retrieved and are returned in order. We mock the
     * method that actually retrieves the attribute option sort orders since we test it separately.
     *
     * @param int   $testCase
     * @param array $input
     * @param array $order
     *
     * @dataProvider dataProvider
     * @loadExpectation
     */
    public function testShouldGetAttributeOrdersThenOrderThem($testCase, $input, $order)
    {
        $mock = $this->getHelperMock('attributefix', ['getSortOrderForAttributeOptions']);

        $mock
            ->expects(empty($input) ? $this->any() : $this->once())
            ->method('getSortOrderForAttributeOptions')
            ->will($this->returnValue($order));

        $result = $mock->sortOptionValues($input);

        $expected = $this->expected('tc_' . $testCase)->getResult();

        $this->assertSame($expected, $result);
    }

    /**
     * The option values should be loaded from the eav_attribute_option table according to their
     * sort_order, then returned as a simple array
     *
     * @param int   $attributeId For referencing the fixture
     * @param array $input
     * 
     * @loadFixture
     * @loadExpectation
     * @dataProvider dataProvider
     */
    public function testShouldRetrieveOptionsInSortOrder($attributeId, $input)
    {
        $result = Mage::helper('attributefix')->getSortOrderForAttributeOptions($input);
        $expected = $this->expected('attr_' . $attributeId)->getResult();
        $this->assertSame($expected, $result);
    }
}
