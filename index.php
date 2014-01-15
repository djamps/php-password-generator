<?php
ini_set('session.gc_maxlifetime', 2592000);
ini_set('session.cache_expire', 2592000);
ini_set('session.cache_limiter', 'none');
ini_set('session.cookie_lifetime', 2592000); 
session_start(); 
?><html>
<head>
<title>Ajax Password generator</title>
<script type="text/javascript">
function generate(lengthn,strengthn) {
var xmlhttp;
document.myForm.btn.disabled=true;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("pass").value=xmlhttp.responseText;
    document.myForm.btn.disabled=false;
    SelectAll('pass');
    }
  }
xmlhttp.open("GET","server.php?l="+lengthn+'&s='+strengthn,true);
xmlhttp.send();
}
function SelectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}


</script>
</head>

<body>
<form name="myForm" onsubmit="return false">

  <select name="s">
    <?   echo "<option ".(0==$_SESSION['passwordphp_strength']?"selected=\"selected\"":"")." value=\"0\">Normal</option>";
         echo "<option ".(1==$_SESSION['passwordphp_strength']?"selected=\"selected\"":"")." value=\"1\">Medium</option>";
         echo "<option ".(2==$_SESSION['passwordphp_strength']?"selected=\"selected\"":"")." value=\"2\">Strong</option>";
    ?>
  </select>
  <select name="l">
    <? if (!$_SESSION['passwordphp_length']) { $_SESSION['passwordphp_length'] = 8;} for ($i=5; $i<=50; $i++) {
         echo "<option ".($i==$_SESSION['passwordphp_length']?"selected=\"selected\"":"")." value=".$i.">".$i." Chars</option>";
       }
    ?>
  </select>
  <input id="pass" type="text" name="pass" value="" onClick="SelectAll(this.id);" readonly>
  <input type="button" name="btn" value="Generate" onclick="generate(form.l.value,form.s.value); ">

  <!--<input type="button" name="cpy" value="Copy to Clipboard" onclick="copy('pass');">-->
</form>

</body>
</html>
