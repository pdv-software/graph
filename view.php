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
?>

<!--[if IE]><script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/excanvas.min.js"></script><![endif]-->


<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.time.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.selection.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.touch.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/jquery.flot.togglelegend.min.js"></script>
<!--
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Lib/flot/flot.min.js"></script>
-->
<script type="text/javascript"><?php require "Modules/graph/graph_langjs.php"; ?></script>
<script language="javascript" type="text/javascript" src="<?php echo $path;?>Modules/graph/vis.helper.js"></script>
<script type="text/javascript"><?php require "Modules/graph/graph_constjs.php"; ?></script>

<style>
#wrapper {
  padding:0px;
  margin:0px;
  padding-left: 250px;
}

#sidebar-wrapper {
  margin-top:-10px;
  margin-left: -250px;
  left: 250px;
  width: 250px;
  background: #eee;
  position: fixed;
  overflow-y: auto;
  z-index: 1000;
}

#page-content-wrapper {
  width: 100%;
  padding-left:0px;
}

button.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 10px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

button.accordion.active, button.accordion:hover {
    background-color: #ddd;
}

button.accordion:after {
    content: '\02795';
    font-size: 13px;
    color: #777;
    float: right;
    margin-left: 5px;
}

button.accordion.active:after {
    content: "\2796";
}

div.panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
#    overflow: auto;
    overflow-x: auto;
    transition: 0.6s ease-in-out;
    opacity: 0;
}

div.panel.show {
    opacity: 1;
    max-height: 500px;  
}
</style>

<div id="wrapper">
    <div id="sidebar-wrapper">
            <div style="padding:10px;">
                <div id="sidebar-close" style="float:right; cursor:pointer; padding:10px;"><i class="icon-remove"></i></div>
                <h4><?php echo _("My Graphs"); ?></h4>
                <select id="graph-select" style="width:215px">
                </select>
                
                <br><br>
                <b><?php echo _("Graph Name"); ?>:</b><br>
                <input id="graph-name" type="text" style="width:200px" />
                <button id="graph-delete" class="btn" style="display:none"><?php echo _("Delete"); ?></button>
                <button id="graph-save" class="btn"><?php echo _("Save"); ?></button>
            </div>
            <div style="padding-left:10px;">
                <h4><?php echo _("Feeds"); ?></h4>
                
            </div>
            <div style="overflow-x: hidden; background-color:#f3f3f3; width:100%">
                <table class="table" id="feeds">
                </table>
            </div>
            
    </div>

    <div id="page-content-wrapper" style="max-width:1280px">
        <h3><?php echo _("Data viewer"); ?><div style="float:right;" id="graph-title"></div></h3> 

        <div id="error" style="display:none"></div>

        <div id="histogram-controls" style="padding-bottom:5px; display:none;">
            <div class="input-prepend input-append">
                <span class="add-on" style="width:85px"><b><?php echo _("Histogram"); ?></b></span>
                <span class="add-on" style="width:75px"><?php echo _("Type"); ?></span>
                <select id="histogram-type" style="width:150px">
                    <option value="timeatvalue" ><?php echo _("Time at value"); ?></option>
                    <option value="kwhatpower" ><?php echo _("kWh at Power"); ?></option>
                </select>
                <span class="add-on" style="width:75px"><?php echo _("Resolution"); ?></span>
                <input id="histogram-resolution" type="text" style="width:60px"/>
            </div>
            
            <button id="histogram-back" class="btn" style="float:right"><?php echo _("Back to main view"); ?></button>
        </div>

        <div id="placeholder_bound" style="width:100%; height:400px;">
<div id="graph_bound" style="height:400px; width:100%; position:relative; ">
           <div id="placeholder"></div>
    <div id="graph-buttons" style="position:absolute; top:18px; right:32px; opacity:0.5;">
        <div class='btn-group'>
            <button class="btn" id="sidebar-open"><i class="icon-list"></i></button>
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
        </div>

        <div id="info" style="padding:20px; display:none">

            <button class="accordion" id="accFeeds"><b><?php echo _("Feeds"); ?></b></button>
            <div class="panel" >
              <table class="table">
                <tr><th><?php echo _("Feed"); ?></th><th><?php echo _("Type"); ?></th><th><?php echo _("Color"); ?></th><th><?php echo _("Fill"); ?></th><th><?php echo _("Quality"); ?></th><th><?php echo _("Min"); ?></th><th><?php echo _("Max"); ?></th><th><?php echo _("Diff"); ?></th><th><?php echo _("Mean"); ?></th><th><?php echo _("Stdev"); ?></th><th><?php echo _("&Sigma;h"); ?></th><th style='text-align:center'><?php echo _("Scale"); ?></th><th style='text-align:center'><?php echo _("Delta"); ?></th><th style='text-align:center'><?php echo _("Average"); ?></th><th><?php echo _("DP"); ?></th><th style="width:120px"></th></tr>
                <tbody id="stats"></tbody>
              </table>
            </div>
            
            <button class="accordion"><b><?php echo _("Details"); ?></b></button>
            <div class="panel">
            <div class="input-prepend input-append" style="padding-right:5px">
                <span class="add-on" style="width:60px"><?php echo _("Start"); ?></span>
                <input id="request-start" type="text" style="width:80px" />
                <span class="add-on" style="width:60px"><?php echo _("End"); ?></span>
                <input id="request-end" type="text" style="width:80px" />
            </div>
            <div class="input-prepend input-append">
                <span class="add-on" style="width:60px"><?php echo _("Type"); ?></span>
                <select id="request-type" style="width:120px">
                    <option value="interval"><?php echo _("Fixed Interval"); ?></option>
                    <option><?php echo _("Daily"); ?></option>
                    <option><?php echo _("Weekly"); ?></option>
                    <option><?php echo _("Monthly"); ?></option>
                    <option><?php echo _("Annual"); ?></option>
                </select>
                
                <span class="fixed-interval-options">
                    <input id="request-interval" type="text" style="width:60px" />
                    <span class="add-on"><?php echo _("Fix"); ?> <input id="request-fixinterval" type="checkbox" style="margin-top:1px" /></span>
                    <span class="add-on"><?php echo _("<abbr title='Limit to data interval'>Limit</abbr>"); ?> <input id="request-limitinterval" type="checkbox" style="margin-top:1px" /></span>
                </span>
            </div>
            <div class="input-prepend input-append">
                <span class="add-on" style="width:60px"><?php echo _("Y-axis"); ?></span>
                <span class="add-on" style="width:30px"><?php echo _("min"); ?></span>
                <input id="yaxis-min" type="text" style="width:50px" value="auto"/>
                <span class="add-on" style="width:30px"><?php echo _("max"); ?></span>
                <input id="yaxis-max" type="text" style="width:50px" value="auto"/>
                
                <button id="reload" class="btn"><?php echo _("Reload"); ?></button>
            </div>

            <div class="input-prepend input-append">
                <span class="add-on" style="width:60px"><?php echo _("Show"); ?></span>
                <span class="add-on"><?php echo _("missing data"); ?>: <input type="checkbox" id="showmissing" style="margin-top:1px" /></span>
                <span class="add-on"><?php echo _("legend"); ?>: <input type="checkbox" id="showlegend" style="margin-top:1px" /></span>
                <span class="add-on"><?php echo _("feed tag"); ?>: <input type="checkbox" id="showtag" style="margin-top:1px" /></span>
            </div>

            <div id="window-info" style=""></div><br>
            </div>
            
            <button class="accordion"><b><?php echo _("Export"); ?></b></button>
              <div class="panel">
                <button class="btn" id="showcsv" >CSV Output +</button>
                <span class="add-on csvoptions"><?php echo _("Time format"); ?>:</span>
                <select id="csvtimeformat" class="csvoptions">
                    <option value="unix"><?php echo _("Unix timestamp"); ?></option>
                    <option value="seconds"><?php echo _("Seconds since start"); ?></option>
                    <option value="datestr"><?php echo _("Date-time string"); ?></option>
                </select>
                <span class="add-on csvoptions"><?php echo _("Null values"); ?>:</span>
                <select id="csvnullvalues" class="csvoptions">
                    <option value="show"><?php echo _("Show"); ?></option>
                    <option value="lastvalue"><?php echo _("Replace with last value"); ?></option>
                    <option value="remove"><?php echo _("Remove whole line"); ?></option>
                </select>
              <textarea id="csv" style="width:98%; height:300px; display:none; margin-top:10px"></textarea>
              </div> 
        </div>
    </div>
</div>

<script language="javascript" type="text/javascript" src="<?php echo $path;?>Modules/graph/graph.js"></script>

<script>
    var path = "<?php echo $path; ?>";
    
    // Begin: accordion effect
    var acc = document.getElementsByClassName("accordion");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function(){
            this.classList.toggle("active");
            this.nextElementSibling.classList.toggle("show");
        }
    }
    // End: accordion effect

    sidebar_resize();
    graph_init_editor();
    
    // Assign active feedid from URL
    var urlparts = window.location.pathname.split("graph/");
    if (urlparts.length==2) {
        feedid = parseInt(urlparts[1]);
        f = getfeed(feedid);
        feedlist.push({id:feedid, name:f.name, tag:f.tag, yaxis:1, fill:0, scale: 1.0, delta:false, dp:1, plottype:'lines'});
    }
    
    load_feed_selector();
    graph_resize();
    
    var timeWindow = 3600000*24.0*7;
    var now = Math.round(+new Date * 0.001)*1000;
    view.start = now - timeWindow;
    view.end = now;
    view.calc_interval();
    
    
    graph_reloaddraw();
    

// Auto expand Feeds accordion element
//    $(document).ready(function () {
//        document.getElementById("accFeeds").click();
//    });
</script>

