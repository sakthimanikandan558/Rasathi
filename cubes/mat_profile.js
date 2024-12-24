cube(`mat_profile`, {
  sql_table: `public.mat_profile`,
  
  data_source: `default`,
  
  joins: {
    
  },
  
  dimensions: {
    name: {
      sql: `name`,
      type: `string`
    },
    
    gender: {
      sql: `gender`,
      type: `string`
    },
    
    mobile_number: {
      sql: `mobile_number`,
      type: `string`
    },
    
    height: {
      sql: `height`,
      type: `string`
    },
    
    weight: {
      sql: `weight`,
      type: `string`
    },
    
    income_currency_id: {
      sql: `income_currency_id`,
      type: `string`
    },
    
    special_info: {
      sql: `special_info`,
      type: `string`
    },
    
    more_info: {
      sql: `more_info`,
      type: `string`
    },
    
    state: {
      sql: `state`,
      type: `string`
    },
    
    mat_state_id: {
      sql: `mat_state_id`,
      type: `string`
    },
    
    mat_country_id: {
      sql: `mat_country_id`,
      type: `string`
    },
    
    citizenship: {
      sql: `citizenship`,
      type: `string`
    },
    
    mat_city_id: {
      sql: `mat_city_id`,
      type: `string`
    },
    
    mat_religion_id: {
      sql: `mat_religion_id`,
      type: `string`
    },
    
    mat_caste_id: {
      sql: `mat_caste_id`,
      type: `string`
    },
    
    mat_subcaste_id: {
      sql: `mat_subcaste_id`,
      type: `string`
    },
    
    mat_star_id: {
      sql: `mat_star_id`,
      type: `string`
    },
    
    mat_raasi_id: {
      sql: `mat_raasi_id`,
      type: `string`
    },
    
    mat_profile_for_id: {
      sql: `mat_profile_for_id`,
      type: `string`
    },
    
    mat_bodytype_id: {
      sql: `mat_bodytype_id`,
      type: `string`
    },
    
    mat_complexion_id: {
      sql: `mat_complexion_id`,
      type: `string`
    },
    
    mat_drinking_id: {
      sql: `mat_drinking_id`,
      type: `string`
    },
    
    mat_education_id: {
      sql: `mat_education_id`,
      type: `string`
    },
    
    mat_employed_in_id: {
      sql: `mat_employed_in_id`,
      type: `string`
    },
    
    mat_family_status_id: {
      sql: `mat_family_status_id`,
      type: `string`
    },
    
    mat_family_type_id: {
      sql: `mat_family_type_id`,
      type: `string`
    },
    
    mat_family_value_id: {
      sql: `mat_family_value_id`,
      type: `string`
    },
    
    mat_food_id: {
      sql: `mat_food_id`,
      type: `string`
    },
    
    resident_status_id: {
      sql: `resident_status_id`,
      type: `string`
    },
    
    mat_gothra_id: {
      sql: `mat_gothra_id`,
      type: `string`
    },
    
    mat_mother_tongue_id: {
      sql: `mat_mother_tongue_id`,
      type: `string`
    },
    
    mat_marital_status_id: {
      sql: `mat_marital_status_id`,
      type: `string`
    },
    
    mat_occupation_id: {
      sql: `mat_occupation_id`,
      type: `string`
    },
    
    mat_smoking_id: {
      sql: `mat_smoking_id`,
      type: `string`
    },
    
    mat_heightinches_id: {
      sql: `mat_heightinches_id`,
      type: `string`
    },
    
    mat_physicalstatus_id: {
      sql: `mat_physicalstatus_id`,
      type: `string`
    },
    
    profile_flag: {
      sql: `profile_flag`,
      type: `string`
    },
    
    preferences_flag: {
      sql: `preferences_flag`,
      type: `string`
    },
    
    mat_profile_id: {
      sql: `mat_profile_id`,
      type: `string`
    },
    
    age: {
      sql: `age`,
      type: `string`
    },
    
    mat_annual_income_id: {
      sql: `mat_annual_income_id`,
      type: `string`
    },
    
    mat_dosham_id: {
      sql: `mat_dosham_id`,
      type: `string`
    },
    
    mat_monthly_income_id: {
      sql: `mat_monthly_income_id`,
      type: `string`
    },
    
    picturepath: {
      sql: `picturepath`,
      type: `string`
    },
    
    issentqueue: {
      sql: `issentqueue`,
      type: `string`
    },
    
    isdcode: {
      sql: `isdcode`,
      type: `string`
    },
    
    gothraname: {
      sql: `gothraname`,
      type: `string`
    },
    
    other_education: {
      sql: `other_education`,
      type: `string`
    },
    
    other_religion: {
      sql: `other_religion`,
      type: `string`
    },
    
    ispaid: {
      sql: `ispaid`,
      type: `string`
    },
    
    otp: {
      sql: `otp`,
      type: `string`
    },
    
    freemsg_balance: {
      sql: `freemsg_balance`,
      type: `string`
    },
    
    phoneview_balance: {
      sql: `phoneview_balance`,
      type: `string`
    },
    
    astromatch_balance: {
      sql: `astromatch_balance`,
      type: `string`
    },
    
    servicecall_balance: {
      sql: `servicecall_balance`,
      type: `string`
    },
    
    mat_membership_id: {
      sql: `mat_membership_id`,
      type: `string`
    },
    
    kmatch_score: {
      sql: `kmatch_score`,
      type: `string`
    },
    
    other_subcaste: {
      sql: `other_subcaste`,
      type: `string`
    },
    
    currency: {
      sql: `currency`,
      type: `string`
    },
    
    horoscope: {
      sql: `horoscope`,
      type: `string`
    },
    
    horoscopetype: {
      sql: `horoscopetype`,
      type: `string`
    },
    
    idproof: {
      sql: `idproof`,
      type: `string`
    },
    
    educationproof: {
      sql: `educationproof`,
      type: `string`
    },
    
    incomeproof: {
      sql: `incomeproof`,
      type: `string`
    },
    
    otpcount: {
      sql: `otpcount`,
      type: `string`
    },
    
    profilecompercen: {
      sql: `profilecompercen`,
      type: `string`
    },
    
    profileremaining: {
      sql: `profileremaining`,
      type: `string`
    },
    
    isonline: {
      sql: `isonline`,
      type: `string`
    },
    
    mat_registrationsource_id: {
      sql: `mat_registrationsource_id`,
      type: `string`
    },
    
    mat_leadcategory_id: {
      sql: `mat_leadcategory_id`,
      type: `string`
    },
    
    isinproofvalidate: {
      sql: `isinproofvalidate`,
      type: `string`
    },
    
    suspensionreason: {
      sql: `suspensionreason`,
      type: `string`
    },
    
    jabberroomname: {
      sql: `jabberroomname`,
      type: `string`
    },
    
    jabberusername: {
      sql: `jabberusername`,
      type: `string`
    },
    
    jabbernotificationname: {
      sql: `jabbernotificationname`,
      type: `string`
    },
    
    email: {
      sql: `email`,
      type: `string`
    },
    
    manualverificationsource: {
      sql: `manualverificationsource`,
      type: `string`
    },
    
    manualverification: {
      sql: `manualverification`,
      type: `string`
    },
    
    utm_source: {
      sql: `utm_source`,
      type: `string`
    },
    
    banner_flag: {
      sql: `banner_flag`,
      type: `string`
    },
    
    lightbox_flag: {
      sql: `lightbox_flag`,
      type: `string`
    },
    
    profileregister_flag: {
      sql: `profileregister_flag`,
      type: `string`
    },
    
    old_age: {
      sql: `old_age`,
      type: `string`
    },
    
    profile_tagging: {
      sql: `profile_tagging`,
      type: `string`
    },
    
    profilecreatedfrom: {
      sql: `profilecreatedfrom`,
      type: `string`
    },
    
    pincode: {
      sql: `pincode`,
      type: `string`
    },
    
    address: {
      sql: `address`,
      type: `string`
    },
    
    showapppopup: {
      sql: `showapppopup`,
      type: `string`
    },
    
    parents_isdcode: {
      sql: `parents_isdcode`,
      type: `string`
    },
    
    parents_mobilenumber: {
      sql: `parents_mobilenumber`,
      type: `string`
    },
    
    parents_monthlyincome: {
      sql: `parents_monthlyincome`,
      type: `string`
    },
    
    parents_currency: {
      sql: `parents_currency`,
      type: `string`
    },
    
    appdownloadlinksent: {
      sql: `appdownloadlinksent`,
      type: `string`
    },
    
    total_smscount: {
      sql: `total_smscount`,
      type: `string`
    },
    
    used_smscount: {
      sql: `used_smscount`,
      type: `string`
    },
    
    balance_smscount: {
      sql: `balance_smscount`,
      type: `string`
    },
    
    smspack_isactive: {
      sql: `smspack_isactive`,
      type: `string`
    },
    
    alternate_mobilenumber: {
      sql: `alternate_mobilenumber`,
      type: `string`
    },
    
    alternate_isdcode: {
      sql: `alternate_isdcode`,
      type: `string`
    },
    
    verifiedparentsnumber: {
      sql: `verifiedparentsnumber`,
      type: `string`
    },
    
    verifysourceofparentsnumber: {
      sql: `verifysourceofparentsnumber`,
      type: `string`
    },
    
    utm_medium: {
      sql: `utm_medium`,
      type: `string`
    },
    
    utm_campaign: {
      sql: `utm_campaign`,
      type: `string`
    },
    
    mat_subdomain_id: {
      sql: `mat_subdomain_id`,
      type: `string`
    },
    
    unlimited_pack: {
      sql: `unlimited_pack`,
      type: `string`
    },
    
    is_typesense: {
      sql: `is_typesense`,
      type: `string`
    },
    
    created_date: {
      sql: `created_date`,
      type: `time`
    },
    
    updated_date: {
      sql: `updated_date`,
      type: `time`
    },
    
    updatedproofvalidate: {
      sql: `updatedproofvalidate`,
      type: `time`
    },
    
    dob: {
      sql: `dob`,
      type: `time`
    },
    
    lastonline: {
      sql: `lastonline`,
      type: `time`
    },
    
    otp_generated_time: {
      sql: `otp_generated_time`,
      type: `time`
    },
    
    ageupdation_date: {
      sql: `ageupdation_date`,
      type: `time`
    },
    
    date_live_at_site: {
      sql: `date_live_at_site`,
      type: `time`
    },
    
    firsttime_otpverified_date: {
      sql: `firsttime_otpverified_date`,
      type: `time`
    },
    
    smspack_activateddate: {
      sql: `smspack_activateddate`,
      type: `time`
    },
    
    parents_numberverified_date: {
      sql: `parents_numberverified_date`,
      type: `time`
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
