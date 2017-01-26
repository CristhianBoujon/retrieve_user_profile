<?php

/**
*
*  FacebookService class encapsules the calls to the facebook API
**/

class FacebookService
{

    protected $facebook;
    
    protected $exception;

    protected $userToken;

    // field list was extracted from https://developers.facebook.com/docs/graph-api/reference/user
    protected $userFields = array('id',
                                'about',
                                'age_range',
                                'birthday',
                                'context',
                                'cover',
                                'currency',
                                'devices',
                                'education',
                                'email',
                                'favorite_athletes',
                                'favorite_teams',
                                'first_name',
                                'gender',
                                'hometown',
                                'inspirational_people',
                                'interested_in',
                                'languages',
                                'last_name',
                                'link',
                                'locale',
                                'location',
                                'middle_name',
                                'name',
                                'name_format',
                                'political',
                                'quotes',
                                'relationship_status',
                                'religion',
                                'significant_other',
                                'sports',
                                'timezone',
                                'updated_time',
                                'video_upload_limits',
                                'viewer_can_send_gift',
                                'website',
                                'work');

    public function __construct($settings, $userToken)
    {
        $this->facebook = new Facebook\Facebook([
            'app_id' => $settings['app_id'],
            'app_secret' => $settings['app_secret'],
            'default_graph_version' => $settings['default_graph_version'],
            'http_client_handler' => $settings['http_client_handler']
        ]);

        $this->userToken = $userToken;
        return $this;
    }

    public function getUser($id, $fields = null)
    {
        $fieldList = ($fields) ? join(',', $fields) : join(',', $this->userFields);
            
        $fbResponse = $this->facebook->get('/' . $id . '?fields=' . $fieldList , $this->userToken);

        return $fbResponse->getGraphUser()->asArray();
    }

}