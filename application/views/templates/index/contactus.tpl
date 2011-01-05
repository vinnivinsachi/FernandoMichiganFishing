{include file="layouts/$layout/header.tpl" lightbox=true}
											{include file='partials/leftColumnIndex.tpl'}
			<div id='rightBottomContainer'>
				<div id='rightMenu' style="width:475px; float:left;">
					<a href="#" style="float:left; margin-left:8px;"><img alt="" src="/resources/userdata/uploaded-files/images/fishing8.gif" width="300" height="196"></a>
					<a href="#" style="float:left;"><img alt="" src="/resources/userdata/uploaded-files/images/fishing7.gif" width="135" height="92" style="padding:2px; padding-left:10px;"></a>
					<a href="#" style="float:left;"><img alt="" src="/resources/userdata/uploaded-files/images/fishing6.gif" width="135" height="92" style="padding:2px; padding-left:10px;"></a>
				</div>
				<div class="rightBox" style="">
					<div class="topBoxPadding2">
						<div class="rightBoxTitle">Contact us!</div>
					</div>
					<div style="width:436px;margin:12px 0px 0px 16px; float:left;">
						<!--<div class="hh h3"></div>-->
						<div class="rightContentBox">
							
<form method="post" action="{geturl controller='index' action='contactus'}" id="registration-form">		
		
		
		<div class="row" id="form_username_container">
			<label for="first_name"><strong style="color:#003366; font-size:1.7em;">*</strong>First Name:</label>
			<input type="text" id="form_username" name="first_name" value="{$fp->first_name|escape}"/>
			{include file='partials/error.tpl' error=$fp->getError('first_name')}
		</div>
		
		<div class="row" id="form_password_container">
			<label for="last_name"><strong style="color:#003366; font-size:1.7em;">*</strong>Last Name:</label>
			<input type="text" name="last_name"/>
			{include file='partials/error.tpl' error=$fp->getError('last_name')}
		</div>

		
		<div class="row" id="form_email_container">
			<label for="form_email"><strong style="color:#003366; font-size:1.7em;">*</strong>Email Address:</label>
			<input type="text" id="form_email" name="email" value="{$fp->email|escape}"/>
			{include file='partials/error.tpl' error=$fp->getError('email')}
		</div>
		
		<div class="row" id="form_first_name_container">
			<label for="form_first_name"><strong style="color:#003366; font-size:1.7em;">*</strong>Message:</label>
			<textarea rows="5" cols="50" name="description" value="{$fp->description|escape}" ></textarea>
			{include file='partials/error.tpl' error=$fp->getError('description')}
		</div>
		
		<div class="submit">
			<input type="submit" value="Submit" />
		</div>
        
							<br/><br/>
							Please contact us to reserve your trip, or with any questions at nolimitcharters@gmail.com or at 1-800-304-2527 or 734.904.4979<br/>

							Our address is: P.O.Box 234, Manistee, MI 49660-1454<br/><br/>
							
							Boat Directions<br/>
							
							Our lake boat is docked at The Riverside Motel & Marina, in Slip #13. It is located at 520 Water St. on the south side of the Big Manistee River between downtown Manistee and Lake Michigan.<br/>
							
							Driving directions:<br/><br/>
							
							From Detroit - Take M-10 N/E for 29.7 km. <br/>
							Take exit 18C on the left to merge onto I-696 W toward Lansing for 13.7 km.<br/> 
							Merge onto I-96 W for 262 km<br/>
							Take exit 1B to merge onto US-31 N toward Ludington for 96.9 km<br/>
							Turn right at US-10 E/US-31 N for 7.2 km<br/>
							Turn left at US-31 N/Scottville Bypass <br/>
							Continue to follow US-31 N toward Manistee.<br/><br/>
							
							From Grand Rapids &ndash; Take the ramp onto US-131 N for 3.6 mi<br/>
							Take exit 89 on the left for I-96/M-37 toward Muskegon/Lansing for 0.3 mi<br/>
							Keep left at the fork to continue toward I-96 W and merge onto I-96 W for 30.5 mi<br/>
							Take exit 1B to merge onto US-31 N toward Ludington for 60.2 mi<br/>
							Turn right at US-10 E/US-31 N for 4.5 mi<br/>
							Turn left at US-31 N/Scottville Bypass <br/>
							Continue to follow US-31 N to Manistee<br/><br/>
							
							From Chicago - Take I-90 E/I-94 E for 0.1 mi<br/>
							Keep left at the fork, follow signs for I-90 E/I-94 E/Indiana and merge onto I-90 E/I-94 E<br/> 
							Continue to follow I-90 E for 33.7 mi (Partial toll road, entering Indiana) <br/>
							Take exit 21for 64.6 mito merge onto I-94 E toward Detroit (Partial toll road, entering Michigan)<br/> 
							Slight right at US-31 N (signs for I-196/Holland/Gd Rapids) for 1 mi<br/>
							Continue onto I-196 N44 for 2 mi<br/>
							Continue onto I-196 BUS E/US-31 N for 6 mi<br/>
							Continue onto US-31 N for 87.8 mi<br/>
							Turn right at US-10 E/US-31 N for 4.5 mi<br/>
							Turn left at US-31 N/Scottville Bypass and continue to follow US-31 N until Manistee<br/><br/>
							
							
							Closest airport: <br/>
							
							Traverse City Airport(TVC-Cherry Capital)&ndash;48 miles away. We will be glad to arrange transportation to and from the airport &ndash; contact us for details.<br/> 
							
							Mapped directions to fishing locations in Manistee:<br/>
						</div>
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