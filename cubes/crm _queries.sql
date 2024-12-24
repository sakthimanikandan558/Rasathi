-- Docs: https://docs.mage.ai/guides/sql-blocks
insert into adm_agentcount_of_talktime(agent_email,calldate,talktime_lessthan_15min,
                                   talktime_15min_to_25min,talktime_above_25min)  

select agent_email,calldate,
sum(case when call_duration < 15 then 1 else 0 end) talktime_lessthan_15min ,
sum(case when call_duration >= 15 and call_duration <= 25 then 1 else 0 end) talktime_15min_to_25min,
sum(case when call_duration > 25 then 1 else 0 end) talktime_above_25min
from public.adm_crm_call_log_upload
where call_connect='connected' 
and calldate=current_date
group by agent_email,calldate order by 2 ;

 
 insert into adm_profile_total_talktime(mat_profile_id,sum_of_talktime)
select ccl.mat_profile_id,ccl.sum_of_talktime 
from (select mat_profile_id,round(sum(call_duration),2) sum_of_talktime
from public.adm_crm_call_log_upload
where call_connect='connected' 
group by mat_profile_id order by 1 ) as ccl
where ccl.mat_profile_id not in(select mat_profile_id from adm_profile_total_talktime);

update 	adm_profile_total_talktime as mtt 
set mat_profile_id=ccl.mat_profile_id	,
    sum_of_talktime=ccl.sum_of_talktime
    from (select mat_profile_id,round(sum(call_duration),2) sum_of_talktime
from public.adm_crm_call_log_upload
where call_connect='connected' 
group by mat_profile_id order by 1) as 
	            ccl where
			    mtt.mat_profile_id=ccl.mat_profile_id
 ;

insert into adm_agenttalktime_details_per_day(agent_email,calldate,connected_call_count,
                                          total_talktime)
select agent_email,calldate,count(call_connect) connected_call_count,
sum(call_duration) total_talktime
from public.adm_crm_call_log_upload
where call_connect='connected' 
and calldate = current_date
group by agent_email,calldate order by 2 ;

insert into adm_agent_avg_talktime_last30days(agent_email,avg_talktime)
select ccl.agent_email,ccl.avg_talktime from
(select agent_email,round(avg(call_duration),2) avg_talktime
from public.adm_crm_call_log_upload
where call_connect='connected' 
and calldate > current_date - interval '30' day
group by agent_email) as ccl 
where ccl.agent_email not in (select agent_email from adm_agent_avg_talktime_last30days);

update adm_agent_avg_talktime_last30days as aat 
set agent_email=ccl.agent_email,
    avg_talktime=ccl.avg_talktime
	from (select agent_email,round(avg(call_duration),2) avg_talktime
from public.adm_crm_call_log_upload
where call_connect='connected' 
and calldate > current_date - interval '30' day
group by agent_email ) as ccl
where aat.agent_email=ccl.agent_email;



insert into adm_agentmonthly_connected_callcount(agent_email,month,call_count_per_month)
select ccl.agent_email,ccl.month,ccl.call_count_per_month 
from(select agent_email,to_char(calldate,'yyyy-Mon') as month,
count(call_connect) call_count_per_month 
from public.adm_crm_call_log_upload
where call_connect='connected' 
group by agent_email,to_char(calldate,'yyyy-Mon') order by 3) as ccl 
where ccl.agent_email not in(select agent_email from adm_agentmonthly_connected_callcount );

update adm_agentmonthly_connected_callcount as acc
set agent_email=ccl.agent_email,
    month=ccl.month,
	call_count_per_month=ccl.call_count_per_month
	from (select agent_email,to_char(calldate,'yyyy-Mon') as month,
count(call_connect) call_count_per_month 
from public.adm_crm_call_log_upload
where call_connect='connected' 
group by agent_email,to_char(calldate,'yyyy-Mon') order by 3) as ccl
where acc.agent_email=ccl.agent_email;

insert into adm_agent_talktime(agent_email,call_count,sum_of_talktime,avg_of_talktime)						   
select ccl.agent_email,ccl.call_count,ccl.sum_of_talktime,ccl.avg_of_talktime 
from 
(select agent_email,count(call_duration) call_count,
        round(sum(call_duration),2) sum_of_talktime,round(avg(call_duration),2) avg_of_talktime
from public.adm_crm_call_log_upload
where call_connect='connected'
group by agent_email order by 1) as ccl
where ccl.agent_email not in(select agent_email from adm_agent_talktime );

update adm_agent_talktime as att
set agent_email = ccl.agent_email,
    call_count = ccl.call_count,
	sum_of_talktime = ccl.sum_of_talktime,
	avg_of_talktime = ccl.avg_of_talktime
	from (select agent_email,count(call_duration) call_count,round(sum(call_duration),2) sum_of_talktime,round(avg(call_duration),2) avg_of_talktime
from public.adm_crm_call_log_upload
where call_connect='connected'
group by agent_email order by 1) as ccl
where att.agent_email=ccl.agent_email;

insert into mat_profile_talktime(mat_profile_id,current_bucket,total_talktime,
									 last_adm_usersid,last_call_time) 
select mp.mat_profile_id,mp.current_bucket,
	mp.total_talktime,mp.last_adm_usersid,mp.last_call_time
	from(with mptt2 as(
with mptt as(select admcc.mat_profile_id,
case 
      when admcc.call_duration > 0 and admcc.call_duration <= 15 then '0 - 15' else     
     (case when admcc.call_duration > 15 and admcc.call_duration <= 25 then '15 - 25' else 
	   (case when admcc.call_duration > 25 and admcc.call_duration <= 45 then '25 - 45' else
	     (case when admcc.call_duration > 45 then '> 45' 
		  end)
		end) 
	  end)
end current_bucket  ,
case when admcc.call_duration > 0 and admcc.call_duration <= 15 then admcc.call_duration
	else 
	(case when admcc.call_duration > 15 and admcc.call_duration <= 25 then admcc.call_duration else
	  (case when admcc.call_duration > 25 and admcc.call_duration <= 45 then admcc.call_duration else
		(case when admcc.call_duration > 45  then admcc.call_duration 
		 end)
	   end)
	 end) 
end total_talktime,
admcc.calldate last_call_time
from (select mat_profile_id,sum(call_duration) call_duration,max(calldate) calldate from
	  public.adm_crm_call_log_upload
	 where call_connect='connected' 
     and call_duration <> 0 	
     and mat_profile_id <>0
     group by mat_profile_id) admcc )
	 
	 select distinct  mptt.mat_profile_id,mptt.current_bucket,mptt.total_talktime,admcc2.agent_email,
	 mptt.last_call_time from mptt
	 join adm_crm_call_log_upload admcc2
	 on admcc2.mat_profile_id=mptt.mat_profile_id
	 and admcc2.calldate=mptt.last_call_time
	 )
	
	select distinct mptt2.mat_profile_id,
	mptt2.current_bucket,mptt2.total_talktime,
	admu.adm_users_id last_adm_usersid,
	 mptt2.last_call_time from mptt2
	 join adm_users admu
	 on mptt2.agent_email=admu.name) mp
	 where mp.mat_profile_id not in(select mat_profile_id from mat_profile_talktime);

     with mptt2 as(
with mptt as(select admcc.mat_profile_id,
case 
      when admcc.call_duration > 0 and admcc.call_duration <= 15 then '0 - 15' else     
     (case when admcc.call_duration > 15 and admcc.call_duration <= 25 then '15 - 25' else 
	   (case when admcc.call_duration > 25 and admcc.call_duration <= 45 then '25 - 45' else
	     (case when admcc.call_duration > 45 then '> 45' 
		  end)
		end) 
	  end)
end current_bucket  ,
case when admcc.call_duration > 0 and admcc.call_duration <= 15 then admcc.call_duration
	else 
	(case when admcc.call_duration > 15 and admcc.call_duration <= 25 then admcc.call_duration else
	  (case when admcc.call_duration > 25 and admcc.call_duration <= 45 then admcc.call_duration else
		(case when admcc.call_duration > 45  then admcc.call_duration 
		 end)
	   end)
	 end) 
end total_talktime,
admcc.calldate last_call_time
from (select mat_profile_id,sum(call_duration) call_duration,max(calldate) calldate from
	  public.adm_crm_call_log_upload
	 where call_connect='connected' 
     and call_duration <> 0 	
     and mat_profile_id <>0
     group by mat_profile_id) admcc )
	 
	 select distinct  mptt.mat_profile_id,mptt.current_bucket,mptt.total_talktime,admcc2.agent_email,
	 mptt.last_call_time from mptt
	 join adm_crm_call_log_upload admcc2
	 on admcc2.mat_profile_id=mptt.mat_profile_id
	 and admcc2.calldate=mptt.last_call_time
	 )
	update mat_profile_talktime as mpt set current_bucket=mp.current_bucket,
	                                 total_talktime=mp.total_talktime,
									 last_adm_usersid=mp.last_adm_usersid,
									 last_call_time=mp.last_call_time
									 from
	(select distinct mptt2.mat_profile_id,
	mptt2.current_bucket,mptt2.total_talktime,
	admu.adm_users_id last_adm_usersid,
	 mptt2.last_call_time from mptt2
	 join adm_users admu
	 on mptt2.agent_email=admu.name 
	 ) as mp where mpt.mat_profile_id=mp.mat_profile_id;

insert into adm_users_calldetails(adm_users_id,agent_email,profile_spoken,connected_calls,total_talktime,
			  target_per_daysale,target_per_monthsale,calldate)
 select accl.adm_users_id,accl.agent_email,accl.profile_spoken,accl.connected_calls,accl.total_talktime,
        accl.target_per_daysale,accl.target_per_monthsale,accl.calldate
		from
 ( select admu.adm_users_id,accl.agent_email,
						   count(distinct accl.mat_profile_id) profile_spoken,
  count(distinct accl.mat_profile_id) connected_calls,
  sum(accl.call_duration) total_talktime,admu.target_per_daysale,admu.target_per_monthsale,
  accl.calldate
  from adm_crm_call_log_upload accl
  join adm_users admu
  on accl.agent_email=admu.name
  where  accl.call_connect='connected'
  group by admu.adm_users_id,accl.agent_email,admu.target_per_daysale,admu.target_per_monthsale,accl.calldate
  ) accl
  where accl.agent_email not in(select agent_email from adm_crm_call_log_upload );

update adm_users_calldetails as aduc set 
	adm_users_id=accl.adm_users_id,
	agent_email=accl.agentemail,
	profile_spoken=accl.profile_spoken,
	connected_calls=accl.connected_calls,
	total_talktime=accl.total_talktime,
	target_per_daysale=accl.target_per_daysale,
	target_per_monthsale=accl.target_per_monthsale,
	calldate=accl.call_date
	  from
	(select admu.adm_users_id,accl.agent_email agentemail,
						   count(distinct accl.mat_profile_id) profile_spoken,
  count(distinct accl.mat_profile_id) connected_calls,
  sum(accl.call_duration) total_talktime,admu.target_per_daysale,admu.target_per_monthsale,
  accl.calldate call_date
  from adm_crm_call_log_upload accl
  join adm_users admu
  on accl.agent_email=admu.name
  where  accl.call_connect='connected'
  group by admu.adm_users_id,accl.agent_email,admu.target_per_daysale,admu.target_per_monthsale,accl.calldate
	 ) as accl
	 where agent_email=accl.agentemail
	 and calldate::date=accl.call_date::date;

insert into mat_profile_movement(mat_profile_id,adm_users_id,frombucket,tobucket,
		moved_datetime)
  select acc.mat_profile_id,acc.adm_users_id,acc.frombucket,acc.tobucket,acc.moved_datetime from
  (select accl.mat_profile_id,
         admu.adm_users_id,
         min(accl.call_duration) frombucket,
         max(accl.call_duration) tobucket,
		 accl.calldate moved_datetime
  from adm_crm_call_log_upload accl
  join adm_users admu
  on accl.agent_email=admu.name
  where accl.mat_profile_id<>0
  group by accl.mat_profile_id,admu.adm_users_id,accl.calldate) acc
  where acc.mat_profile_id not in(select mat_profile_id from adm_crm_call_log_upload);


update 	mat_profile_movement as mpm 
	set mat_profile_id=acc.mat_profileid,
        adm_users_id=acc.adm_usersid,
		frombucket=acc.frombucket,
		tobucket=acc.tobucket,
		moved_datetime=acc.moveddatetime from 
  (select accl.mat_profile_id mat_profileid,
         admu.adm_users_id adm_usersid,
         min(accl.call_duration) frombucket,
         max(accl.call_duration) tobucket,
		 accl.calldate moveddatetime
  from adm_crm_call_log_upload accl
  join adm_users admu
  on accl.agent_email=admu.name
  where accl.mat_profile_id<>0
  group by accl.mat_profile_id,admu.adm_users_id,accl.calldate) acc
  where mat_profile_id=acc.mat_profileid
  and adm_users_id=acc.adm_usersid
  and moved_datetime=acc.moveddatetime;

insert into new_allocation_count(adm_users_id,agent_email,allocated_profiles_count,calldate)
 select nac.adm_users_id,nac.agent_email,nac.allocated_profiles_count,nac.calldate
 from
 (
 select apa.adm_users_id,acc.agent_email,count(apa.mat_profile_id) allocated_profiles_count,
  acc.calldate from agent_profile_allocation apa
  join adm_users admu
  on apa.adm_users_id=admu.adm_users_id
  left join adm_crm_call_log_upload acc
  on apa.mat_profile_id=acc.mat_profile_id
  and admu.name=acc.agent_email
  where acc.call_connect='not connected'
  and acc.call_duration=0
  group by apa.adm_users_id,acc.calldate,acc.agent_email
	 ) nac
  where nac.adm_users_id not in(select adm_users_id from agent_profile_allocation);

  update new_allocation_count as nal
  set adm_users_id=nac.adm_users_id,
      agent_email=nac.agent_email,
	  allocated_profiles_count=nac.allocated_profiles_count,
	  calldate=nac.calldate
  from
 (
 select apa.adm_users_id,acc.agent_email,count(apa.mat_profile_id) allocated_profiles_count,
  acc.calldate from agent_profile_allocation apa
  join adm_users admu
  on apa.adm_users_id=admu.adm_users_id
  left join adm_crm_call_log_upload acc
  on apa.mat_profile_id=acc.mat_profile_id
  and admu.name=acc.agent_email
  where acc.call_connect='not connected'
  and acc.call_duration=0
  group by apa.adm_users_id,acc.calldate,acc.agent_email
	 ) nac
  where nal.adm_users_id=nac.adm_users_id ;

