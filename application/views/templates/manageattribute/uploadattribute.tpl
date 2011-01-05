{include file="layouts/$layout/header.tpl" lightbox=true}
	<br/>
	Name of attribute: {$attribute.name}<br/>
	<div>
		<form method='post' action="{geturl controller='manageattribute' action='uploadattribute'}?actioncall=3&paramSet={$attribute.table}">
			<!--<a href="{geturl controller='manageattribute' action='uploadattribute'}?actioncall=3&paramSet={$attribute.table}&id={$detail.id}">delete</a>-->
			{foreach from=$attribute.details item=detail}
			<input type="checkbox" name='image_id[{$detail.id}]' value='{$detail.id}' />
			{$detail.details_name} / {$detail.price_offset} 
			<img src='/resources/userdata/tmp/thumbnails/{$detail.username}/{$attribute.attributeTable}/{$attribute.name}/{$detail.id}.W30_miniDetailImage.jpg'><br/>
			{/foreach}
			<button onclick="showloadingImage()">Delete selected color/fabric(s)</button>
		</form>
	</div>
	
	<div>
		<div id="customAttributeSetsCreationMainDiv">
	
		</div>
		<div id='createNewAttributeDivControls'>
			Name of new color/fabric set: <input type="text" value='{$attribute.name}' id='newAttributeSetNameInputID' style='display:none';/><button type='button' onclick="createNewAttributeSet('2', 'fabric_set','{$attribute.id}')">Add more colors to this color/fabric set</button>
		</div>
	</div>

{literal}
<script type="text/javascript">
function createNewAttributeSet(action, paramSet, id){
	attributeSetNameOriginal=$('newAttributeSetNameInputID').value;
	
	//alert('count is: '+fabricSetNameOriginal.length);
	if(attributeSetNameOriginal.length==0){
		alert('Please enter a name for this attribute set');
	}else{
		attributeSetName=filterStringWithSymbol(attributeSetNameOriginal,'_');
		//alert(fabricSetName);
		attributeSetDivMain=$('customAttributeSetsCreationMainDiv');
		var timestamp = new Date();
		attributeSetDivMain.insert( { bottom: "<form method='post' id='attributeSet-"+attributeSetName+"' action='/manageattribute/uploadattribute?actioncall="+action+"&paramSet="+paramSet+"&id="+id+"' enctype='multipart/form-data'>"
										  +"<div id='attributeSetForm-"+attributeSetName+"' >"
										  +"<strong>Color/fabric set: "+attributeSetNameOriginal+"</strong><input type='hidden' value='"+attributeSetName+"' name=attributeSet["+attributeSetName+"]/>"
										  +"<div class='attributeSetDetail'>"
										  +"Name: <input type='text' class='formSetNameText' name=attributeSet["+attributeSetName+"][name]["+timestamp.getTime()+"] />"
										  +"Price offset(optional): <input type='text' class='formSetPriceOffsetNumeric' name=attributeSet["+attributeSetName+"][price]["+timestamp.getTime()+"] />"
										  +"Image unpload(optional): <input type='file' name=customAttributeDetailImage["+timestamp.getTime()+"] />"
										  +"<button type='button' onclick='this.up().remove();'>Delete</button>"
										  +"<div class='fieldError'>sd</div></div>"
										  +"</div><button type='button' onclick='addDetailAttributeInSet(this)'>Add another color in this set</button><button type='button' onclick=verfityAndSubmitForm('attributeSet-"+attributeSetName+"')>Save</button><input type='submit' value='save' onclick='showloadingImage()'/></form>" } );
		//alert('here');
		//alert(attributeSetDivMain.down().id);
		$('createNewAttributeDivControls').hide();
		alert('here');
		//alert("'attributeSet-"+attributeSetName+"'"); 
		//new formEnhancer('attributeSet-'+attributeSetName);
		alert('here2');
	}
}

function addDetailAttributeInSet(element){
	alert(element.innerHTML);
	attributeSet=$('customAttributeSetsCreationMainDiv').down();
	attributeSetName=attributeSet.id.split("-")[1];
	alert(attributeSetName);
	attributeSetForm = $('attributeSetForm-'+attributeSetName);

	var timestamp = new Date();
	attributeSetForm.insert( { bottom: "<div class='attributeSetDetail'>"
		  							+"Name: <input type='text' class='formSetNameText' name=attributeSet["+attributeSetName+"][name]["+timestamp.getTime()+"]/>"
		  							+"Price offset(optional):<input type='text'  class='formSetPriceOffsetNumeric' name=attributeSet["+attributeSetName+"][price]["+timestamp.getTime()+"]/>"
		  							+"Image unpload(optional): <input type='file' name=customAttributeDetailImage["+timestamp.getTime()+"] />"
		  							+"<button type='button' onclick='this.up().remove();'>Delete</button>"
		  							+"<div class='fieldError'>sd</div></div>"
		  							});
	//alert('here at add new');
	
}
function verfityAndSubmitForm(formName){
	//textFormFields= $A('formText');
	alert('form name is: '+formName);
	alert('here');
	attributeSetDetails = $$('.attributeSetDetail');
	alert('here2');
	alert(attributeSetDetails.length);

	verifiedForm=true;
	attributeSetDetails.each(function(value){
		errorArray='';
		hasError=false;
		setName = value.down('input.formSetNameText');
		if(setName.value.length==0){
			alert('name is none can not process');
			errorArray +='You must enter a name for this attribute. ';
			hasError=true;
		}
		priceOffset = value.down('input.formSetPriceOffsetNumeric');
		alert(priceOffset.className);
		alert('here inside');
		if(priceOffset.value.length==0){
			alert('settin value to zero');
			priceOffset.value=0;
		}else if(isNaN(priceOffset.value)){
			alert('value is not zero');
			errorArray+='Price offset is not a number value. ';
			hasError=true;
		}

		if(hasError){
			alert('displaying error message');
			alert('fieldError existing '+value.down('div.fieldError').innerHTML);
			value.down('div.fieldError').innerHTML = errorArray;
			verifiedForm=false;
		}else{
			value.down('div.fieldError').innerHTML='';
		}
	});

	if(verifiedForm){
		showloadingImage(); 
		$(formName).submit();
	}	
}

function showloadingImage(){
	
	$('loadingImage').show();
	
}


</script>
{/literal}
{include file="layouts/$layout/footer.tpl"}