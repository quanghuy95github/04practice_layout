<?php
namespace OpenTechiz\Blog\Controller\Comment;

use \Magento\Framework\App\Action\Action;

class Save extends Action
{

    protected $resultJsonFactory;

    protected $inlineTranslation;

    protected $_transportBuilder;

    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    )
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->inlineTranslation = $inlineTranslation;
        $this->_transportBuilder = $transportBuilder;
        $this->scopeConfig = $scopeConfig;
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
        if (!\Zend_Validate::is(trim($post['email']), 'NotEmpty')) {
            $error = true;
            $message = 'name can not be empty';
        }
        
        // save data to database
        $email = $post['email'];
        $content = $post['content'];
        $post_id = $post['post_id'];

        $comment = $this->_objectManager->create('OpenTechiz\Blog\Model\Comment');
        $comment->setEmail($email);
        $comment->setContent($content);
        $comment->setPostID($post_id);
        $comment->setAvailableStatuses(true);

        $comment->save();

        $sender = [
            'name' => "Nguyen Quang Huy",
            'email' => "quanghuy.tb.vn@gmail.com"
        ];
        // sendmail
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $transport = $this->_transportBuilder
            ->setTemplateIdentifier($this->scopeConfig->getValue('blog/general/template', $storeScope))
            ->setTemplateOptions(
                [
                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                    'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                ]
            )
            ->setTemplateVars(['name' => 'quang huy']) // ten nguoi nhan
            ->setFrom($sender)      // email nguoi gui
            ->addTo($email)             // email nguoi nhan
            ->setReplyTo($email)        // email nhan reply
            ->getTransport()
            ->sendMessage();
            
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