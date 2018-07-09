<?php
namespace OpenTechiz\Blog\Controller\Comment;

use \Magento\Framework\App\Action\Action;

class Save extends Action
{

    protected $resultJsonFactory;

    protected $inlineTranslation;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    )
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->inlineTranslation = $inlineTranslation;
        parent::__construct($context);
    }
     /**
     * Booking action
     *
     * @return void
     */
    public function execute()
    {
        $error = false;
        $message = '';
        $post = (array) $this->getRequest()->getPostValue(); // receive data from request.
        if (!$post) {
            $error = true;
            $message = 'Your submission is not valid. Please try again';
        }
        $this->inlineTranslation->suspend(); // to avoid inline stranslation broking ajaxe reponse
        $postObject = new \Magento\Framework\DataObject();
        $postObject->setData($post);

        // add validation code here
        if (!\Zend_Validate::is(trim($post['customer_id']), 'NotEmpty')) {
            $error = true;
            $message = 'name can not be empty';
        }
        
        // save data to database
        $customer_id = $post['customer_id'];
        $content = $post['content'];
        $post_id = $post['post_id'];

        $comment = $this->_objectManager->create('OpenTechiz\Blog\Model\Comment');
        $comment->setCustomerId($post_id);
        $comment->setContent($content);
        $comment->setPostID($post_id);

        $comment->save();

        // return nofication comment
        $jsonResultReaponse = $this->resultJsonFactory->create();
        if (!$error) {
            $jsonResultReaponse->setData([
                'result' => 'success', 
                'message' => 'Thanks for your submission. Our admin will review and approve shortly'
            ]);
        }else{
            $jsonResultReaponse->setData([
                'result' => 'error', 
                'message' => $message
            ]);
        }
        return $jsonResultReaponse;
    }
}