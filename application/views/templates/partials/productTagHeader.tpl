<div id="productTagHeader">
    <span style="font-size:1.5em; font-weight:bold; float:left; margin: 10px 10px 0px 10px;">{$tag}			    </span>
    {$seller}
    <a class="productTagHeaderButton {if $currentPage=='productPreview'}currentSeller{/if}" href="{geturl controller='productpreview' action='tag'}?tag={$tag}&seller=dancewear rialto">DancewearRialto</a>
    <a class="productTagHeaderButton {if $currentPage=='userProductPreview'}currentSeller{/if}" href="{geturl controller='userproductpreview' action='tag'}?tag={$tag}">Users market</a>
    
    
   
    <a class="shoppingCartIcon" style="float:right; margin-top:3px;" href="{geturl controller='shoppingcart' action='index'}"><img src="/htdocs/css/images/shoppingcart_flattened.png" width="35" /></a>
    <span style="float:right; margin-top:9px;">{$shoppingCartInfo->totalItems} item in your <a href="{geturl controller='shoppingcart' action='index'}" style="font-size:14px;">cart</a></span>
</div>

<div id="breadcrumbs">
    {breadcrumbs trail=$breadcrumbs->getTrail()}
</div>