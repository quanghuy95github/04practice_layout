<?php
namespace OpenTechiz\Blog\Controller\Save;

use \Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{

	protected $_resultPageFactory;

    function __construct(
        \Magento\Framework\App\Action\Context $context
    )
    {
        $this->_resultFactory = $context->getResultFactory();
        parent::__construct($context);
    }
	 /**
     * Booking action
     *
     * @return void
     */
    public function execute()
    {
        // 1. POST request : Get booking data
        $comment = (array) $this->getRequest()->getPost();

        if (!empty($comment)) {
            // Retrieve your form data
            $customer_id    = (int)$comment['customer_id'];
            $content    	= $comment['content'];
            $post_id        = (int)$comment['post_id'];

            // Doing-something with...
            $comment = $this->_objectManager->create('OpenTechiz\Blog\Model\Comment');
            $comment->setCustomerId($post_id);
            $comment->setContent($content);
            $comment->setPostID($post_id);

            $comment->save();
            // Display the succes form validation message
            $this->messageManager->addSuccessMessage('comment done !');

            // Redirect to your form page (or anywhere you want...)
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl('/magento2_data/blog/');

            return $resultRedirect;
        }
    }
}