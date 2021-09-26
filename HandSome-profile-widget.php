
/*
plugin Name:HandSome Profile widget HD 
Description:adds ability to add social profiles to a site and output them as a widget and supports arabic language sites 
version:1.0 
license:Gpl-2.08+
Author:Abdullah Azzam Aladham
Author URI:https://www.linkedin.com/in/abdullah-aladham/
Text domain:handsome-profile-widget-hd

This program is free software ,you can use or redistribute it ,but you can't modify it without anypermission*/

//
if(!defined('ABSPATH')){
    exit;
}
define('HD_HSPW_LOCATION',dirname(_FILE_));
define('HD_HSPW_LOCATION_URL',plugins_url('',_FILE_));

/**
*Get the registered social profiles .
* 
*@return an array of registered social profiles.
*/
function hd_hspw_get_social_profiles(){
    //return a filterable social profiles.
    return apply_filters(
        'hd_hspw_social_profiles',
        array() 
    );
}
function hd_hspw_register_default_social_profile($profiles){

    //add facebook profile
    $profiles['facebook']= array(
        'id'                =>'hd_hspw_facebook_url',
        'label'             =>__('Facebook URL','handsome-profile-widget-hd'),
        class               =>'facebook',
        'description'       =>__('Enter your Facebook profile URL','handsome-profile-widget-hd'),
        'priority'          =>10,
        'type'              =>'text',
        'default'           =>''    ,
        'santize_callback'  =>'sanitize_text_field'
    );
    //add linkedin profile
    $profiles['Linkedin']= array(
        'id'                =>'hd_hspw_linkedin_url',
        'label'             =>__('Linkedin URL','handsome-profile-widget-hd'),
        class               =>'Linkedin',
        'description'       =>__('Enter your Linkedin profile URL','handsome-profile-widget-hd'),
        'priority'          =>20,
        'type'              =>'text',
        'default'           =>''    ,
        'santize_callback'  =>'sanitize_text_field'
    );

//add twitter profile
    $profiles['Twitter']= array(
        'id'                =>'hd_hspw_twitter_url',
        'label'             =>__('twitter URL','handsome-profile-widget-hd'),
        class               =>'Twitter',
        'description'       =>__('Enter your Twitter profile URL','handsome-profile-widget-hd'),
        'priority'          =>30,
        'type'              =>'text',
        'default'           =>''    ,
        'santize_callback'  =>'sanitize_text_field'
    );
    $profiles['Instagram']= array(
        'id'                =>'hd_hspw_Instagram_url',
        'label'             =>__('Instagram URL','handsome-profile-widget-hd'),
        class               =>'Instagram',
        'description'       =>__('Enter your Instagram profile URL','handsome-profile-widget-hd'),
        'priority'          =>40,
        'type'              =>'text',
        'default'           =>''    ,
        'santize_callback'  =>'sanitize_text_field'
    );

    return $profiles;
}
add_filter('hd_hspw_social_profiles','hd_hspw_register_default_social_profile',10,1);
//registers the social profile with the customizer in wordpress
@return WP_customizer $wp_customize the customizer object */

function hd_hspw_register_social_customizer_settings($wp_customize)
{
    $social_profiles=hd_hspw_get_social_profiles();
    if(!empty($social_profiles)){
        $wp_customize->add_section('hd_hspw_social',
        array(
            'title'     =>__('Social Profiles'),
            'descroption'=>__('Add Social media profiles here.'),
            'priority' =>160,
            'capability'=>'edit_theme_options'
            )
        );
foreach ($social_profiles as $social_profile){
    $wp_customize->add_setting(
        $social_profile['id'],
        array(
            'default' =>'',
            'sanitize_callback'=>$social_profile['sanitize_callback'],
        )
    );

    $wp_customize->add_control(
        $social_profile['id'],
        array(
            'type'=>$social_profile['type'],
            'priority'  => $social_profile['priority'],
            'section'   =>'hd_hspw_social',
            'label'     =>  $social_profile['label'],
            'description' => $social_profile['description'] ,
            )
    )
}
    }
}