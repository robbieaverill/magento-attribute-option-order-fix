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
     * Load attribute prices information
     *
     * @return self
     */
    protected function _loadPrices()
    {
        if ($this->count()) {
            $pricings = array(
                0 => array()
            );

            if ($this->getHelper()->isPriceGlobal()) {
                $websiteId = 0;
            } else {
                $websiteId = (int)Mage::app()->getStore($this->getStoreId())->getWebsiteId();
                $pricing[$websiteId] = array();
            }

            $select = $this->getConnection()->select()
                ->from(array('price' => $this->_priceTable))
                ->where('price.product_super_attribute_id IN (?)', array_keys($this->_items));

            if ($websiteId > 0) {
                $select->where('price.website_id IN(?)', array(0, $websiteId));
            } else {
                $select->where('price.website_id = ?', 0);
            }

            $query = $this->getConnection()->query($select);

            while ($row = $query->fetch()) {
                $pricings[(int)$row['website_id']][] = $row;
            }

            $values = array();

            foreach ($this->_items as $item) {
                $productAttribute = $item->getProductAttribute();
                if (!($productAttribute instanceof Mage_Eav_Model_Entity_Attribute_Abstract)) {
                    continue;
                }
                $options = $productAttribute->getFrontend()->getSelectOptions();

                $optionsByValue = array();
                foreach ($options as $option) {
                    $optionsByValue[$option['value']] = $option['label'];
                }

                /**
                 * Modification to re-enable the sorting by relevance for attribute options
                 * @author Robbie Averill <robbie@averill.co.nz>
                 */
                $toAdd = array();
                foreach ($this->getProduct()->getTypeInstance(true)
                             ->getUsedProducts(array($productAttribute->getAttributeCode()), $this->getProduct())
                         as $associatedProduct) {

                    $optionValue = $associatedProduct->getData($productAttribute->getAttributeCode());

                    if (array_key_exists($optionValue, $optionsByValue)) {
                        $toAdd[] = $optionValue;
                    }
                }

                // Add the attribute options, but in the relevant order rather than by ID
                foreach (array_intersect_key($optionsByValue, array_flip($toAdd)) as $optionValueKey => $optionValue) {
                    // If option available in associated product
                    if (!isset($values[$item->getId() . ':' . $optionValueKey])) {
                        // If option not added, we will add it.
                        $values[$item->getId() . ':' . $optionValueKey] = array(
                            'product_super_attribute_id' => $item->getId(),
                            'value_index'                => $optionValueKey,
                            'label'                      => $optionsByValue[$optionValueKey],
                            'default_label'              => $optionsByValue[$optionValueKey],
                            'store_label'                => $optionsByValue[$optionValueKey],
                            'is_percent'                 => 0,
                            'pricing_value'              => null,
                            'use_default_value'          => true
                        );
                    }
                }
                /**
                 * End attribute option order modification
                 * @author Robbie Averill <robbie@averill.co.nz>
                 */
            }

            foreach ($pricings[0] as $pricing) {
                // Addding pricing to options
                $valueKey = $pricing['product_super_attribute_id'] . ':' . $pricing['value_index'];
                if (isset($values[$valueKey])) {
                    $values[$valueKey]['pricing_value']     = $pricing['pricing_value'];
                    $values[$valueKey]['is_percent']        = $pricing['is_percent'];
                    $values[$valueKey]['value_id']          = $pricing['value_id'];
                    $values[$valueKey]['use_default_value'] = true;
                }
            }

            if ($websiteId && isset($pricings[$websiteId])) {
                foreach ($pricings[$websiteId] as $pricing) {
                    $valueKey = $pricing['product_super_attribute_id'] . ':' . $pricing['value_index'];
                    if (isset($values[$valueKey])) {
                        $values[$valueKey]['pricing_value']     = $pricing['pricing_value'];
                        $values[$valueKey]['is_percent']        = $pricing['is_percent'];
                        $values[$valueKey]['value_id']          = $pricing['value_id'];
                        $values[$valueKey]['use_default_value'] = false;
                    }
                }
            }

            foreach ($values as $data) {
                $this->getItemById($data['product_super_attribute_id'])->addPrice($data);
            }
        }
        return $this;
    }
}
