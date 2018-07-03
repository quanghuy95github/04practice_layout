<?php
namespace OpenTechiz\Helloworld\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'OpenTechiz_Helloworld::helloworld';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('OpenTechiz_Helloworld::helloworld');
        $resultPage->addBreadcrumb(__('Helloworld'), __('Helloworld'));
        $resultPage->addBreadcrumb(__('Manage Helloworld'), __('Manage Helloworld'));
        $resultPage->getConfig()->getTitle()->prepend(__('Helloworld'));

        return $resultPage;
    }
}