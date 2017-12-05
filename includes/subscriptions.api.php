<?php

function getSubscriptionPlans($isIndividual=true){
    $plans = getData($isIndividual);
    // wordpress_dd($plans);
    $yearly_plans = array();
    $monthly_plans = array();
    $monthly_descriptions = array(
        'Basic'=>array(),
        'Premium'=>array()
    );
    $yearly_descriptions = array(
        'Basic'=>array(),
        'Premium'=>array()
    );

    $monthly_description_t = array();
    $yearly_description_t = array();
    foreach( $plans as $plan ){
        if(BILLING_YEARLY == $plan->BillingPeriod){
            array_push($yearly_plans, $plan);
            if('Basic'==$plan->Level){
                $yearly_descriptions['Basic'] = array_merge($yearly_descriptions['Basic'], getFeatureList($plan->Description, $plan->Level));
            }else if('Premium'==$plan->Level){
                $yearly_descriptions['Premium'] = array_merge($yearly_descriptions['Premium'], getFeatureList($plan->Description, $plan->Level));
            }
            $yearly_description_t = array_merge($yearly_description_t, getFeatureList2($plan->Description));
            
        }else if(BILLING_MONTHLY == $plan->BillingPeriod){
            array_push($monthly_plans, $plan);
            if('Basic'==$plan->Level){
                $monthly_descriptions['Basic'] = array_merge($monthly_descriptions['Basic'],getFeatureList($plan->Description, $plan->Level));
            }else if('Premium'==$plan->Level){
                $monthly_descriptions['Premium'] = array_merge($monthly_descriptions['Premium'],getFeatureList($plan->Description, $plan->Level));
            }
            $monthly_description_t = array_merge($monthly_description_t, getFeatureList2($plan->Description));
        }        
    }
    $monthly_description_t = array_unique($monthly_description_t);
    $yearly_description_t = array_unique($yearly_description_t);

    $monthly_features = array();
    foreach($monthly_description_t as $monthly_description_t_item){
        $monthly_features[$monthly_description_t_item] = array(
            'Premium'=>0,
            'Basic'=>0,
        );
        foreach($monthly_descriptions['Premium'] as $monthly_descriptions_premium){
            if($monthly_descriptions_premium['feature'] == $monthly_description_t_item){
                $monthly_features[$monthly_description_t_item]['Premium'] = $monthly_descriptions_premium['Premium'];
            }
        }
        foreach($monthly_descriptions['Basic'] as $monthly_descriptions_premium){
            if($monthly_descriptions_premium['feature'] == $monthly_description_t_item){
                $monthly_features[$monthly_description_t_item]['Basic'] = $monthly_descriptions_premium['Basic'];
            }
        }
    }

    $yearly_features = array();
    foreach($yearly_description_t as $yearly_description_t_item){
        $yearly_features[$yearly_description_t_item] = array(
            'Premium'=>0,
            'Basic'=>0,
        );
        foreach($yearly_descriptions['Premium'] as $yearly_descriptions_premium){
            if($yearly_descriptions_premium['feature'] == $yearly_description_t_item){
                $yearly_features[$yearly_description_t_item]['Premium'] = $yearly_descriptions_premium['Premium'];
            }
        }
        foreach($yearly_descriptions['Basic'] as $yearly_descriptions_premium){
            if($yearly_descriptions_premium['feature'] == $yearly_description_t_item){
                $yearly_features[$yearly_description_t_item]['Basic'] = $yearly_descriptions_premium['Basic'];
            }
        } 
    }

    return array(
        "monthly_plans"=> array (
            'plans'=> $monthly_plans,
            'desc' => $monthly_features,
            'features'=> $monthly_description_t
        ),
        "yearly_plans"=> array (
            'plans'=> $yearly_plans,
            'desc' => $yearly_features,
            'features'=> $yearly_description_t
        ), 
    );
}

function getFeatureList($descriptions, $level){
    $descriptions_array = explode('</li>',$descriptions);
    $descriptions_arrays = array();
    foreach($descriptions_array as $descriptions_item){
        $descriptions_item = trim($descriptions_item);
        if(!empty($descriptions_item)){            
            $descriptions_item = str_replace("<li>","",$descriptions_item);
            $descriptions_item = str_replace("</li>","",$descriptions_item);
            array_push($descriptions_arrays, array(
                'feature'=> $descriptions_item,
                'Basic'  => $level == 'Basic' ? True : False,
                'Premium'  => $level == 'Premium' ? True : False,
            ));
        }
    }
    return $descriptions_arrays;
}

function getFeatureList2($descriptions){    
    $descriptions_array = explode('</li>',$descriptions);
    // var_dump($descriptions_array);
    // exit;
    $descriptions_arrays = array();
    foreach($descriptions_array as $descriptions_item){
        $descriptions_item = trim($descriptions_item);
        if(!empty($descriptions_item)){
            $descriptions_item = str_replace("<li>","",$descriptions_item);
            $descriptions_item = str_replace("</li>","",$descriptions_item);
            array_push($descriptions_arrays, $descriptions_item);
        }
    }
    // wordpress_dd($descriptions_arrays);
    return $descriptions_arrays;
}


function getData($isIndividual=true){
    $return = array();
    $isIndividual_data = $isIndividual ? "true" : "false";
    $url = SUBSCRIPTION_API_URL . $isIndividual_data;
    $headers = array(
        'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result);
    if(!empty($result->Status) && $result->Status){
        $return = !empty($result->Data->Plans)? $result->Data->Plans : array();
    }
    return $return;
}

