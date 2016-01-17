<?php
/**
 * Helper to provide sorting methods for attribute option values
 *
 * @category Mage
 * @package  RobbieAverill_AttributeFix
 * @author   Robbie Averill <robbie@averill.co.nz>
 */
class RobbieAverill_AttributeFix_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Sort the attribute options by their sort order
     * @param  array $options
     * @return array
     */
    public function sortOptionValues($options)
    {
        $optionIds = array_keys($options);
        $sortOrder = $this->getSortOrderForAttributeOptions($optionIds);

        foreach ($sortOrder as $optionId => &$value) {
            $value = $options[$optionId];
        }

        return $sortOrder;
    }

    /**
     * Given an array of attribute option IDs, get their sort order
     * @param  array $optionIds
     * @return array
     */
    public function getSortOrderForAttributeOptions($optionIds)
    {
        $resource = Mage::getModel('core/resource');
        $connection = $resource->getConnection('core/read');

        $select = $connection->select()
            ->from(
                ['e' => $resource->getTableName('eav/attribute_option')],
                ['option_id', 'sort_order']
            )
            ->where('option_id IN (' . implode(',', array_map('intval', $optionIds)) . ')')
            ->order('sort_order');

        $orders = $connection->fetchAll($select);

        $output = [];
        foreach ($orders as $order) {
            $output[$order['option_id']] = $order['sort_order'];
        }

        return $output;
    }
}
