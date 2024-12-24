create table mat_profile_calldetails(id serial not null primary key,
									 mat_id integer,
									total_calls integer,
									connected_calls integer,
									not_connected_calls integer,
									Total_talktime_till_now numeric,
									Talktime_today numeric,
									Total_Talktime_till_yesterday numeric,
									Talktime_yesterday numeric,
									Talktime_in_last_7_days_yesterday numeric,
									Last_connected_call_date timestamp without time zone,
									 Last_call_made_Dialout_date timestamp without time zone,
									 No_of_calls_in_the_last_21_days integer,
									 No_of_connected_calls_in_the_last_21_days integer,
									 Total_talktime_in_the_last_21_days numeric,
									 Last_called_telecaller numeric,
									 Currently_loaded_to_which_caller numeric,
									 Profile_Status varchar(100),
									 Count_of_login numeric,
									 Last_login_date_of_the_customer timestamp without time zone,
									 UTM_source_Medium_campaign varchar(1000),
									 Last_Payment_page_Visited_date timestamp without time zone,
									 Paid_or_Free varchar(50),
									 Link_to_download_log varchar(200),
									 Last_Lead_exit_date_due_to_Pester_or_Ignore_from_a_caller timestamp without time zone,
									 Current_status_of_lead varchar(100),
									 Reason_for_call_status varchar(500),
									 Hold_date_or_Supress_date timestamp without time zone,
									 Expected_release_date_or_Released_date timestamp without time zone
									 
									);
									
									
									
									

with mp as
  (select mat_profile_id from mat_profile),
  ttc as
  (select mat_profile_id,count(mat_profile_id) total_calls
  from adm_crm_call_log_upload
  where (call_connect='connected') or (call_connect='not connected')
  group by mat_profile_id ),
  cc as
  (select mat_profile_id,count(mat_profile_id) connected_calls
  from adm_crm_call_log_upload
  where call_connect='connected'
  group by mat_profile_id),
  nc as
  (select mat_profile_id,count(mat_profile_id) not_connected_calls
  from adm_crm_call_log_upload
  where call_connect='not connected'
  group by mat_profile_id),
   tttn as 
  (select mat_profile_id,sum(call_duration) total_talktime_till_now
  from adm_crm_call_log_upload
   where call_connect='connected'
  group by mat_profile_id),
  ttt as
  (select mat_profile_id,sum(call_duration) Talktime_today
  from adm_crm_call_log_upload
   where call_connect='connected'
   and calldate::date=current_date
  group by mat_profile_id),
  ttty as
  (select mat_profile_id,sum(call_duration) Total_Talktime_till_yesterday
  from adm_crm_call_log_upload
   where call_connect='connected'
   and calldate::date=current_date
  group by mat_profile_id),
  tty as
  (select mat_profile_id,sum(call_duration) Talktime_yesterday
  from adm_crm_call_log_upload
   where call_connect='connected'
   and calldate::date=current_date-1
  group by mat_profile_id),
  ttly as
  (select mat_profile_id,sum(call_duration) Talktime_in_last_7_days_yesterday
  from adm_crm_call_log_upload
   where call_connect='connected'
   and calldate::date >= current_date-8 and calldate::date <= current_date-1
  group by mat_profile_id),
  lcd as
  (select mat_profile_id,max(calldate) Last_connected_calldate
  from adm_crm_call_log_upload
  where call_connect='connected'
  group by mat_profile_id),
  lcm as
  (select mat_profile_id,max(calldate) Last_call_made_Dialout_date
  from adm_crm_call_log_upload
  where (call_connect='connected') or (call_connect='not connected') 
  group by mat_profile_id),
  nocl as
  (select mat_profile_id,count(mat_profile_id) No_of_calls_in_the_last_21_days
  from adm_crm_call_log_upload
  where (call_connect='connected') or (call_connect='not connected') 
   and calldate::date>= current_date-21 and calldate::date<=current_date
  group by mat_profile_id),
  noccl as
  (select mat_profile_id,count(mat_profile_id) No_of_connected_calls_in_the_last_21_days
  from adm_crm_call_log_upload
  where (call_connect='connected') 
   and calldate::date>= current_date-21 and calldate::date<=current_date
  group by mat_profile_id)
  
select ttc.mat_profile_id,
       case when ttc.total_calls is null then 0 else ttc.total_calls end total_calls,
       case when cc.connected_calls  is null then 0 else cc.connected_calls end connected_calls,
	   case when nc.not_connected_calls is null then 0 else nc.not_connected_calls end not_connected_calls,
	   case when tttn.total_talktime_till_now is null then 0 else tttn.total_talktime_till_now end total_talktime_till_now,
	   case when ttt.Talktime_today is null then 0 else ttt.Talktime_today end Talktime_today,
	   case when ttty.Total_Talktime_till_yesterday is null then 0 else ttty.Total_Talktime_till_yesterday end Total_Talktime_till_yesterday,
	   case when tty.Talktime_yesterday is null then 0 else tty.Talktime_yesterday end Talktime_yesterday,
	   case when ttly.Talktime_in_last_7_days_yesterday is null then 0 else ttly.Talktime_in_last_7_days_yesterday end Talktime_in_last_7_days_yesterday,
	   lcd.Last_connected_calldate ,
	   lcm.Last_call_made_Dialout_date ,
	   case when nocl.No_of_calls_in_the_last_21_days is null then 0 else nocl.No_of_calls_in_the_last_21_days end No_of_calls_in_the_last_21_days,
	   case when noccl.No_of_connected_calls_in_the_last_21_days is null then 0 else noccl.No_of_connected_calls_in_the_last_21_days end No_of_connected_calls_in_the_last_21_days
	   from mp
	   left join ttc
	   on mp.mat_profile_id=ttc.mat_profile_id
	   left join cc
	   on mp.mat_profile_id=cc.mat_profile_id
	   left join nc
	   on mp.mat_profile_id=nc.mat_profile_id
	   left join tttn
	   on mp.mat_profile_id=tttn.mat_profile_id
	   left join ttt
	   on mp.mat_profile_id=ttt.mat_profile_id
	   left join ttty
	   on ttty.mat_profile_id=mp.mat_profile_id
	   left join tty
	   on mp.mat_profile_id=tty.mat_profile_id
	   left join ttly
	   on mp.mat_profile_id=ttly.mat_profile_id
	   left join lcd
	   on mp.mat_profile_id=lcd.mat_profile_id
	   left join lcm
	   on mp.mat_profile_id=lcm.mat_profile_id
	   left join nocl
	   on mp.mat_profile_id=nocl.mat_profile_id
	   left join noccl
	   on mp.mat_profile_id=noccl.mat_profile_id
	   limit 100
	   
	   
	   
       
  
	   
       
  
  
									
