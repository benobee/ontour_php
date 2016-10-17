<?php

class Show{
	public $id, $show_date, $venue_city, $venue_state, $show_type, $show_details, $session_username, $venue_country, $member_going;
}

class Event{
	public $id, $event_time, $event_type, $event_details, $event_date, $event_status, $event_address, $event_file, $session_username;
}

class Band{
	public $id, $band_id, $artist_name, $member, $admin, $role, $parent, $name, $phone, $crew;
	
			public function __construct()
			{			
				$this->crew = "going";
			}
}
class Schedule{
	public $id, $title, $member, $type, $description, $parent;	
}

class Schedule_times{
	public $id, $date, $time, $parent, $member, $comment, $session_username;	
}

class Show_config{
	public $id, $parent, $member, $show_date, $phone, $email, $role;		
}

class Daycrew 
	{
            // Creating some properties (variables tied to an object)
			
			public $artist;
            public $name;
            public $role;
            public $email;
			public $phone;
			public $day;
			public $going;
            
            // Assigning the values
			
        public function __construct($artist, $name, $role, $email, $phone, $day, $going) 
			{
				$this->artist = $artist;
				$this->name = $name;
				$this->role = $role;
				$this->email = $email;
				$this->phone = $phone;
				$this->day = $day;
				$this->going = $going;

            }			
    }
	

?>

