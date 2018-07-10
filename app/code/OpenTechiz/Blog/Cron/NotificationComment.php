<?php
namespace OpenTechiz\Blog\Cron;

use \Psr\Log\LoggerInterface;

/**
* 
*/
class NotificationComment
{
	protected $logger;
	
	protected $commentCollectionFactory;

	protected $userCollection;

	protected $_transportBuilder;

	public function __construct(
		LoggerInterface $logger,
		\OpenTechiz\Blog\Model\ResourceModel\Comment\CollectionFactory $commentCollectionFactory,
		\Magento\User\Model\ResourceModel\User\CollectionFactory $userCollection,
		\Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
	)
	{
		$this->logger = $logger;
		$this->commentCollectionFactory = $commentCollectionFactory;
		$this->userCollection = $userCollection;
		$this->_transportBuilder = $transportBuilder;
	}

	/**
   * Write to system.log
   *
   * @return void
   */
	public function execute() {
		// get count comment not active
		$commentCount = $this->commentCollectionFactory
            ->create()
            ->addFieldToFilter('status', 0)
            ->count();


        // sender infor
        $sender = [
            'name' => "Nguyen Quang Huy",
            'email' => "quanghuy.tb.vn@gmail.com"
        ];

        // get infor all admin and sendmail
        $admins = $this->userCollection->create();
        $adminCount = $admins->count();

        // check have comment not active and have admin in system and sendmail
        if ($commentCount > 0 && $adminCount > 0) {
        	foreach ($admins as $admin) {
	        	// sendmail
	        	$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
	        	$transport = $this->_transportBuilder
		            ->setTemplateIdentifier($this->scopeConfig->getValue('blog/reminder/template', $storeScope))
		            ->setTemplateOptions(
		                [
		                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
		                    'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
		                ]
		            )
		            ->setTemplateVars(['name' => $admin->getName()]) // ten nguoi nhan
		            ->setFrom($sender)      // email nguoi gui
		            ->addTo($admin->getEmail())             // email nguoi nhan
		            ->setReplyTo($sender['email'])        // email nhan reply
		            ->getTransport()
		            ->sendMessage();
	        }
        }
        

        
        
    }
}