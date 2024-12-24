cube(`adm_agenttalktime_details_per_day`, {
  sql_table: `public.adm_agenttalktime_details_per_day`,
  
  data_source: `default`,
  
  joins: {
    
  },
  
  dimensions: {
    id: {
      sql: `id`,
      type: `number`,
      primary_key: true
    },
    
    total_talktime: {
      sql: `total_talktime`,
      type: `number`
    },
    
    
    connected_call_count: {
      sql: `connected_call_count`,
      type: `number`
    },
    
    total_count: {
      sql: `total_count`,
      type: `number`
    },
    
    agent_email: {
      sql: `agent_email`,
      type: `string`
    },
     
    
    calldate: {
      sql: `calldate::date`,
      type: `string`
    }
  },
  
  measures: {
    count: {
      type: `count`
    },
    
    
  },
  
  pre_aggregations: {
    // Pre-aggregation definitions go here.
    // Learn more in the documentation: https://cube.dev/docs/caching/pre-aggregations/getting-started
  }
});
