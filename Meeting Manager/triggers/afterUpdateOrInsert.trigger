trigger afterUpdateOrInsert on Meeting__c (after update) {

    Map<String,String> meetingNameDetails = new Map<String,String>();
    String channelName;
        
    for(Meeting__c m : trigger.new){
    	meetingNameDetails.put(m.Name,m.Highlights__c);
    	channelName = m.Channel__c; // Assuming only one meeting is updated.
    }
    
    String jsonString = JSON.serialize(meetingNameDetails);
    
    Pusher.push(System.Label.PusherAppId,System.Label.PusherAuthKey,System.Label.PusherAuthSecret, channelName, channelName + '_event',jsonString); 
    
}