<?php
namespace Pulsestorm\HelloWorldMVVM\Controller\Hello;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;

class World extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;
    protected $registry;

    public function __construct(
    Context $context, 
    PageFactory $pageFactory, 
    \Magento\Framework\Registry $registry
    )
    {
        $this->registry = $registry;
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {   
        
        $this->registry->register('var_content','Nguyen Quang Huy');
        // var_dump(__METHOD__);
        $page_object = $this->pageFactory->create();
        return $page_object;
    }    
}