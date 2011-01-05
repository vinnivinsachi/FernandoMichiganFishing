	<br/>
	<br/>
	<strong style="font-size:1.5em;">Shoes Attribute Selection</strong><br/><br/>
	Type of metric<select name="shoes_metric">
		<option value="US">US size</option>
		<option value="EU">Euro Size</option>
		<option value="BR">British Size</option>
	</select>
	<br/>
	Minimum available size<select name="min_size">
		{foreach from=$measurement item=value}
			<option value="{$value}">{$value}</option>
		{/foreach}
	</select>
	Max availabe size
	<select name="max_size">
		{foreach from=$measurement item=value}
			<option value="{$value}">{$value}</option>
		{/foreach}
	</select>
	Size interval
	<select name="size_interval">
		<option value="0.5">0.5</option>
		<option value="1">1</option>
	</select>