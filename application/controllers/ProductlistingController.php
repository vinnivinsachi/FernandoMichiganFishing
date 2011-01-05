<?php
	/*productlist handles only one product at a time and that is the product currently being created for listing or edited for relisting.
	*uses Formgenerator to generate the right form for different product_type
	*uses ObjectGenerator to generate the right object for the listing 
	*uses product delegation function getProductForUser(userid, product_id);
	*uses product delegation function generateGSDetailsSession()
	********/
	
	class ProductlistingController extends CustomControllerAction
	{
		public $product;
		public $productListing;
		public $request;
		public $product_purchase_type;
		public $product_category;
		public $product_type;
		public $product_tag;
		
		public function init()
		{
			parent::init();
			//require APPLICATION_PATH .'/../library/productConfig.php';
			$this->breadcrumbs->addStep('DancewearRialto partner product listing', $this->getUrl(null, 'productlisting'));
			//$this->request=new stdClass();
			//$_SESSION['categoryType'] = 'product';
			$this->gsNewProductListTrue = new Zend_Session_Namespace('gsNewProductListTrue');
			$this->gsExistingProductListInfo = new Zend_Session_Namespace('gsExistingProductListInfo');
			//echo $productConfig['purchase_type'][0];
			
		}
		
		public function preDispatch(){
			parent::preDispatch();
			//require APPLICATION_PATH .'/../library/productConfig.php';
			$this->request = $this->getRequest();
			//must have id and product type. otherwise redirect!XXXXXXXXXXXXXXXXXXXXXxx
			$this->product_id = $this->request->getParam('id');
			$this->product_purchase_type = $this->request->getParam('purchase_type');
			//$this->product_type = $this->request->getParam('product');
			//$this->product_tag = $this->request->getParam('tag');
			//check to see if there is a product id
			
			
			//echo 'here at predispatch';
			//echo 'echoing stuff'.$this->product_purchase_type.' '.$PRODUCT_CONFIG['purchase_type'];
			
			/*if($this->product_purchase_type =='' || !in_array($this->product_purchase_type, $this->productConfig['purchase_type'])){
				if($this->product_purchase_type =='customize' && $this->signedInUserSessionInfoHolder->generalInfo->user_type!='admin'){
					$this->messenger->addMessage('you are not allowed to upload customized products');
					$this->_redirect('index/error');
				}
				$this->messenger->addMessage('bad purchase type');
				//echo $this->product_purchase_type.'<br/>';
			
				$this->_redirect('index/error');
			}else{
				echo 'working!';
				$this->view->product_purchase_type = $this->product_purchase_type;
			}*/
			
			
			
			/*if($this->product_type!='' && !in_array($this->product_type, $this->availableProduct)){
				$this->messenger->addMessage('bad product type: '.$this->product_type);
				$this->_redirect('index/error');
			}
			if(!isset($this->product_id)||!is_numeric($this->product_id)){
				echo 'here at unset existing<br />';
				unset($this->gsExistingProductListTrue);
				$this->gsNewProductList=true;
			//check to see if there is a product_type
			}elseif(in_array($this->product_type, $this->availableProduct) && in_array($this->product_tag, $this->availableProductTags)){
				echo 'here at in array product type<br />';
				//if(isset($this->gsExistingProductListTrue)&&$this->gsExistingProductListTrue='true'){
				echo 'here at existing product listing true<br />';
				//check to see if that product is already loaded from database, if it is, load the product anyway.
				if(isset($this->gsExistingProductListInfo->products_info[$this->product_type][$this->product_id]->valid)){
					if($this->gsExistingProductListInfo->products_info[$this->product_type][$this->product_id]->valid){
						echo 'here at unsetting new product listing true<br />';
						$this->tempProduct = new DatabaseObject_Products($this->db);
						//$this->tempProduct = ObjectGenerator::generateProductForListing($this->db, $this->product_type);
						$this->tempProduct->getProductForUser($this->signedInUserSessionInfoHolder->generalInfo->userID, $this->product_id, $this->product_type);
						//this is to make sure that the product's username can be pulled for image attribute storage purposes
						$this->tempProduct->setUsernameForProduct($this->signedInUserSessionInfoHolder->generalInfo->username);
						unset($this->gsNewProductListTrue);
					}else{
						$this->_redirect('productlisting/productlistingerror');

					}
				}
				//if not loaded, load and then store to gxExisitngProductListInfo session
				else{
					echo 'here at load and settin existing product info session<br />';
					//load product and insert into the session
					//All products must have getProductForUser()
					$this->tempProduct = new DatabaseObject_Products($this->db);
					if($this->tempProduct->getProductForUser($this->signedInUserSessionInfoHolder->generalInfo->userID, $this->product_id, $this->product_type)){
						$this->tempProduct->setUsernameForProduct($this->signedInUserSessionInfoHolder->generalInfo->username);
						echo'product loaded for user<br />';
						$this->gsExistingProductListInfo->products_info[$this->product_type][$this->product_id]->valid=true;				
						$this->gsExistingProductListInfo->products_info[$this->product_type][$this->product_id]->details=$this->tempProduct->generateGSDetailsSession();
						//Zend_Debug::dump($this->gsExistingProductListInfo->products_info);
						//echo 'here is the -----this->gsExistingProductListInfo->products_info-------<br />'.Zend_Debug::dump($this->gsExistingProductListInfo->products_info);
						
					}else{
						echo 'failed to load product<br />';
						$this->gsExistingProductListInfo->products_info[$this->product_type][$this->product_id]->valid=false;
						$this->_redirect('productlisting/productlistingerror');

}
				}
			}else{
				echo 'error url<br />';
				$this->_redirect('productlisting/productlistingerror');

			}
			$this->productListing = new Zend_Session_Namespace('productListing');
			$this->view->signedInUser=$this->signedInUserSessionInfoHolder;*/
		}
	
		public function indexAction()
		{
			/*$this->product_category = $this->request->getParam('category');
			$currentProductSelectionPage = 'selectcategory';
			if($this->product_category=='' || !in_array($this->product_category, $this->productConfig['product_categories'])){
				//$this->messenger->addMessage('please select a main category of products to upload');
				$this->_forward($currentProductSelectionPage);
			}else{
				
				$this->view->product_category = $this->product_category;
				if($this->product_category=='women'){
					$currentProductSelectionPage='selectwomenproducttype';
					$this->_forward('selectwomenproducttype');
				}elseif($this->product_category=='men'){
					$currentProductSelectionPage='selectmenproducttype';
					$this->_forward('selectmenproducttype');
				}elseif($this->product_category=='jewelry'){
					$currentProductSelectionPage='selectjewelrytype';
					$this->_forward('selectjewelrytype');
				}elseif($this->product_category=='accessories'){
					$currentProductSelectionPage='selectaccessoriestype';
					$this->_forward('selectaccessoriestype');
				}
			}
			
			$this->product_type = $this->request->getParam('type');
			
			if($this->product_type=='' || !in_array($this->product_type, $this->productConfig['product_type'])){
				$this->messenger->addMessage('please select a correct category of products to upload');
				$this->_forward($currentProductSelectionPage);
			}else{
				$currentProductSelectionPage = 'enterattributeforproduct';
				$this->_forward($currentProductSelectionPage);
			}
			*/
			
			//for multiple users to login in and upgrade their account status and post items. 
			if(!($this->userObject->user_type!='generalSeller' || $this->userObject->user_type!='storeSeller')){
				echo 'you need to be upgrade to a seller in order to list items';
				//$this->_forward('upgradegeneralseller', 'account');
			}else{
				/*$size = $this->getRequest()->getParam('size_category');
				$sex= $this->getRequest()->getParam('sex');
				$type = $this->getRequest()->getParam('type');
				$heel = $this->getRequest()->getParam('heel');
				$tag = $this->getRequest()->getParam('productTag');
				$product_id =$this->getRequest()->getParam('id');
				$product =$size.$sex.$type.$heel;
				//echo $product;
				if(in_array($product, $this->availableProduct) && in_array($tag, $this->availableProductTags)){
					echo 'here at good product';
					$this->productListing->product_type = $product;
					$this->_redirect('productlisting/editproduct?id='.$product_id.'&product='.$product.'&tag='.$tag);
				}else{
					echo 'product type is: '.$product;
					echo 'you need to select a type of product that you would like to list';
				}*/
			}
			
			//include('productConfig.php');
			//Zend_Debug::Dump($productTypeConfig);
			//$this->view->productConfig = $productTypeConfig;
		}
		
		public function uploadbuynowproductAction(){
			$this->view->purchase_type = 'buy now';
			$this->view->editproductlink='editbuynowproduct';
		}
		public function uploadcustomizeproductAction(){
			$this->view->purchase_type = 'customize';
			$this->view->editproductlink='editcustomeproduct';
			
		}
		
		//retrievs the necessary form for product uploading
		//allows only one selection per attribute
		//allows multiple picture uploads
		//this is a ultimate product editing page.
		public function editbuynowproductAction(){
			$this->request=$this->getRequest();
			$this->purchase_type = $this->request->getParam('purchase_type');
			$this->product_category=$this->request->getParam('category');
			$this->product_type=$this->request->getParam('type');
			$this->product_tag=$this->request->getParam('tag');
		    $this->product_id=$this->request->getParam('id');
		}
		
		//retrievs the necessary form for product uploading
		//allows a range on selections per attribute
		//ultimate product editing page. 
		public function editcustomeproductAction(){
			$this->purchase_type = $this->request->getParam('purchase_type');
			$this->product_category=$this->request->getParam('category');
			$this->product_type=$this->request->getParam('type');
			$this->product_tag=$this->request->getParam('tag');
			if($this->productConfig[$this->purchase_type][$this->product_category][$this->product_type]==$this->product_tag){
				//the path to product is good. 
				
			}
		}
		
		/*public function editgeneralinfoAction(){
			$this->purchase_type = 'customize';
			$this->product_category=$this->request->getParam('category');
			$this->product_type=$this->request->getParam('type');
			$this->product_tag=$this->request->getParam('tag');
			if($this->productConfig[$this->purchase_type][$this->product_category][$this->product_type]==$this->product_tag){
				//display the form, 
			}
		}*/
		
		public function editproductAction()
		{
		
			$param['purchase_type'] = $this->request->getParam('purchase_type');
			$param['product_category']=$this->request->getParam('category');
			$param['product_type']=$this->request->getParam('type');
			$param['product_tag']=$this->request->getParam('tag');
			$param['product_id'] = $this->request->getParam('id');
			if($param['product_id']==''){
				$param['product_id']=0;
			}
			
			$config = Zend_Registry::get('config');
			echo $config->paths->base;
			
			if(in_array($param['product_tag'], $this->productConfig['upload_menu_item'][$param['purchase_type']][$param['product_category']][$param['product_type']])){
				//display the form, 
				echo 'here at good attribute selection';
				$param['inventory_attribute_table'] = $this->productConfig['tag_attribute_table'][$param['product_tag']];
				$fp = new FormProcessor_Product($this->db, $this->signedInUserSessionInfoHolder->generalInfo, $param);
				if($this->request->isPost()){
					echo 'here at post<br />';
					if($fp->process($this->request)){
						Zend_Debug::dump($_FILES);
						
							//Zend_Debug::dump($v);
							echo 'product name is: '.$fp->product->name;
						DatabaseObject_Helper_ImageUpload::uploadImage($_FILES['generalImages'], $this->db,'products_images',$param['product_tag'], $fp->product_id,$fp->product->name);
						//}
						//echo 'productlisting/editproduct?purchase_type='.$fp->product->purchase_type.'&category='.$fp->product->product_category.'&type='.$fp->product->product_type.'&tag='.$fp->product->product_tag.'&id='.$fp->product->getId();
						//$this->_redirect('productlisting/editproduct?purchase_type='.$fp->product->purchase_type.'&category='.$fp->product->product_category.'&type='.$fp->product->product_type.'&tag='.$fp->product->product_tag.'&id='.$fp->product->getId());
					}
				}
				$this->view->fp = $fp;
			}else{
				$this->messenger->addMessage('you have an error in this request');
				$this->_redirect('index/error');
			}
		}
		
		
		
		public function productlistingpreviewAction(){
			if(!(isset($this->product_id)||($this->product_id>0)&&is_numeric($this->product_id))){
				echo 'error url<br />';
				$this->_redirect('productlisting/productlistingerror');

}elseif(!(in_array($this->product_type, $this->availableProduct))){
				echo 'product type is: '.$this->product_type;
				echo 'error bad type';
				$this->_redirect('productlisting/productlistingerror');

}else{
				
				echo 'display shit';	
				$this->view->product = $this->tempProduct;
				
				//Zend_Debug::dump($this->tempProduct);
				echo 'count of tempProduct images: '.count($this->tempProduct->images);
				//Zend_Debug::dump($this->tempProduct->images);
			}
			//echo 'username is: '.$this->tempProduct->username;
			//*******************IMAGES ATTRIBUTE*****************************//
			$selectColumnOptions=array('group'=>true, 
									   'value'=>array ('image_attribute_id', 'attribute_name', 'image_name', 'price_adjustment'));
			$attributeArray = DatabaseObject_Helper_ProductListing::getImageAttribute($this->db, $this->tempProduct->username, $this->tempProduct->product_type, $this->product_id, $selectColumnOptions);
			
			$selectColumnOptions=array('group'=>false, 
									   'value'=>array ('image_attribute_id', 'attribute_name', 'image_name', 'price_adjustment'));
			$imageAttribute = DatabaseObject_Helper_ProductListing::getImageAttribute($this->db, $this->tempProduct->username, $this->tempProduct->product_type, $this->product_id, $selectColumnOptions);
			
			$this->view->attributeArray=$attributeArray;
			$this->view->imageAttribute=$imageAttribute;
			
			//*******************SIZE ATTRIBUTE*******************************//
			$selectColumnOptions=array('group'=>true, 
									   'value'=>array ('size_attribute_id', 'attribute_name', 'size_name', 'price_adjustment'));
			$sizeAttributeArray = DatabaseObject_Helper_ProductListing::getSizeAttribute($this->db, $this->tempProduct->username, $this->tempProduct->product_type, $this->product_id, $selectColumnOptions);
			
			$selectColumnOptions=array('group'=>false, 
									   'value'=>array ('size_attribute_id', 'attribute_name', 'size_name', 'price_adjustment'));
			$sizeAttribute = DatabaseObject_Helper_ProductListing::getSizeAttribute($this->db, $this->tempProduct->username, $this->tempProduct->product_type, $this->product_id, $selectColumnOptions);
			
			$this->view->sizeAttributeArray=$sizeAttributeArray;
			$this->view->sizeAttribute=$sizeAttribute;
			
			
			//*******************MEASUREMENT ATTRIBUTE*************************//
			$selectColumnOptions=array('group'=>false, 
									   'value'=>array ('measurement_attribute_id', 'measurement_name', 'beginning_measurement', 'ending_measurement', 'incremental_measurement','price_adjustment','filename', 'video_youtube'));
			$measurementAttribute = DatabaseObject_Helper_ProductListing::getMeasurementAttribute($this->db, $this->tempProduct->username, $this->tempProduct->product_type, $this->product_id, $selectColumnOptions);
			
			$this->view->measurementAttribute = $measurementAttribute;
			
			//********************Tags*****************************************//
			$tags = DatabaseObject_Helper_ProductListing::loadTagForObject($this->tempProduct, 'storeSeller');
			//Zend_Debug::dump($tags);
			$this->view->tags = $tags;
		}
		

		
		public function markproductasnewAction()
		{
			DatabaseObject_Helper_ProductListing::markAsNew($this->tempProduct,1);
			$this->_redirect($_SERVER['HTTP_REFERER']);
		}
		
		public function removeproductasnewAction(){
			DatabaseObject_Helper_ProductListing::markAsNew($this->tempProduct,0);
			$this->_redirect($_SERVER['HTTP_REFERER']);
		}
		
		public function sendproductliveAction(){
			//$validate = $this->request->isXmlHttpRequest();
			if(isset($this->tempProduct)){
				$this->tempProduct->status='LIVE';
				$this->tempProduct->save();
							$this->_redirect($_SERVER['HTTP_REFERER']);
			}else{
				
			}
		}
		
		public function sendproductdraftAction(){
			if(isset($this->tempProduct)){
				$this->tempProduct->status='DRAFT';
				$this->tempProduct->save();
							$this->_redirect($_SERVER['HTTP_REFERER']);
			}else{
				
			}
		}
		
		public function viewpendingproductAction(){
			if($this->product_tag!='' && in_array($this->product_tag, $this->availableProductTags)){
				$options['product_tag']=$this->product_tag;
				$options['no_options']=false;	
			}else{
				$options['no_options']=true;	
			}
			$productList = DatabaseObject_Helper_ProductListing::retrieveAllProduct($this->db, 'products', $this->signedInUserSessionInfoHolder->generalInfo->userID, $options);
		
			//Zend_Debug::dump($productList);
			$this->view->productList = $productList;
			
			$tags = DatabaseObject_Helper_ProductDisplay::retrieveSingleTagFroProduct($this->db, 'products', $this->signedInUserSessionInfoHolder->generalInfo->userID);
			//$tags = DatabaseObject_Helper_ProductDisplay::retriveAllTagsForProductType($this->db, 'products_tags', $this->signedInUserSessionInfoHolder->generalInfo->userID);
			$this->view->tagArray = $tags;
		//*********************************************************OLD VERSION*********************************//
				/*$tag = $this->request->getParam('tag');
				$product = $this->request->getParam('product');
				
				if($product=='')
				{
					$product='pants';
				}
				$options = array(
								'order' => 'ts_created DESC',
								'tag' => $tag,
								'product' => $product
				);				
				
				//$v is used here and all products must have a loadAllProductForUser
				$product = ObjectGenerator::generateProductForListing($this->db, $product)->loadAllProductForUser($this->signedInUserSessionInfoHolder->generalInfo->userID, $options);
				
				$this->view->pantsProduct = $product;
				
				//retrieve appropiate tages for product category now
				$tagArray=array();
				foreach($this->availableProduct as $k=>$v)
				{
					$options=array('groupby'=>'tag');
					$tags = DatabaseObject_Helper_ProductDisplay::retriveAllTagsForProductType($this->db, $v, $options);
					
					$tagArray[$v]['tag']=$tags;
				}
				
				$this->view->tagArray = $tags;


				$this->view->productTypes = $this->availableProduct;*/
		}
		
	
		public function productlistingerrorAction(){
			
		}
		
		public function editAction()
		{
			
		}
		
		public function previewAction()
		{
			
		}
		
		public function setstatusAction()
		{
			
		}
		
		public function addinventoryAction()
		{
			
		
		}
		
		public function tagsAction()
		{
			
			if(!isset($this->tempProduct)){
				
				echo 'you are here at product unavailable';
			}
			
			$tag = $this->request->getPost('tag');
			
			if($this->request->getPost('add'))
			{
				DatabaseObject_Helper_ProductListing::addTagToObject($this->tempProduct, $tag,'storeSeller', $this->signedInUserSessionInfoHolder->generalInfo->userID );	
				$this->messenger->addMessage('Categories added to product');
			}
			else if($this->request->getPost('delete'))
			{
				DatabaseObject_Helper_ProductListing::removeTagFromObject($this->tempProduct, $this->request->getParam('tagid'), 'storeSeller', $this->signedInUserSessionInfoHolder->generalInfo->userID );	
				$this->messenger->addMessage('Categories deleted for user product');
			}
			//$this->_redirect('productlisting/productlistingpreview?id='.$this->tempProduct->getId().'&product='.$this->product_type.'&tag='.$this->product_tag);
		}
		
		public function categoriesAction()
		{
			
		}
		
		
		public function addmeasurementtoproductAction(){
			if($this->request->getPost('upload')){
				$fp=new FormProcessor_Helper_MeasurementAttribute($this->tempProduct);
				
				if($fp->process($this->request)){
					echo 'here at added to product';
				}else{
					echo 'error';
				}
			}elseif($this->request->getPost('delete')){
				$id = $this->request->getParam('measurement');
				$measurement = new DatabaseObject_Attribute_MeasurementWithImageAttribute($this->db);
				
				if($measurement->loadForPost($id, $this->tempProduct->username, $this->product_type, $this->product_id))
				{
					$measurement->delete();
					//Zend_Debug::dump($measurement);
					echo 'measurement deleted';
				}else{
					echo 'failed at delete';
				}
				
			}
		}
		
		public function addsizeattributetoproductAction(){
			
			if($this->request->getPost('upload')){
				$fp=new FormProcessor_Helper_SizeAttribute($this->tempProduct);
				
				if($fp->process($this->request)){
					echo 'here at added to product';
				}else{
					echo 'error';
				}
			}elseif($this->request->getParam('delete')){
				$id = $this->request->getParam('size');
				$size = new DatabaseObject_Attribute_SizeAttribute($this->db);
				
				if($size->loadForPost($id, $this->tempProduct->username, $this->product_type, $this->product_id))
				{
					$size->delete();
					//Zend_Debug::dump($measurement);
					echo 'size deleted';
				}else{
					echo 'failed at delete';
				}
				
			}
			$this->_redirect('productlisting/productlistingpreview?id='.$this->tempProduct->getId().'&product='.$this->product_type.'&tag='.$this->product_tag);

		}
		
		//work with qualified products. 
		public function imagesAction()
		{
			if($this->request->getPost('upload')){
				echo 'here at image upload<br />';
				$fp=new FormProcessor_Image($this->tempProduct, 'storeSeller');
				echo 'here at instantiating image<br />';
				if($fp->process($this->request)){
					echo 'here at process request<br />';
					//then update the session variable for it
					$this->messenger->addMessage('Image uploaded');
				}else{
					echo 'here at process error<br />';
					foreach($fp->getErrors() as $error)
					{
						$this->messenger->addMessage($error);
					}
				}
			}
			elseif($this->request->getParam('delete'))
			{
				/*$image_id = (int) $this->request->getPost('image');
				$image = new DatabaseObject_Image($this->db, $this->tempProduct->image_table, $this->tempProduct->product_tag);
				
				if($image->loadForPost($this->product_id, $image_id)){
					$image->delete(); //the files are unlinked/deleted at preDelete.
					////echo 'image at delete';
					
					if($this->request->isXmlHttpRequest()){
						$json = array('deleted' =>true, 'image_id' =>$image_id);
					}
					else{
						$this->messenger->addMessage('Image deleted');
					}
				}*/
			}
			
			/*elseif($this->request->getPost('reorder'))
			{
				$order = $request->getPost('post_images');
				$product->setImageOrder($order);

			}*/
			$this->_redirect('productlisting/productlistingpreview?id='.$this->tempProduct->getId().'&product='.$this->product_type.'&tag='.$this->product_tag);
		}
		
		//must have an id and producttype
		public function addimageattributetoproductAction(){
			if($this->request->getPost('upload')){
				echo 'here at image upload<br />';
				$fp = new FormProcessor_Helper_ImageAttribute($this->tempProduct);
				echo 'here at instantiating image<br />';
				if($fp->process($this->request)){
					echo 'here at process request<br />';
					//then update the session variable for it
					$this->messenger->addMessage('Image uploaded');
				}else{
					echo 'here at process error<br />';
					foreach($fp->getErrors() as $error)
					{
						$this->messenger->addMessage($error);
					}
				}
			}
			elseif($this->request->getParam('delete'))
			{
				//echo "at delete";
				//must check availability, can not delete other people stuff.
				$image_id = (int) $this->request->getParam('image');
				//$attribute_name = $this->request->getParam('attribute_name');
				$image = new DatabaseObject_Attribute_ImageAttribute($this->db);
				/*$image->setSaveFilePath($this->tempProduct->username, $this->tempProduct->product_type, $this->tempProduct->getId(), $attribute_name);*/
				if($image->loadForPost($this->tempProduct->getId(), $image_id)){
					$image->delete(); //the files are unlinked/deleted at preDelete.
					////echo 'image at delete';
					
					/*if($request->isXmlHttpRequest()){
						$json = array('deleted' =>true, 'image_id' =>$image_id);
					}
					else{
						$this->messenger->addMessage('Image deleted');
					}*/
				}
			}
			$this->_redirect('productlisting/productlistingpreview?id='.$this->tempProduct->getId().'&product='.$this->product_type.'&tag='.$this->product_tag);
		}
	}
?>