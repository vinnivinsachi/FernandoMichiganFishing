{$user->first_name}, ORDER notice

Dear {$user->last_name},


Order from: {$member->first_name} {$member->last_name} 


^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Date:{$dateTime}
invoice ID: {$invoice}

Check your order status at: 
http://www.ProfessionalBallroomShoes.com/guestorder?ID={$invoice}&orderType=buyer
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^


			
{foreach from=$productsProfile item=profile}	
-----------------------------------------------------------------------------
{if $profile->ProductAttribute->inv_id ==''}
{$profile->product_name}
{else}
{$profile->product_name} (inventory)
{/if}


{if $profile->orderAttribute->foot_size != ''}
{if $profile->orderAttribute->heel !=''}
Heel: {$profile->orderAttribute->heel}
Color: {$profile->orderAttribute->color} 
{/if}
Foot Size: {$profile->orderAttribute->foot_size}
Width: 	{$profile->orderAttribute->foot_width}
Sole: {$profile->orderAttribute->sole}
{elseif $profile->orderAttribute->Waist !=''}
Body Height: 	{$profile->orderAttribute->Height}
Hip:	{$profile->orderAttribute->Hip}
Waist: {$profile->orderAttribute->Waist}
Pants Height: {$profile->orderAttribute->Pants_Height}
{/if}

quantity: {$profile->quantity}
unit cost:	{$profile->unit_cost}
-----------------------------------------------------------------------------
{/foreach}

			
************
Total:
$ {$total}
************

{if $addPromo!='true'}
----------------
PromotionCode:
# {$promoCode}
----------------

----------------
Discount amount
{$discount} dollar
----------------

**********************
Final amount charged:
$ {$finalTotal}
**********************
{/if}

	
Sincerely,

ProfessionalBallroomShoes Administrator

