<?php

namespace Sinapsis\SortByNewest\Block\Product\ProductList;

use Magento\Catalog\Block\Product\ProductList\Toolbar as MagentoToolbar;

class Toolbar extends MagentoToolbar
{
    public function setCollection($collection)
    {
        $this->_collection = $collection;
        $this->_collection->setCurPage($this->getCurrentPage());

        $limit = (int)$this->getLimit();
        if ($limit > 0) {
            $this->_collection->setPageSize($limit);
        }

        $currentOrder = $this->getCurrentOrder();
        $currentDirection = $this->getCurrentDirection();

        if ($currentOrder) {
            switch ($currentOrder) {
                case 'position':
                    $this->_collection->addAttributeToSort($currentOrder, $currentDirection);
                    break;
                case 'created_at':
                    $this->_collection->setOrder($currentOrder, 'desc');
                    break;
                default:
                    $this->_collection->setOrder($currentOrder, $currentDirection);
                    break;
            }
        }

        return $this;
    }
}
