cube(`mat_profile_movement`, {
  sql: `select mpm.mat_profile_id mat_profile_id,
	      mpm.tobucket tobucket,mpt.current_bucket current_bucket,
	      mpm.talk_time talk_time,mpt.total_talktime total_talktime,
          mpm.adm_users_id adm_users_id,mpt.last_adm_usersid last_adm_usersid,
	      mpm.moved_datetime moved_datetime,mpt.last_call_time last_call_time,
	      apa.entry_dttm entry_dttm 
	from
	 agent_profile_allocation apa
	join mat_profile_talktime mpt
	on apa.mat_profile_id=mpt.mat_profile_id
	and apa.adm_users_id=mpt.last_adm_usersid
	join mat_profile_movement mpm
	on mpt.mat_profile_id=mpm.mat_profile_id`,
  data_source: `default`,
  
  joins: {
  
     agent_profile_allocation:
         {
            relationship: `hasMany`,
            sql: `${mat_profile_movement.mat_profile_id}=${agent_profile_allocation.mat_profile_id}
            
        
                 `
         
         },
         
         
    
  },
  
  dimensions: {
    mat_profile_id: {
      sql: `mat_profile_id`,
      type: `number`,
      primary_key: true,
    },
    
    
    adm_users_id: {
      sql: `adm_users_id`,
      type: `number`
    },
    
    
    tobucket: {
      sql: `tobucket`,
      type: `number`
    },
    
    current_bucket: {
      sql: `current_bucket`,
      type: `number`
    },
    
    total_talktime: {
      sql: `total_talktime`,
      type: `number`
    },
    
    
    last_call_time: {
      sql: `moved_datetime::date`,
      type: `time`
    },
    
    
    
    moved_datetime: {
      sql: `last_call_time::date `,
      type: `time`
    },
    
    entry_dttm: {
      sql: `entry_dttm::date `,
      type: `time`
    }
    
    
    
  },
  
  measures: {
    

    
    
    bucket_one: {
      sql: ` case when ${current_bucket}=${tobucket} and ${last_call_time}<> ${entry_dttm}
      
                      then 0 else
                     case when ${total_talktime}>0 and ${total_talktime}<=15 then  1 else 0 end end`,
      type: `sum`,
      title: `0 - 15 Min`
    },
    
    bucket_two: {
      sql: `case when ${current_bucket}=${tobucket} and ${last_call_time}<> ${entry_dttm}
                        then 0 else
                      case when ${total_talktime}>15 and ${total_talktime}<=25 then  1 else 0 end end`,
      type: `sum`,
      title: `15 - 25 Min`
    },
    
    bucket_three: {
      sql: `case when ${current_bucket}=${tobucket} and ${last_call_time}<> ${entry_dttm} then 0 else
                      case when ${total_talktime} >25 and ${total_talktime}<=45 then  1 else 0 end end`,
      type: `sum`,
      title: `25 - 45 Min`
    },
    
    bucket_four: {
      sql: `case when ${current_bucket}=${tobucket} and ${last_call_time}<> ${entry_dttm}
             and ${total_talktime} > 45 then 0 else
              case when ${total_talktime} > 45 then  1 else 0 end end`,
      type: `sum`,
      title: `Above 45 Min`
    },
  },
  segments: {
  
     
     },
  
  pre_aggregations: {
    // Pre-aggregation definitions go here.
    // Learn more in the documentation: https://cube.dev/docs/caching/pre-aggregations/getting-started
  }
});
