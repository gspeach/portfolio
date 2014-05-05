//collects nodelist of all links on page
var nodelistLinks = document.getElementsByTagName("a");
	for (var i = 0; i < nodelistLinks.length; i++)
	{
		nodelistLinks[i].addEventListener( "click",function (event) { //when link is clicked this function starts
		event.preventDefault();
		myFunction(this);
        }, false );
}

//converts the nodelist to an array
var linkArray = [];
for (var i = 0; i < nodelistLinks.length; i++) {
    var self = nodelistLinks[i];
    linkArray.push(self);
}

function myFunction(link)
{
	//finds location of link within nodelist
	var linkLoc = 0;
	for (var i = 0; nodelistLinks.item(i) != link; i++) {
		linkLoc ++;
	}

	var link = linkArray.slice(linkLoc, linkLoc+1);//splices out link from array
	var clickedurl = link.toString();//converts new array to string
	
	txt = "The following URL " + clickedurl + " was copied into Javascript.";
	document.getElementById('url').innerHTML=txt;

	var xmlhttp;
	if (window.XMLHttpRequest) xmlhttp = new XMLHttpRequest(); // all browsers 
	else xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");     // for IE
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			//pulls all of the info from the xml file
			var xmldata = xmlhttp.responseXML;
			//this pulls the root or beginning parent element
			root = xmldata.documentElement;
			//variables used for searching and pulling xml data
			address = root.getElementsByTagName("address");
			admvalue = root.getElementsByTagName("admvalue");
			gsvalue = root.getElementsByTagName("gsvalue");
			
			var nodes = "";
			for(var i=0;i<address.length;i++)
			{
				nodes += address.item(i).firstChild.data + "<" + admvalue.item(i).firstChild.data + "<" + gsvalue.item(i).firstChild.data + ">";
			}
			
			//this if else statement searches the array address2 for variable link.
			//If it finds the url within the xml file then the code will pull necessary values
			if(nodes.indexOf(clickedurl) != -1)
			{
				var index1 = nodes.indexOf(clickedurl);
				var clickedurllength = clickedurl.length;
				var index2 = index1 + clickedurllength + 1;				
				var admvalue2 = "";
				
				while (nodes.charAt(index2) != "<")
				{
					admvalue2 += nodes.charAt(index2);
					index2 ++;
				}
				
				var admvalue2length = admvalue2.length;
				var index3 = nodes.indexOf(admvalue2);
				var index4 = index3 + admvalue2length + 1;
				var gsvalue2 = "";
				
				while (nodes.charAt(index4) != ">")
				{
					gsvalue2 += nodes.charAt(index4);
					index4 ++;
				}
				
				txt2 = "The urls.xml document was successfully searched and was found to contain " + clickedurl + ".";
				txt3 = "The AdmantX value is " + admvalue2 + ". The Grapeshot value is " + gsvalue2 + ".";
				document.getElementById('ajax').innerHTML=txt2;
				document.getElementById('button').innerHTML=txt3;
			}
			//this is for when the url is not found within the xml file. 
			//admantx will be called and php will write to xml
			else
			{
				txt2 = "The url was not found in urls.xml so admantx and gs were called and the returned values were sent to phpwrite.php.";
				document.getElementById('ajax').innerHTML=txt2;
				//vales to be sent to phpwrite.php
				var add = clickedurl; 
				var val1 = "some returned value";     
				var val2 = "some returned value";  
          
				var xmlhttp2;
				if (window.XMLHttpRequest) xmlhttp2 = new XMLHttpRequest(); // all browsers 
				else xmlhttp2 = new ActiveXObject("Microsoft.XMLHTTP");     // for IE
	 
				//this is where the values are added to the url so phpwrite.php can read them
				var url = 'phpwrite.php?add=' + add + '&val1=' + val1 + '&val2=' + val2;
				xmlhttp2.open('GET', url, false);
				xmlhttp2.onreadystatechange = function () 
				{
					if (xmlhttp2.readyState===4 && xmlhttp2.status===200) 
					{
					}
				}
				xmlhttp2.send();
				return false;
			}
		}
	}
	xmlhttp.open("GET","urls.xml",true);
	xmlhttp.send();

}