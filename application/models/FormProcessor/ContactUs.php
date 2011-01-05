<?php

	class FormProcessor_ContactUs extends FormProcessor
	{
		protected $db = null;
		public $user = null;
		public $post = null;
		
		static $tags=array(
			'a' =>array('href', 'target','name'),
			'img' =>array('src', 'alt'),
			'b' =>array(),
			'strong' =>array(),
			'em' =>array(),
			'i' =>array(),
			'ul' =>array(),
			'li' =>array(),
			'ol' =>array(),
			'p' =>array(),
			'br' =>array(),
			);
		
		public function __construct($db)
		{
			parent::__construct();
			
			$this->db = $db;
			
			
			$this->post= new DatabaseObject_ContactUs($db);			
			
		}
		
		public function process(Zend_Controller_Request_Abstract $request)
		{
			//echo "<br/>here at process.";
			$this->first_name = $this->sanitize($request->getPost('first_name'));
			$this->last_name =$this->sanitize($request->getPost('last_name'));
			
			if(strlen($this->first_name)==0)
			{
				$this->addError('first_name', 'Please enter your first name');//this is a giving FormProcessor.php function. 
			}
			if(strlen($this->last_name)==0)
			{
				$this->addError('last_name', 'Please enter your last name');//this is a giving FormProcessor.php function. 
			}
			
			$this->email = $this->sanitize($request->getPost('email'));
			$validator = new Zend_Validate_EmailAddress();
			
			if(strlen($this->email)==0)
			{
				$this->addError('email', 'Please enter you email address');
			}
			elseif(!$validator->isValid($this->email))
			{
				$this->addError('email', 'Please enter a valid email address');
			}
			else
			{
				$this->email = strtolower($this->email);
			}
			
			
			$this->description = self::cleanHtml($request->getPost('description'));
			
			//echo "<br/>here before there is error().";
			
			if(!$this->hasError())
			{
				$this->post->first_name = $this->first_name;
				$this->post->last_name = $this->last_name;
				$this->post->email = $this->email;
				
				
				$this->post->description = $this->description;
				$this->post->save();
			
			}
			
			return !$this->hasError();
		
		}
		
		//temporary placeholder for clean HTML
		public static function cleanHtml($html)
		{
			$chain = new Zend_filter();
			//$chain->addFilter(new Zend_Filter_StripTags(self::$tags));
			$chain->addFilter(new Zend_Filter_StringTrim());
			//$chain = new Zend_Filter_HtmlEntities();
			
			$html = $chain->filter($html);
			$html = stripslashes($html);
		
			//echo $html;
			$temp = $html;			
		while(1)
			{
				$html = preg_replace('/(<[^>]*)javascript:([^>]*>)/i', '$1$2', $html);
				
				//if nothing changed this iteration then break the loop
				if($html==$temp)
				{
					break;
				}
				
				$temp = $html;
			}
				

			return $html;
		}
		
	}
?>