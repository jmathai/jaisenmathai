var offset = 0;
var limit  = 5;
var tags   = '';
var tagsArray  = [];

function sideBar()
{
  $('custom-sidebar').innerHTML = ''
                                + ' <h2 class="module-header">Photos</h2>'
                                + ' <div class="module-content">'
                                + '   <div>'
                                + '     <form style="display:inline;" onsubmit="searchImages(); return false;">'
                                + '       <input type="text" id="ptgSearchField" class="formfield" />&nbsp;<input type="image" src="/images/search_16x16.png" class="png" width="16" height="16" border="0" align="absmiddle" onclick="searchImages(); return false;" /></a>'
                                + '     </form>'
                                + '   </div>'
                                + '   <div id="photoDiv" class="sidebar-photos"></div>'
                                + '</div>';
}

function searchImages()
{
  tags = document.getElementById('ptgSearchField').value;
  offset = arguments.length == 0 ? 0 : arguments[0];
  setTimeout('ptg.image.search({"privacy":"1","tags":tags,"limit":limit,"offset":offset,"order":"dateTaken"}, "searchImagesRsp")', 100);
}

function searchImagesRsp(data)
{
  var html = '';
  $("photoDiv").innerHTML = '';
  while(image = ptg.result.next(data))
  {
    if(image.name == null){ image.name = 'This photo has no title.'; }
    html += '<div><a href="'+ptg.html.customImageLockSrc(image.thumbnailPath, image.key, image.width, image.height, 640, 480)+'" title="'+image.name+' - &lt;a href=&quot;http://www.photagious.com/handler/photo/'+image.key+'/&quot; target=&quot;_blank&quot;&gt;View On Photagious&lt;/a&gt;">' + ptg.html.customImageTag(image.thumbnailPath, image.key, 115, 50, {"width":"115","height":"50","hspace":"1","vspace":"3","border":"0","style":"border:solid 1px #404040;"}) + '</a></div>';
  }
  
  html += '<div style="width:115px; margin-left:2px;">';
  // previous
  if(offset > 0)
  {
    html += '<a href="javascript:void(0);" onclick="searchImages(offset - limit);"><img src="/images/previous_16x16.png" width="16" height="16" border="0" align="left" /></a>';
  }
  
  // next
  if((offset+limit) <= ptg.result.totalRows(data))
  {
    html += '<a href="javascript:void(0);" onclick="searchImages(offset + limit);"><img src="/images/next_16x16.png" width="16" height="16" border="0" align="right" /></a>';
  }
  
  html += '<br/></div>';
  
  $("photoDiv").innerHTML = html;
  setupZoom();
  
  return false;
}

var ptg = new PTG("656ff15dffa1a18c53c94b242da917f9");
sideBar();
searchImages();
ptg.user.getTags({'limit':'20','order':'random'}, 'makeCloud');
