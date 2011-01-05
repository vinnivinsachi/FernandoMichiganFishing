{include file='header.tpl' lightdox=true}
	<div style="width:24%; float:left;">
    
  		<fieldset>
        	<legend>Product categories</legend>
            	<ul>
                	<li> <a href="{geturl action='viewpendingproduct'}">All</a></li>
                   {foreach from=$tagArray item=tag}
                        <li><a href="{geturl action='viewpendingproduct'}?tag={$tag.product_tag}">{$tag.product_tag}</a></li>
                    {/foreach}
                </ul>
        </fieldset>
    
    </div>

	<div style="width:74%; float:right;">
        <fieldset>
        <legend>Products</legend>
    	<table width="100%" id="productListTable">
            	<tr>
                	<td>Name:</td>
                    <td>Price:</td>
                    <td>RP</td>
                    <td>Brand:</td>
                    <td>Status:</td>
                    <td>Listing type:</td>
                    <td>Time Created:</td>
                </tr>
                <tr>
                	
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                    	<select id="productBrandJavascript">
                        	<option value="All">All</option>
                            <option value="BDdance">BDdance</option>
                            <option value="SDUSA">SoulDancer</option>
                            <option value="STP">Stephanie Professional</option>
                            <option value="DN">Dance Naturals</option>
                            <option value="Chrissane">Chrissane</option>
                            <option value="Other">Other</option>
                        </select></td>
                     <td>
                     	<select id="productStatusJavascript">
                        	<option value="All">All</option>
                        	<option value="DRAFT">Draft</option>
                            <option value="LIVE">Live</option>
                        </select></td>
                     <td></td>
                     <td></td>
                </tr>
    	{foreach from=$productList item=product}
        		<tr class="{$product.product_type} {$product.brand} {$product.status} itemRow">
                	<td>{if $product.new =='1'}
                    	<img src="/htdocs/css/images/New_product.png" height="15"/>{/if}{$product.name}</td>
                    <td>${$product.price}</td>
                    <td>{$product.reward_point}</td>
                    <td>{$product.brand}</td>
                    <td>{$product.status}</td>
                    <td>{$product.listing_type}</td>
             
                    <td>{$product.ts_created|date_format:"%Y-%m-%d"}</td>
                </tr>
                <tr class="{$product.product_type} {$product.brand} {$product.status} itemRow">
                	<td colspan="2"></td>
                	<td colspan="5" style="text-align:right;">
                    	{if $product.status =='DRAFT'}
                    	<a href="{geturl action='sendproductlive'}?id={$product.products_id}&product={$product.product_type}&tag={$product.product_tag}">Publish</a>
                        {elseif $product.status =='LIVE'}
                    	<a href="{geturl action='sendproductdraft'}?id={$product.products_id}&product={$product.product_type}&tag={$product.product_tag}">Unpublish</a>
                        {/if}
                        <!--remove this part and automate new product updates-->
                        <!--
                        {if $product.new =='1'}
						<a href="{geturl action='removeproductasnew'}?id={$product.products_id}&product={$product.product_type}&tag={$product.product_tag}"><img src="/htdocs/css/images/remove_from_new.png" alt="remove new" title="remove new" /></a>
                        {else}
                        <a href="{geturl action='markproductasnew'}?id={$product.products_id}&product={$product.product_type}&tag={$product.product_tag}"><img src="/htdocs/css/images/New_product.png" alt="add to new" title="add new" /></a>{/if}-->
                        
                        <a href="{geturl controller='productlisting' action='productlistingpreview'}?id={$product.products_id}&product={$product.product_type}&tag={$product.product_tag}">Add images</a>
                    	<a href="{geturl controller='productlisting' action='editproduct'}?id={$product.products_id}&product={$product.product_type}&tag={$product.product_tag}">Edit</a>
                     
                        <!--<a href="{geturl controller='productpreview' action='listingpreview'}?id={$product.products_id}&product={$product.product_type}&tag={$product.product_tag}"><img src="/htdocs/css/images/inventory.gif" alt="preview" title="preview"/></a>
                        <a href="#"><img src="/htdocs/css/images/facebook-icon.jpg" alt="preview" height="24" title="facebook"/></a>
                        <a href="#"><img src="/htdocs/css/images/twittericon.png"  alt="twitter"height="24" title="twitter"/></a>-->
                    </td>
                </tr>
                
        {/foreach}
        </table>
        </fieldset>
	</div>
    
    {literal}
		<script src="/htdocs/javascripts/inventorySelector/inventorySelector.js" type="text/javascript"></script>
        <script type="text/javascript">
			new productListing('productListTable');
		</script>
    {/literal}
{include file='footer.tpl'}