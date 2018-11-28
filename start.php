<?php
/**
 * MarkDown Editor
 * 
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Facyla
 * @copyright Facyla 2018
 * @link https://facyla.fr/
 */

// @TODO Use AMD for JS scripts

elgg_register_event_handler('init','system','markdown_editor_plugin_init');

function markdown_editor_plugin_init() {
	
	// Note : CSS we will be output anyway directly into the view, so we can embed markdown_editors on other sites
	elgg_extend_view('css','markdown_editor/css');
	

	
	// Register main page handler
	elgg_register_page_handler('markdown_editor', 'markdown_editor_page_handler');
	
	// Register actions
	//$actions_path = elgg_get_plugins_path() . 'markdown_editor/actions/markdown_editor/';
	//elgg_register_action("markdown_editor/edit", $actions_path . 'edit.php');
	
		// register the JavaScript (autoloaded in 1.10)
	elgg_register_simplecache_view('js/markdown_editor/edit');
	$js = elgg_get_simplecache_url('js', 'markdown_editor/edit');
	elgg_register_js('elgg.markdown_editor.edit', $js);
	
}


/* Main tool page handler */
function markdown_editor_page_handler($page) {
	$include_path = elgg_get_plugins_path() . 'markdown_editor/pages/markdown_editor/';
	if (empty($page[0])) { $page[0] = 'index'; }
	switch ($page[0]) {
		case "view":
			// @TODO display markdown_editor in one_column layout, or iframe mode ?
			if (!empty($page[1])) { set_input('guid', $page[1]); }
			if (include($include_path . 'view.php')) { return true; }
			break;
			
		case "add":
			if (!empty($page[1])) { set_input('container_guid', $page[1]); }
			// @TODO display markdown_editor in one_column layout, or iframe mode ?
			if (include($include_path . 'edit.php')) { return true; }
			break;
		
		case "edit":
			if (!empty($page[1])) { set_input('guid', $page[1]); }
			// @TODO display markdown_editor in one_column layout, or iframe mode ?
			if (include($include_path . 'edit.php')) { return true; }
			break;
			
		case 'admin':
			// @TODO Forward to plugin settings
			forward('admin/plugin_settings/markdown_editor');
			break;
		
		case 'index':
		default:
			if (include($include_path . 'index.php')) { return true; }
	}
	return false;
}



// Check enabled libraries and register the corresponding scripts and CSS
function markdown_editor_register_libraries() {
	
	// Register JS scripts and CSS files
	elgg_register_js($libname, $config['url'], $location);
	elgg_register_css($libname, $config['url']);
	
}


// Load registered JS and CSS libraries for a given vendor
function markdown_editor_load_libraries($vendor = 'anythingmarkdown_editor') {
	elgg_load_js($name); }
	elgg_load_css($name); }
	
}


