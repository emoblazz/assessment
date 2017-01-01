<?php
if (($ext=="jpg") or ($ext=="jpeg") or ($ext=="png") or ($ext=="gif") or ($ext=="ico")  or ($ext=="JPG"))	
  {		
	$display=$row1['file'];
  }	
elseif (($ext=="ppt") or ($ext=="pptx"))		
  {			
	$display="ico/ppt.png";
  }
elseif (($ext=="doc") or ($ext=="docx"))		
  {		
	$display="ico/word.png";
  }
elseif (($ext=="xls") or ($ext=="xlsx"))		
  {		
	$display="ico/excel.png";
  }  
elseif ($ext=="pdf")		
  {		
	$display="ico/pdf.jpeg";
  }
elseif ($ext=="sql")		
  {		
	$display="ico/sql.png";
  }
elseif ($ext=="psd")		
  {		
	$display="ico/psd.jpg";
  }
elseif ($ext=="zip")		
  {		
	$display="ico/zip.png";
  }
elseif (($ext=="mp3") or ($ext=="wav"))	
  {		
	$display="ico/sound.png";
  }
elseif (($ext=="mp4") or ($ext=="mpeg") or ($ext=="flv") or ($ext=="3gp"))	
  {		
	$display="ico/video.png";
  }
else
  {		
	$display="unknown.jpg";
  }
?>  