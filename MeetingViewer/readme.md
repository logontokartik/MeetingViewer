<h1>Meeting Viewer App</h1>
This simple PHP + JQuery app uses the Pusher Client Libraries to get the real-time updates on a Meeting/Event.

<h2>Deploying to Heroku</h2>
* git clone git@github.com:logontokartik/MeetingViewer.git
* Navigate to the MeetingViewer folder within MeetingViewer and enter below commands
* git init
* git add .
* git commit -m "initial commit"
* heroku create
* git remote -v
* heroku git remote -a "heroku app thats created"
* git push heroku master

Note: Make sure that configuration is done before opening the app on Heroku.

<h2>Configurartion</h2>
Make sure you add the Application Key from Pusher to connect to your account
* heroku config:add app_key="YOUR PUSHER APP KEY" 

<TODO>
For now this application is using the Channel Names, and Event Names hardcoded in the List ID's and is limited only to 3 meetings that are pre-defined. 
Need to figure out a way to make the process automated where the Meetings are pulled from Salesforce dynamically. making them publicly available.	
