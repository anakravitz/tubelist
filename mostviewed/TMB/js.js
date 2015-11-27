// adapted from Mr. Hrishabh Sharma's work at TechnologyMantraBlog.com

var playListArray;

$(document).ready(function(){
   playListArray = new Array();
 });

function playInPlayList(index)
{
	player.playVideoAt(index);
}

function playThis(videoID)
{
	 player.loadVideoById(videoID);
	
}

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
	
	playListArray.push(data);
	player.cuePlaylist(playListArray);
	
	var vidIndex = playListArray.length - 1;
	document.getElementById(data).setAttribute('onClick', 'playInPlayList('+vidIndex+')');
}


function getParams(){
	var urlParams = {};
	var match,
		pl     = /\+/g,  // Regex for replacing addition symbol with a space
		search = /([^&=]+)=?([^&]*)/g,
		decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
		query  = window.location.search.substring(1);

	/*urlParams = {};*/
	while (match = search.exec(query)){
		urlParams[decode(match[1])] = decode(match[2]);
	}

	return urlParams;

}

function getVideoList(keyword) {
	document.getElementById("videoList").innerHTML="YouTube video list is loading. Please wait...";
	$.get('TMB/f.php', getParams(), function(data){
		$("#videoList")[0].innerHTML = data;
	});
	 
	}


function getVideoText2(keyword) {
	document.getElementById("videoText").innerHTML="YouTube video list is loading. Please wait...";
	$.get('TMB/l.php', getParams(), function(data){
		$("#videoText")[0].innerHTML = data;
	});
}


function nextPage(keyword,token) {
	document.getElementById("videoList").innerHTML="YouTube video list is loading. Please wait...";
	var params = getParams();
	params['keyword'] = keyword;
	params['nextPage'] = token;
	$.get('TMB/f.php', params, function(data){
		$("#videoList")[0].innerHTML = data;
	});
	  
	}
	

function nextPageText(keyword,token) {
	document.getElementById("videoText").innerHTML="YouTube video list is loading. Please wait...";
	  var params = getParams();
	params['keyword'] = keyword;
	params['nextPage'] = token;
	$.get('TMB/l.php', params, function(data){
		$("#videoText")[0].innerHTML = data;
	});
}

var liCountResult = liCount();
function liCount(){ 
		var myList = document.getElementById("myO2");
		var i = 2, itemCount = 0;
		while (myList.getElementsByTagName("li")[i++]) itemCount++;
		return itemCount;
}



//update the <ol> list start value every time you click Next Page
function add2() {
		if(document.getElementById("myO2").start !== 451) 	{
		document.getElementById("myO2").start = document.getElementById("myO2").start+50;
		} else {
	    document.getElementById("myO2").start = 1;
		}

}



//date picker
$(document).ready(function(){
    $("#category").val($("#category").data('selected'));

    $("#txtFromDate").datepicker({
        numberOfMonths: 2,
        dateFormat: "yy-mm-dd",
        minDate: new Date(2005, 4 - 1, 23),
        maxDate: "today",
        changeMonth: true,
        changeYear: true,
        onSelect: function(selected) {
          $("#txtToDate").datepicker("option","minDate", selected)
        }
    });
    $("#txtToDate").datepicker({ 
        numberOfMonths: 2,
        dateFormat: "yy-mm-dd",
        minDate: new Date(2005, 4 - 1, 24),
        maxDate: "+1",
        changeMonth: true,
        changeYear: true,
        onSelect: function(selected) {
           $("#txtFromDate").datepicker("option","maxDate", selected)
        }
    });  
});

