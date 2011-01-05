{include file="layouts/$layout/header.tpl" lightbox=true}
											{include file='partials/leftColumnIndex.tpl'}

		
			<div id='rightBottomContainer'>
				<div id='rightMenu' style="width:475px; float:left;">
						<a href="#" style="float:left; margin-left:8px;"><img alt="" src="/resources/userdata/uploaded-files/images/fishing1.gif" width="300" height="196"></a>
					<a href="#" style="float:left;"><img alt="" src="/resources/userdata/uploaded-files/images/fishing3.gif" width="135" height="92" style="padding:2px; padding-left:10px;"></a>
					<a href="#" style="float:left;"><img alt="" src="/resources/userdata/uploaded-files/images/fishing5.gif" width="135" height="92" style="padding:2px; padding-left:10px;"></a>
				</div>
				<div class="rightBox" style="">
					<div class="topBoxPadding2">
						<div class="rightBoxTitle">Photos</div>
					</div>
					<div style="width:436px;margin:12px 0px 0px 16px; float:left;">
						<!--<div class="hh h3"></div>-->
                        {foreach from=$ids item=id}
                        {if ($id!=21) and ($id!=14) and ($id!=15) and ($id!='2') and ($id!=22)}
                        <a class='colorBox' rel='photos' href="/resources/userdata/uploaded-files/picture/{$id}.jpg"><img src="/resources/userdata/uploaded-files/picture/{$id}.jpg" style="float:left; padding:2px;" width="100px"/></a>
                        {/if}
                        {/foreach}
					</div>
					<div class="bottomBoxPadding2">	
					</div>
				</div>
			</div>
		</div>
		<div class="divider2">
		</div>
		<div class="foot" style="float:left;"><span></span></div>
	</div>

</div>

{include file="layouts/$layout/footer.tpl"}