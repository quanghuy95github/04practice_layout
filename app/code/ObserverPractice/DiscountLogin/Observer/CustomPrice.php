<?php
namespace ObserverPractice\DiscountLogin\Observer;

use Magento\Framework\Event\ObserverInterface;

class CustomPrice implements ObserverInterface
{

    public function execute(\Magento\Framework\Event\Observer $observer) {
        $item = $observer->getEvent()->getData('quote_item');
        $debugBackTrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        // echo "<pre>";
        // var_dump($this);
        // foreach ($debugBackTrace as $item) {
        //     print_r($item);
        // }
        // die();
        $item = ($item->getParentItem() ? $item->getParentItem() : $item);
        $price = $item->getProduct()->getPriceInfo()->getPrice('final_price')->getValue();
        $new_price = $price - ($price * 50 / 100); //discount the price of the product to 50%
        $item->setCustomPrice($new_price);
        $item->setOriginalCustomPrice($new_price);
        $item->getProduct()->setIsSuperMode(true);
    }
}