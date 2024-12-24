cube(`mat_profile_talktime`, {
  sql: `select distinct apa.mat_profile_id mat_profile_id,mpt.current_bucket current_bucket,
mpt.total_talktime total_talktime,apa.adm_users_id adm_users_id,
mpt.last_call_time::date last_call_time
from agent_profile_allocation apa
join mat_profile_talktime mpt
on apa.mat_profile_id=mpt.mat_profile_id`,
  data_source: `default`,
  
  joins: {
  
     agent_profile_allocation:
         {
            relationship: `hasMany`,
            sql: `${mat_profile_talktime.mat_profile_id}=${agent_profile_allocation.mat_profile_id}
            
        
                 `
         
         },
         
         
    
  },
  
  dimensions: {
    mat_profile_id: {
      sql: `mat_profile_id`,
      type: `number`,
      primary_key: true,
    },
    
    current_bucket: {
      sql: `current_bucket`,
      type: `string`
    },
    
    total_talktime: {
      sql: `total_talktime`,
      type: `number`
    },
    
    last_adm_usersid: {
      sql: `adm_users_id`,
      type: `number`
    },
    
    last_call_time: {
      sql: `last_call_time`,
      type: `time`
    },
    
  },
  
  measures: {
    newallocationcount: {
      sql: ` case when ${mat_profile_id} is null then 1 else ${mat_profile_id} end`,
      type: `sum`,
      title: `New_Allocation`
    },
    
    count: {
      type: `count`,
    
    },

    
    
    bucket_one: {
      sql: `case when ${current_bucket}='0 - 15' then  1 else 0 end`,
      type: `sum`,
      title: `0 - 15 Min`
    },
    
    bucket_two: {
      sql: `case when ${current_bucket}='15 - 25' then  1 else 0 end`,
      type: `sum`,
      title: `15 - 25 Min`
    },
    
    bucket_three: {
      sql: `case when ${current_bucket}='25 - 45' then  1 else 0 end`,
      type: `sum`,
      title: `25 - 45 Min`
    },
    
    bucket_four: {
      sql: `case when ${current_bucket}='> 45' then  1 else 0 end`,
      type: `sum`,
      title: `Above 45 Min`
    },
  },
  segments: {
  
     new_allocation: {
       sql: `${mat_profile_id} is null`
     
     }
     },
  
  pre_aggregations: {
    // Pre-aggregation definitions go here.
    // Learn more in the documentation: https://cube.dev/docs/caching/pre-aggregations/getting-started
  }
});
