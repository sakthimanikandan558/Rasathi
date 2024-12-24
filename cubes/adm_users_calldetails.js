cube(`adm_users_calldetails`, {
  sql_table: `public.adm_users_calldetails`,
  
  data_source: `default`,
  
  joins: {
  
     
         
      
    
  },
  
  dimensions: {
    adm_users_id: {
      sql: `adm_users_id`,
      type: `number`,
      primary_key: true,
    },
    
    agent_email: {
      sql: `agent_email`,
      type: `string`
    },
    
    profile_spoken: {
      sql: `profile_spoken`,
      type: `number`
    },
    
    connected_calls: {
      sql: `connected_calls`,
      type: `number`
    },
    
    total_talktime: {
      sql: `total_talktime`,
      type: `number`
    },
    
    target_per_daysale: {
      sql: `case when target_per_daysale is null then 0 else target_per_daysale end`,
      type: `number`
    },
    
    target_per_monthsale: {
      sql: `case when target_per_monthsale is null then 0 else target_per_monthsale end `,
      type: `number`
    },
    
    calldate: {
      sql: `calldate::date`,
      type: `time`
    }
    
    
  },
  
  measures: {
    count: {
      type: `count`
    }
  },
  
  pre_aggregations: {
    // Pre-aggregation definitions go here.
    // Learn more in the documentation: https://cube.dev/docs/caching/pre-aggregations/getting-started
  }
});
