cube(`employment`, {
  sql_table: `public.employment`,
  title: ` `,
  data_source: `default`,
  
  joins: {
  
     adm_users:
         {
            relationship: `hasMany`,
            sql: `${adm_users.adm_users_id}=${employment.adm_users_id}
                 `
         
         }
         
         
    
  },
  
  dimensions: {
    id: {
      sql: `id`,
      type: `number`,
      primary_key: true,
    },
    
    adm_users_id: {
      sql: `adm_users_id`,
      type: `number`,
      title: `adm_users_id`
    },
    
    emp_code: {
      sql: `emp_code`,
      type: `string`,
      title: `emp_code`
    },
    
    emp_status: {
      sql: `emp_status`,
      type: `string`,
      title: `emp_status`
    },
    
    hire_date: {
      sql: `hire_date`,
      type: `time`,
      title: `hire_date`
    },
    
    hire_month: {
      sql: `to_char(current_date,'mm')::integer - to_char(hire_date,'mm')::integer`,
      type: `number`,
      title: `hire_month`
    },
    
    
    
    
  },
  
  measures: {
    
    
    
  },
 
  
  pre_aggregations: {
    // Pre-aggregation definitions go here.
    // Learn more in the documentation: https://cube.dev/docs/caching/pre-aggregations/getting-started
  }
});
