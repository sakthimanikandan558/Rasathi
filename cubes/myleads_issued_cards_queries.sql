No calls today:

{
  "dimensions": [
    "adm_agenttalktime_details_per_day.total_count"
  ],
  "order": {
    "adm_agenttalktime_details_per_day.total_count": "asc"
  },
  "filters": [
    {
      "member": "adm_agenttalktime_details_per_day.agent_email",
      "operator": "equals",
      "values": [
        "kaladevi.l@praniontech.com"
      ]
    }
  ]
}

-----------------------------------------------------------------------------
no of connected calls:

{
  "dimensions": [
    "adm_agenttalktime_details_per_day.connected_call_count"
  ],
  "order": {
    "adm_agenttalktime_details_per_day.connected_call_count": "asc"
  },
  "filters": [
    {
      "member": "adm_agenttalktime_details_per_day.agent_email",
      "operator": "equals",
      "values": [
        "kaladevi.l@praniontech.com"
      ]
    }
  ]
}

--------------------------------------------------------------------------------------
total talktime today:

{
  "dimensions": [
    "adm_agenttalktime_details_per_day.total_talktime"
  ],
  "order": {
    "adm_agenttalktime_details_per_day.total_talktime": "asc"
  },
  "filters": [
    {
      "member": "adm_agenttalktime_details_per_day.agent_email",
      "operator": "equals",
      "values": [
        "kaladevi.l@praniontech.com"
      ]
    }
  ]
}

-----------------------------------------------------------------------------------------------------
sales per today:

{
  "dimensions": [
    "sales_per_day.salespertoday"
  ],
  "order": {
    "sales_per_day.salespertoday": "asc"
  },
  "filters": [
    {
      "member": "sales_per_day.adm_users_id",
      "operator": "equals",
      "values": [
        "10869435"
      ]
    },
    {
      "member": "sales_per_day.created_date",
      "operator": "equals",
      "values": [
        "2019-07-09"
      ]
    }
  ]
}

-----------------------------------------------------------------------------------------
sales per month:

{
  "dimensions": [
    "sales_per_month.salespermonth"
  ],
  "order": {
    "sales_per_month.salespermonth": "asc"
  },
  "filters": [
    {
      "member": "sales_per_month.adm_users_id",
      "operator": "equals",
      "values": [
        "41626233"
      ]
    },
    {
      "member": "sales_per_month.created_month",
      "operator": "equals",
      "values": [
        "May"
      ]
    }
  ]
}
---------------------------------------------------------------------------------------------------

