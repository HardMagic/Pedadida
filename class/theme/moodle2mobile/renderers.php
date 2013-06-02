<?php

class theme_moodle2mobile_core_renderer extends core_renderer {


        /**
     * The standard tags (typically performance information and validation links,
     * if we are in developer debug mode) that should be output in the footer area
     * of the page. Designed to be called in theme layout.php files.
     * @return string HTML fragment.
     */
    public function standard_footer_html() {
        global $CFG;

         $actualdevice = get_device_type();
        $currentdevice = $this->page->devicetypeinuse;
        $switched = ($actualdevice != $currentdevice);

        if (!$switched && $currentdevice == 'default' && $actualdevice == 'default') {
            // The user is using the a default device and hasn't switched so don't shown the switch
            // device links.
            return '';
        }

        if ($switched) {
            $linktext = get_string('switchdevicerecommended');
            $devicetype = $actualdevice;
        } else {
            $linktext = get_string('switchdevicedefault');
            $devicetype = 'default';
        }
        $linkurl = new moodle_url('/theme/switchdevice.php', array('url' => $this->page->url, 'device' => $devicetype, 'sesskey' => sesskey()));

        $content  = html_writer::start_tag('div', array('id' => 'switch','class' => 'rounded-corners-8px'));
		
        $content .= html_writer::start_tag('span', array('class' => 'switch-text'));
		$content .= html_writer::tag('h5',$linktext);
		$content .= html_writer::end_tag('span');
		
		$content .= html_writer::start_tag('div', array('title' => $linkurl));
		$content .= html_writer::start_tag('span', array('class' => 'on active'));
		$content .= html_writer::tag('h2','ON');
		$content .= html_writer::end_tag('span');
		$content .= html_writer::start_tag('span', array('class' => 'off'));
		$content .= html_writer::tag('h2','OFF');
		$content .= html_writer::end_tag('span');
		$content .= html_writer::end_tag('div');
		
        $content .= html_writer::end_tag('div');

        return $content;
    }

    /**
     * Renders a custom menu object (located in outputcomponents.php)
     *
     * The custom menu this method override the render_custom_menu function
     * in outputrenderers.php
     * @staticvar int $menucount
     * @param custom_menu $menu
     * @return string
     */
    protected function render_custom_menu(custom_menu $menu) {
        // If the menu has no children return an empty string
        if (!$menu->has_children()) {
            return '';
        }
        // Initialise this custom menu
        $content = html_writer::start_tag('ul', array('class'=>'custommenu'));
        // Render each child
        foreach ($menu->get_children() as $item) {
            $content .= $this->render_custom_menu_item($item);
        }
        // Close the open tags
        $content .= html_writer::end_tag('ul');
        // Return the custom menu
        return $content;
    }

    /**
     * Renders a custom menu node as part of a submenu
     *
     * The custom menu this method override the render_custom_menu_item function
     * in outputrenderers.php
     *
     * @see render_custom_menu()
     *
     * @staticvar int $submenucount
     * @param custom_menu_item $menunode
     * @return string
     */
    protected function render_custom_menu_item(custom_menu_item $menunode) {
        // Required to ensure we get unique trackable id's
        static $submenucount = 0;
        
        if ($menunode->has_children()) {
			$content = html_writer::start_tag('li', array('class'=>'has_children default'));
            // If the child has menus render it as a sub menu
            $submenucount++;
            if ($menunode->get_url() !== null) {
                $url = $menunode->get_url();
            } else {
                $url = '#cm_submenu_'.$submenucount;
            }
            
            $content .= html_writer::link($url, $menunode->get_text(), array('title'=>$menunode->get_title()));
            
            $content .= html_writer::start_tag('ul');
            foreach ($menunode->get_children() as $menunode) {
                $content .= $this->render_custom_menu_item($menunode);
            }
            $content .= html_writer::end_tag('ul');
        } else {
			$content = html_writer::start_tag('li', array('class'=>'default'));
            // The node doesn't have children so produce a final menuitem

            if ($menunode->get_url() !== null) {
                $url = $menunode->get_url();
            } else {
                $url = '#';
            }
            $content .= html_writer::link($url, $menunode->get_text(), array('title'=>$menunode->get_title()));
        }
        $content .= html_writer::end_tag('li');
        // Return the sub menu
        return $content;
    }

 /**--------------------------------------------------------------------------------------------------------------------------------
   
     * Produces a header for a block
     *
     * @param block_contents $bc
     * @return string
     */
    protected function block_header(block_contents $bc) {

        $title = '';
        if ($bc->title) {
            $title = $bc->title;
			$idtitle =$bc->blockinstanceid;
        }

        //$controlshtml = $this->block_controls($bc->controls);

        $output = '';
        if ($title || $controlshtml) {
            $output .= html_writer::tag('li', html_writer::tag('a',$title, array('href' => '#','rel' => '#'.$idtitle)));
        }
        return $output;
    }

    /**
     * Produces the content area for a block
     *
     * @param block_contents $bc
     * @return string
     */
    protected function block_content(block_contents $bc) {
		$idtitle =$bc->blockinstanceid;
		
        $output = html_writer::start_tag('div', array('id' => $idtitle,'class' => 'tabbed pop-inner2'));
		$output .= html_writer::start_tag('div', array('id' => 'pages-wrapper3','class' => 'iscroller'));
		$output .= html_writer::start_tag('div', array('id' => 'pages-iscroll'));
        if (!$bc->title && !$this->block_controls($bc->controls)) {
            //$output .= html_writer::tag('div', '', array('class'=>'block_action notitle')); -----------
        }
        $output .= $bc->content;
        $output .= $this->block_footer($bc);
        $output .= html_writer::end_tag('div');
		$output .= html_writer::end_tag('div');
		$output .= html_writer::end_tag('div');

        return $output;
    }

    /**
     * overrides core_renderer::blocks_for_region()
     *  in moodlelib.php. Returns a string
     * values ready for use.
     *
     * @return string
     */
    public function blocks_for_head($region) {
        $blockcontents = $this->page->blocks->get_content_for_region($region, $this);
        $output = '';
		
        foreach ($blockcontents as $bc) {
            if ($bc instanceof block_contents) {
                if (!($bc->attributes['class'] == 'block_settings  block')
                        && !($bc->attributes['class'] == 'block_navigation  block') && !($bc->attributes['class'] == 'block_course_summary  block') && !($bc->attributes['class'] == 'block_search_forums  block') && !($bc->attributes['class'] == 'block_login  block') && !($bc->attributes['class'] == 'block_myprofile  block') && !($bc->attributes['class'] == 'block_messages  block')) {
                    $output .= $this->block_header($bc);
                }
            } else if ($bc instanceof block_move_target) {
                $output .= $this->block_move_target($bc);
            } else {
                throw new coding_exception('Unexpected type of thing (' . get_class($bc) . ') found in list of block contents.');
            }
        }
        return $output;
    }
	
	public function blocks_for_content($region) {
        $blockcontents = $this->page->blocks->get_content_for_region($region, $this);
        $output = '';
		
		  foreach ($blockcontents as $bc) {
            if ($bc instanceof block_contents) {
                if (!($bc->attributes['class'] == 'block_settings  block')
                        && !($bc->attributes['class'] == 'block_navigation  block') && !($bc->attributes['class'] == 'block_course_summary  block') && !($bc->attributes['class'] == 'block_search_forums  block') && !($bc->attributes['class'] == 'block_login  block') && !($bc->attributes['class'] == 'block_myprofile  block') && !($bc->attributes['class'] == 'block_messages  block')) {
                    $output .= $this->block_content($bc);
                }
				 
            } else if ($bc instanceof block_move_target) {
                $output .= $this->block_move_target($bc);
            } else {
                throw new coding_exception('Unexpected type of thing (' . get_class($bc) . ') found in list of block contents.');
            }
        }
		
    return $output;
       
    }
	
	public function blocks_for_nav($region) {
        $blockcontents = $this->page->blocks->get_content_for_region($region, $this);
        $output = '';
		
		  foreach ($blockcontents as $bc) {
            if ($bc instanceof block_contents) {
                if ($bc->attributes['class'] == 'block_navigation  block')  {
                    $output .= $bc->content;
                }
            } 
        }
		
    return $output;
       
    }
	public function blocks_for_sett($region) {
        $blockcontents = $this->page->blocks->get_content_for_region($region, $this);
        $output = '';
		
		  foreach ($blockcontents as $bc) {
            if ($bc instanceof block_contents) {
                if ($bc->attributes['class'] == 'block_settings  block')  {
                    $output .= $bc->content;
                }
            } 
        }
		
    return $output;
       
    }
	public function blocks_for_msjs($region) {
        $blockcontents = $this->page->blocks->get_content_for_region($region, $this);
        $output = '';
		
		  foreach ($blockcontents as $bc) {
            if ($bc instanceof block_contents) {
                if ($bc->attributes['class'] == 'block_messages  block')  {
                    $output .= $bc->content;
                }
            } 
        }
		
    return $output;
       
    }
	/**
     * Return the navbar content so that it can be echoed out by the layout
     * @return string XHTML navbar
     */
    public function navbar() {
        $items = $this->page->navbar->get_items();

        $htmlblocks = array();
        // Iterate the navarray and display each node
        $itemcount = count($items);
        $separator = get_separator();
        for ($i=1;$i < $itemcount;$i++) { //----- i=1 to exclude the HOME ---------------------------------------------------------------------------------------
            $item = $items[$i];
            $item->hideicon = true;
            if ($i===1) {
                $content = html_writer::tag('li',html_writer::tag('div',$this->render($item),array('class' => 'breadcrumb')));
            } else {
				
                $content = html_writer::tag('li',html_writer::tag('div',$separator.$this->render($item),array('class' => 'breadcrumb')));
            }
            $htmlblocks[] = $content;
        }

        //accessibility: heading for navbar list  (MDL-20446)
        $navbarcontent = html_writer::tag('span', get_string('pagepath'), array('class'=>'accesshide'));
        $navbarcontent .= html_writer::tag('ul', join('', $htmlblocks));
        // XHTML
        return $navbarcontent;
    }
	
}
include_once ($CFG->dirroot. '/mod/choice/renderer.php');
 
class theme_moodle2mobile_mod_choice_renderer extends mod_choice_renderer {

    public function display_publish_anonymous_horizontal($choices) {
        global $CHOICE_COLUMN_WIDTH;

        $table = new html_table();
        $table->cellpadding = 5;
        $table->cellspacing = 0;
        $table->attributes['class'] = 'results anonymous ';
        $table->summary = get_string('responsesto', 'choice', format_string($choices->name));
        $table->data = array();

        $columnheaderdefault = new html_table_cell();
        $columnheaderdefault->scope = 'col';

        $tableheadertext = clone($columnheaderdefault);
        $tableheadertext->text = get_string('choiceoptions', 'choice');

        $tableheadernumber = clone($columnheaderdefault);
        $tableheadernumber->text = get_string('numberofuser', 'choice');

        $tableheaderpercentage = clone($columnheaderdefault);
        $tableheaderpercentage->text = get_string('numberofuserinpercentage', 'choice');

        $tableheadergraph = clone($columnheaderdefault);
        $tableheadergraph->text = get_string('responsesresultgraphheader', 'choice');

        $table->head = array($tableheadertext, $tableheadernumber, $tableheaderpercentage, $tableheadergraph);

        $count = 0;
        ksort($choices->options);

        $columndefault = new html_table_cell();
        $columndefault->attributes['class'] = 'data';

        $colheaderdefault = new html_table_cell();
        $colheaderdefault->scope = 'row';
        $colheaderdefault->header = true;
        $colheaderdefault->attributes['class'] = 'header data';

        $rows = array();
        foreach ($choices->options as $optionid => $options) {
            $colheader = clone($colheaderdefault);
            $colheader->text = $options->text;

            $graphcell = clone($columndefault);
            $datacellnumber = clone($columndefault);
            $datacellpercentage = clone($columndefault);

            $numberofuser = $width = $percentageamount = 0;

            if (!empty($options->user)) {
               $numberofuser = count($options->user);
            }

            if($choices->numberofuser > 0) {
               $width = ($CHOICE_COLUMN_WIDTH * ((float)$numberofuser / (float)$choices->numberofuser));
               $percentageamount = ((float)$numberofuser/(float)$choices->numberofuser)*100.0;
            }

            $attributes = array();
            $attributes['style'] = 'height:20px; width:'.$width.'px';
            $attributes['alt'] = '';
            $attributes['src'] = $this->output->pix_url('row', 'choice');
            $displaydiagram = html_writer::tag('img','', $attributes);

            $graphcell->text = $displaydiagram;
            $graphcell->attributes = array('class'=>'graph horizontal');

            if($choices->numberofuser > 0) {
               $percentageamount = ((float)$numberofuser/(float)$choices->numberofuser)*100.0;
            }

            $datacellnumber->text = $numberofuser;
            $datacellpercentage->text = format_float($percentageamount,1). '%';


            $row = new html_table_row();
            $row->cells = array($colheader, $datacellnumber, $datacellpercentage, $graphcell);
            $rows[] = $row;
        }

        $table->data = $rows;

        $html = '';
        $header = html_writer::tag('h2',format_string(get_string("responses", "choice")));
        $html .= html_writer::tag('div', $header, array('class'=>'responseheader'));
        $html .= html_writer::tag('div', html_writer::table($table), array('class'=>'response')); //--- Add a div container to the table in order to active it horizonal scroll propertie ---

        return $html;
    }
 
}
class theme_moodle2mobile_topsettings_renderer extends plugin_renderer_base {

   
    public function settings_search_box() {
        global $CFG;
        $content = "";
        if (has_capability('moodle/site:config', get_context_instance(CONTEXT_SYSTEM))) {
            $content .= $this->search_form(new moodle_url("$CFG->wwwroot/$CFG->admin/search.php"), optional_param('query', '', PARAM_RAW));
        }
        $content .= html_writer::empty_tag('br', array('clear' => 'all'));
        return $content;
    }

   
    public function search_form(moodle_url $formtarget, $searchvalue) {
        global $CFG;

        if (empty($searchvalue)) {
            $searchvalue = get_string('search').' '.get_string('settings').'..';
        }

        $content = html_writer::start_tag('form', array('class' => 'topadminsearchform', 'method' => 'get', 'action' => $formtarget));
        $content .= html_writer::start_tag('div', array('class' => 'search-box'));
        $content .= html_writer::tag('label', s(get_string('searchinsettings', 'admin')), array('for' => 'adminsearchquery', 'class' => 'accesshide'));
        $content .= html_writer::empty_tag('input', array('id' => 'topadminsearchquery', 'type' => 'text', 'name' => 'query', 'value' => s($searchvalue),
                    'onfocus' => "if(this.value == 'Search Settings..') {this.value = '';}",
                    'onblur' => "if (this.value == '') {this.value = 'Search Settings..';}"));
        //$content .= html_writer::empty_tag('input', array('class'=>'search-go','type'=>'submit', 'value'=>''));
        $content .= html_writer::end_tag('div');
        $content .= html_writer::end_tag('form');

        return $content;
    }

}


?>
