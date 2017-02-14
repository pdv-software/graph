<?php
    /*
    All Emoncms code is released under the GNU Affero General Public License.
    See COPYRIGHT.txt and LICENSE.txt.

    ---------------------------------------------------------------------
    Emoncms - open source energy visualisation
    Part of the OpenEnergyMonitor project:
    http://openenergymonitor.org
    */

    global $path, $embed;
    global $fullwidth;
    $fullwidth = true;
    
    $graphid = get("graphid");
?>

<!--[if IE]><script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/excanvas.min.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.time.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.selection.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.touch.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.togglelegend.min.js"></script>
<script type="text/javascript"><?php require "Modules/graph/graph_langjs.php"; ?></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Modules/graph/vis.helper.js"></script>
<script type="text/javascript"><?php require "Modules/graph/graph_constjs.php"; ?></script>

<div id="placeholder_bound" style="width:100%; height:100%">
    <div id="placeholder"></div>
    <div id="graph-buttons" style="position:absolute; top:18px; right:32px; opacity:0.5;">
        <div class='btn-group'>
            <button class='btn graph_time' type='button' time='1'><?php echo _("D"); ?></button>
            <button class='btn graph_time' type='button' time='7'><?php echo _("W"); ?></button>
            <button class='btn graph_time' type='button' time='30'><?php echo _("M"); ?></button>
            <button class='btn graph_time' type='button' time='365'><?php echo _("Y"); ?></button>
            <button class='btn graph-nav' id='graph_zoomin'>+</button>
            <button class='btn graph-nav' id='graph_zoomout'>-</button>
            <button class='btn graph-nav' id='graph_left'><</button>
            <button class='btn graph-nav' id='graph_right'>></button>
        </div>
    </div>
</div>

<script language="javascript" type="text/javascript" src="<?php echo $path;?>Modules/graph/graph.js"></script>

<script>
    $("body").css("background","none");
    embed = true;
    
    var path = "<?php echo $path; ?>";
    
    var graphid = "<?php echo $graphid; ?>";
    
    $.ajax({                                      
        url: path+"/graph/get?id="+graphid,
        async: true,
        dataType: "json",
        success: function(result) {
            
            view.start = result.start;
            view.end = result.end;
            view.interval = result.interval;
            view.limitinterval = result.limitinterval;
            view.fixinterval = result.fixinterval;
            floatingtime = result.floatingtime,
            yaxismin = result.yaxismin;
            yaxismax = result.yaxismax;
            feedlist = result.feedlist;
            
            // show settings
            showmissing = result.showmissing;
            showtag = result.showtag;
            showlegend = result.showlegend;
            
            if (floatingtime) {
                var timewindow = view.end - view.start;
                var now = Math.round(+new Date * 0.001)*1000;
                view.end = now;
                view.start = view.end - timewindow;
            }

            graph_resize();
            graph_reloaddraw();
        }
    });
    

</script>

