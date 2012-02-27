var home='home.php';
var subs='subs.php';
var sugg='suggest.php';
var sear='search.php';

function loadAJAX(elem,file)
{
  var xmlhttp;
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
    xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
  }
  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById(elem).innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open('GET',file,true);
  xmlhttp.send();
}
function qFocus()
{
  if (document.getElementById('q').value=='Find...')
    document.getElementById('q').value='';
  else suggest();
}
function qBlur()
{
  if (document.getElementById('q').value=='')
    document.getElementById('q').value='Find...';
  document.getElementById('suggestTab').style.display='none';
}
function suggest()
{
  document.getElementById('suggestTab').style.display='block';
  str=document.getElementById('q').value;
  loadAJAX('suggestTab',sugg);
}
function search(str)
{
  if (str=='Find...') str='<p>everything</p>';
  else str='<p>searching '+str+':</p>';

  var xmlhttp;
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
    xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
  }
  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById('content').innerHTML=str + xmlhttp.responseText;
    }
  }
  xmlhttp.open('GET',sear,true);
  xmlhttp.send();

}