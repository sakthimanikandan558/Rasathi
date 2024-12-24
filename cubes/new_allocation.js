cube(`new_allocation`, {
  sql: `select apa.adm_users_id,apa.mat_profile_id,apa.entry_dttm
  from agent_profile_allocation apa
  join adm_users admu
  on apa.adm_users_id=admu.adm_users_id
  where not exists (
      select 'x' from mat_profile_talktime where mat_profile_talktime.mat_profile_id = apa.mat_profile_id
  ) `,
  
  data_source: `default`,
  
  joins: {
  
      
  
     
  },
  
  dimensions: {
    
    adm_users_id: {
      sql: `adm_users_id`,
      type: `number`
    },
    
    mat_profile_id: {
      sql: `mat_profile_id`,
      type: `number`
    },
    
    entry_dttm: {
      sql: `entry_dttm::date`,
      type: `time`
    }
  },
  
  measures: {
  
  count: {
    sql: `${mat_profile_id}`,
    type: `count`,
    title: `New Allocation`
  
  }
    
  },
  
  pre_aggregations: {
    // Pre-aggregation definitions go here.
    // Learn more in the documentation: https://cube.dev/docs/caching/pre-aggregations/getting-started
  }
});
