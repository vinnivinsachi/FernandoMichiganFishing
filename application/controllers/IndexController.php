<?php
	class IndexController extends CustomControllerAction
	{
		public function init(){
			parent::init();
		}
		
		public function preDispatch()
		{
			parent::preDispatch();	
			$this->view->action = $this->getRequest()->getParam('action');
			
		}
	
		public function indexAction()
		{
			//$this->breadcrumbs->addStep('Dancewear Rialto', $this->getUrl(null, 'index'));
			//echo 'first leg';
			//$this->view->layout =''
		}
		
		public function homeAction(){
			
		}
		
		public function lakefishingAction(){
			
		}
		
		public function riverfishingAction(){
			
		}
		
		public function servicesAction()
		{
		
		}
		
		public function lodgingandentertainmentAction()
		{
			$this->breadcrumbs->addStep('Terms');
		}
		
		public function reservationsAction()
		{
		
		}
		
		
		public function photosAction()
		{
			$ids=array();
			$i=1;
			while($i<=24){
				$ids[]=$i;
				echo $i++;	
			}
			$this->view->ids=$ids;
		}
		
		public function fishreportblogAction(){
			echo 'you have an error in your selection';
		}
		
		public function whattobringAction()
		{
		
		
		}
		
		public function contactusAction()
		{
			$request=$this->getRequest(); //zend function returns all get and post items. 
			
			$fp = new FormProcessor_ContactUs($this->db);
			
			if($request->isPost()) //zend function
			{
				if($fp->process($request))	//custom defined function in UserRegistration.php
				{
					
					
					$templater = new Templater();			
					
					$message = new DatabaseObject_ContactUs($this->db);
					$message->loadByID($fp->post->getId());

					$templater->online_message=$message;

					
					//fetch teh e-amil body
					$body = $templater->render('email/contact-us.tpl');
					
					//extract the subject from the first line
					list($subject, $body) = preg_split('/\r|\n/', $body, 2);
					
					//now set up and send teh email
					$mail = new Zend_Mail();
					
					//set the to address and the user's full name in the 'to' line
					//echo "<br/> here at user email address: ".$this->email."<br/>";
					$mail->addTo('vinzha@gmail.com', trim('Fernando'));
					$mail->addTo('frivero@emich.edu', trim('Fernando E'));
					//get the admin 'from details form teh config
					$mail->setFrom('nolimitecharters@gmail.com', 'nlc-no-reply');
					
					//set the subject and boy and send the mail
					$mail->setSubject('No Limit Charters online message');
					$mail->setBodyText(trim($body));
					$mail->send();
					$this->_forward('contactusconfirmation');
				}
			}
			
			$this->breadcrumbs->addStep('Contact Us');
			$this->view->fp = $fp;
			
		}
		
		public function aboutusAction()
		{
		
		
		}
		
		public function contactusconfirmationAction(){
		}
		
		public function faqAction()
		{
			/*$options=array('productTag'=>'Latin women shoes',
						   'productShoeSizes' => 'Euro_34_5');
			DatabaseObject_Helper_SizeFinder::findSizeByAttribute($this->db, $options);*/
			/*
			$API_KEY = "your_api_key";
$SECRET_ACCESS_KEY = "your_secret_key";
// you might think you could use the PHP const DATE_RFC1123 but it is defined as "D, d M Y H:i:s O"
$http_date = gmdate("D, d M Y H:i:s T");
// (ex. Sat, 12 Jul 2008 09:04:28 GMT)
 
$parameters = "user_id=1234&body=" . urlencode("Art thou not Romeo, and a Montague?");
//user_id=1234&body=Art+thou+not+Romeo%2C+and+a+Montague%3F
 
$canonical_string = $API_KEY . $http_date . $parameters;
$b64_mac = base64_encode(hash_hmac('sha1', $canonical_string, $SECRET_ACCESS_KEY,true));
 
$authentication = "Zeep " . $API_KEY . ":" . $b64_mac;
 
echo($authentication);*/
/*
POST /api/send_message HTTP/1.1
Host: zeepmobile.com
Authorization: Zeep cef7a046258082993759bade995b3ae8:XGPPx8+Me8RBoEUTPO6LSiSLDn4=
Date: Thu, 25 Mar 2010 02:35:20 GMT
Content-Type: application/x-www-form-urlenGistd
*/


			/*$product = new DatabaseObject_Products($this->db);
			$product->product_type = 'pants';
			$product->name = 'black';
			$product->User_id = '1';
			$product->Username='vinzha';
			$product->brand ='BDdance';
			$product->price = '1453';
			$product->discount_price='341';
			$product->save();*/
			
			
			/*include('/simple_html_dom.php');
			// Create DOM from URL or file
			$html = file_get_html('http://www.inventory.souldancerusa.com/shoes/www/inventorylist.asp?cat=LL');
			
			$table = $html->find('table');
			
			$productTable;
			
			$productArray = array();
			$massProductArray = array();
			
			foreach($table as $k=>$v){
				//echo $k;
				if ($k=='5')
				{
					$productTable = $v->find('tr');
					foreach($productTable as $key=>$value){
						
						$row = $value->find('td');
						$tempProductId;
						foreach($row as $keyBase=>$valueBase){
							
						echo $valueBase->plaintext.'  /  ';
						}
						echo '<br />';
					}
						
				}
			}
			
			
			foreach($massProductArray as $k=>$v)
			{
				//echo $k;
				foreach($v as $key=>$value)
				{
				}
			}*/
			//Zend_Debug::dump($massProductArray);
			
			
			
			
			//echo $productTable;
			
			
			
			//echo $tr;
			
			
			//echo $html;
			// Find all images 
			

			
			/*$product = new DatabaseObject_Product_Pants($this->db);
			$product->load('48');
			
			echo 'here at username'.$product->brand;
			echo 'here at product profile'.$product->profile->description;*/
			
			//DatabaseObject_Helper_ProductListing::markAsNew($product);
				//DatabaseObject_Helper_Usermanager::addRewardPointToUser($this->db, 'cQ7kM4bMNx', '4', 'from new member registration', $_SERVER['REMOTE_ADDR'],'cQ7kM4bMNx');
			//The removal of directory set by apache. 
			/*$directory = "/home/ve/visachidesign.com/html/data/uploaded-files/test1/";
			function remove_dir($current_dir) {
		   
					if($dir = @opendir($current_dir)) {
					while (($f = readdir($dir)) !== false) {
						if($f > '0' and filetype($current_dir.$f) == "file") {
							unlink($current_dir.$f);
						} elseif($f > '0' and filetype($current_dir.$f) == "dir") {
							remove_dir($current_dir.$f.'//');
						}
					}
					closedir($dir);
					rmdir($current_dir);
				}
			}
			
			remove_dir($directory);
  */
			/*$image = new DatabaseObject_ImageAttribute($this->db);
			
			$image->setSaveFilePath('tester1', 'pants', '2', 'color');
			
			$image->GetUploadPath();
			echo '<br />';
			$image->GetThumbnailPath();*/
			/*
			$product = new DatabaseObject_Product_Pants($this->db);
			$product->User_id = 15;
			$product->name='test pants';
			$product->price=145.34;
			$product->status='D';
			$product->brand='custom';
			$product->body_height=174;
			$product->body_waist=34;
			$product->body_hip=37;
			$product->waist_to_floor=45;
			$product->profile->color='blue';
			$product->profile->material='gaberdine';
			//$product->save();
			
			$_SESSION['testItem']=$product;
			$_SESSION['testItem']->save();*/
		}
		
}
?>