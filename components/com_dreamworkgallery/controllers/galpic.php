<?php
/**
* @Copyright Copyright (C) 2011- xml/swf
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/
// No direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport('joomla.application.component.controller');
 
/**
 * Gallery XML Component Controller
 */
if (!class_exists('JControllerSST')) {
 if (!class_exists('JController')) {
  if(function_exists('class_alias')) {
   class_alias('JControllerLegacy', 'JControllerSST');
  } else {
   class JControllerSST extends JControllerLegacy
   {
    function __construct()
    {
     parent::__construct();
    }
   }
  }
  } else {
  if(function_exists('class_alias')) {
   class_alias('JController', 'JControllerSST');
  } else {
   class JControllerSST extends JController
   {
    function __construct()
    {
     parent::__construct();
    }
   }
  }
 }
}
class GalleryControllerGalpic extends JControllerSST
{
    /**
     * Method to display the view
     *
     * @access    public
     */
    function display()
    {
		JRequest::setVar( 'view', 'galpic' );
		JRequest::setVar( 'layout', 'default' );
        parent::display();
    }
	function catpics()
	{
		$mainframe = JFactory::getApplication();
		$model = $this->getModel('galpic');//&$this->getModel();
		$cat_id = JRequest::getInt('gcatid');
		$data = $model->getData($cat_id);

		$params_comg = &JComponentHelper::getParams('com_dreamworkgallery');
		$picsdir = $params_comg->get('pic_path', 'images/dreamworkgallery/gallery');
		$picsdir .= '/';
		$picsdir = JURI::root() . $picsdir;
		$nameclr = $params_comg->get('nameclr', '#A63431');
		$curncy_sym = $params_comg->get('curncy_sym', "$");
		$pic_ttimg = (int)$params_comg->get('pic_ttimg', '1');
		
		$picperr = (int)$params_comg->get('picperr', '5');
		$picrperp = (int)$params_comg->get('picrperp', '10');
		$pic_numb = count($data);
		
		$page_index_num = 10;
		$page_num = JRequest::getInt('pagenum');
		
		$first_pic_id = 0;
		$last_pic_id = count($data) - 1;
		if ($pic_numb > $picperr * $picrperp) {
			$pages_all = ceil($pic_numb / ($picperr * $picrperp));
			$last_page = ceil($page_num / $page_index_num) * $page_index_num;
			if ($last_page > $pages_all) {
				$last_page = $pages_all;
			}
			if ($last_page < $page_index_num) {
				$first_page = 1;
			} else {
				$first_page = $last_page - $page_index_num + 1;
			}
			$first_pic_id = ($page_num - 1) * $picperr * $picrperp;
			$must_last_id = $first_pic_id + ($picperr * $picrperp) - 1;
			if ($must_last_id < $last_pic_id) {
				$last_pic_id = $must_last_id;
			}
		}
		
		$toolt_js_add = '';
		$toolt_divs = '';
		$r_cnt = 1;
		$curr_picr = 1;
		$ret_str = '<div id="galtblid" class="galtblid"><table>';
		for ($ii = $first_pic_id; $ii <= $last_pic_id; $ii++) {
			if($curr_picr == 1) {$ret_str .= '<tr>';}
			if ($pic_ttimg != 9) {
				$toolt_divs .= '<div id="tooltipi_'.$data[$ii]->id.'" class="pstooltipi" >'.$data[$ii]->descr.'</div>';
				$toolt_js_add .= 'jQuery("#pscatpicidi_'.$data[$ii]->id.'").tooltip({tip: \'#tooltipi_'.$data[$ii]->id.'\', tipClass: \'pstooltipi\', effect: \'slide\'});
';
}
			$ret_str .= '<td align="center">';
			$ret_str .= '<font size="1" color="'.$nameclr.'">'.$data[$ii]->name . '</font>';
			$ret_str .= '<br />';
			$ret_str .= '<a href="' . (($data[$ii]->medfld == 11) ? $data[$ii]->linkit : $picsdir . $data[$ii]->image) . '" title="' . $data[$ii]->name . '" class="shbxs1" >'.' <img id="pscatpicidi_'.$data[$ii]->id.'" src="' . $picsdir . $data[$ii]->thumb . '" alt="' . $data[$ii]->altthumb . '" /> '.'</a>';

			if($curr_picr == $picperr) {
				$ret_str .= '</tr>';
				$curr_picr = 1;
			} else {
				$curr_picr++;
			}
		}
		$ret_str .= '</table></div>';
		if ($pic_numb > $picperr * $picrperp) {
			$ret_str .= '<div id="picpage" style="margin: 10px 0px; text-align: right;">';
			if ($first_page > $page_index_num) {
				$ret_str .= '<a href="javascript:void(0);" onclick="ShowCat('.$cat_id.', 1);" >&lt;&lt; ' . JText::_('FIRST') . '</a>';
				$ret_str .= '<a href="javascript:void(0);" onclick="ShowCat('.$cat_id.', '.($page_num - 1).');" >&lt; ' . JText::_('PREV') . '</a>';
			}
			for ($ip = $first_page; $ip <= $last_page; $ip++) {
				if ($ip != $page_num) {
					$ret_str .= '<a href="javascript:void(0);" onclick="ShowCat('.$cat_id.', '.$ip.');" >'.$ip.'</a>';
				} else {
					$ret_str .= '<span style="margin: 2px; padding: 2px;"><b>'.$page_num.'</b></span>';
				}
			}
			if($page_num < $pages_all) {
				$ret_str .= '<a href="javascript:void(0);" onclick="ShowCat('.$cat_id.', '.($page_num + 1).');" >' . JText::_('NEXT') . ' &gt;</a>';
			}
			if ($last_page < $pages_all) {
				$ret_str .= '<a href="javascript:void(0);" onclick="ShowCat('.$cat_id.', '.$pages_all.');" >' . JText::_('LAST') . ' &gt;&gt;</a>';
			}
			$ret_str .= '</div>';
		}
		//$ret_str .= $toolt_divs;
		//$toolt_js_add = '<script type="text/javascript">
//' . $toolt_js_add . '</script>';
		//$ret_str .= $toolt_js_add;
		$ret_str .= "_sss_sss_sss_" . $toolt_divs . "_sss_sss_sss_" . $toolt_js_add;
		echo $ret_str;
		$mainframe->close();
	}
	

}
