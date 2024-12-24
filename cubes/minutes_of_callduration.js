cube(`minutesOfCallDuration`, {
  sql: `select agent_email,calldate,
sum(case when call_duration >0 and call_duration <= 15 then 1 else 0 end) talktime_lessthan_15min ,
sum(case when call_duration > 15 and call_duration <= 25 then 1 else 0 end) talktime_15min_to_25min,
sum(case when call_duration > 25 and call_duration <=45 then 1 else 0 end) talktime_above_25min_to_45min,
sum(case when call_duration > 45   then 1 else 0 end) above45min
from adm_crm_call_log_upload
where call_connect='connected' 
group by agent_email,calldate order by 2 `,
  title: ` `,
  data_source: `default`,
  joins: {
  
       adm_users:
         {
            relationship: `belonsTo`,
            sql: `${minutesOfCallDuration.agent_email}=${adm_users.name}`
         
         },
  
  },
  dimensions: {
    id: {
       sql: `id`,
       type: `number`,
       primary_key: true
     },
    agent_email: {
      sql: `agent_email`,
      type: `string`,
      title: `Agent mail`
    },
    calldate: {
      sql: `calldate`,
      type: `time`,
      title: `Calldate`
    },
    talktime_lessthan_15min: {
      sql: `talktime_lessthan_15min`,
      type: `number`,
      title: `0 - 15 Min`
    },
    talktime_15min_to_25min: {
      sql: `talktime_15min_to_25min`,
      type: `number`,
      title: `15 - 25 Min`
    },
    talktime_above_25min_to_45min: {
      sql: `talktime_above_25min_to_45min`,
      type: `number`,
      title: `25 - 45 Min`
    },
    above45min: {
      sql: `above45min`,
      type: `number`,
      title: `Above 45 Min`
    }
  },
  measures: {
    count: {
      type: `count`
    }
  },
  pre_aggregations: {// Pre-aggregation definitions go here.
    // Learn more in the documentation: https://cube.dev/docs/caching/pre-aggregations/getting-started
  },
  preAggregations: {
    main: {
      dimensions: [minutesOfCallDuration.above45min, minutesOfCallDuration.agent_email, minutesOfCallDuration.talktime_15min_to_25min, minutesOfCallDuration.talktime_above_25min_to_45min, minutesOfCallDuration.talktime_lessthan_15min],
      timeDimension: minutesOfCallDuration.calldate,
      granularity: `day`,
      refresh_key: {
        every: `5 minutes`
      }
    }
  }
});
