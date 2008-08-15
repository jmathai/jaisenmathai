/* Cache of /js/compress-aaa.js|prototype.lite.js|javascript.js|blog-ptg.js|FancyZoom.js|FancyZoomHTML.js|shCore.js|shBrushCss.js|shBrushJscript.js|shBrushPhp.js */

var Class={create:function(){return function(){this.initialize.apply(this,arguments);}}}
Object.extend=function(destination,source){for(property in source)destination[property]=source[property];return destination;}
Function.prototype.bind=function(object){var __method=this;return function(){return __method.apply(object,arguments);}}
Function.prototype.bindAsEventListener=function(object){var __method=this;return function(event){__method.call(object,event||window.event);}}
function $(){if(arguments.length==1)return get$(arguments[0]);var elements=[];$c(arguments).each(function(el){elements.push(get$(el));});return elements;function get$(el){if(typeof el=='string')el=document.getElementById(el);return el;}}
if(!window.Element)var Element=new Object();Object.extend(Element,{remove:function(element){element=$(element);element.parentNode.removeChild(element);},hasClassName:function(element,className){element=$(element);if(!element)return;var hasClass=false;element.className.split(' ').each(function(cn){if(cn==className)hasClass=true;});return hasClass;},addClassName:function(element,className){element=$(element);Element.removeClassName(element,className);element.className+=' '+className;},removeClassName:function(element,className){element=$(element);if(!element)return;var newClassName='';element.className.split(' ').each(function(cn,i){if(cn!=className){if(i>0)newClassName+=' ';newClassName+=cn;}});element.className=newClassName;},cleanWhitespace:function(element){element=$(element);$c(element.childNodes).each(function(node){if(node.nodeType==3&&!/\S/.test(node.nodeValue))Element.remove(node);});},find:function(element,what){element=$(element)[what];while(element.nodeType!=1)element=element[what];return element;}});var Position={cumulativeOffset:function(element){var valueT=0,valueL=0;do{valueT+=element.offsetTop||0;valueL+=element.offsetLeft||0;element=element.offsetParent;}while(element);return[valueL,valueT];}};document.getElementsByClassName=function(className){var children=document.getElementsByTagName('*')||document.all;var elements=[];$c(children).each(function(child){if(Element.hasClassName(child,className))elements.push(child);});return elements;}
Array.prototype.iterate=function(func){for(var i=0;i<this.length;i++)func(this[i],i);}
if(!Array.prototype.each)Array.prototype.each=Array.prototype.iterate;function $c(array){var nArray=[];for(var i=0;i<array.length;i++)nArray.push(array[i]);return nArray;}

var Dom={get:function(el){if(typeof el==='string'){return document.getElementById(el);}else{return el;}}};var Event={add:function(){if(window.addEventListener){return function(el,type,fn){Dom.get(el).addEventListener(type,fn,false);};}else if(window.attachEvent){return function(el,type,fn){var f=function(){fn.call(Dom.get(el),window.event);};Dom.get(el).attachEvent('on'+type,f);};}}()};function typeHeader()
{var rand=parseInt(Math.random()*10);switch(rand)
{case 0:case 5:var str1='<'+'?php echo "Welcome to my page!"; ?'+'>';var str2="<"+"?php echo 'Welcome to my page!'; ?"+">";var cpos=11;break;case 1:case 6:var str1="<"+"?php $bool = $status == false; ?"+">";var str2="<"+"?php $bool = $status === false; ?"+">";var cpos=23;break;case 2:case 7:var str1="<"+"?php $obj = new Object(); $obj->method(); ?"+">";var str2="<"+"?php Object::method(); ?"+">";var cpos=8;break;case 3:case 8:var str1="<"+"?php if(preg_match('/^start/', $subject)){ ?"+">";var str2="<"+"?php if(strncmp($subject, 'start', 5) == 0){ ?"+">";var cpos=9;break;case 4:case 9:var str1="<"+"?php if(strlen($string) < 10){ ?"+">";var str2="<"+"?php if(!isset($string{10})){ ?"+">";var cpos=9;break;}
var pos=0;var wait=200;var current=str1;var status=1;var relt=/\</g;var regt=/\>/g;var start=function()
{if(status==1&&pos==str1.length)
{wait=100;status=2;}
else
if(status==2&&pos==cpos)
{current=str2;wait=200;status=3;}
else
if(status==3&&pos==str2.length)
{status=4;}
switch(status)
{case 1:pos++;break;case 2:pos--;break;case 3:pos++;break;}
if(status<4)
{document.getElementById('header-banner').innerHTML=current.substring(0,pos).replace(relt,'&lt;').replace(regt,'&gt;');setTimeout(start,wait);}}
start();}
var ptg;Event.add(window,'load',function(){typeHeader();ptg=new PTG("656ff15dffa1a18c53c94b242da917f9");sideBar();searchImages();});

var offset=0;var limit=5;var tags='';var tagsArray=[];function sideBar()
{$('custom-sidebar').innerHTML=''
+' <h2 class="module-header">Photos</h2>'
+' <div class="module-content">'
+'   <div>'
+'     <form style="display:inline;" onsubmit="searchImages(); return false;">'
+'       <input type="text" id="ptgSearchField" class="formfield" />&nbsp;<input type="button" class="search" onclick="searchImages(); return false;" />'
+'     </form>'
+'   </div>'
+'   <div id="photoDiv" class="sidebar-photos"></div>'
+'</div>';}
function searchImages()
{tags=document.getElementById('ptgSearchField').value;offset=arguments.length==0?0:arguments[0];setTimeout('ptg.image.search({"privacy":"1","tags":tags,"limit":limit,"offset":offset,"order":"dateTaken"}, "searchImagesRsp")',100);}
function searchImagesRsp(data)
{var html='';$("photoDiv").innerHTML='';while(image=ptg.result.next(data))
{if(image.name==null){image.name='This photo has no title.';}
html+='<div><a href="'+ptg.html.customImageLockSrc(image.thumbnailPath,image.key,image.width,image.height,640,480)+'" title="'+image.name+' - &lt;a href=&quot;http://www.photagious.com/handler/photo/'+image.key+'/&quot; target=&quot;_blank&quot;&gt;View On Photagious&lt;/a&gt;">'+ptg.html.customImageTag(image.thumbnailPath,image.key,115,50,{"width":"115","height":"50","hspace":"1","vspace":"3","border":"0","style":"border:solid 1px #404040;"})+'</a></div>';}
html+='<div style="width:115px; margin-left:2px;">';if(offset>0)
{html+='<input type="button" class="previous" onclick="searchImages(offset - limit);" />';}
if((offset+limit)<=ptg.result.totalRows(data))
{html+='<input type="button" class="next" onclick="searchImages(offset + limit);"/>';}
html+='<br/></div>';$("photoDiv").innerHTML=html;setupZoom();return false;}

var includeCaption=true;var zoomTime=5;var zoomSteps=15;var includeFade=1;var minBorder=90;var shadowSettings='0px 5px 25px rgba(0, 0, 0, ';var zoomImagesURI='/images/zoom/';var myWidth=0,myHeight=0,myScroll=0;myScrollWidth=0;myScrollHeight=0;var zoomOpen=false,preloadFrame=1,preloadActive=false,preloadTime=0,imgPreload=new Image();var preloadAnimTimer=0;var zoomActive=new Array();var zoomTimer=new Array();var zoomOrigW=new Array();var zoomOrigH=new Array();var zoomOrigX=new Array();var zoomOrigY=new Array();var zoomID="ZoomBox";var theID="ZoomImage";var zoomCaption="ZoomCaption";var zoomCaptionDiv="ZoomCapDiv";if(navigator.userAgent.indexOf("MSIE")!=-1){var browserIsIE=true;}
function setupZoom(){prepZooms();insertZoomHTML();zoomdiv=document.getElementById(zoomID);zoomimg=document.getElementById(theID);}
function prepZooms(){if(!document.getElementsByTagName){return;}
var links=document.getElementsByTagName("a");for(i=0;i<links.length;i++){if(links[i].getAttribute("href")){if(links[i].getAttribute("href").search(/(.*)\.(jpg|jpeg|gif|png|bmp|tif|tiff)/gi)!=-1){if(links[i].getAttribute("rel")!="nozoom"){links[i].onclick=function(event){return zoomClick(this,event);};links[i].onmouseover=function(){zoomPreload(this);};}}}}}
function zoomPreload(from){var theimage=from.getAttribute("href");if(imgPreload.src.indexOf(from.getAttribute("href").substr(from.getAttribute("href").lastIndexOf("/")))==-1){preloadActive=true;imgPreload=new Image();imgPreload.onload=function(){preloadActive=false;}
imgPreload.src=theimage;}}
function preloadAnimStart(){preloadTime=new Date();document.getElementById("ZoomSpin").style.left=(myWidth/2)+'px';document.getElementById("ZoomSpin").style.top=((myHeight/2)+myScroll)+'px';document.getElementById("ZoomSpin").style.visibility="visible";preloadFrame=1;document.getElementById("SpinImage").src=zoomImagesURI+'zoom-spin-'+preloadFrame+'.png';preloadAnimTimer=setInterval("preloadAnim()",100);}
function preloadAnim(from){if(preloadActive!=false){document.getElementById("SpinImage").src=zoomImagesURI+'zoom-spin-'+preloadFrame+'.png';preloadFrame++;if(preloadFrame>12)preloadFrame=1;}else{document.getElementById("ZoomSpin").style.visibility="hidden";clearInterval(preloadAnimTimer);preloadAnimTimer=0;zoomIn(preloadFrom);}}
function zoomClick(from,evt){var shift=getShift(evt);if(!evt&&window.event&&(window.event.metaKey||window.event.altKey)){return true;}else if(evt&&(evt.metaKey||evt.altKey)){return true;}
getSize();if(preloadActive==true){if(preloadAnimTimer==0){preloadFrom=from;preloadAnimStart();}}else{zoomIn(from,shift);}
return false;}
function zoomIn(from,shift){zoomimg.src=from.getAttribute("href");if(from.childNodes[0].width){startW=from.childNodes[0].width;startH=from.childNodes[0].height;startPos=findElementPos(from.childNodes[0]);}else{startW=50;startH=12;startPos=findElementPos(from);}
hostX=startPos[0];hostY=startPos[1];if(document.getElementById('scroller')){hostX=hostX-document.getElementById('scroller').scrollLeft;}
endW=imgPreload.width;endH=imgPreload.height;if(zoomActive[theID]!=true){if(document.getElementById("ShadowBox")){document.getElementById("ShadowBox").style.visibility="hidden";}else if(!browserIsIE){if(fadeActive["ZoomImage"]){clearInterval(fadeTimer["ZoomImage"]);fadeActive["ZoomImage"]=false;fadeTimer["ZoomImage"]=false;}
document.getElementById("ZoomImage").style.webkitBoxShadow=shadowSettings+'0.0)';}
document.getElementById("ZoomClose").style.visibility="hidden";if(includeCaption){document.getElementById(zoomCaptionDiv).style.visibility="hidden";if(from.getAttribute('title')&&includeCaption){document.getElementById(zoomCaption).innerHTML=from.getAttribute('title');}else{document.getElementById(zoomCaption).innerHTML="";}}
zoomOrigW[theID]=startW;zoomOrigH[theID]=startH;zoomOrigX[theID]=hostX;zoomOrigY[theID]=hostY;zoomimg.style.width=startW+'px';zoomimg.style.height=startH+'px';zoomdiv.style.left=hostX+'px';zoomdiv.style.top=hostY+'px';if(includeFade==1){setOpacity(0,zoomID);}
zoomdiv.style.visibility="visible";sizeRatio=endW/endH;if(endW>myWidth-minBorder){endW=myWidth-minBorder;endH=endW/sizeRatio;}
if(endH>myHeight-minBorder){endH=myHeight-minBorder;endW=endH*sizeRatio;}
zoomChangeX=((myWidth/2)-(endW/2)-hostX);zoomChangeY=(((myHeight/2)-(endH/2)-hostY)+myScroll);zoomChangeW=(endW-startW);zoomChangeH=(endH-startH);if(shift){tempSteps=zoomSteps*7;}else{tempSteps=zoomSteps;}
zoomCurrent=0;if(includeFade==1){fadeCurrent=0;fadeAmount=(0-100)/tempSteps;}else{fadeAmount=0;}
zoomTimer[theID]=setInterval("zoomElement('"+zoomID+"', '"+theID+"', "+zoomCurrent+", "+startW+", "+zoomChangeW+", "+startH+", "+zoomChangeH+", "+hostX+", "+zoomChangeX+", "+hostY+", "+zoomChangeY+", "+tempSteps+", "+includeFade+", "+fadeAmount+", 'zoomDoneIn(zoomID)')",zoomTime);zoomActive[theID]=true;}}
function zoomOut(from,evt){if(getShift(evt)){tempSteps=zoomSteps*7;}else{tempSteps=zoomSteps;}
if(zoomActive[theID]!=true){if(document.getElementById("ShadowBox")){document.getElementById("ShadowBox").style.visibility="hidden";}else if(!browserIsIE){if(fadeActive["ZoomImage"]){clearInterval(fadeTimer["ZoomImage"]);fadeActive["ZoomImage"]=false;fadeTimer["ZoomImage"]=false;}
document.getElementById("ZoomImage").style.webkitBoxShadow=shadowSettings+'0.0)';}
document.getElementById("ZoomClose").style.visibility="hidden";if(includeCaption&&document.getElementById(zoomCaption).innerHTML!=""){document.getElementById(zoomCaptionDiv).style.visibility="hidden";}
startX=parseInt(zoomdiv.style.left);startY=parseInt(zoomdiv.style.top);startW=zoomimg.width;startH=zoomimg.height;zoomChangeX=zoomOrigX[theID]-startX;zoomChangeY=zoomOrigY[theID]-startY;zoomChangeW=zoomOrigW[theID]-startW;zoomChangeH=zoomOrigH[theID]-startH;zoomCurrent=0;if(includeFade==1){fadeCurrent=0;fadeAmount=(100-0)/tempSteps;}else{fadeAmount=0;}
zoomTimer[theID]=setInterval("zoomElement('"+zoomID+"', '"+theID+"', "+zoomCurrent+", "+startW+", "+zoomChangeW+", "+startH+", "+zoomChangeH+", "+startX+", "+zoomChangeX+", "+startY+", "+zoomChangeY+", "+tempSteps+", "+includeFade+", "+fadeAmount+", 'zoomDone(zoomID, theID)')",zoomTime);zoomActive[theID]=true;}}
function zoomDoneIn(zoomdiv,theID){zoomOpen=true;zoomdiv=document.getElementById(zoomdiv);if(document.getElementById("ShadowBox")){setOpacity(0,"ShadowBox");shadowdiv=document.getElementById("ShadowBox");shadowLeft=parseInt(zoomdiv.style.left)-13;shadowTop=parseInt(zoomdiv.style.top)-8;shadowWidth=zoomdiv.offsetWidth+26;shadowHeight=zoomdiv.offsetHeight+26;shadowdiv.style.width=shadowWidth+'px';shadowdiv.style.height=shadowHeight+'px';shadowdiv.style.left=shadowLeft+'px';shadowdiv.style.top=shadowTop+'px';document.getElementById("ShadowBox").style.visibility="visible";fadeElementSetup("ShadowBox",0,100,5);}else if(!browserIsIE){fadeElementSetup("ZoomImage",0,.8,5,0,"shadow");}
if(includeCaption&&document.getElementById(zoomCaption).innerHTML!=""){zoomcapd=document.getElementById(zoomCaptionDiv);zoomcapd.style.top=parseInt(zoomdiv.style.top)+(zoomdiv.offsetHeight+15)+'px';zoomcapd.style.left=(myWidth/2)-(zoomcapd.offsetWidth/2)+'px';zoomcapd.style.visibility="visible";}
if(!browserIsIE)setOpacity(0,"ZoomClose");document.getElementById("ZoomClose").style.visibility="visible";if(!browserIsIE)fadeElementSetup("ZoomClose",0,100,5);document.onkeypress=getKey;}
function zoomDone(zoomdiv,theID){zoomOpen=false;zoomOrigH[theID]="";zoomOrigW[theID]="";document.getElementById(zoomdiv).style.visibility="hidden";zoomActive[theID]==false;document.onkeypress=null;}
function zoomElement(zoomdiv,theID,zoomCurrent,zoomStartW,zoomChangeW,zoomStartH,zoomChangeH,zoomStartX,zoomChangeX,zoomStartY,zoomChangeY,zoomSteps,includeFade,fadeAmount,execWhenDone){if(zoomCurrent==(zoomSteps+1)){zoomActive[theID]=false;clearInterval(zoomTimer[theID]);if(execWhenDone!=""){eval(execWhenDone);}}else{if(includeFade==1){if(fadeAmount<0){setOpacity(Math.abs(zoomCurrent*fadeAmount),zoomdiv);}else{setOpacity(100-(zoomCurrent*fadeAmount),zoomdiv);}}
moveW=cubicInOut(zoomCurrent,zoomStartW,zoomChangeW,zoomSteps);moveH=cubicInOut(zoomCurrent,zoomStartH,zoomChangeH,zoomSteps);moveX=cubicInOut(zoomCurrent,zoomStartX,zoomChangeX,zoomSteps);moveY=cubicInOut(zoomCurrent,zoomStartY,zoomChangeY,zoomSteps);document.getElementById(zoomdiv).style.left=moveX+'px';document.getElementById(zoomdiv).style.top=moveY+'px';zoomimg.style.width=moveW+'px';zoomimg.style.height=moveH+'px';zoomCurrent++;clearInterval(zoomTimer[theID]);zoomTimer[theID]=setInterval("zoomElement('"+zoomdiv+"', '"+theID+"', "+zoomCurrent+", "+zoomStartW+", "+zoomChangeW+", "+zoomStartH+", "+zoomChangeH+", "+zoomStartX+", "+zoomChangeX+", "+zoomStartY+", "+zoomChangeY+", "+zoomSteps+", "+includeFade+", "+fadeAmount+", '"+execWhenDone+"')",zoomTime);}}
function getKey(evt){if(!evt){theKey=event.keyCode;}else{theKey=evt.keyCode;}
if(theKey==27){zoomOut(this,evt);}}
function fadeOut(elem){if(elem.id){fadeElementSetup(elem.id,100,0,10);}}
function fadeIn(elem){if(elem.id){fadeElementSetup(elem.id,0,100,10);}}
var fadeActive=new Array();var fadeQueue=new Array();var fadeTimer=new Array();var fadeClose=new Array();var fadeMode=new Array();function fadeElementSetup(theID,fdStart,fdEnd,fdSteps,fdClose,fdMode){if(fadeActive[theID]==true){fadeQueue[theID]=new Array(theID,fdStart,fdEnd,fdSteps);}else{fadeSteps=fdSteps;fadeCurrent=0;fadeAmount=(fdStart-fdEnd)/fadeSteps;fadeTimer[theID]=setInterval("fadeElement('"+theID+"', '"+fadeCurrent+"', '"+fadeAmount+"', '"+fadeSteps+"')",15);fadeActive[theID]=true;fadeMode[theID]=fdMode;if(fdClose==1){fadeClose[theID]=true;}else{fadeClose[theID]=false;}}}
function fadeElement(theID,fadeCurrent,fadeAmount,fadeSteps){if(fadeCurrent==fadeSteps){clearInterval(fadeTimer[theID]);fadeActive[theID]=false;fadeTimer[theID]=false;if(fadeClose[theID]==true){document.getElementById(theID).style.visibility="hidden";}
if(fadeQueue[theID]&&fadeQueue[theID]!=false){fadeElementSetup(fadeQueue[theID][0],fadeQueue[theID][1],fadeQueue[theID][2],fadeQueue[theID][3]);fadeQueue[theID]=false;}}else{fadeCurrent++;if(fadeMode[theID]=="shadow"){if(fadeAmount<0){document.getElementById(theID).style.webkitBoxShadow=shadowSettings+(Math.abs(fadeCurrent*fadeAmount))+')';}else{document.getElementById(theID).style.webkitBoxShadow=shadowSettings+(100-(fadeCurrent*fadeAmount))+')';}}else{if(fadeAmount<0){setOpacity(Math.abs(fadeCurrent*fadeAmount),theID);}else{setOpacity(100-(fadeCurrent*fadeAmount),theID);}}
clearInterval(fadeTimer[theID]);fadeTimer[theID]=setInterval("fadeElement('"+theID+"', '"+fadeCurrent+"', '"+fadeAmount+"', '"+fadeSteps+"')",15);}}
function setOpacity(opacity,theID){var object=document.getElementById(theID).style;if(navigator.userAgent.indexOf("Firefox")!=-1){if(opacity==100){opacity=99.9999;}}
object.filter="alpha(opacity="+opacity+")";object.opacity=(opacity/100);}
function linear(t,b,c,d)
{return c*t/d+b;}
function sineInOut(t,b,c,d)
{return-c/2*(Math.cos(Math.PI*t/d)-1)+b;}
function cubicIn(t,b,c,d){return c*(t/=d)*t*t+b;}
function cubicOut(t,b,c,d){return c*((t=t/d-1)*t*t+1)+b;}
function cubicInOut(t,b,c,d)
{if((t/=d/2)<1)return c/2*t*t*t+b;return c/2*((t-=2)*t*t+2)+b;}
function bounceOut(t,b,c,d)
{if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b;}else if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b;}else if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b;}else{return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b;}}
function getSize(){if(self.innerHeight){myWidth=window.innerWidth;myHeight=window.innerHeight;myScroll=window.pageYOffset;}else if(document.documentElement&&document.documentElement.clientHeight){myWidth=document.documentElement.clientWidth;myHeight=document.documentElement.clientHeight;myScroll=document.documentElement.scrollTop;}else if(document.body){myWidth=document.body.clientWidth;myHeight=document.body.clientHeight;myScroll=document.body.scrollTop;}
if(window.innerHeight&&window.scrollMaxY){myScrollWidth=document.body.scrollWidth;myScrollHeight=window.innerHeight+window.scrollMaxY;}else if(document.body.scrollHeight>document.body.offsetHeight){myScrollWidth=document.body.scrollWidth;myScrollHeight=document.body.scrollHeight;}else{myScrollWidth=document.body.offsetWidth;myScrollHeight=document.body.offsetHeight;}}
function getShift(evt){var shift=false;if(!evt&&window.event){shift=window.event.shiftKey;}else if(evt){shift=evt.shiftKey;if(shift)evt.stopPropagation();}
return shift;}
function findElementPos(elemFind)
{var elemX=0;var elemY=0;do{elemX+=elemFind.offsetLeft;elemY+=elemFind.offsetTop;}while(elemFind=elemFind.offsetParent)
return Array(elemX,elemY);}

function insertZoomHTML(){var inBody=document.getElementsByTagName("body").item(0);var inSpinbox=document.createElement("div");inSpinbox.setAttribute('id','ZoomSpin');inSpinbox.style.position='absolute';inSpinbox.style.left='10px';inSpinbox.style.top='10px';inSpinbox.style.visibility='hidden';inSpinbox.style.zIndex='525';inBody.insertBefore(inSpinbox,inBody.firstChild);var inSpinImage=document.createElement("img");inSpinImage.setAttribute('id','SpinImage');inSpinImage.setAttribute('src',zoomImagesURI+'zoom-spin.gif');inSpinbox.appendChild(inSpinImage);var inZoombox=document.createElement("div");inZoombox.setAttribute('id','ZoomBox');inZoombox.style.position='absolute';inZoombox.style.left='10px';inZoombox.style.top='10px';inZoombox.style.visibility='hidden';inZoombox.style.zIndex='499';inBody.insertBefore(inZoombox,inSpinbox.nextSibling);var inImage1=document.createElement("img");inImage1.onclick=function(event){zoomOut(this,event);return false;};inImage1.setAttribute('src',zoomImagesURI+'spacer.gif');inImage1.setAttribute('id','ZoomImage');inImage1.setAttribute('border','0');inImage1.setAttribute('style','-webkit-box-shadow: '+shadowSettings+'0.0)');inImage1.style.display='block';inImage1.style.width='10px';inImage1.style.height='10px';inImage1.style.cursor='pointer';inZoombox.appendChild(inImage1);var inClosebox=document.createElement("div");inClosebox.setAttribute('id','ZoomClose');inClosebox.style.position='absolute';if(browserIsIE){inClosebox.style.left='-1px';inClosebox.style.top='0px';}else{inClosebox.style.left='-15px';inClosebox.style.top='-15px';}
inClosebox.style.visibility='hidden';inZoombox.appendChild(inClosebox);var inImage2=document.createElement("img");inImage2.onclick=function(event){zoomOut(this,event);return false;};inImage2.setAttribute('src',zoomImagesURI+'closebox.png');inImage2.setAttribute('width','30');inImage2.setAttribute('height','30');inImage2.setAttribute('border','0');inImage2.style.cursor='pointer';inClosebox.appendChild(inImage2);if(!document.getElementById('ZoomImage').style.webkitBoxShadow&&!browserIsIE){var inFixedBox=document.createElement("div");inFixedBox.setAttribute('id','ShadowBox');inFixedBox.style.position='absolute';inFixedBox.style.left='50px';inFixedBox.style.top='50px';inFixedBox.style.width='100px';inFixedBox.style.height='100px';inFixedBox.style.visibility='hidden';inFixedBox.style.zIndex='498';inBody.insertBefore(inFixedBox,inZoombox.nextSibling);var inShadowTable=document.createElement("table");inShadowTable.setAttribute('border','0');inShadowTable.setAttribute('width','100%');inShadowTable.setAttribute('height','100%');inShadowTable.setAttribute('cellpadding','0');inShadowTable.setAttribute('cellspacing','0');inFixedBox.appendChild(inShadowTable);var inShadowTbody=document.createElement("tbody");inShadowTable.appendChild(inShadowTbody);var inRow1=document.createElement("tr");inRow1.style.height='25px';inShadowTbody.appendChild(inRow1);var inCol1=document.createElement("td");inCol1.style.width='27px';inCol1.style.background="url('"+zoomImagesURI+"zoom-shadow-corners.png') no-repeat 0px -1px";inRow1.appendChild(inCol1);var inCol2=document.createElement("td");inCol2.style.background="url('"+zoomImagesURI+"zoom-shadow-tb.png') repeat-x 0px 1px";inRow1.appendChild(inCol2);var inCol3=document.createElement("td");inCol3.style.width='27px';inCol3.style.background="url('"+zoomImagesURI+"zoom-shadow-corners.png') no-repeat -27px -1px";inRow1.appendChild(inCol3);inRow2=document.createElement("tr");inShadowTbody.appendChild(inRow2);var inCol4=document.createElement("td");inCol4.style.background="url('"+zoomImagesURI+"zoom-shadow-lr.png') repeat-y";inRow2.appendChild(inCol4);var inCol5=document.createElement("td");inCol5.setAttribute('bgcolor','#ffffff');inRow2.appendChild(inCol5);var inSpacer3=document.createElement("img");inSpacer3.setAttribute('src',zoomImagesURI+'spacer.gif');inSpacer3.setAttribute('height','1');inSpacer3.setAttribute('width','1');inSpacer3.style.display='block';inCol5.appendChild(inSpacer3);var inCol6=document.createElement("td");inCol6.style.background="url('"+zoomImagesURI+"zoom-shadow-lr.png') repeat-y -27px 0px";inRow2.appendChild(inCol6);var inRow3=document.createElement("tr");inRow3.style.height='26px';inShadowTbody.appendChild(inRow3);var inCol7=document.createElement("td");inCol7.style.width='27px';inCol7.style.background="url('"+zoomImagesURI+"zoom-shadow-corners.png') no-repeat 0px -27px";inRow3.appendChild(inCol7);var inCol8=document.createElement("td");inCol8.style.background="url('"+zoomImagesURI+"zoom-shadow-tb.png') repeat-x 0px -25px";inRow3.appendChild(inCol8);var inCol9=document.createElement("td");inCol9.style.width='27px';inCol9.style.background="url('"+zoomImagesURI+"zoom-shadow-corners.png') no-repeat -27px -27px";inRow3.appendChild(inCol9);}
if(includeCaption){var inCapDiv=document.createElement("div");inCapDiv.setAttribute('id','ZoomCapDiv');inCapDiv.style.position='absolute';inCapDiv.style.visibility='hidden';inCapDiv.style.marginLeft='auto';inCapDiv.style.marginRight='auto';inCapDiv.style.zIndex='501';inBody.insertBefore(inCapDiv,inZoombox.nextSibling);var inCapTable=document.createElement("table");inCapTable.setAttribute('border','0');inCapTable.setAttribute('cellPadding','0');inCapTable.setAttribute('cellSpacing','0');inCapDiv.appendChild(inCapTable);var inTbody=document.createElement("tbody");inCapTable.appendChild(inTbody);var inCapRow1=document.createElement("tr");inTbody.appendChild(inCapRow1);var inCapCol1=document.createElement("td");inCapCol1.setAttribute('align','right');inCapCol1.setAttribute('width','13');inCapCol1.setAttribute('height','27');inCapCol1.style.background="url('"+zoomImagesURI+"zoom-caption-lr.png') no-repeat";inCapRow1.appendChild(inCapCol1);var inCapCol2=document.createElement("td");inCapCol2.setAttribute('background',zoomImagesURI+'zoom-caption-fill.png');inCapCol2.setAttribute('id','ZoomCaption');inCapCol2.setAttribute('valign','middle');inCapCol2.style.fontSize='14px';inCapCol2.style.fontFamily='Helvetica';inCapCol2.style.fontWeight='bold';inCapCol2.style.color='#ffffff';inCapCol2.style.textShadow='0px 2px 4px #000000';inCapCol2.style.whiteSpace='nowrap';inCapRow1.appendChild(inCapCol2);var inCapCol3=document.createElement("td");inCapCol3.setAttribute('width','13');inCapCol3.setAttribute('height','27');inCapCol3.style.background="url('"+zoomImagesURI+"zoom-caption-lr.png') no-repeat -13px 0px";inCapRow1.appendChild(inCapCol3);}}

var dp={sh:{Toolbar:{},Utils:{},RegexLib:{},Brushes:{},Strings:{AboutDialog:'<html><head><title>About...</title></head><body class="dp-about"><table cellspacing="0"><tr><td class="copy"><p class="title">dp.SyntaxHighlighter</div><div class="para">Version: {V}</p><p><a href="http://www.dreamprojections.com/syntaxhighlighter/?ref=about" target="_blank">http://www.dreamprojections.com/syntaxhighlighter</a></p>&copy;2004-2007 Alex Gorbatchev.</td></tr><tr><td class="footer"><input type="button" class="close" value="OK" onClick="window.close()"/></td></tr></table></body></html>'},ClipboardSwf:null,Version:'1.5.1'}};dp.SyntaxHighlighter=dp.sh;dp.sh.Toolbar.Commands={ExpandSource:{label:'+ expand source',check:function(highlighter){return highlighter.collapse;},func:function(sender,highlighter)
{sender.parentNode.removeChild(sender);highlighter.div.className=highlighter.div.className.replace('collapsed','');}},ViewSource:{label:'view plain',func:function(sender,highlighter)
{var code=dp.sh.Utils.FixForBlogger(highlighter.originalCode).replace(/</g,'&lt;');var wnd=window.open('','_blank','width=750, height=400, location=0, resizable=1, menubar=0, scrollbars=0');wnd.document.write('<textarea style="width:99%;height:99%">'+code+'</textarea>');wnd.document.close();}},CopyToClipboard:{label:'copy to clipboard',check:function(){return window.clipboardData!=null||dp.sh.ClipboardSwf!=null;},func:function(sender,highlighter)
{var code=dp.sh.Utils.FixForBlogger(highlighter.originalCode).replace(/&lt;/g,'<').replace(/&gt;/g,'>').replace(/&amp;/g,'&');if(window.clipboardData)
{window.clipboardData.setData('text',code);}
else if(dp.sh.ClipboardSwf!=null)
{var flashcopier=highlighter.flashCopier;if(flashcopier==null)
{flashcopier=document.createElement('div');highlighter.flashCopier=flashcopier;highlighter.div.appendChild(flashcopier);}
flashcopier.innerHTML='<embed src="'+dp.sh.ClipboardSwf+'" FlashVars="clipboard='+encodeURIComponent(code)+'" width="0" height="0" type="application/x-shockwave-flash"></embed>';}
alert('The code is in your clipboard now');}},PrintSource:{label:'print',func:function(sender,highlighter)
{var iframe=document.createElement('IFRAME');var doc=null;iframe.style.cssText='position:absolute;width:0px;height:0px;left:-500px;top:-500px;';document.body.appendChild(iframe);doc=iframe.contentWindow.document;dp.sh.Utils.CopyStyles(doc,window.document);doc.write('<div class="'+highlighter.div.className.replace('collapsed','')+' printing">'+highlighter.div.innerHTML+'</div>');doc.close();iframe.contentWindow.focus();iframe.contentWindow.print();alert('Printing...');document.body.removeChild(iframe);}},About:{label:'?',func:function(highlighter)
{var wnd=window.open('','_blank','dialog,width=300,height=150,scrollbars=0');var doc=wnd.document;dp.sh.Utils.CopyStyles(doc,window.document);doc.write(dp.sh.Strings.AboutDialog.replace('{V}',dp.sh.Version));doc.close();wnd.focus();}}};dp.sh.Toolbar.Create=function(highlighter)
{var div=document.createElement('DIV');div.className='tools';for(var name in dp.sh.Toolbar.Commands)
{var cmd=dp.sh.Toolbar.Commands[name];if(cmd.check!=null&&!cmd.check(highlighter))
continue;div.innerHTML+='<a href="#" onclick="dp.sh.Toolbar.Command(\''+name+'\',this);return false;">'+cmd.label+'</a>';}
return div;}
dp.sh.Toolbar.Command=function(name,sender)
{var n=sender;while(n!=null&&n.className.indexOf('dp-highlighter')==-1)
n=n.parentNode;if(n!=null)
dp.sh.Toolbar.Commands[name].func(sender,n.highlighter);}
dp.sh.Utils.CopyStyles=function(destDoc,sourceDoc)
{var links=sourceDoc.getElementsByTagName('link');for(var i=0;i<links.length;i++)
if(links[i].rel.toLowerCase()=='stylesheet')
destDoc.write('<link type="text/css" rel="stylesheet" href="'+links[i].href+'"></link>');}
dp.sh.Utils.FixForBlogger=function(str)
{return(dp.sh.isBloggerMode==true)?str.replace(/<br\s*\/?>|&lt;br\s*\/?&gt;/gi,'\n'):str;}
dp.sh.RegexLib={MultiLineCComments:new RegExp('/\\*[\\s\\S]*?\\*/','gm'),SingleLineCComments:new RegExp('//.*$','gm'),SingleLinePerlComments:new RegExp('#.*$','gm'),DoubleQuotedString:new RegExp('"(?:\\.|(\\\\\\")|[^\\""\\n])*"','g'),SingleQuotedString:new RegExp("'(?:\\.|(\\\\\\')|[^\\''\\n])*'",'g')};dp.sh.Match=function(value,index,css)
{this.value=value;this.index=index;this.length=value.length;this.css=css;}
dp.sh.Highlighter=function()
{this.noGutter=false;this.addControls=true;this.collapse=false;this.tabsToSpaces=true;this.wrapColumn=80;this.showColumns=true;}
dp.sh.Highlighter.SortCallback=function(m1,m2)
{if(m1.index<m2.index)
return-1;else if(m1.index>m2.index)
return 1;else
{if(m1.length<m2.length)
return-1;else if(m1.length>m2.length)
return 1;}
return 0;}
dp.sh.Highlighter.prototype.CreateElement=function(name)
{var result=document.createElement(name);result.highlighter=this;return result;}
dp.sh.Highlighter.prototype.GetMatches=function(regex,css)
{var index=0;var match=null;while((match=regex.exec(this.code))!=null)
this.matches[this.matches.length]=new dp.sh.Match(match[0],match.index,css);}
dp.sh.Highlighter.prototype.AddBit=function(str,css)
{if(str==null||str.length==0)
return;var span=this.CreateElement('SPAN');str=str.replace(/ /g,'&nbsp;');str=str.replace(/</g,'&lt;');str=str.replace(/\n/gm,'&nbsp;<br>');if(css!=null)
{if((/br/gi).test(str))
{var lines=str.split('&nbsp;<br>');for(var i=0;i<lines.length;i++)
{span=this.CreateElement('SPAN');span.className=css;span.innerHTML=lines[i];this.div.appendChild(span);if(i+1<lines.length)
this.div.appendChild(this.CreateElement('BR'));}}
else
{span.className=css;span.innerHTML=str;this.div.appendChild(span);}}
else
{span.innerHTML=str;this.div.appendChild(span);}}
dp.sh.Highlighter.prototype.IsInside=function(match)
{if(match==null||match.length==0)
return false;for(var i=0;i<this.matches.length;i++)
{var c=this.matches[i];if(c==null)
continue;if((match.index>c.index)&&(match.index<c.index+c.length))
return true;}
return false;}
dp.sh.Highlighter.prototype.ProcessRegexList=function()
{for(var i=0;i<this.regexList.length;i++)
this.GetMatches(this.regexList[i].regex,this.regexList[i].css);}
dp.sh.Highlighter.prototype.ProcessSmartTabs=function(code)
{var lines=code.split('\n');var result='';var tabSize=4;var tab='\t';function InsertSpaces(line,pos,count)
{var left=line.substr(0,pos);var right=line.substr(pos+1,line.length);var spaces='';for(var i=0;i<count;i++)
spaces+=' ';return left+spaces+right;}
function ProcessLine(line,tabSize)
{if(line.indexOf(tab)==-1)
return line;var pos=0;while((pos=line.indexOf(tab))!=-1)
{var spaces=tabSize-pos%tabSize;line=InsertSpaces(line,pos,spaces);}
return line;}
for(var i=0;i<lines.length;i++)
result+=ProcessLine(lines[i],tabSize)+'\n';return result;}
dp.sh.Highlighter.prototype.SwitchToList=function()
{var html=this.div.innerHTML.replace(/<(br)\/?>/gi,'\n');var lines=html.split('\n');if(this.addControls==true)
this.bar.appendChild(dp.sh.Toolbar.Create(this));if(this.showColumns)
{var div=this.CreateElement('div');var columns=this.CreateElement('div');var showEvery=10;var i=1;while(i<=150)
{if(i%showEvery==0)
{div.innerHTML+=i;i+=(i+'').length;}
else
{div.innerHTML+='&middot;';i++;}}
columns.className='columns';columns.appendChild(div);this.bar.appendChild(columns);}
for(var i=0,lineIndex=this.firstLine;i<lines.length-1;i++,lineIndex++)
{var li=this.CreateElement('LI');var span=this.CreateElement('SPAN');li.className=(i%2==0)?'alt':'';span.innerHTML=lines[i]+'&nbsp;';li.appendChild(span);this.ol.appendChild(li);}
this.div.innerHTML='';}
dp.sh.Highlighter.prototype.Highlight=function(code)
{function Trim(str)
{return str.replace(/^\s*(.*?)[\s\n]*$/g,'$1');}
function Chop(str)
{return str.replace(/\n*$/,'').replace(/^\n*/,'');}
function Unindent(str)
{var lines=dp.sh.Utils.FixForBlogger(str).split('\n');var indents=new Array();var regex=new RegExp('^\\s*','g');var min=1000;for(var i=0;i<lines.length&&min>0;i++)
{if(Trim(lines[i]).length==0)
continue;var matches=regex.exec(lines[i]);if(matches!=null&&matches.length>0)
min=Math.min(matches[0].length,min);}
if(min>0)
for(var i=0;i<lines.length;i++)
lines[i]=lines[i].substr(min);return lines.join('\n');}
function Copy(string,pos1,pos2)
{return string.substr(pos1,pos2-pos1);}
var pos=0;if(code==null)
code='';this.originalCode=code;this.code=Chop(Unindent(code));this.div=this.CreateElement('DIV');this.bar=this.CreateElement('DIV');this.ol=this.CreateElement('OL');this.matches=new Array();this.div.className='dp-highlighter';this.div.highlighter=this;this.bar.className='bar';this.ol.start=this.firstLine;if(this.CssClass!=null)
this.ol.className=this.CssClass;if(this.collapse)
this.div.className+=' collapsed';if(this.noGutter)
this.div.className+=' nogutter';if(this.tabsToSpaces==true)
this.code=this.ProcessSmartTabs(this.code);this.ProcessRegexList();if(this.matches.length==0)
{this.AddBit(this.code,null);this.SwitchToList();this.div.appendChild(this.bar);this.div.appendChild(this.ol);return;}
this.matches=this.matches.sort(dp.sh.Highlighter.SortCallback);for(var i=0;i<this.matches.length;i++)
if(this.IsInside(this.matches[i]))
this.matches[i]=null;for(var i=0;i<this.matches.length;i++)
{var match=this.matches[i];if(match==null||match.length==0)
continue;this.AddBit(Copy(this.code,pos,match.index),null);this.AddBit(match.value,match.css);pos=match.index+match.length;}
this.AddBit(this.code.substr(pos),null);this.SwitchToList();this.div.appendChild(this.bar);this.div.appendChild(this.ol);}
dp.sh.Highlighter.prototype.GetKeywords=function(str)
{return'\\b'+str.replace(/ /g,'\\b|\\b')+'\\b';}
dp.sh.BloggerMode=function()
{dp.sh.isBloggerMode=true;}
dp.sh.HighlightAll=function(name,showGutter,showControls,collapseAll,firstLine,showColumns)
{function FindValue()
{var a=arguments;for(var i=0;i<a.length;i++)
{if(a[i]==null)
continue;if(typeof(a[i])=='string'&&a[i]!='')
return a[i]+'';if(typeof(a[i])=='object'&&a[i].value!='')
return a[i].value+'';}
return null;}
function IsOptionSet(value,list)
{for(var i=0;i<list.length;i++)
if(list[i]==value)
return true;return false;}
function GetOptionValue(name,list,defaultValue)
{var regex=new RegExp('^'+name+'\\[(\\w+)\\]$','gi');var matches=null;for(var i=0;i<list.length;i++)
if((matches=regex.exec(list[i]))!=null)
return matches[1];return defaultValue;}
function FindTagsByName(list,name,tagName)
{var tags=document.getElementsByTagName(tagName);for(var i=0;i<tags.length;i++)
if(tags[i].getAttribute('name')==name)
list.push(tags[i]);}
var elements=[];var highlighter=null;var registered={};var propertyName='innerHTML';FindTagsByName(elements,name,'pre');FindTagsByName(elements,name,'textarea');if(elements.length==0)
return;for(var brush in dp.sh.Brushes)
{var aliases=dp.sh.Brushes[brush].Aliases;if(aliases==null)
continue;for(var i=0;i<aliases.length;i++)
registered[aliases[i]]=brush;}
for(var i=0;i<elements.length;i++)
{var element=elements[i];var options=FindValue(element.attributes['class'],element.className,element.attributes['language'],element.language);var language='';if(options==null)
continue;options=options.split(':');language=options[0].toLowerCase();if(registered[language]==null)
continue;highlighter=new dp.sh.Brushes[registered[language]]();element.style.display='none';highlighter.noGutter=(showGutter==null)?IsOptionSet('nogutter',options):!showGutter;highlighter.addControls=(showControls==null)?!IsOptionSet('nocontrols',options):showControls;highlighter.collapse=(collapseAll==null)?IsOptionSet('collapse',options):collapseAll;highlighter.showColumns=(showColumns==null)?IsOptionSet('showcolumns',options):showColumns;var headNode=document.getElementsByTagName('head')[0];if(highlighter.Style&&headNode)
{var styleNode=document.createElement('style');styleNode.setAttribute('type','text/css');if(styleNode.styleSheet)
{styleNode.styleSheet.cssText=highlighter.Style;}
else
{var textNode=document.createTextNode(highlighter.Style);styleNode.appendChild(textNode);}
headNode.appendChild(styleNode);}
highlighter.firstLine=(firstLine==null)?parseInt(GetOptionValue('firstline',options,1)):firstLine;highlighter.Highlight(element[propertyName]);highlighter.source=element;element.parentNode.insertBefore(highlighter.div,element);}}

dp.sh.Brushes.CSS=function()
{var keywords='ascent azimuth background-attachment background-color background-image background-position '+'background-repeat background baseline bbox border-collapse border-color border-spacing border-style border-top '+'border-right border-bottom border-left border-top-color border-right-color border-bottom-color border-left-color '+'border-top-style border-right-style border-bottom-style border-left-style border-top-width border-right-width '+'border-bottom-width border-left-width border-width border cap-height caption-side centerline clear clip color '+'content counter-increment counter-reset cue-after cue-before cue cursor definition-src descent direction display '+'elevation empty-cells float font-size-adjust font-family font-size font-stretch font-style font-variant font-weight font '+'height letter-spacing line-height list-style-image list-style-position list-style-type list-style margin-top '+'margin-right margin-bottom margin-left margin marker-offset marks mathline max-height max-width min-height min-width orphans '+'outline-color outline-style outline-width outline overflow padding-top padding-right padding-bottom padding-left padding page '+'page-break-after page-break-before page-break-inside pause pause-after pause-before pitch pitch-range play-during position '+'quotes richness size slope src speak-header speak-numeral speak-punctuation speak speech-rate stemh stemv stress '+'table-layout text-align text-decoration text-indent text-shadow text-transform unicode-bidi unicode-range units-per-em '+'vertical-align visibility voice-family volume white-space widows width widths word-spacing x-height z-index';var values='above absolute all always aqua armenian attr aural auto avoid baseline behind below bidi-override black blink block blue bold bolder '+'both bottom braille capitalize caption center center-left center-right circle close-quote code collapse compact condensed '+'continuous counter counters crop cross crosshair cursive dashed decimal decimal-leading-zero default digits disc dotted double '+'embed embossed e-resize expanded extra-condensed extra-expanded fantasy far-left far-right fast faster fixed format fuchsia '+'gray green groove handheld hebrew help hidden hide high higher icon inline-table inline inset inside invert italic '+'justify landscape large larger left-side left leftwards level lighter lime line-through list-item local loud lower-alpha '+'lowercase lower-greek lower-latin lower-roman lower low ltr marker maroon medium message-box middle mix move narrower '+'navy ne-resize no-close-quote none no-open-quote no-repeat normal nowrap n-resize nw-resize oblique olive once open-quote outset '+'outside overline pointer portrait pre print projection purple red relative repeat repeat-x repeat-y rgb ridge right right-side '+'rightwards rtl run-in screen scroll semi-condensed semi-expanded separate se-resize show silent silver slower slow '+'small small-caps small-caption smaller soft solid speech spell-out square s-resize static status-bar sub super sw-resize '+'table-caption table-cell table-column table-column-group table-footer-group table-header-group table-row table-row-group teal '+'text-bottom text-top thick thin top transparent tty tv ultra-condensed ultra-expanded underline upper-alpha uppercase upper-latin '+'upper-roman url visible wait white wider w-resize x-fast x-high x-large x-loud x-low x-slow x-small x-soft xx-large xx-small yellow';var fonts='[mM]onospace [tT]ahoma [vV]erdana [aA]rial [hH]elvetica [sS]ans-serif [sS]erif';this.regexList=[{regex:dp.sh.RegexLib.MultiLineCComments,css:'comment'},{regex:dp.sh.RegexLib.DoubleQuotedString,css:'string'},{regex:dp.sh.RegexLib.SingleQuotedString,css:'string'},{regex:new RegExp('\\#[a-zA-Z0-9]{3,6}','g'),css:'value'},{regex:new RegExp('(-?\\d+)(\.\\d+)?(px|em|pt|\:|\%|)','g'),css:'value'},{regex:new RegExp('!important','g'),css:'important'},{regex:new RegExp(this.GetKeywordsCSS(keywords),'gm'),css:'keyword'},{regex:new RegExp(this.GetValuesCSS(values),'g'),css:'value'},{regex:new RegExp(this.GetValuesCSS(fonts),'g'),css:'value'}];this.CssClass='dp-css';this.Style='.dp-css .value { color: black; }'+'.dp-css .important { color: red; }';}
dp.sh.Highlighter.prototype.GetKeywordsCSS=function(str)
{return'\\b([a-z_]|)'+str.replace(/ /g,'(?=:)\\b|\\b([a-z_\\*]|\\*|)')+'(?=:)\\b';}
dp.sh.Highlighter.prototype.GetValuesCSS=function(str)
{return'\\b'+str.replace(/ /g,'(?!-)(?!:)\\b|\\b()')+'\:\\b';}
dp.sh.Brushes.CSS.prototype=new dp.sh.Highlighter();dp.sh.Brushes.CSS.Aliases=['css'];

dp.sh.Brushes.JScript=function()
{var keywords='abstract boolean break byte case catch char class const continue debugger '+'default delete do double else enum export extends false final finally float '+'for function goto if implements import in instanceof int interface long native '+'new null package private protected public return short static super switch '+'synchronized this throw throws transient true try typeof var void volatile while with';this.regexList=[{regex:dp.sh.RegexLib.SingleLineCComments,css:'comment'},{regex:dp.sh.RegexLib.MultiLineCComments,css:'comment'},{regex:dp.sh.RegexLib.DoubleQuotedString,css:'string'},{regex:dp.sh.RegexLib.SingleQuotedString,css:'string'},{regex:new RegExp('^\\s*#.*','gm'),css:'preprocessor'},{regex:new RegExp(this.GetKeywords(keywords),'gm'),css:'keyword'}];this.CssClass='dp-c';}
dp.sh.Brushes.JScript.prototype=new dp.sh.Highlighter();dp.sh.Brushes.JScript.Aliases=['js','jscript','javascript'];

dp.sh.Brushes.Php=function()
{var funcs='abs acos acosh addcslashes addslashes '+'array_change_key_case array_chunk array_combine array_count_values array_diff '+'array_diff_assoc array_diff_key array_diff_uassoc array_diff_ukey array_fill '+'array_filter array_flip array_intersect array_intersect_assoc array_intersect_key '+'array_intersect_uassoc array_intersect_ukey array_key_exists array_keys array_map '+'array_merge array_merge_recursive array_multisort array_pad array_pop array_product '+'array_push array_rand array_reduce array_reverse array_search array_shift '+'array_slice array_splice array_sum array_udiff array_udiff_assoc '+'array_udiff_uassoc array_uintersect array_uintersect_assoc '+'array_uintersect_uassoc array_unique array_unshift array_values array_walk '+'array_walk_recursive atan atan2 atanh base64_decode base64_encode base_convert '+'basename bcadd bccomp bcdiv bcmod bcmul bindec bindtextdomain bzclose bzcompress '+'bzdecompress bzerrno bzerror bzerrstr bzflush bzopen bzread bzwrite ceil chdir '+'checkdate checkdnsrr chgrp chmod chop chown chr chroot chunk_split class_exists '+'closedir closelog copy cos cosh count count_chars date decbin dechex decoct '+'deg2rad delete ebcdic2ascii echo empty end ereg ereg_replace eregi eregi_replace error_log '+'error_reporting escapeshellarg escapeshellcmd eval exec exit exp explode extension_loaded '+'feof fflush fgetc fgetcsv fgets fgetss file_exists file_get_contents file_put_contents '+'fileatime filectime filegroup fileinode filemtime fileowner fileperms filesize filetype '+'floatval flock floor flush fmod fnmatch fopen fpassthru fprintf fputcsv fputs fread fscanf '+'fseek fsockopen fstat ftell ftok getallheaders getcwd getdate getenv gethostbyaddr gethostbyname '+'gethostbynamel getimagesize getlastmod getmxrr getmygid getmyinode getmypid getmyuid getopt '+'getprotobyname getprotobynumber getrandmax getrusage getservbyname getservbyport gettext '+'gettimeofday gettype glob gmdate gmmktime ini_alter ini_get ini_get_all ini_restore ini_set '+'interface_exists intval ip2long is_a is_array is_bool is_callable is_dir is_double '+'is_executable is_file is_finite is_float is_infinite is_int is_integer is_link is_long '+'is_nan is_null is_numeric is_object is_readable is_real is_resource is_scalar is_soap_fault '+'is_string is_subclass_of is_uploaded_file is_writable is_writeable mkdir mktime nl2br '+'parse_ini_file parse_str parse_url passthru pathinfo readlink realpath rewind rewinddir rmdir '+'round str_ireplace str_pad str_repeat str_replace str_rot13 str_shuffle str_split '+'str_word_count strcasecmp strchr strcmp strcoll strcspn strftime strip_tags stripcslashes '+'stripos stripslashes stristr strlen strnatcasecmp strnatcmp strncasecmp strncmp strpbrk '+'strpos strptime strrchr strrev strripos strrpos strspn strstr strtok strtolower strtotime '+'strtoupper strtr strval substr substr_compare';var keywords='and or xor __FILE__ __LINE__ array as break case '+'cfunction class const continue declare default die do else '+'elseif empty enddeclare endfor endforeach endif endswitch endwhile '+'extends for foreach function include include_once global if '+'new old_function return static switch use require require_once '+'var while __FUNCTION__ __CLASS__ '+'__METHOD__ abstract interface public implements extends private protected throw';this.regexList=[{regex:dp.sh.RegexLib.SingleLineCComments,css:'comment'},{regex:dp.sh.RegexLib.MultiLineCComments,css:'comment'},{regex:dp.sh.RegexLib.DoubleQuotedString,css:'string'},{regex:dp.sh.RegexLib.SingleQuotedString,css:'string'},{regex:new RegExp('\\$\\w+','g'),css:'vars'},{regex:new RegExp(this.GetKeywords(funcs),'gmi'),css:'func'},{regex:new RegExp(this.GetKeywords(keywords),'gm'),css:'keyword'}];this.CssClass='dp-c';}
dp.sh.Brushes.Php.prototype=new dp.sh.Highlighter();dp.sh.Brushes.Php.Aliases=['php'];
