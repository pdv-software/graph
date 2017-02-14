
<?php
/*
  All Emoncms code is released under the GNU Affero General Public License.
  See COPYRIGHT.txt and LICENSE.txt.

  ---------------------------------------------------------------------
  Emoncms - open source energy visualisation
  Part of the OpenEnergyMonitor project:
  http://openenergymonitor.org
*/

// no direct access
defined('EMONCMS_EXEC') or die('Restricted access');

// Create a Javascript associative array who contain all sentences from module
?>
var LANG_JS = new Array();
function _Tr(key)
{
<?php // will return the default value if LANG_JS[key] is not defined. ?>
    return LANG_JS[key] || key;
}
<?php
//Please USE the builder every javascript modify at: /script/langjs_builder.php
?>
// START AUTO GENERATED

// graph.js
LANG_JS["Apr"] = '<?php echo addslashes(_("Apr")); ?>';
LANG_JS["Aug"] = '<?php echo addslashes(_("Aug")); ?>';
LANG_JS["Bars"] = '<?php echo addslashes(_("Bars")); ?>';
LANG_JS["Dec"] = '<?php echo addslashes(_("Dec")); ?>';
LANG_JS["Feb"] = '<?php echo addslashes(_("Feb")); ?>';
LANG_JS["Fri"] = '<?php echo addslashes(_("Fri")); ?>';
LANG_JS["g"] = '<?php echo addslashes(_("g")); ?>';
LANG_JS["Histogram"] = '<?php echo addslashes(_("Histogram")); ?>';
LANG_JS["Jan"] = '<?php echo addslashes(_("Jan")); ?>';
LANG_JS["Jul"] = '<?php echo addslashes(_("Jul")); ?>';
LANG_JS["Jun"] = '<?php echo addslashes(_("Jun")); ?>';
LANG_JS["k"] = '<?php echo addslashes(_("k")); ?>';
LANG_JS["Length"] = '<?php echo addslashes(_("Length")); ?>';
LANG_JS["Lines"] = '<?php echo addslashes(_("Lines")); ?>';
LANG_JS["m"] = '<?php echo addslashes(_("m")); ?>';
LANG_JS["Mar"] = '<?php echo addslashes(_("Mar")); ?>';
LANG_JS["May"] = '<?php echo addslashes(_("May")); ?>';
LANG_JS["Mon"] = '<?php echo addslashes(_("Mon")); ?>';
LANG_JS["Nov"] = '<?php echo addslashes(_("Nov")); ?>';
LANG_JS["Oct"] = '<?php echo addslashes(_("Oct")); ?>';
LANG_JS["Please enter a name for the graph you wish to save"] = '<?php echo addslashes(_("Please enter a name for the graph you wish to save")); ?>';
LANG_JS["Request error"] = '<?php echo addslashes(_("Request error")); ?>';
LANG_JS["Sat"] = '<?php echo addslashes(_("Sat")); ?>';
LANG_JS["Select graph"] = '<?php echo addslashes(_("Select graph")); ?>';
LANG_JS["Sep"] = '<?php echo addslashes(_("Sep")); ?>';
LANG_JS["Sun"] = '<?php echo addslashes(_("Sun")); ?>';
LANG_JS["Thu"] = '<?php echo addslashes(_("Thu")); ?>';
LANG_JS["Tue"] = '<?php echo addslashes(_("Tue")); ?>';
LANG_JS["Wed"] = '<?php echo addslashes(_("Wed")); ?>';
LANG_JS["Window"] = '<?php echo addslashes(_("Window")); ?>';

// graph_render.js
LANG_JS["Graph"] = '<?php echo addslashes(_("Graph")); ?>';
LANG_JS["Saved graphs from graph module"] = '<?php echo addslashes(_("Saved graphs from graph module")); ?>';
// END AUTO GENERATED
