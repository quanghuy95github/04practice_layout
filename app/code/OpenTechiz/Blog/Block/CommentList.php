<?php
namespace OpenTechiz\Blog\Block;

use OpenTechiz\Blog\Api\Data\CommentInterface;
use OpenTechiz\Blog\Model\ResourceModel\Comment\Collection as CommentCollection;
use Magento\Framework\DataObject\IdentityInterface;

class CommentList extends \Magento\Framework\View\Element\Template implements IdentityInterface
    
{
    /**
     * @var \OpenTechiz\Blog\Model\ResourceModel\Post\CollectionFactory
     */
    protected $_commentCollectionFactory;

    protected $_request;
    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \OpenTechiz\Blog\Model\ResourceModel\Post\CollectionFactory $postCollectionFactory,
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \OpenTechiz\Blog\Model\ResourceModel\Comment\CollectionFactory $commentCollectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_request = $request;
        $this->_commentCollectionFactory = $commentCollectionFactory;
    }

    public function getPostID()
    {
        return $this->_request->getParam('post_id', false);
    }

    /**
     * @return \OpenTechiz\Blog\Model\ResourceModel\Post\Collection
     */
    public function getComments()
    {
        $post_id = $this->getPostID();

        // Check if posts has already been defined
        // makes our block nice and re-usable! We could
        // pass the 'posts' data to this block, with a collection
        // that has been filtered differently!
        if (!$this->hasData('cmt')) {
            $comments = $this->_commentCollectionFactory
                ->create()
                ->addFilter('post_id', $post_id)
                ->addFilter('is_active', 1)
                ->addOrder(
                    CommentInterface::CREATION_TIME,
                    CommentCollection::SORT_ORDER_DESC
                );
            $this->setData('cmt', $comments);
        }
        return $this->getData('cmt');
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        $identities = [];
        foreach ($this->getComments() as $comment) {
            $identities = array_merge($identities, $comment->getIdentities());
        }
        // lay nhan dai dien cho ca block comment
        $identities[] = \OpenTechiz\Blog\Model\Post::CACHE_TAG . '_' . 'list';
        return $identities;
    }
}
