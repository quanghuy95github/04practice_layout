<?php

namespace ObserverPractice\DiscountLogin\Observer;

use Magento\Framework\Event\ObserverInterface;

class CustomerLogin implements ObserverInterface
{
	protected $_logger;

	public function __construct(
		\Psr\Log\LoggerInterface $logger
		)
	{
		$this->_logger = $logger;
	}

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
    	$data = [];
        $customer = $observer->getEvent()->getCustomer();
        echo $customer->getName(); 
        $data[] = $customer->getName(); //Get customer name
        $data[] = $customer->getEmail(); //Get customer email
        $this->_logger->info('login', $data);
        exit;
    }
}