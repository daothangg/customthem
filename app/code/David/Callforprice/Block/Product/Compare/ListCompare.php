<?php
namespace David\Callforprice\Block\Product\Compare;
class ListCompare extends \Magento\Catalog\Block\Product\Compare\ListCompare{
    public function getProductPrice(\Magento\Catalog\Model\Product $product, $id=''){
        $html=$this->getLayout()->createBlock('\Magento\Framework\View\Element\Template')->assign('product',$product)->setTemplate('David_Callforprice::button.phtml')->toHtml();
        $priceRender=$this->getLayout()->getBlock('product.price.render.default');
        $price ='';
        if($priceRender){
            $price=$priceRender->render(
                \Magento\Catalog\Pricing\Price\FinalPrice::PRICE_CODE,
                $product,
            [
                
                'price_id'=>'product_price'.$product->getId() .$id,
                'display_minimal_price'=>true,
                'zone'=>\Magento\Framework\Pricing\Render::ZONE_ITEM_LIST,
            ]
        );


        }
        return $price . $html;
    
    }
}