<div id="leftContainer">
    	<fieldset>
        <legend>Upload a {$purchase_type} product for sale</legend>

        <span style="font-size:14px; color:#069;">What kind of {$purchase_type} products would you like to upload? Please select the appropriate category.</span>
        <ul id="qm0" class="qmmc" style="float:left;">
            <li><a class="qmparent" >Women</a>
                <ul>
                <li><a class="qmparent productTagAnchor"  id="menStandardShoes">Shoes</a>
                	<ul>
                    	<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=women&type=shoes&tag=women latin shoes">Latin shoes</a></li>
                    	<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=women&type=shoes&tag=women standard shoes">Standard shoes</a></li>
                    	<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=women&type=shoes&tag=women practice shoes">Practice shoes</a></li>
                    </ul>
                </li>
                <li><a  id="menLatinShoes" class="qmparent productTagAnchor">Dresses</a>
                	<ul>
                    	<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=women&type=dresses&tag=women latin competition dresses">Latin competition dress</a></li>
                    	<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=women&type=dresses&tag=women standard competition dresses">Standard competition dress</a></li>
                    	<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=women&type=dresses&tag=women social and practice dresses">Social and practice dress</a></li>
                    </ul>
                </li>
                <li><a class="qmparent productTagAnchor">Skirts</a>
                	<ul>
                    	<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=women&type=skirts&tag=short skirts">Short skirt</a></li>
                    	<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=women&type=skirts&tag=long skirts">Long skirt</a></li>
                    </ul>
                </li>
                <li><a class="qmparent productTagAnchor" href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=women&type=dresses&tag=tops">Tops</a></li>
                </ul>
            </li>
            <li><a class="qmparent" >Men</a>
                <ul>
                <li><a class="productTagAnchor qmparent">Shoes</a>
                	<ul>
                		<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=men&type=shoes&tag=men latin shoes">Latin shoes</a></li>
                		<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=men&type=shoes&tag=men standard shoes">Standard shoes</a></li>
                    	<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=men&type=shoes&tag=men practice shoes">Practice shoes</a></li>    
                    </ul>
                </li>
                <li><a class="qmparent" >Sets</a>
                	<ul>
                    	<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=men&type=sets&tag=men suits">Suits</a></li>
                    	<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=men&type=sets&tag=men suits">Tailsuits</a></li>
                    	<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=men&type=sets&tag=men costumes">Costumes</a></li>
		            </ul>
		        </li>
                <li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=men&type=shirts&tag=men shirts">Shirts</a></li>
                <li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=men&type=pants&tag=men pants">Pants</a></li>
                <li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=men&type=vests&tag=men vests">Vests</a></li>
                <li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=men&type=jackets&tag=men jackests">Jackets</a></li>
            	</ul></li>
            <li><a class="qmparent" href="javascript:void(0)">Jewlery</a>
            	<ul>
                
                <li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=jewelry&type=jewelry&tag=sets">jewelry sets</a></li>
                <li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=jewelry&type=jewelry&tag=hair">Hair</a></li>
                <li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=jewelry&type=jewelry&tag=earing">Earing</a></li>
                <li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=jewelry&type=jewelry&tag=necklace">Necklace</a></li>
               	<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=jewelry&type=jewelry&tag=wrist">Wrist</a></li>
               	<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=jewelry&type=jewelry&tag=clothing">Clothing</a></li>
            	</ul></li>
            <li><a class="qmparent" href="javascript:void(0)">Accessories</a>
            	<ul>
                
                <li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=accessories&type=accessories&tag=shoe brushes">Shoe brushes</a></li>
                <li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=accessories&type=accessories&tag=heel protectors">Heel protectors</a></li>
                <li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=accessories&type=accessories&tag=soles">Soles</a></li>
                <li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=accessories&type=accessories&tag=bags">Bags</a></li>
               	<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=accessories&type=accessories&tag=robes">Robes</a></li>
               	<li><a href="{geturl controller='productlisting' action=$editproductlink}?purchase_type={$purchase_type}&category=accessories&type=accessories&tag=belts">Belts</a></li>
            	</ul></li>
           
        </ul>

<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all', 'main' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
{literal}
<script type="text/javascript">qm_create(0,true,0,500,'all',false,false,false,false);</script>
{/literal}
	</fieldset>
</div>
    <div id="rightContainer">
        <div id="productUploadTagImage" class="">
        </div>
    </div>
<script src="/htdocs/javascripts/productTagSelection.js" type="text/javascript"></script>