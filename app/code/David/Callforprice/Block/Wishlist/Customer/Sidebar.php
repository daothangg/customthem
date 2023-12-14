<?php 
namespace David\Callforprice\Block\Wishlist\Customer;
use Magento\Catalog\Model\Product;
use Magento\Framework\Pricing\Render;
class Sidebar extends \Magento\Wishlist\Block\Customer\Sidebar
{
    public function getProductPriceHtml(
        Product $product, $priceType,
        $renderZone = Render::ZONE_ITEM_LIST, 
        array $arguments = []
        ){
            if (!isset($arguments['zone'])){
                $arguments['zone']=$renderZone;
            }
            $price='';
            $html = $this->getLayout()->createBlock('Magento\Framework\View\Element\Template')->assign('product', $product)->setTemplate('David_Callforprice::button.phtml')->toHtml();
   
            $priceRender=$this->getpriceRender();
            if($priceRender){
                $price= $priceRender->render($priceType,$product,$arguments);
                
            }
            return $price . $html;
        }
        private function getpriceRender(){
            $priceRender=$this->getLayout()->getBlock('product.price.render.default');
            if(!$priceRender){
                $priceRender=$this->getLayout()->createBlock(
                    'Magento\Framework\Pricing\Render',
                    'product.price.render.default',
                    [
                        'data'=>[
                            'price_render_handle'=>'catalog_product_prices'
                        ],
                    ]
                    );
                    
            }
            return $priceRender;
        }
}

