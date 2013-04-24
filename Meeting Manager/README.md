<h1>Salesforce Mobile Meeting Manager</h1>
This is simple Meeting Manager Application that allows users to enter details about a Meeting / Event.

<h2>Deploying to your Salesforce Developer Org</h2>
* git clone git@github.com:logontokartik/MeetingViewer.git
* Navigate to the Meeting Manager Folder and zip all the folders (excluding README.md)
* Open Workbench (workbench.developerforce.com) and click on migration --> deploy. Choose the zipped file, select single package and ignore warning and click next and click deploy.

<h2>Configurartion</h2>
* By Default the visibility of the App is turned off in Salesforce. To view the app Navigate to Setup --> Administration --> Profile, choose the profile you are working on click on edit and make the App "Meeting Manager" Visible. Also make the tabs
Mobile Meetings and Meetings Visible.
* Add the Remote Site "PusherAPI - https://api.pusherapp.com"
<h2>Sample Data</h2>

Execute the below code in the Developer Console to insert the sample data into meetings object.

<pre>
List<\Meeting__c\> meetings = new List<\Meeting__c\>();

meetings.add(new Meeting__c(Name='Salesforce Demo Meetup Boston',Location__c='Boston',Meeting_Start_Date__c='04/25/2013',Meeting_End_Date__c='04/26/2013',Channel__c='sf_meetup1',Attendees__c=40));
meetings.add(new Meeting__c(Name='Salesforce Demo Meetup Chicago',Location__c='Chicago',Meeting_Start_Date__c='04/26/2013',Meeting_End_Date__c='04/27/2013',Channel__c='sf_meetup2',Attendees__c=30));
             
insert meetings;
</pre>

<h2> Limitations </h2>

Currently the channels that are used for the meetings are handling sending the updates to the subscribed users on Heroku via Pusher. So only sf_meetup1, sf_meetup2, sf_meetup3 are configured. If other channels are used, the broadcast will not work.
