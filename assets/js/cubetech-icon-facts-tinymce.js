tinymce.create( 
	'tinymce.plugins.cubetech_icon_facts', 
	{
	    /**
	     * @param tinymce.Editor editor
	     * @param string url
	     */
	    init : function( editor, url ) {
			/**
			*  register a new button
			*/
			editor.addButton(
				'cubetech_icon_facts_button', 
				{
					cmd   : 'cubetech_icon_facts_button_cmd',
					title : editor.getLang( 'cubetech_icon_facts.buttonTitle', 'cubetech Icon Facts' ),
					image : url + '/../img/toolbar-icon.png'
				}
			);
			/**
			* and a new command
			*/
			editor.addCommand(
				'cubetech_icon_facts_button_cmd',
				function() {
					/**
					* @param Object Popup settings
					* @param Object Arguments to pass to the Popup
					*/
					editor.windowManager.open(
						{
							// this is the ID of the popups parent element
							id       : 'cubetech_icon_facts_dialog',
							width    : 480,
							title    : editor.getLang( 'cubetech_icon_facts.popupTitle', 'cubetech Icon Facts' ),
							height   : 'auto',
							wpDialog : true,
							display  : 'block',
						},
						{
							plugin_url : url
						}
					);
				}
			);
		}
	}
);

// register plugin
tinymce.PluginManager.add( 'cubetech_icon_facts', tinymce.plugins.cubetech_icon_facts );