<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/// Website where help was found.
/// https://www.amityweb.co.uk/blog/adding-a-module-position-loadposition-inside-another-module-in-joomla
/// Nog 'n reference
/// https://joomla.stackexchange.com/questions/1054/displaying-a-joomla-module-using-php

function plgModuleLoadModule( $html )
{
   $db = JFactory::getDBO();
   // simple performance check to determine whether bot should process further
   if ( JString::strpos( $html, 'loadposition' ) == false ) {
      return $html;
   }

   // expression to search for
   $regex = '/{loadposition\s*.*?}/i';

   // find all instances of plugin and put in $matches
   preg_match_all( $regex, $html, $matches );

   // Number of plugins
   $count = count( $matches[0] );

   // plugin only processes if there are any instances of the plugin in the text
   if ( $count ) {
      $html = plgModuleProcessPositions( $html, $matches, $count, $regex );
   }
  
   return $html;
}

function plgModuleProcessPositions ( $html, $matches, $count, $regex )
{
   for ( $i=0; $i < $count; $i++ )
   {
      $load = str_replace( 'loadposition','', $matches[0][$i] );
      $load = str_replace( '{','', $load );
      $load = str_replace( '}', '', $load );
      $load = trim( $load );
//	  file_put_contents('hhh.txt', $load);

      $modules   = plgModuleLoadPosition( $load );
      $html    = str_replace($matches[0][$i], $modules, $html );
   }

     // removes tags without matching module positions
   $html = preg_replace( $regex, '', $html );
  
   return $html;
}

function plgModuleLoadPosition( $position )
{
   $document   = JFactory::getDocument();
   $renderer   = $document->loadRenderer('module');
   $options   = array('style' => 'xhtml');

   $contents = '';
   foreach (JModuleHelper::getModules($position) as $mod)  {
      $contents .= $renderer->render($mod, $options, null);
   }
//   	  file_put_contents('hhhh.txt', $contents);
   return $contents;
}

$doc = JFactory::getDocument();
JHtml::_('jquery.framework');
$doc->addScriptDeclaration($this->msg['js']);
JHtml::_('bootstrap.framework');
$doc->addStyleDeclaration($this->msg['css']);
$htmlbody = $this->msg['html'];
$htmlbody = plgModuleLoadModule($htmlbody);
?>
<div class="row-fluid">	<?php echo $htmlbody; ?></div>