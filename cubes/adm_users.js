cube(`adm_users`, {
  sql: `select adm_users_id,name,mobile_number,adm_roles_id,password,target_per_day,'80' as cc_target,target_per_month,avg_tt_per_day,
avg_tt_per_month,target_per_daysale,target_per_monthsale from adm_users_v2`,
  
  data_source: `default`,
  
  joins: {
  
     agent_profile_allocation:
         {
            relationship: `hasMany`,
            sql: `${adm_users.adm_users_id}=${agent_profile_allocation.adm_users_id}`
         
         },
         
         minutesOfCallDuration:
         {
            relationship: `hasMany`,
            sql: `${minutesOfCallDuration.agent_email}=${adm_users.name}`
         
         },
         
      employment:
         {
            relationship: `belongsTo`,
            sql: `${adm_users.adm_users_id}=${employment.adm_users_id}
                 `
         
         },
         
      adm_users_language:
         {
            relationship: `belongsTo`,
            sql: `${adm_users_language.adm_users_id}=${adm_users.adm_users_id}
                 `
         
         }
         
      
        
         
      
    
  },
  
  dimensions: {
    adm_users_id: {
      sql: `adm_users_id`,
      type: `string`,
      primary_key: true,
    },
    
    name: {
      sql: `name`,
      type: `string`
    },
    
    mobile_number: {
      sql: `mobile_number`,
      type: `string`
    },
    
    adm_roles_id: {
      sql: `adm_roles_id`,
      type: `string`
    },
    
    password: {
      sql: `password`,
      type: `string`
    },
    
    target_per_day: {
      sql: `case when target_per_day is null then 0 else target_per_day end`,
      type: `number`
    },
    
    cc_target: {
      sql: `cc_target`,
      type: `string`
    },
    
    target_per_month: {
      sql: `target_per_month`,
      type: `string`
    },
    
    avg_tt_per_day: {
      sql: `case when avg_tt_per_day is null then 0 else avg_tt_per_day end`,
      type: `number`
    },
    
    avg_tt_per_month: {
      sql: `avg_tt_per_month`,
      type: `string`
    },
    
    target_per_daysale: {
      sql: `case when target_per_daysale is null then 0 else target_per_daysale end`,
      type: `number`
    },
    
    target_per_monthsale: {
      sql: `case when target_per_monthsale is null then 0 else target_per_monthsale end`,
      type: `number`
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
