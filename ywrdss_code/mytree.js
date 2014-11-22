
var mapPanel, map;

Ext.onReady(function() {

var dclm = "<span style='font-weight:bold; font-size:10px;'>Disclaimer:</span><span style='font-size:10px;'><i>The data contained in this geo-spatial database has been compiled from a broad array of sources.  It is provided without warranty of any kind. The Center for Spatial Information does not warrant, guarantee, or make any representations regarding the use of, or results from the use of the Data in terms of correctness, accuracy, reliability, currentness, or otherwise.  Use these data solely at your own risk.</i>";
        
var options = {
				
				projection: new OpenLayers.Projection("EPSG:900913"),
				displayProjection: new OpenLayers.Projection("EPSG:4326"),
				maxExtent: new OpenLayers.Bounds(-20037508.34, -20037508.34,
																				 20037508.34, 20037508.34),
        restrictedExtent: new OpenLayers.Bounds(-13935979.6, 5628201.2,
																								-12941681.8, 6296751.3)

				};

   map = new OpenLayers.Map('map',options);

	
	var apiKey = 'AhlPsJLo85RSp41rqqOMfceh7aKF4yc7JRPzXC62fKYaMHrcnbmKjqNWxumfyQ2S';
	
	// var aerialBing = new OpenLayers.Layer.Bing({
    // key: apiKey,
    // type: "Aerial"
	// });
	
	var roadBing = new OpenLayers.Layer.Bing({
    key: apiKey,
    type: "Road"
	});
	
	
//gis layers
var basins = new OpenLayers.Layer.WMS(
                    "Sub-basins", "http://csi.gis.cwu.edu/geoserver/wms", 
                    {
                        layers: 'cite:gwis_new2',
                        styles: '',
                        transparent: 'true',
                        srs: 'EPSG:4326'                          
                    },
                     
                    { isBaseLayer: false,
                      visibility: true
                    }                                        
            );

var reservoirs = new OpenLayers.Layer.WMS(
                    "BOR Water infrastructure - Storage Reservoirs", "http://csi.gis.cwu.edu/geoserver/wms", 
                    {
                        layers: 'cite:storageres',
                        styles: '',
                        transparent: 'true',
                        srs: 'EPSG:4326'                          
                    },
                     
                    { isBaseLayer: false,
                      visibility: true
                    }                                        
            
            );
            
var rivers = new OpenLayers.Layer.WMS(
                    "Rivers", "http://csi.gis.cwu.edu/geoserver/wms", 
                    {
                        layers: 'cite:rivers',
                        styles: '',
                        transparent: 'true',
                        srs: 'EPSG:4326'                          
                    },
                     
                    { isBaseLayer: false,
                      visibility: false
                    }                                        
            
            ); 
            
var hydrost = new OpenLayers.Layer.WMS(
                    "BOR Water infrastructure - Hydro Stations", "http://csi.gis.cwu.edu/geoserver/wms", 
                    {
                        layers: 'cite:hydrostations',
                        styles: '',
                        transparent: 'true',
                        srs: 'EPSG:4326'                          
                    },
                     
                    { isBaseLayer: false,
                      visibility: false
                    }                                        
            
            ); 

var canal = new OpenLayers.Layer.WMS(
                    "KRD water delivery systems", "http://csi.gis.cwu.edu/geoserver/wms", 
                    {
                        layers: 'cite:canals',
                        styles: '',
                        transparent: 'true',
                        srs: 'EPSG:4326'                          
                    },
                     
                    { isBaseLayer: false,
                      visibility: false
                    }                                        
            
            );             
               
var turnouts = new OpenLayers.Layer.WMS(
                    "KRD Turn-outs", "http://csi.gis.cwu.edu/geoserver/wms", 
                    {
                        layers: 'cite:turnouts',
                        styles: '',
                        transparent: 'true',
                        srs: 'EPSG:4326'                          
                    },
                     
                    { isBaseLayer: false,
                      visibility: false
                    }                                        
            
            );                
 
var trs = new OpenLayers.Layer.WMS(
                    "Township - Range - Section", "http://csi.gis.cwu.edu/geoserver/wms", 
                    {
                        layers: 'cite:townshiprange',
                        styles: '',
                        transparent: 'true',
                        srs: 'EPSG:4326'                          
                    },
                     
                    { isBaseLayer: false,
                      visibility: false
                    }                                        
            
            ); 
               
var dpoint = new OpenLayers.Layer.WMS(
                    "Devices", "http://csi.gis.cwu.edu/geoserver/wms", 
                    {
                        layers: 'cite:d_point',
                        styles: '',
                        transparent: 'true',
                        srs: 'EPSG:4326'                          
                    },
                     
                    { isBaseLayer: false,
                      visibility: true
                    }                                        
            
            );               

var blk = new OpenLayers.Layer.WMS(
                    "Currently Blocked Habitat", "http://csi.gis.cwu.edu/geoserver/wms", 
                    {
                        layers: 'cite:blocked_data',
                        styles: '',
                        transparent: 'true',
                        srs: 'EPSG:4326'                          
                    },
                     
                    { isBaseLayer: false,
                      visibility: false
                    }                                        
            
            ); 

var ublk = new OpenLayers.Layer.WMS(
                    "Recently Unblocked Habitat", "http://csi.gis.cwu.edu/geoserver/wms", 
                    {
                        layers: 'cite:unblocked_data',
                        styles: '',
                        transparent: 'true',
                        srs: 'EPSG:4326'                          
                    },
                     
                    { isBaseLayer: false,
                      visibility: false
                    }                                        
            
            ); 
                                      
var pou = new OpenLayers.Layer.WMS(
                    "Water Rights per Parcel", "http://csi.gis.cwu.edu/geoserver/wms", 
                    {
                        layers: 'cite:pou_new',
                        styles: '',
                        transparent: 'true',
                        srs: 'EPSG:4326'                          
                    },
                     
                    { isBaseLayer: false,
                      visibility: true
                    }                                        
            
            );               

                                   
        //change order here for TOC            
    map.addLayers([roadBing, basins, pou, trs, reservoirs, rivers, blk, ublk, hydrost, canal, turnouts, dpoint]);
    map.zoomToMaxExtent();
    map.addControl(new OpenLayers.Control.MousePosition());
    map.addControl(new OpenLayers.Control.ScaleLine());
              
// create navigation history controls
               
							var nav = new OpenLayers.Control.NavigationHistory();
											// parent control must be added to the map
											nav.previous.title = "Go back to previous extent";
											nav.next.title = "Go to next extent";
											map.addControl(nav);
											
											var history = new OpenLayers.Control.Panel(
											{div: document.getElementById("extents")}
											);
											
											history.addControls([nav.next, nav.previous]);
											map.addControl(history);
        
    // create a map panel with some layers that we will show in our layer tree
    // below.
    mapPanel = new GeoExt.MapPanel({
        border: true,
        region: "center",
        contentEl: 'extents',
        map: map
    });    
    
    var info = new OpenLayers.Control.WMSGetFeatureInfo({
            url: "http://csi.gis.cwu.edu/geoserver/wms", 
            title: 'Identify features by clicking',
            queryVisible: true,
            eventListeners: {
                getfeatureinfo: function(event) {
                
                    var feature = map.getLonLatFromPixel(event.xy);
                    var popup = new GeoExt.Popup({
                    title: 'Layer Info',
                    width:300,
                    height:300,
                    map: mapPanel,
                    lonlat: feature,
                    html: event.text + dclm,
                    maximizable: true,
                    autoScroll: true,
                    collapsible: true                  
        });
              popup.show();
            }
           
            }
        });

        map.addControl(info);
        info.activate();    
    
         
        var layerList = new GeoExt.tree.LayerContainer({
        text: 'Layers',
        layerStore: mapPanel.layers,
        leaf: false,
        expanded: true
        });

        var layerTree = new Ext.tree.TreePanel({
        border: true,
        region: "west",
        title: 'Map Layers',
        width: 200,
        split: true,
        collapsible: true,
        autoScroll: true,
        root: layerList,
        bbar:({
          items: [
              {text: "About", handler: function(){about.show();}},
              {text: "Layer Info", handler: function(){linfo.show();}},
              {text: "PDF's", handler: function(){pdf.show();}}
              ]
              }),
        
        tbar:({
          items: [
              {text: "View Layer Metadata", handler: function(){metadata.show();}},
              {text: "Legend", handler: function(){leg.show();}}
              ]
              })

        });
        
    
    // create the tree with the configuration from above
    new Ext.Viewport({
        layout: "fit",
        hideBorders: true,
        items: {
            layout: "border",
            deferredRender: false,
            items: [mapPanel, layerTree, {
                tbar:[{
                      text: "Search Help",
                      handler: function() {
                      shelp.show();
                      }
                      }],
                contentEl: "desc",
                region: "east",
                bodyStyle: {"padding": "5px"},
                collapsible: true,
                split: false,
                width: 200,
                autoScroll: true,
                title: "Search Forum"
            }]
        }
    });
    
    map.setCenter(new OpenLayers.LonLat(-120.679,47.106).transform(map.displayProjection, map.projection),10);
	about.show();
	
$('#cover')
.css({visibility: "hidden",
opacity: 100
});

});

var metadata = new Ext.Window({
        layout: "fit",
        hideBorders: true,
        closeAction: "hide",
        width: 500,
        height: 400,
        title: "Layer Metadata",
        items: [{
              contentEl: "metadata",
              autoScroll: true
            }]           
    });

var linfo = new Ext.Window({
        layout: "fit",
        hideBorders: true,
        closeAction: "hide",
        width: 300,
        height: 400,
        title: "Layer Information",
        items: [{
              contentEl: "layerinfo",
              autoScroll:true
            }]           
    });

var about = new Ext.Window({
        layout: "fit",
        hideBorders: true,
        closeAction: "hide",
        width: 350,
        height: 400,
        title: "About",
        items: [{
              contentEl: "about",
              autoScroll: true
            }]           
    });

var shelp = new Ext.Window({
        layout: "fit",
        hideBorders: true,
        closeAction: "hide",
        width: 200,
        height: 300,
        title: "Search Help",
        items: [{
              contentEl: "searchhelp",
              autoScroll: true
            }]           
    });

var pdf = new Ext.Window({
        layout: "fit",
        hideBorders: true,
        closeAction: "hide",
        width: 200,
        height: 350,
        title: "PDF's",
        items: [{
              contentEl: "pdf",
              autoScroll: true
            }]           
    });  
    
var leg = new Ext.Window({
        layout: "fit",
        hideBorders: true,
        closeAction: "hide",
        width: 430,
        height: 380,
        title: "Map Legend",
        items: [{
              contentEl: "legend",
              autoScroll: true
            }]           
    });           

//ajax search using jQuery

				//detect click and key events that will initialize the search function
				$(document).ready(function(){
						$("#search_button").click(function(e){ 
								e.preventDefault(); 
								ajax_search(); 
						}); 
						$("#search_term").keyup(function(e){ 
								e.preventDefault();
								if(e.keyCode==13){ 
								ajax_search(); 
								}
						}); 

				}); 

				//perform the search

				//pass in page variable from search.php for paging long results 
				function ajax_search(page){
					//show results in sidebar using jquery
					$("#nodelist").show();
					
					//Show loading animation while query is being run.
					//$("#nodelist").html(loading);
					// Get values from 'search term' element and 'type_term' element in the html search form. 
					var search_val=$("#search_term").val();
					var type_val=$("#type_term").val();
					
					// Send values to 'search.php' page. 
					$.post("search.php", {search_term: search_val, type_term: type_val, current: page}, function(data){
					 if (data.length>3){
						//Show response in sidebar.
						 $("#nodelist").html(data); 
					 }
					 else{
							data='no results';
						 $("#nodelist").html(data);
					 
						}
					}) 
				} 
				
// center on postgres search results feature and create point with a name attribute

function centersearchfeature(xmax, xmin, ymax, ymin)
{ 
map.zoomToExtent(new OpenLayers.Bounds(xmin, ymin, xmax, ymax).transform(map.displayProjection, map.projection));
}