<?php

/**
 * @copyright 2014-2023 Sentora Project (http://www.sentora.org/) 
 * Sentora is a GPL fork of the ZPanel Project whose original header follows:
 *
 * Generic template place holder class.
 * @package zpanelx
 * @subpackage dryden -> ui -> tpl
 * @version 1.1.0
 * @author Jason Davis (jason.davis.fl@gmail.com)
 * @copyright ZPanel Project (http://www.zpanelcp.com/)
 * @link http://www.zpanelcp.com/
 * @license GPL (http://www.gnu.org/licenses/gpl.html)
 */
class ui_tpl_modulelistzsidebar {

    public static function Template() {
        $line = '';
        $modcats = ui_moduleloader::GetModuleCats();

        foreach ($modcats as $modcat) {
            $mods = ui_moduleloader::GetModuleList($modcat['mc_id_pk'], 'modadmin');

            if ($mods) {
                $line .= '<li>';
                $line .= '<div class="heading">' .$modcat['mc_name_vc']. ' <span class="open">+</span></div>';
                $line .= '<ul>';
                
                foreach ($mods as $mod) {
                    $class_name = str_replace(array(' ', '_'), '-', strtolower($mod['mo_folder_vc']));
                   
					/*
					// deprecated
					$line .= '<li>';  
                    if ($mod['mo_installed_ts'] != 0) {
                        $line .= '<a href="?module=' . $mod['mo_folder_vc']. '"><i class="icon-' . $class_name . ' greyscale transparent"><img src="/modules/' . $mod['mo_folder_vc'] . '/assets/icon.png" height="16px" width="16px"></i> ';
                    } else {
                        $line .= '<a href="?module=' . $mod['mo_folder_vc']. '"><i class="icon-'.$class_name.'"></i> ';
                    }
					*/
					
					$module_icon = "";
					$line .= '<li><a href="?module=' . $mod['mo_folder_vc']. '">';
					
					if ($mod['mo_installed_ts'] != 0) {
						$icon = ui_module::GetModuleIcon( $mod['mo_folder_vc'], 16, 16 );
						
						switch ($icon['extension']) {
							case ICON_EXTENSION_SVG:
								$module_icon = $icon['svg_dom'];
								$class_name = "";
								break;
							case ICON_EXTENSION_PNG:
								$module_icon = '<img src="' .$icon['path']. '" height="16px" width="16px">';
								$class_name .= " greyscale transparent";
								break;
						}
					}
					
					$line .= '<i class="icon-'.$class_name.'">'. $module_icon .'</i> <: '.$mod['mo_name_vc'].' :></a></li>';
                }
                $line .= '</ul></li>';
            }
        }

        return $line;
    }

}

?>
