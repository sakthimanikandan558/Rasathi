cube(`adm_users_language`, {
  sql_table: `public.adm_users_language`,
  title: ` `,
  data_source: `default`,
  
  joins: {
  
     adm_users:
         {
            relationship: `hasMany`,
            sql: `${adm_users_language.adm_users_id}=${adm_users.adm_users_id}
                 `
         
         }
         
         
    
  },
  
  dimensions: {
     adm_userslanguage_id: {
      sql: `adm_userslanguage_id`,
      type: `number`,
      primary_key: true,
    },
    
    adm_users_id: {
      sql: `adm_users_id`,
      type: `number`,
      title: `adm_users_id`
    },
    
    adm_language_id: {
      sql: `adm_language_id`,
      type: `number`,
      title: `adm_language_id`
    },
    
    
    
    
    
  },
  
  measures: {
    
    
    
  },
 
  
  pre_aggregations: {
    // Pre-aggregation definitions go here.
    // Learn more in the documentation: https://cube.dev/docs/caching/pre-aggregations/getting-started
  }
});
