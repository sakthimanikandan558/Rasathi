cube(`new_allocation_count`, {
  sql_table: `public.new_allocation_count`,
  
  data_source: `default`,
  
  joins: {
  
      
  agent_profile_allocation:
         {
            relationship: `hasMany`,
            sql: `${new_allocation_count.adm_users_id}=${agent_profile_allocation.adm_users_id}`
         
         }
     
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
    
    adm_users_id: {
      sql: `adm_users_id`,
      type: `number`
    },
    
    mat_profile_id: {
      sql: `mat_profile_id`,
      type: `number`
    },
    
    calldate: {
      sql: `calldate::date`,
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
