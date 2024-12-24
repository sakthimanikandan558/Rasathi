cube(`sales_per_month`, {
  sql: `select adm_users_id,to_char(created_date,'Mon') created_month,count(mat_order_id) salespermonth
from adm_sale_mapping
group by adm_users_id,to_char(created_date,'Mon') `,
  
  data_source: `default`,
  
  joins: {
  
      
  
     
  },
  
  dimensions: {
    
    adm_users_id: {
      sql: `adm_users_id`,
      type: `number`
    },
    
   salespermonth : {
      sql: `salespermonth`,
      type: `number`
    },
    
    created_month: {
      sql: `created_month`,
      type: `string`
    }
  },
  
  measures: {
  
  
    
  },
  
  pre_aggregations: {
    // Pre-aggregation definitions go here.
    // Learn more in the documentation: https://cube.dev/docs/caching/pre-aggregations/getting-started
  }
});
