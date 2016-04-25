<?php 
namespace CakephpTinymceElfinder\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\Core\Configure;
use Cake\Routing\Router;

class TinymceElfinderHelper extends Helper {
    public $name = 'TinymceElfinder';
    
	public function defineElfinderBrowser($return = false) {
	    $url = Router::url('/cakephp-tinymce-elfinder/Elfinders/elfinder');
	    $clientOptions = Configure::read('TinymceElfinder.client_options');

	    $title = Configure::read('TinymceElfinder.title');
	    
		$str = '
		<script type="text/javascript">
		function elFinderBrowser (field_name, url, type, win) {
			  tinymce.activeEditor.windowManager.open({
			    file: "'.$url.'",
			    title: "'.$title.'",
			    width: '.($clientOptions['width']+20).',  
			    height: '.($clientOptions['height']+50).',
			    resizable: "'.$clientOptions['resizable'].'"
			  }, {
			    setUrl: function (url) {
			      win.document.getElementById(field_name).value = url;
			    }
			  });
			  return false;
			}
		</script>';	
		
		if ($return) {
		    return $str;
		} else {
		    echo $str;
		}
	}
	
	
}