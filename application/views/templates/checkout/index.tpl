{include file='header.tpl'}
{include file='lib/leftColumnIndex.tpl'}

<div id="rightContainer" style='width:750px; float:left; padding:20px;'>
	{include file='lib/indexTagHeader.tpl'}
	<div id="accordion" style="margin-top:20px;">
        <h3><a href="#">Cart Info: Step 1
        	<div id="currentOrderTime" style="float:right;">
            12/2/10 14:23:45
            </div></a></h3>
        <div>
            <div id="basketInformation">
    
                <div id="productOrderTopTile" style="float:left;; width:100%;">
                    <div class="productSellerInfo" style="float:left; width:55%;">
                    .
                    </div>
                    <div class="productOrderQuantity" style="float:left;; width:15%;">
                    Quantity
                    </div>
                    <div class="productOrderPrice" style="float:left; width:15%;">
                    Price
                    </div>
                    <div class="productOrderRewardPoints" style="float:left; width:15%;">
                    Reward Points
                    </div>
                </div>
                
                <!--foreach loop begins-->
            {foreach from=$shoppingCartProducts item=product key=cartKey}
            <div class="productOrderIndividualProduct" style="float:left; width:100%; border-bottom:1px solid #069;">
                <div class="productOrderBody">
                    <div class="productSellerInfo" style="float:left; width:55%;">
                    	{$product.product_Username} / {$product.product_market}<br />
                        <a href="{geturl controller='shoppingcart' action='removeitemsfromshoppingcart'}?cartProductId={$cartKey}"><img src="/htdocs/css/images/deleteFromShoppingFlattened.png" style="margin-bottom:-10px;"/></a>Product name: {$product.product_name}<br />
                        
                            <div class="productOrderAttributes" style="padding-left:20px;">
                            {if $product.useMyMeasurement==true}
                             <label>Use my measurements: </label>
                            	<span>My mesurements on file</span><br />
                            {/if}
                            {foreach from=$product.attributes item=attributes key=Key}
                            <label>{$Key}: </label>
                            <span>{$attributes}</span><br />
                            {/foreach}
                            </div>
                    </div>
                    <div id="productOrderQuantity" style="float:left;; width:15%;">
                    1
                    </div>
                    <div id="productOrderPrice" style="float:left; width:15%;">
					{$product.product_price}
                    </div>
                    <div id="productOrderRewardPoints" style="float:left; width:15%;">
					{$product.reward_points}
                    </div>
                </div>
                <div class="productShippingBody">
                    <div class="productSellerInfo" style="float:left; width:55%;">
                    Shipping Information: Ship with in 4 days.
                    </div>
                    <div id="productOrderQuantity" style="float:left;; width:15%;">Shipping:</div>
                    <div id="productOrderPrice" style="float:left; width:15%;">
                    ${$product.shipping_costs}
                    </div>
                </div>
            </div>
            {/foreach}
        </div>
            
        
        <div id="cartCost" style="width:100%; float:left;">
                <div class="productSellerInfo" style="float:left; width:55%;">Cart Costs</div>
                <div id="productOrderQuantity" style="float:left;; width:15%;">.</div>
                <div id="productOrderPrice" style="float:left; width:15%;">${$shoppingCartInfo->totalCost}</div>
                <div id="productOrderRewardPoints" style="float:left; width:15%;">${$shoppingCartInfo->totalRewardPoints}</div>
        </div>	
            <div id="proceedShoppingCart" style="width:100%; float:left; text-align:right;">
        	
        	<a id="proceedToShippingInfoAnchor" style="float:right; margin-top:10px;"><img src="/htdocs/css/images/nextToShipping.gif" style="margin-right:-9px;"/></a>
        	</div>
       </div>
        
        <h3><a href="#">Shipping Info: Step 2 
        	<div id="currentOrderTime" style="float:right;">
			[user {$user->generalInfo->username}]
            </div></a></h3>
        <div>
               <div style="padding:10px; border-bottom:1px solid #069; width:98%; float:left;">
                    <div id="allShippingAddresses" style="width:100%; float:left;">
                    {foreach from=$user->generalInfo->shippingAddress item=Item key=Key}
                    <div class="shippingAddressBox" id="shippingAddress_{$Key}">
                        Address One: {$user->generalInfo->shippingAddress[$Key]->address_one}<br />
                        Address Two: {$user->generalInfo->shippingAddress[$Key]->address_two}<br />
                        City: {$user->generalInfo->shippingAddress[$Key]->city}, {$user->generalInfo->shippingAddress[$Key]->state} {$user->generalInfo->shippingAddress[$Key]->zip}<br />
                        Country: {$user->generalInfo->shippingAddress[$Key]->country}<br />
                       
                        <a id="deleteShippingAddress_{$Key}" class='deleteShippingAddressAnchor' href="{geturl controller='account' action='deleteshipping'}?editAddress={$Key}">Delete</a><br />
                        
                        {if $defaultShippingKey!=$Key}
                        <a id="makeShippingAddress_{$Key}" class='makeShippingAddressAnchor' href="{geturl controller='account' action='makedefaultshipping}?editAddress={$Key}"><img src="/htdocs/css/images/ShippingButton.gif" /></a><br />
                        {/if}
                    </div>
                    {/foreach}
                    </div>
                    <div style="float:left; width:100%; padding-top:10px;"><a id="toggleAddShipping">Add a shipping address</a></div>
                    <div id="editShippingForm" style=" width:100%; float:left; display:none;">
                    
                        <form method="post" action="{geturl controller='account' action='editshipping'}?editAddress={$addressID}" id="shippingAddressForm">
                                <div>
                                <label>Address One: </label>
                                <input type="text" value="{$fp->address_one}" name="address_one"/><br />
                                {include file='lib/error.tpl' error=''}
                                </div>
                                <label>Address Two:</label>
                                <input type="text" value="{$fp->address_two}" name="address_two"/><br />
                                <div>
                                <label>City: </label>
                                <input type="text" value="{$fp->city}" name="city"/><br />
                                {include file='lib/error.tpl' error=''}
                                </div>
                                <div>
                                <label>State:</label>
                                <input type="text" value="{$fp->state}" name="state"/><br />
                                {include file='lib/error.tpl' error=''}
                                </div>
                                <div>
                                <label>Country:</label>
                                <input type="text" value="{$fp->country}" name="country"/><br />
                                {include file='lib/error.tpl' error=''}
                                </div>
                                <div>
                                <label>Zip:</label>
                                <input type="text" value="{$fp->zip}" name="zip" /><br />
                                {include file='lib/error.tpl' error=''}
                                </div>
                                <input type="checkbox" name="defaultShipping" />Ship to this address<br />
                                <input type="submit" value="save"/>
                        </form>
                    </div>
                </div>
                
              	<div style="float:right; width:282px; padding:10px; text-align:left;">
                    Please ship it to: <br />
                    <div id="finalUserOrderShippingInfo" style="margin-left:45px; font-size:16px; font-weight:bold; line-height:1.3em;">
                    {if $defaultShippingKey}
                    
                    {$user->generalInfo->first_name} {$user->generalInfo->last_name}<br />
                    {$user->generalInfo->shippingAddress[$defaultShippingKey]->address_one}<br />
                    {if $user->generalInfo->shippingAddress[$defaultShippingKey]->address_two !=''}
                        {$user->generalInfo->shippingAddress[$defaultShippingKey]->address_two !=''}<br />
                    {/if}
                    {$user->generalInfo->shippingAddress[$defaultShippingKey]->city}, {$user->generalInfo->shippingAddress[$defaultShippingKey]->state} {$user->generalInfo->shippingAddress[$defaultShippingKey]->zip}<br />
                    {$user->generalInfo->shippingAddress[$defaultShippingKey]->country}<br />
                    
                    {else}
                    Please add or select a delivery address from above.
                    {/if}
                    </div>
                </div>
                <div style="float:left; width:98%; padding:0px 10px 10px 10px;">
                	<a id="backToCartInfo" style="float:left;"><img src="/htdocs/css/images/backToCart.gif" style="margin-left:-13px;"/></a>
                	<a  id="nextToRewardPointAnchor" style="float:right;{if !$defaultShippingKey}
display:none;{/if}"><img src="/htdocs/css/images/nextToRewardPointsAndPromotions.gif"/></a>
                </div>
        </div>
        <h3><a href="#">Reward points and promotions: Step 3
        	<div id="currentOrderTime" style="float:right;">
			[user {$user->generalInfo->username}]
            </div></a></h3>
        <div>
            <div id="orderRewardsDetails" style="width:100%; float:left;">
           
                <div id="orderRewardMotherDiv" style="width:98%; float:left; padding:10px; ;border-bottom:1px solid #069;">
                    <div id="rewardPointNotice" style="width:50%; float:left;">
                    You have <span class="bigFont">{$userRewardPoint}</span> reward point(s) available. <br />
                    <span class="bigFont">4 points = $1</span><br />
                    <span class="italicAlert">You may not discount the cart to less than 10 dollars.</span>
                    </div>
                    <div id="rewardPointSelection" style="width:40%; float:right; margin-right:20px;">
                        <span style="margin-left:59px;">Apply</span>
                        <select id="rewardPointSelection">
                        {foreach from=$incrementalRewardNumber item=number key=Key}
                        <option value="{$number}">{$number} points/{$Key} dollars </option>
                        {/foreach}
                        </select>
                    </div>
                </div>
                <div id="orderPromotionsMotherDiv" style="padding:10px; margin:10px; width:90%; float:left;">
                    <div id="promotionsNotice" style="width:50%; float:left;">
                     If you have a promotion code, please enter your code in the left box.
                    </div>
                    <div id="promotionInput" style="width:40%; float:right; ">
                    <span>Promotion code: </span><input id="promotionCode" type="text" value=""/>
                    </div>
                </div>
            
             <a id="backToShippingInfoAnchor" style="float:left;"><img src="/htdocs/css/images/backToShipping.gif" /></a>
              <a id="proceedToComfirmation" style="float:right;"><img src="/htdocs/css/images/continueToConfirmation.gif" style="margin-bottom:-1px;"/></a>
            </div>
        </div>
    </div>
</div>

{literal}
<script type="text/javascript">
new checkOutEnhancer('shippingAddressForm');


new simpleToggle('toggleAddShipping', 'editShippingForm', 'selectionOn');

$j(document).ready(function(){
							$j("#accordion").accordion({ autoHeight: false,disabled:true, collapsible:true});
});

var AccordionObject = $j("#accordion");

$("proceedToShippingInfoAnchor").observe('click', function(event){
														  // alert('hi');
														  														 								 						  AccordionObject.accordion("option", "disabled", false);
		
														  AccordionObject.accordion("option", "active", 1);
														  														  														  AccordionObject.accordion("option", "disabled",true);

														   //alert('hei');
														   });
$("nextToRewardPointAnchor").observe('click', function(event){	
													   
													   	  AccordionObject.accordion("option", "disabled", false);														  AccordionObject.accordion("option", "active", 2);
														  AccordionObject.accordion("option", "disabled",true);
												
														   });
														
$("backToShippingInfoAnchor").observe('click', function(event){
														  // alert('hi');
														  														 								 						  AccordionObject.accordion("option", "disabled", false);
		
														  AccordionObject.accordion("option", "active", 1);
														  														  														  AccordionObject.accordion("option", "disabled",true);
														   });
$("backToCartInfo").observe('click', function(event){
														  // alert('hi');
														  														 								 						  AccordionObject.accordion("option", "disabled", false);
		
														  AccordionObject.accordion("option", "active", 0);
														  														  														  AccordionObject.accordion("option", "disabled",true);
														   });

</script>


{/literal}
{include file='footer.tpl'}