<?php

class Facebook_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function get_facebook_cookie() {
        $app_id = '165166353527095';
        $application_secret = '72f99b8e4f7c6d6c7e0856528ba51fad';

        if (isset($_COOKIE['fbs_' . $app_id])) {
            echo "dfgdsf";exit;
            $args = array();
            parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
            ksort($args);
            $payload = '';
            foreach ($args as $key => $value) {
                if ($key != 'sig') {
                    $payload .= $key . '=' . $value;
                }
            }
            if (md5($payload . $application_secret) != $args['sig']) {

                return null;
            }
            return $args;
        } else {
            return null;
        }
    }

    function getUser() {
        $cookie = $this->get_facebook_cookie();
        $user = @json_decode(file_get_contents(
            'https://graph.facebook.com/me?access_token=' .
                $cookie['access_token']), true);
        return $user;
    }

    function getFriendIds($include_self = TRUE) {
        $cookie = $this->get_facebook_cookie();
        $friends = @json_decode(file_get_contents(
            'https://graph.facebook.com/me/friends?access_token=' .
                $cookie['access_token']), true);
        $friend_ids = array();
        foreach ($friends['data'] as $friend) {
            $friend_ids[] = $friend['id'];
        }
        if ($include_self == TRUE) {
            $friend_ids[] = $cookie['uid'];
        }

        return $friend_ids;
    }

    function getFriends($include_self = TRUE) {
        $cookie = $this->get_facebook_cookie();
        print_r($cookie);

        $friends = @json_decode(file_get_contents(
            'https://graph.facebook.com/me/friends?access_token=' .
                $cookie['access_token']), true);

        if ($include_self == TRUE) {
            $friends['data'][] = array(
                'name' => 'You',
                'id' => $cookie['uid']
            );
        }
        return $friends['data'];
    }

    function getFriendArray($include_self = TRUE) {
        $cookie = $this->get_facebook_cookie();
        $friendlist = @json_decode(file_get_contents(
            'https://graph.facebook.com/me/friends?access_token=' .
                $cookie['access_token']), true);
        $friends = array();
        foreach ($friendlist['data'] as $friend) {
            $friends[$friend['id']] = array(
                'name' => $friend['name'],
                'picture' => 'http://graph.facebook.com/'.$friend['id'].'/picture'
            );
        }
        if ($include_self == TRUE) {
            $friends[$cookie['uid']] = 'You';
        }
        return $friends;
    }

}

?>