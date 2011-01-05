// JavaScript Document

var settings ={
		messages: 'messages',
		statusSuccessColor: '#003399',
		messages_hide_delay: 0.5
};

var options={
	duration: 1.5,
	from: 0,
	to: 1
}

function init(e)
{
		//check if the messages element exists and is visible,
		//and if so, apply the highlight effect to it
		var messages =$(settings.messages);
		
		if(messages && messages.visible())
		{
			new Effect.Fade(messages, options);
		}
		
		//new SearchSuggestor('search');
		
}

function message_write(message)
{
	var messages = $(settings.messages);
	if(!messages)
	{
		return;
	}
	
	if(message.length==0)
	{
		messages.hide();
		return;
	}
	
	messages.update(message);
	messages.show();
	/*messages_clear();*/
}


function message_clear()
{
	setTimeout("message_write('')", settings.messages_hide_delay*1000);
}



Event.observe(window, 'load', init);

function filterStringWithSymbol(str_str,str_symbol) {
	str_str=str_str.trim();
    re = /\$|,| |@|#|~|`|\%|\*|\^|\&|\(|\)|\+|\=|\[|\-|\_|\]|\[|\}|\{|\;|\:|\'|\"|\<|\>|\?|\||\\|\!|\$|\./g;
    // remove special characters like "$" and "," etc...
    return str_str.replace(re, str_symbol);
}