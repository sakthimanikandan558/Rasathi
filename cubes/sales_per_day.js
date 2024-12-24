cube(`sales_per_day`, {
  sql: `select adm_users_id,created_date::date created_date,count(mat_order_id) salespertoday
from adm_sale_mapping 
group by  adm_users_id,created_date::date `,
  
  data_source: `default`,
  
  joins: {
  
      
  
     
  },
  
  dimensions: {
    
    adm_users_id: {
      sql: `adm_users_id`,
      type: `number`
    },
    
   salespertoday : {
      sql: `salespertoday`,
      type: `number`
    },
    
    created_date: {
      sql: `created_date`,
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
