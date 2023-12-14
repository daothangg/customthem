var config = {
	
     map: {
        '*': {           
            'Qty':"Magento_Checkout/js/update_qty"
			// 'fiedId':"Magento_Checkout/js/view/customjs"
			
		}
        }, 

    shim: {
        'Qty': {
            deps: ['jquery']
        }
    }
};