{include file='header.tpl'}
{include file='lib/leftColumnIndex.tpl'}

<div id="rightContainer" style='width:750px; float:left; padding:20px;'>

	<div id="orderMainDiv" style="float:left; width:100%;">
    	
        <div id="orderInfoTitle" class="orderTitle" style="cursor:pointer;">
        	Order Confirmation: 
        	<div id="currentOrderTime" style="float:right;">
            12/2/10 14:23:45
            </div>
        </div>
        
        <div id="basketInformation" style='margin-top:15px;' >
            	 <span class="bigFont">Seller and product info</span><br />
            <div id="productOrderTopTile" style="float:left; width:95%;  padding:10px; margin:10px;" >
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
            
           {foreach from=$shoppingCartProducts item=product key=cartKey}
            <div class="productOrderIndividualProduct" style="float:left;; width:100%; border-bottom:1px solid #069;">
                <div class="productOrderBody">
                    <div class="productSellerInfo" style="float:left; width:55%;">
                    	{$product.product_Username} / {$product.product_market}<br />
                        Product name: {$product.product_name}<br />
                        
                            <div class="productOrderAttributes" style="padding-left:20px;">
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
            
       	<!-- end of product forloop-->
        <div id="orderShippingDetails" style="width:95%; float:left; margin-top:15px;">
                <span class="bigFont">User and shipping information</span><br />
                Please ship it to: <br />
                <div id="finalUserOrderShippingInfo" style="margin-left:45px; padding:10px; margin:10px; font-size:16px; font-weight:bold; line-height:1.3em;">
                {if $defaultShippingKey}
                {$user->generalInfo->first_name} {$user->generalInfo->last_name}<br />
                {$user->generalInfo->shippingAddress[$defaultShippingKey]->address_one}<br />
                {if $user->generalInfo->shippingAddress[$defaultShippingKey]->address_two !=''}
                	{$user->generalInfo->shippingAddress[$defaultShippingKey]->address_two !=''}<br />
                {/if}
                {$user->generalInfo->shippingAddress[$defaultShippingKey]->city}, {$user->generalInfo->shippingAddress[$defaultShippingKey]->state} {$user->generalInfo->shippingAddress[$defaultShippingKey]->zip}<br />
                {$user->generalInfo->shippingAddress[$defaultShippingKey]->country}<br />   
                {else}
               	Please select a shipping address from above
                {/if}
                </div>
                <a href="{geturl action='index'}"><img src="/htdocs/css/images/backToShipping.gif" /></a><br />
            
        </div>
        
        <div id="orderRewardsDetails" style="width:100%; float:left;margin-top:15px;">
        	 <span class="bigFont">Apply reward points and promotions</span><br />
            <div id="orderRewardMotherDiv" style="width:95%; float:left; padding:10px; margin:10px;border-bottom:1px solid #069;">
                <div id="rewardPointNotice" style="width:50%; float:left;">
                You have <span class="bigFont">{$userRewardPoint}</span> reward point(s) available. <br />
                <span class="bigFont">4 points = $1</span><br />
                <span class="italicAlert">You may not discount the cart to less than 10 dollars.</span>
                </div>
                <div id="rewardPointSelection" style="width:50%; float:left;">
                    <span style="margin-left:114px;">Apply</span><input type="text" value="{$shoppingCartInfo->rewardPointsUsed} points" readonly="readonly" />
                    
                </div>
            </div>
            <div id="orderPromotionsMotherDiv" style="padding:10px; margin:10px; width:95%; float:left;">
            	<div id="promotionsNotice" style="width:50%; float:left;">
               	 If you have a promotion code, please enter your code in the left box.
                </div>
                <div id="promotionInput" style="width:50%; float:left;">
                <span style="margin-left:58px;">Promotion code: </span><input type="text" value="{$shoppingCartInfo->promotionCodeUsed}" readonly="readonly"/>
                </div>
            </div>
            
           <a href="{geturl action='index'}"><img src="/htdocs/css/images/backToRewardPoint.gif" style="margin-left:-3px;"/></a>
        
        
		</div>
        
        <div class="totalCartPriceAfterRecalc" style="width:100%; float:left;margin-top:15px;">
            <span class="bigFont">Grand Total</span><br  />
        	<div class="totalCartMotherDiv" style="width:95%; float:left; padding:10px; margin:10px;border-bottom:1px solid #069;">
            
            <div class="cartCost" style="width:100%; float:left;">
                <div class="productSellerInfo" style="float:left; width:55%;">Cart Costs</div>
                <div class="productOrderQuantity" style="float:left;; width:15%;">.</div>
                <div class="productOrderPrice" style="float:left; width:15%;">${$shoppingCartInfo->totalCost}</div>
                <div class="productOrderRewardPoints" style="float:left; width:15%;">award {$shoppingCartInfo->totalRewardPoints} point(s)</div>
        	</div>	
                
                <div class="cartCost" style="width:100%; float:left;" >
                    <div class="productSellerInfo" style="float:left; width:55%;">Reward points:</div>
                    <div class="productOrderQuantity" style="float:left;; width:15%;">use {$shoppingCartInfo->rewardPointsUsed} points</div>
                    <div class="productOrderPrice" style="float:left; width:15%; color:#F60;">-${$shoppingCartInfo->rewardAmountDeducted}</div>
                    <div class="productOrderRewardPoints" style="float:left; width:15%;"></div>
                </div>
            	<div class="cartCost" style="width:100%; float:left;" >
                    <div class="productSellerInfo" style="float:left; width:55%;">Promostions:</div>
                    <div class="productOrderQuantity" style="float:left;; width:15%;">Code:{$shoppingCartInfo->promotionCodeUsed}</div>
                    <div class="productOrderPrice" style="float:left; width:15%; color:#F60;">-${$shoppingCartInfo->promotionAmountDeducted}</div>
                    <div class="productOrderRewardPoints" style="float:left; width:15%;"></div>
                </div>
            </div>
            <div class="totalCartMotherPrice" style="width:95%; float:left; padding:10px; margin:10px;border-bottom:1px solid #069; font-weight:bold;">
                <div class="cartCost" style="width:100%; float:left;" >
                    <div class="productSellerInfo" style="float:left; width:55%;">Grand Total:</div>
                    <div class="productOrderQuantity" style="float:left;; width:15%;">After Recalc:</div>
                    <div class="productOrderPrice" style="float:left; width:15%;">${$shoppingCartInfo->finalTotalCost}</div>
                    <div class="productOrderRewardPoints" style="float:left; width:15%;">Award {$shoppingCartInfo->totalRewardPoints} points</div>
                </div>
            </div>
        </div>
        <a href="{geturl action='createorder'}" style="float:right;"><img src="/htdocs/css/images/next to paypal.gif" style="margin-bottom:-1px;"/></a>
    </div>
</div>

{include file='footer.tpl'}