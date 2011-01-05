<div id="productTagHeader">
    
   
    <a class="shoppingCartIcon" style="float:right; margin-top:3px;" href="{geturl controller='shoppingcart' action='index'}"><img src="/htdocs/css/images/shoppingcart_flattened.png" width="35" /></a>
    <span style="float:right; margin-top:9px;">{$shoppingCartInfo->totalItems} item in your <a href="{geturl controller='shoppingcart' action='index'}" style="font-size:14px;">cart</a></span>
</div>

<div id="breadcrumbs">
    {breadcrumbs trail=$breadcrumbs->getTrail()}
</div>