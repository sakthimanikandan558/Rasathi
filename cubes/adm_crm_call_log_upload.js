cube(`adm_crm_call_log_upload`, {
  sql_table: `public.adm_crm_call_log_upload`,
  
  data_source: `default`,
  
  joins: {
  
     
  },
  
  dimensions: {
    id: {
      sql: `id`,
      type: `number`,
      primary_key: true
    },
    
    agent_email: {
      sql: `agent_email`,
      type: `string`
    },
    
    mat_profile_id: {
      sql: `mat_profile_id`,
      type: `number`
    },
    
    phone_number: {
      sql: `phone_number`,
      type: `string`
    },
    
    total_talk_time: {
      sql: `total_talk_time`,
      type: `string`
    },
    
    call_status: {
      sql: `call_status`,
      type: `string`
    },
    
    agent_name: {
      sql: `agent_name`,
      type: `string`
    },
    
    mat_country_name: {
      sql: `mat_country_name`,
      type: `string`
    },
    
    call_connect: {
      sql: `call_connect`,
      type: `string`
    },
    
    call_status_norm: {
      sql: `call_status_norm`,
      type: `string`
    },
    
    phone_number_long: {
      sql: `phone_number_long`,
      type: `string`
    },
    
    calldate_txt: {
      sql: `calldate_txt`,
      type: `string`
    },
    
    call_duration: {
      sql: `call_duration`,
      type: `string`
    },
    
    call_disposition: {
      sql: `call_disposition`,
      type: `string`
    },
    
    tl_name: {
      sql: `tl_name`,
      type: `string`
    },
    
    month: {
      sql: `month`,
      type: `time`
    },
    
    calldate: {
      sql: `calldate::date`,
      type: `time`
    }
  },
  
  measures: {
    count: {
      sql: `mat_profile_id`,
      type: `count`
    }
  },
  
  pre_aggregations: {
    // Pre-aggregation definitions go here.
    // Learn more in the documentation: https://cube.dev/docs/caching/pre-aggregations/getting-started
  }
});
