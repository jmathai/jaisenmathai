// FancyZoomHTML.js - v1.0
// Used to draw necessary HTML elements for FancyZoom
//
// Copyright (c) 2008 Cabel Sasser / Panic Inc
// All rights reserved.

function insertZoomHTML() {

	// All of this junk creates the three <div>'s used to hold the closebox, image, and zoom shadow.
	
	var inBody = document.getElementsByTagName("body").item(0);
	
	// WAIT SPINNER
	
	var inSpinbox = document.createElement("div");
	inSpinbox.setAttribute('id', 'ZoomSpin');
	inSpinbox.style.position = 'absolute';
	inSpinbox.style.left = '10px';
	inSpinbox.style.top = '10px';
	inSpinbox.style.visibility = 'hidden';
	inSpinbox.style.zIndex = '525';
	inBody.insertBefore(inSpinbox, inBody.firstChild);
	
	var inSpinImage = document.createElement("img");
	inSpinImage.setAttribute('class', 'plain'); // jm
	inSpinImage.setAttribute('id', 'SpinImage');
	inSpinImage.setAttribute('src', zoomImagesURI+'zoom-spin.gif'); // make this a gif
	inSpinbox.appendChild(inSpinImage);
	
	// ZOOM IMAGE
	//
	// <div id="ZoomBox">
	//   <a href="javascript:zoomOut();"><img src="/images/spacer.gif" id="ZoomImage" border="0"></a> <!-- THE IMAGE -->
	//   <div id="ZoomClose">
	//     <a href="javascript:zoomOut();"><img src="/images/closebox.png" width="30" height="30" border="0"></a>
	//   </div>
	// </div>
	
	var inZoombox = document.createElement("div");
	inZoombox.setAttribute('id', 'ZoomBox');
	
	inZoombox.style.position = 'absolute'; 
	inZoombox.style.left = '10px';
	inZoombox.style.top = '10px';
	inZoombox.style.visibility = 'hidden';
	inZoombox.style.zIndex = '499';
	
	inBody.insertBefore(inZoombox, inSpinbox.nextSibling);
	
	var inImage1 = document.createElement("img");
	inImage1.onclick = function (event) { zoomOut(this, event); return false; };	
	inImage1.setAttribute('src',zoomImagesURI+'spacer.gif');
	inImage1.setAttribute('id','ZoomImage');
	inImage1.setAttribute('border', '0');
	inImage1.setAttribute('class', 'plain'); // jm
	// inImage1.setAttribute('onMouseOver', 'zoomMouseOver();')
	// inImage1.setAttribute('onMouseOut', 'zoomMouseOut();')
	
	// This must be set first, so we can later test it using webkitBoxShadow.
	inImage1.setAttribute('style', '-webkit-box-shadow: '+shadowSettings+'0.0)');
	inImage1.style.display = 'block';
	inImage1.style.width = '10px';
	inImage1.style.height = '10px';
	inImage1.style.cursor = 'pointer'; // -webkit-zoom-out?
	inZoombox.appendChild(inImage1);

	var inClosebox = document.createElement("div");
	inClosebox.setAttribute('id', 'ZoomClose');
	inClosebox.style.position = 'absolute';
	
	// In MSIE, we need to put the close box inside the image.
	// It's 2008 and I'm having to do a browser detect? Sigh.
	if (browserIsIE) {
		inClosebox.style.left = '-1px';
		inClosebox.style.top = '0px';	
	} else {
		inClosebox.style.left = '-15px';
		inClosebox.style.top = '-15px';
	}
	
	inClosebox.style.visibility = 'hidden';
	inZoombox.appendChild(inClosebox);
		
	var inImage2 = document.createElement("img");
	inImage2.onclick = function (event) { zoomOut(this, event); return false; };	
	inImage2.setAttribute('src',zoomImagesURI+'closebox.png');		
	inImage2.setAttribute('width','30');
	inImage2.setAttribute('height','30');
	inImage2.setAttribute('border','0');
	inImage2.setAttribute('class','plain'); // jm
	inImage2.style.cursor = 'pointer';		
	inClosebox.appendChild(inImage2);
	
	// SHADOW
	// Only draw the table-based shadow if the programatic webkitBoxShadow fails!
	// Also, don't draw it if we're IE -- it wouldn't look quite right anyway.
	
	if (! document.getElementById('ZoomImage').style.webkitBoxShadow && ! browserIsIE) {

		// SHADOW BASE
		
		var inFixedBox = document.createElement("div");
		inFixedBox.setAttribute('id', 'ShadowBox');
		inFixedBox.style.position = 'absolute'; 
		inFixedBox.style.left = '50px';
		inFixedBox.style.top = '50px';
		inFixedBox.style.width = '100px';
		inFixedBox.style.height = '100px';
		inFixedBox.style.visibility = 'hidden';
		inFixedBox.style.zIndex = '498';
		inBody.insertBefore(inFixedBox, inZoombox.nextSibling);	
	
		// SHADOW
		// Now, the shadow table. Skip if not compatible, or irrevelant with -box-shadow.
		
		// <div id="ShadowBox"><table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0"> X
		//   <tr height="25">
		//   <td width="27"><img src="/images/zoom-shadow1.png" width="27" height="25"></td>
		//   <td background="/images/zoom-shadow2.png">&nbsp;</td>
		//   <td width="27"><img src="/images/zoom-shadow3.png" width="27" height="25"></td>
		//   </tr>
		
		var inShadowTable = document.createElement("table");
		inShadowTable.setAttribute('border', '0');
		inShadowTable.setAttribute('width', '100%');
		inShadowTable.setAttribute('height', '100%');
		inShadowTable.setAttribute('cellpadding', '0');
		inShadowTable.setAttribute('cellspacing', '0');
		inFixedBox.appendChild(inShadowTable);

		var inShadowTbody = document.createElement("tbody");	// Needed for IE (for HTML4).
		inShadowTable.appendChild(inShadowTbody);
		
		var inRow1 = document.createElement("tr");
		inRow1.style.height = '25px';
		inShadowTbody.appendChild(inRow1);
		
		var inCol1 = document.createElement("td");
		inCol1.style.width = '27px';
    inCol1.style.background = "url('"+zoomImagesURI+"zoom-shadow-corners.png') no-repeat 0px -1px";
		inRow1.appendChild(inCol1);  
		
		var inCol2 = document.createElement("td");
    inCol2.style.background = "url('"+zoomImagesURI+"zoom-shadow-tb.png') repeat-x 0px 1px";
		inRow1.appendChild(inCol2);
		
		var inCol3 = document.createElement("td");
		inCol3.style.width = '27px';
    inCol3.style.background = "url('"+zoomImagesURI+"zoom-shadow-corners.png') no-repeat -27px -1px";
		inRow1.appendChild(inCol3);  
		
		//   <tr>
		//   <td background="/images/zoom-shadow4.png">&nbsp;</td>
		//   <td bgcolor="#ffffff">&nbsp;</td>
		//   <td background="/images/zoom-shadow5.png">&nbsp;</td>
		//   </tr>
		
		inRow2 = document.createElement("tr");
		inShadowTbody.appendChild(inRow2);
		
		var inCol4 = document.createElement("td");
    inCol4.style.background = "url('"+zoomImagesURI+"zoom-shadow-lr.png') repeat-y";
		inRow2.appendChild(inCol4);
		
		var inCol5 = document.createElement("td");
		inCol5.setAttribute('bgcolor', '#ffffff');
		inRow2.appendChild(inCol5);
		// inCol5.innerHTML = '&nbsp;';
		var inSpacer3 = document.createElement("img");
		inSpacer3.setAttribute('src',zoomImagesURI+'spacer.gif');
		inSpacer3.setAttribute('height', '1');
		inSpacer3.setAttribute('width', '1');
		inSpacer3.style.display = 'block';
		inCol5.appendChild(inSpacer3);
		
		var inCol6 = document.createElement("td");
    inCol6.style.background = "url('"+zoomImagesURI+"zoom-shadow-lr.png') repeat-y -27px 0px";
		inRow2.appendChild(inCol6);
	
		//   <tr height="26">
		//   <td width="27"><img src="/images/zoom-shadow6.png" width="27" height="26"</td>
		//   <td background="/images/zoom-shadow7.png">&nbsp;</td>
		//   <td width="27"><img src="/images/zoom-shadow8.png" width="27" height="26"></td>
		//   </tr>  
		// </table>
		
		var inRow3 = document.createElement("tr");
		inRow3.style.height = '26px';
		inShadowTbody.appendChild(inRow3);
		
		var inCol7 = document.createElement("td");
		inCol7.style.width = '27px';
    inCol7.style.background = "url('"+zoomImagesURI+"zoom-shadow-corners.png') no-repeat 0px -27px";
		inRow3.appendChild(inCol7);
		/*var inShadowImg7 = document.createElement("img");
		inShadowImg7.setAttribute('width', '27');
		inShadowImg7.setAttribute('height', '26');
		inShadowImg7.style.display = 'block';
		inCol7.appendChild(inShadowImg7);*/
		
		var inCol8 = document.createElement("td");
    inCol8.style.background = "url('"+zoomImagesURI+"zoom-shadow-tb.png') repeat-x 0px -25px";
		inRow3.appendChild(inCol8);  
		// inCol8.innerHTML = '&nbsp;';
		/*var inSpacer5 = document.createElement("img");
		inSpacer5.setAttribute('src',zoomImagesURI+'spacer.gif');
		inSpacer5.setAttribute('height', '1');
		inSpacer5.setAttribute('width', '1');
		inSpacer5.style.display = 'block';
		inCol8.appendChild(inSpacer5);*/
		
		var inCol9 = document.createElement("td");
		inCol9.style.width = '27px';
    inCol9.style.background = "url('"+zoomImagesURI+"zoom-shadow-corners.png') no-repeat -27px -27px";
		inRow3.appendChild(inCol9);  
		/*var inShadowImg9 = document.createElement("img");
		inShadowImg9.setAttribute('src', zoomImagesURI+'zoom-shadow8.png');
		inShadowImg9.setAttribute('width', '27');
		inShadowImg9.setAttribute('height', '26');
		inShadowImg9.style.display = 'block';
		inCol9.appendChild(inShadowImg9);*/
	}

	if (includeCaption) {
	
		// CAPTION
		//
		// <div id="ZoomCapDiv" style="margin-left: 13px; margin-right: 13px;">
		// <table border="1" cellpadding="0" cellspacing="0">
		// <tr height="26">
		// <td><img src="zoom-caption-l.png" width="13" height="26"></td>
		// <td rowspan="3" background="zoom-caption-fill.png"><div id="ZoomCaption"></div></td>
		// <td><img src="zoom-caption-r.png" width="13" height="26"></td>
		// </tr>
		// </table>
		// </div>
		
		var inCapDiv = document.createElement("div");
		inCapDiv.setAttribute('id', 'ZoomCapDiv');
		inCapDiv.style.position = 'absolute'; 		
		inCapDiv.style.visibility = 'hidden';
		inCapDiv.style.marginLeft = 'auto';
		inCapDiv.style.marginRight = 'auto';
		inCapDiv.style.zIndex = '501';

		inBody.insertBefore(inCapDiv, inZoombox.nextSibling);
		
		var inCapTable = document.createElement("table");
		inCapTable.setAttribute('border', '0');
		inCapTable.setAttribute('cellPadding', '0');	// Wow. These honestly need to
		inCapTable.setAttribute('cellSpacing', '0');	// be intercapped to work in IE. WTF?
		inCapDiv.appendChild(inCapTable);
		
		var inTbody = document.createElement("tbody");	// Needed for IE (for HTML4).
		inCapTable.appendChild(inTbody);
		
		var inCapRow1 = document.createElement("tr");
		inTbody.appendChild(inCapRow1);
		
		var inCapCol1 = document.createElement("td");
		inCapCol1.setAttribute('align', 'right');
    inCapCol1.setAttribute('width', '13');
    inCapCol1.setAttribute('height', '27');
    inCapCol1.style.background = "url('"+zoomImagesURI+"zoom-caption-lr.png') no-repeat";
		inCapRow1.appendChild(inCapCol1);
		
		var inCapCol2 = document.createElement("td");
		inCapCol2.setAttribute('background', zoomImagesURI+'zoom-caption-fill.png');
		inCapCol2.setAttribute('id', 'ZoomCaption');
		inCapCol2.setAttribute('valign', 'middle');
		inCapCol2.style.fontSize = '14px';
		inCapCol2.style.fontFamily = 'Helvetica';
		inCapCol2.style.fontWeight = 'bold';
		inCapCol2.style.color = '#ffffff';
		inCapCol2.style.textShadow = '0px 2px 4px #000000';
		inCapCol2.style.whiteSpace = 'nowrap';
		inCapRow1.appendChild(inCapCol2);
		
		var inCapCol3 = document.createElement("td");
    inCapCol3.setAttribute('width', '13');
    inCapCol3.setAttribute('height', '27');
    inCapCol3.style.background = "url('"+zoomImagesURI+"zoom-caption-lr.png') no-repeat -13px 0px";
		inCapRow1.appendChild(inCapCol3);
	}
}
