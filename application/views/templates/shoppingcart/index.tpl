{include file='header.tpl'}
{include file='lib/leftColumnIndex.tpl'}

<div id="rightContainer" style='width:750px; float:left; padding:20px;'>
	{include file='lib/indexTagHeader.tpl'}

	<div id="orderMainDiv" style="float:left; width:100%;">
    	
        <div id="orderInfoTitle" style="float:left; width:100%; font-weight:bold; font-size:16px; background:#666; color:white; padding:5px;">
        	Shopping Cart
        	<div id="currentOrderTime" style="float:right;">
            12/2/10 14:23:45
            </div>
        </div>
        <div id="basketInformation">
            <div id="productOrderTopTile" style="float:left;; width:100%;">
                <div class="productSellerInfo" style="float:left; width:55%;">
                Seller and product info
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
            <div class="productOrderIndividualProduct" style="float:left;; width:100%; border-bottom:1px solid #069;">
                <div class="productOrderBody">
                    <div class="productSellerInfo" style="float:left; width:55%;">
                    	{$product.product_Username} / {$product.product_market}<br />
                        <a href="{geturl action='removeitemsfromshoppingcart'}?cartProductId={$cartKey}"><img src="/htdocs/css/images/deleteFromShoppingFlattened.png" style="margin-bottom:-10px;"/></a>Product name: {$product.product_name}<br />
                        
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
                    {$product.shipping_costs}
                    </div>
                </div>
            </div>
            {/foreach}
        </div>
            
        
        <div id="cartCost" style="width:100%; float:left;">
                <div class="productSellerInfo" style="float:left; width:55%;">Cart Costs</div>
                <div id="productOrderQuantity" style="float:left;; width:15%;">.</div>
                <div id="productOrderPrice" style="float:left; width:15%;">${$shoppingCartInfo->totalCost}</div>
                <div id="productOrderRewardPoints" style="float:left; width:15%;">{$shoppingCartInfo->totalRewardPoints} points</div>
        </div>
       	<!-- end of product forloop-->
        <div id="proceedShoppingCart" style="width:100%; float:left; text-align:right;">
         	<a href="{geturl action='resetshoppingcart'}" style="float:left; margin-top:10px;"><img src="/htdocs/css/images/empty Cart.gif" /></a>
            {if $shoppingCartInfo->totalItems >0}
        	<a href="{geturl controller='checkout' action='index'}" style="float:right; margin-top:10px;"><img src="/htdocs/css/images/nextToCheckout.gif" style="margin-right:-9px;"/></a>
            {/if}
        </div>
    </div>
</div>

{include file='footer.tpl'}