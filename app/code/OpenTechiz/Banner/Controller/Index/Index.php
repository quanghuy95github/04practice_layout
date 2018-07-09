<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace OpenTechiz\Banner\Controller\Index;

use Magento\Framework\App\Action\Context;
use OpenTechiz\Banner\Model\BannerFactory;


class Index extends \Magento\Framework\App\Action\Action
{

    protected $_bannerFactory;

    public function __construct(
        Context $context,
        BannerFactory $bannerFactory
    ) {
        $this->_bannerFactory = $bannerFactory;
        parent::__construct($context);

    }
    /**
     * Index action
     *
     * @return $this
     */
    public function execute()
    {
        //================================================
        //   working with data by Factory Model
        //================================================

        // Create banner instance
        $banner = $this->_bannerFactory->create();
        $collection = $banner->getCollection();

        // SELECT * FROM banner
        // $data = $collection->getData();
        // echo "<pre>";
        // var_dump($data);

        // SELECT * FROM banner WHERE id > 2
        // $data = $collection->addFieldToFilter('id',['gt' => 2])->getData();
        // echo "<pre>";
        // var_dump($data);

        // SELECT id, image FROM banner WHERE id > 2
        // $data = $collection->addFieldToSelect('image', 'link')
        //     ->addFieldToFilter('id',['gt' => 2])
        //     ->getData();
        // echo "<pre>";
        // print_r($data);

        // SELECT id, image FROM banner WHERE id > 2 AND image LIKE '%.png'
        $data = $collection->addFieldToSelect('id')
            ->addFieldToFilter('id',['gt' => 2])
            ->addFieldToFilter('image',['like' => '%.png'])
            ->getSelect();

        echo $data;
        // echo "<pre>";
        // print_r($data);

        //================================================
        //   working with data by objectManager
        //================================================
        // insert data to banner table
        // init model with objectmanager

        // $banner = $this->_objectManager->create('OpenTechiz\Banner\Model\Banner'); // truyen vao model

        // add data

        /*$banner->addData([
            'image' => 'avartar.png',
            'link' =>  'banner link'
        ]);
        $banner->save();*/

        // update data
        /*
        $data = $banner->load(1);
        $data->setImage("logo.png")->save();
        */

        // show data
        /*
        $data = $banner->load(1);
        print_r($data->getData());
        */

        // delete data
        /*
        $data = $banner->load(1);
        $data->delete();
        */
        // echo "done";
    }
}
