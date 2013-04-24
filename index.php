<!DOCTYPE html>
<html>
<head>
<title>Meeting Viewer</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!--
    For development, you may want to load jQuery/jQuery Mobile from their CDN. 
-->
<link rel="stylesheet" href="jquery.mobile-1.3.0.min.css" />

<script src="https://d3dy5gmtp8yhk7.cloudfront.net/2.0/pusher.min.js" type="text/javascript"></script>
<script type="text/javascript" src="jquery.min.js"></script>
<!--
From jQuery-swip - http://code.google.com/p/jquery-swip/source/browse/trunk/jquery.popupWindow.js 
-->
<script type="text/javascript" src="jquerymobile.js"></script>

<script type="text/javascript">
    
	// Using $j 
	if (window.$j === undefined) {
	    $j = $;
	}
	
	var channel;
	var subChannel;
	var meetingName;


	// Enable pusher logging 
    Pusher.log = function(message) {
      if (window.console && window.console.log) window.console.log(message);
    };

    // Flash fallback logging. 
    WEB_SOCKET_DEBUG = true;

    var pusher = new Pusher('<?=$_ENV['app_key']?>'); // Make sure that the ENV Variable is added to heroku and you include the app_key from your pusher account
    
    $j(document).ready(function() {
           regBtnClickHandlers();
    });
    

	
	
    function regBtnClickHandlers() {

       /* Subscribe to the Channel when the Meeting is clicked. The channel names are binded to the id's of the meetings for now. TO DO : Need to determine a better way of getting all the channel Id and Meetings 1st time without authentication */	

		$j(".mpusher").click(function(e){
		
			e.preventDefault();
		
			subChannel  = this.id;
			meetingName = $j('#'+this.id).children().text();
			channel     = pusher.subscribe(subChannel);
			
			channel.bind('pusher:subscription_succeeded', function() {
				$j('#msub').html('Subscribed to ' + meetingName + '. Updates to this meeting are displayed below');
			});
			
			bindChannel(channel);
			
			$j.mobile.changePage('#detailpage', {changeHash: true});
			
		});
		
		/* UNSUBSCRIBE To the Meeting as soon as back button is clicked.*/
		
		$j("#back").click(function(e){
			e.preventDefault();
		
			channel.unbind(subChannel+'_event', function(){
				console.log('Unbinded');
			});
			pusher.unsubscribe(subChannel);
		
			$j('#mdetails').html('');
			
			$j.mobile.changePage('#mainpage', {changeHash: true});
			
		});
		
		/* Bind Event for the channel and show the updates.*/
		function bindChannel(channel){
		
			console.log('channel binded');
			
			channel.bind(subChannel+'_event',function(data){
				console.log('channel binded again');
				var mtext;
				for(var key in data){
					mtext = data[key];
					console.log('Text ' + mtext);
				}
				$j('#mdetails').html(mtext);
			});
			
		
		}
	
	}

</script>

<!-- Simple HTML Markup to display the updates.-->

</head>
<body>
	<div data-role="page" data-theme="b" id="mainpage">
	    <div data-role="header">
		    <h1>Meetings</h1>
	    </div>
	    <div data-role="content">
	        <ul id="list" data-inset="true" data-role="listview" 
			  data-theme="c" data-dividertheme="b">
			<li><a id="sf_meetup1" class="mpusher"><h2>Salesforce Demo Meetup Boston</h2></a></li>
			<li><a id="sf_meetup2" class="mpusher"><h2>Salesforce Demo Meetup Chicago</h2></a></li>
			<li><a id="sf_meetup3" class="mpusher"><h2>Salesforce Demo Meetup SFO</h2></a></li>
	        </ul>
	    </div>
		
	    <div data-role="footer">
	        <h4>Force.com</h4>
	    </div>
	</div>
	<div data-role="page" data-theme="b" id="detailpage">
	    <div data-role="header">
	    <a href='#mainpage' id="back" class='ui-btn-left' data-icon='arrow-l' data-direction="reverse">Back</a>
		   <h1>Meeting Details</h1>
		   <h2 id="msub"></h2>
	    </div>
	    <div data-role="content">
	       <h3 id="mdetails"></h3>
	    </div>
	    <div data-role="footer">
	        <h4>Force.com</h4>
	    </div>
	</div>
	
</body>
</html>