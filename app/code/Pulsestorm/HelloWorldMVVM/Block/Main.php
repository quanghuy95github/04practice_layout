<?php
namespace Pulsestorm\HelloWorldMVVM\Block;
use Magento\Framework\View\Element\Template;

class Main extends Template
{
    // protected $registry;

    // public function __construct(
    // \Magento\Framework\View\Element\Template\Context $context,
    // \Magento\Framework\Registry $registry
    // )
    // {
    // 	return parent::__construct($context);
    // }

    public function getHelloWorldTxt()
    {
        // return 'Hello world!'.$this->registry->registry('var_content');
        return "hellw";
    }
}
