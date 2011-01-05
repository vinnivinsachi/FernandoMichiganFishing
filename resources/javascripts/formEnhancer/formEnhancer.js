// JavaScript Document
formEnhancer = Class.create();

formEnhancer.prototype={
	form : null,
	boolResponseRequestUpdate:null,
	strResponseRequestUpdateDiv:null,
	initialize:function(form, boolResponseUpdate, strUpdateDiv)
	{
		//alert('at form init');
		this.form=$(form);
		this.form.observe('submit', this.onSubmit.bindAsEventListener(this));
		this.resetErrors();
		if(boolResponseUpdate==1){
			this.boolResponseRequestUpdate=1;
			this.strResponseRequestUpdateDiv=$(strUpdateDiv);
		}
	},
	resetErrors : function(){	
		this.form.getElementsBySelector('.error').invoke('hide');
	},
	
	showError :function(key, val){
		//alert('here at show error');
		var formElement=this.form[key];
		//alert('form key is: '+key);
		var container = formElement.up().down('.error');
		//alert('container is: '+container.innerHTML);
		if(container){
			container.update(val);
			container.show();
		}
	},
	onSubmit :function(e){
		Event.stop(e);
		
		var options={
			parameters: this.form.serialize(true),
			method: this.form.method,
			contentType: 'multipart/form-data',
			onSuccess: this.onFormSuccess.bind(this)
		};
		
		this.resetErrors();
		new Ajax.Request(this.form.action, options);
	},
	onFormSuccess: function(transport){
		//alert('on form success');
		var json = transport.responseText.evalJSON(true);
		var errors = $H(json.errors);
		//alert('error size is: '+errors.size());
		if(errors.size()>0 && errors.size()!=38  &&errors.size()!=43 ){ //38 characters is very strange here because when there is no error, the size of errors is 38... hm..
			//alert('here at form error');
			
			this.form.down('.error').show();
			errors.each(function(pair)
								 {
									// alert(pair.key);
									// alert(pair.value);
									 this.showError(pair.key, pair.value);
								 }.bind(this));
		}else{
			this.form.submit();
		}
	}
}