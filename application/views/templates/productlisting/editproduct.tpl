{include file="layouts/$layout/header.tpl" lightbox=true}

	<div id="leftContainer" style="width:60%;">
    	<form id="generalDetailForm" enctype="multipart/form-data" method="post" action="{geturl controller='productlisting' action='editproduct'}?purchase_type={$fp->purchase_type}&category={$fp->product_category}&type={$fp->product_type}&tag={$fp->product_tag}&id={$fp->product_id}">
	<fieldset>
    	<legend>{$fp->product_tag} Details</legend>
        <label>Name:</label>
        <input type="text" value="{$fp->name}" name="name"><br>
    	{include file='partials/error.tpl' error=$fp->getError('name')}

		<div>
        <label>price:</label>
        $<input type="text" value="{$fp->price}" name="price"><br>
        {include file='partials/error.tpl' error=$fp->getError('price')}
		</div>
        <div>
        <label>sale price (if you would like this item to be on sale - optional):</label>
        $<input type="text" value="{$fp->sales_price}" name="sales_price" /><br />
        </div>
        <div>
        <label>Domestic Shipping rate:</label>
        $<input type="text" value="{$fp->domestic_shipping_rate}" name="domesticShippingRate" /><br />
        {include file='partials/error.tpl' error=$fp->getError('domesticShippingRate')}
        </div>
        <div>
        <label>International Shipping rate:</label>
        $<input type="text" value="{$fp->international_shipping_rate}" name="internationalShippingRate" /><br />
        {include file='partials/error.tpl' error=$fp->getError('internationalShippingRate')}
        </div>
        <div>
        <label>backorder time(this keeps track of latest shipping date)</label>
        <select name="backorder_time">
        	<option value="1 week" {if $fp->backorder_time=='1 week'}selected=selected{/if}>1 week</option>
            <option value="2 weeks" {if $fp->backorder_time=='2 weeks'}selected=selected{/if}>2 weeks</option>
            <option value="3 weeks" {if $fp->backorder_time=='3 weeks'}selected=selected{/if}>3 weeks</option>
            <option value="4 weeks" {if $fp->backorder_time=='4 weeks'}selected=selected{/if}>4 weeks</option>
            <option value="5 weeks" {if $fp->backorder_time=='5 weeks'}selected=selected{/if}>5 weeks</option>
            <option value="6 weeks" {if $fp->backorder_time=='6 weeks'}selected=selected{/if}>6 weeks</option>
            <option value="7 weeks" {if $fp->backorder_time=='7 weeks'}selected=selected{/if}>7 weeks</option>
            <option value="8 weeks" {if $fp->backorder_time=='8 weeks'}selected=selected{/if}>8 weeks</option>
        </select></div><br />
        
        <label>brand:</label>
        <select name="brand">
       		<option value="Supadance">Supadance</option>
            <option value="International">International</option>
            <option value="Rayrose">Rayrose</option>
            <option value="DN">DanceNaturals</option>
            <option value="STP">StephanieProfessional</option>
            <option value="BDdance">BDdance</option>
            <option value="SDUSA">SoulDancer</option>
            <option value="Chrissane">Chrissane</option>
            <option value="Other">Other</option>
        </select><br>
        {include file='partials/error.tpl' error=$fp->getError('brand')}

		<label>Returnable?</label>
		<input type="radio" name='return' value='1' checked="checked"/>yes
		<input type="radio" name='return' value='0' {if $fp->return_allowed=='0'}checked="checked"{/if}/>no
		<br/>
		
        <label>Youtube Video:</label>
        <input type='text' value="{$fp->video_youtube}" name="video_youtube" /><br />
        
        <label>Description:</label><br>
        {wysiwyg name='description' value=$fp->description}

        <input type="hidden" name="id" value="{$fp->product_id}" />
        <input type="hidden" name="product" value="{$fp->product_type}" />
        <input type="hidden" name="tag" value="{$fp->product_tag}" />
        
        {if $fp->product->images|@count>0}
            <ul id="post_images">
                {foreach from=$fp->product->images item=image}
                    <li >
                        <img src="/resources/userdata/tmp/thumbnails/{$signedInUser->generalInfo->username}/{$fp->product->product_tag}/{$image.image_id}.W150_homeFrontFour.jpg" alt="{$image.filename}" />
                        
                        <form method="post" action="{geturl action='images'}">
                            <div>
                                <input type="hidden" name="id" value="{$fp->product->getId()}" />
                                <input type="hidden" name="tag" value="{$fp->product->product_tag}" />
                                <input type="hidden" name="image" value="{$image.image_id}" />
                                <input type="submit" name="delete" value="delete" />
                            </div>
                        </form>
                    </li>
                {/foreach}
            </ul>
        {else}
        no general images uploaded
        {/if}
        
        
        <div id="imageBlock">
        	<div id="image_0" class="imageInput">
	        <label>Image :</label>
				<input type="file" name="generalImages[0]" />
			<button type='button'onclick='	this.up().remove();'>Delete</button>
			</div>
		</div>
		
		<button type='button' id='addAnotherImage' onclick='addNewImageBlock()'>Add another image</button>
		
		<br/>
		
        <input type="submit" value="proceed">
        <a href="{geturl controller='productlisting' action='index'}">Back</a>
        
    </fieldset>
</form>
        
	</div>
	
	
{literal}
<script>
function addNewImageBlock(){
	var images = $$('.imageInput');
	var timestamp = new Date();
	var nextImageNumber = images.length;
	imageBlock = $('imageBlock');
	//alert(images.length);
	imageBlock.insert( { bottom: "<div class='imageInput' id='image_"+timestamp.getTime()+"'>"
		   +"<label>Image: </label>"
		   +"<input type='file' name='generalImages["+timestamp.getTime()+"]' />"
		   +"<button type='button' onclick='this.up().remove();'>Delete</button>"
		   +"</div>" } );
	
	 
}

</script>
{/literal}
{include file="layouts/$layout/footer.tpl"}