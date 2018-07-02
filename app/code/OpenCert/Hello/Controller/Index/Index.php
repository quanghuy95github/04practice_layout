<?php
 
namespace OpenCert\Hello\Controller\Index;
 
use Magento\Framework\App\Action\Context;
 
class Index extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $_registry;
    protected $_logger;

    public function __construct(
        Context $context, 
        \Magento\Framework\View\Result\PageFactory $resultPageFactory, 
        \Magento\Framework\Registry $registry, 
        \Psr\Log\LoggerInterface $logger
        )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_registry = $registry;
        $this->_logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->_registry->register('custom_var', 'Nguyen Quang Huy');
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;

        // debug_backtrace
        // $debugBackTrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        // echo "<pre>";
        // var_dump($this);
        // foreach ($debugBackTrace as $item) {
        //     print_r($item);
        // }
    }
}