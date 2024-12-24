cube(`target_total`, {
  sql: `
          select adm_users_id, '60' total_target from adm_users_v2
  /*with tt as
(select admu.adm_users_id,
sum(wcf."0_15") bucket_one,sum(wcf."15_25") bucket_two,
sum(wcf."25_45") bucket_three,sum(wcf.above_45) bucket_four 
from adm_users admu
join adm_users_language admul
on admu.adm_users_id=admul.adm_users_id
join employment emp
on admu.adm_users_id=emp.adm_users_id
join wc_allocation_factor wcf
on admul.adm_language_id=wcf.adm_language_id
where  (extract(month from current_date)::int - extract(month from emp.hire_date)::int) + 
    (extract(year from current_date)::int - extract(year from emp.hire_date)::int)::int * 12>=
	wcf.vintage_from_mths and
	(extract(month from current_date)::int - extract(month from emp.hire_date)::int) + 
    (extract(year from current_date)::int - extract(year from emp.hire_date)::int)::int * 12<=
	wcf.vintage_to_mths
	group by admu.adm_users_id
)
select tt.adm_users_id,sum(coalesce(tt.bucket_one,0)+coalesce(tt.bucket_two,0)+
						   coalesce(tt.bucket_three,0)+coalesce(tt.bucket_four,0)) total_target
						   from tt
						   group by tt.adm_users_id*/ `,
  
  data_source: `default`,
  
  joins: {
  
      
  
     
  },
  
  dimensions: {
    
    adm_users_id: {
      sql: `adm_users_id`,
      type: `number`
    },
    
   total_target : {
      sql: `total_target`,
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
