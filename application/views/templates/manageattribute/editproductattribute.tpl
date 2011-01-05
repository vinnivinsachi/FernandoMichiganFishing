{include file="layouts/$layout/header.tpl" lightbox=true}
	<fieldset><legend>
	Custom product attribute management</legend>
	{include file="manageattribute/$attributePartial"}
	{$attributePartial}
		
	
	<br/>
	<br/>
	<br/>
		<strong style="font-size:1.5em;">Color and fabric attribute selection</strong><br/>
	Please select what major color/fabric categories does this product belongs to. <br/>
	(if you have this product in a fabric or color that is not listed below, please select its closest cousing<br/>
	example: if you have this product in a shade of red like maroon, please select Red) <br/>
	<input type="checkbox" name="color['black']"/>Black
	<input type="checkbox" name="color['light tan']"/>Light tan
	<input type="checkbox" name="color['dark tan']"/>Dark tan
	<input type="checkbox" name="color['brown']"/>Brown
	<input type="checkbox" name="color['silver']"/>Silver
	<input type="checkbox" name="color['Gold']"/>Gold
	<input type="checkbox" name="color['gray']"/>Gray
	<input type="checkbox" name="color['white']"/>White
	<input type="checkbox" name="color['red']"/>Red
	<input type="checkbox" name="color['pink']"/>Pink
	<input type="checkbox" name="color['orange']"/>Orange
	<input type="checkbox" name="color['yellow']"/>Yellow
	<input type="checkbox" name="color['green']"/>Green
	<input type="checkbox" name="color['cyan']"/>Cyan
	<input type="checkbox" name="color['blue']"/>Blue
	<input type="checkbox" name="color['magenta']"/>Magenta
	<input type="checkbox" name="color['Purple']"/>Purple
	
	<br/>
	<br/>
	
	Your available Color/Fabric sets:
		If default system color selection is used, this product will be using the colors checked above for color selection during product purchase<br/> 
	
	<select name="customFabricSets">
	<option value="default">Default system color categories</option>
	</select>
	<br/>
	<br/>
	If you would like to create a color/fabric set for this product listing or future product listings, click below
	<br/>
	<div id="customAttributeSetsCreationMainDiv">
	
	</div>
	<div id='createNewAttributeDivControls'>
	Name of new color/fabric set: <input type="text" id='newAttributeSetNameInputID'/><button type='button' onclick="createNewAttributeSet('newAttributeSetNameInputID','customAttributeSetsCreationMainDiv', 'createNewAttributeDivControls', '1', 'fabric_set','')">Create this color/fabric set</button> 
	</div>
	
	<br/><br/><br/>
	<strong style="font-size:1.5em;">Custom attribute selection</strong><br/>
	[Please drag your available custom attributes into this selection to add to this product]
	[two boxes, one with all available ones, one with none]
	If you would like to add an additional attribute selections for this product during product purchase,<br/> 
	You may create the custom attribute below<br/>
	(Example: if this product comes with 3 different amount of jewelry additions for different amount of extra charges to the product, <br/>
	You may create a custom attribute selection called 'Jewelry addition', and then add the 3 different selections with the name of selection,<br/>
	 an optional picture attachment to that selection, and optional addition extra charge accociated with that selection.<br/>
	
	<div id="customAttributeMainDiv">
		
	</div>
	<div id='createNewCustomAttributeDivControls'>
	
	Name of new attribute selection: <input type="text" id='newCustomAttributeNameInputID'/><button type="button" onclick="createNewAttributeSet('newCustomAttributeNameInputID','customAttributeMainDiv', 'createNewCustomAttributeDivControls', '1', 'custom_attribute','')">Create this attribute selection</button>
	</div>	
	</fieldset>

{literal}
<script type="text/javascript">
function createNewAttributeSet(nameInput, mainDiv, hideControlDiv, action, paramSet, id){
	attributeSetNameOriginal=$(nameInput).value;
	
	//alert('count is: '+fabricSetNameOriginal.length);
	if(attributeSetNameOriginal.length==0){
		alert('Please enter a name for this attribute set');
	}else{
		attributeSetName=filterStringWithSymbol(attributeSetNameOriginal,'_');
		//alert(fabricSetName);
		attributeSetDivMain=$(mainDiv);
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
										  +"</div><button type='button' onclick=\"addDetailAttributeInSet('"+mainDiv+"', this)\">Add another color in this set</button><button type='button' onclick=verfityAndSubmitForm('attributeSet-"+attributeSetName+"')>Save</button><input type='submit' value='save' onclick='showloadingImage()'/></form>" } );
		//alert('here');
		//alert(attributeSetDivMain.down().id);
		$(hideControlDiv).hide();
		alert('here');
		//alert("'attributeSet-"+attributeSetName+"'"); 
		//new formEnhancer('attributeSet-'+attributeSetName);
		alert('here2');
	}
}

function addDetailAttributeInSet(mainDiv, element){
	alert(element.innerHTML);
	attributeSet=$(mainDiv).down();
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