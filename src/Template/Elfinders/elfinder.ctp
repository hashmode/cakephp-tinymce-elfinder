<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>

<script type="text/javascript">
	var connectorUrl ='<?php echo $connectorUrl; ?>';
	var clientOptions = <?php echo json_encode($clientOptions); ?>;

	var FileBrowserDialogue = {
		init: function() {
			// Here goes your code for setting your custom things onLoad.
		},
    	mySubmit: function (URL) {
    		// pass selected file path to TinyMCE
    		top.tinymce.activeEditor.windowManager.getParams().setUrl(URL.url);
    
    		// close popup window
    		top.tinymce.activeEditor.windowManager.close();
    	}
	}

	clientOptions.url = connectorUrl;

	clientOptions.getFileCallback = function(file) {
		FileBrowserDialogue.mySubmit(file); 
	}

	$().ready(function() {
		var elf = $('#elfinder').elfinder(clientOptions).elfinder('instance');
	});
</script>
