cube(`agent_profile_allocation`, {
  sql_table: `public.agent_profile_allocation`,
  data_source: `default`,
  
  joins: {
  
      adm_users:
         {
            relationship: `belongsTo`,
            sql: `${adm_users.adm_users_id}=${agent_profile_allocation.adm_users_id}`
         
         },
         
         
      mat_profile_talktime:
         {
            relationship: `belongsTo`,
            sql: `${mat_profile_talktime.mat_profile_id}=${agent_profile_allocation.mat_profile_id}
            
        
                 `
         
         },
         
      new_allocation_count:
         {
            relationship: `belongsTo`,
            sql: `${new_allocation_count.adm_users_id}=${agent_profile_allocation.adm_users_id}`
         
         },
         
      mat_profile_movement:
         {
            relationship: `belongsTo`,
            sql: `${mat_profile_movement.mat_profile_id}=${agent_profile_allocation.mat_profile_id}
            
        
                 `
         
         },
    
  },
  
  dimensions: {
    id: {
      sql: `id`,
      type: `number`,
      primary_key: true
    },
    
    adm_users_id: {
      sql: `adm_users_id`,
      type: `string`,
    },
    
    mat_profile_id: {
      sql: `mat_profile_id`,
      type: `number`
    },
    
    
    
    entry_source: {
      sql: `entry_source`,
      type: `string`
    },
    
    rule_type: {
      sql: `rule_type`,
      type: `string`
    },
    
    is_married: {
      sql: `is_married`,
      type: `string`
    },
    
    is_wrong_number: {
      sql: `is_wrong_number`,
      type: `string`
    },
    
    lead_name: {
      sql: `lead_name`,
      type: `string`
    },
    
    total_calls: {
      sql: `total_calls`,
      type: `number`
    },
    
    connected_calls: {
      sql: `connected_calls`,
      type: `number`
    },
    
    
    is_not_interested: {
      sql: `is_not_interested`,
      type: `string`
    },
    
    created_at: {
      sql: `created_at::date`,
      type: `time`
    },
    
    updated_at: {
      sql: `updated_at`,
      type: `time`
    },
    
    customer_followup_dttm: {
      sql: `customer_followup_dttm`,
      type: `time`
    },
    
    own_followup_dttm: {
      sql: `own_followup_dttm`,
      type: `time`
    },
    
    entry_dttm: {
      sql: `entry_dttm`,
      type: `time`
    },
    
    exit_dttm: {
      sql: `exit_dttm`,
      type: `time`
    },
    
    rnr_followup_dttm: {
      sql: `rnr_followup_dttm`,
      type: `time`
    }
  },
  
  measures: {
  
    newallocationcount: {
      sql: `distinct ${mat_profile_id}`,
      type: `count`,
      title: `New Allocation`
    },
    
    count: {
    sql: `${mat_profile_talktime.mat_profile_id}`,
    type: `count`
    
    },
    
    rnr_continuous_count: {
      sql: `rnr_continuous_count`,
      type: `sum`
    },
    
    sum_of_calls: {
      sql: `${total_calls}`,
      type: `sum`
    },
    
    sum_of_connectedcalls: {
      sql: `${connected_calls}`,
      type: `sum`
    }
    
    
    
  },
  
  
    
  
  pre_aggregations: {
    // Pre-aggregation definitions go here.
    // Learn more in the documentation: https://cube.dev/docs/caching/pre-aggregations/getting-started
  }
});
