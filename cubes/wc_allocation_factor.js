cube(`wc_allocation_factor`, {
  sql_table: `public.wc_allocation_factor`,
  title: ` `,
  data_source: `default`,
  
  joins: {
  
     adm_users_language:
         {
            relationship: `hasMany`,
            sql: `${wc_allocation_factor.adm_language_id}=${adm_users_language.adm_language_id}
                 `
         
         }
         
         
    
  },
  
  dimensions: {
     id: {
      sql: `id`,
      type: `number`,
      primary_key: true,
    },
    
    vintage_from_months: {
      sql: `vintage_from_mths`,
      type: `number`,
      title: `vintage_from_mths`
    },
    
    vintage_to_months: {
      sql: `vintage_to_mths`,
      type: `number`,
      title: `vintage_to_mths`
    },
    
    adm_language_id: {
      sql: `adm_language_id`,
      type: `number`,
      title: `adm_language_id`
    },
    
    factor: {
      sql: `factor`,
      type: `number`,
      title: `factor`
    },
    
    created_at: {
      sql: `created_at`,
      type: `time`,
      title: `created_at`
    },
    
    bucket_one: {
      sql: `case when "0_15" is null then 0 else "0_15" end`,
      type: `number`,
      title: `0_15`,    
    
    
    },
    
    bucket_two: {
      sql: `case when "15_25" is null then 0 else "15_25" end`,
      type: `number`,
      title: `15_25`  
    
    },
    
    bucket_three: {
      sql: `case when "25_45" is null then 0 else "25_45" end`,
      type: `number`,
      title: `25_45`,    
    
    },
    
    bucket_four: {
      sql: `case when above_45 is null then 0 else above_45 end`,
      type: `number`,
      title: `above_45`,    
    
    
    },
    
    
    
    
    
    
    
    
    
  },
  
  measures: {
    
    hire_month: {
      sql: `${employment.hire_month} `,
      type: `number`,
      title: `hire_month`,    
    
    
    },
    
  },
  
  segments: {
      
     differ: {
     sql: `${hire_month}>= ${vintage_from_months}
           and ${hire_month} <= ${vintage_to_months}`
     },
  
  },
 
  
  pre_aggregations: {
    // Pre-aggregation definitions go here.
    // Learn more in the documentation: https://cube.dev/docs/caching/pre-aggregations/getting-started
  }
});
