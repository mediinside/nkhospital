<?php
define('GET', 'GET');
define('POST', 'POST');
define('DELETE', 'DELETE');


class User_Management_Path
{
  public static $TOKEN          = "/oauth/token";
  public static $TOKEN_INFO		= "/v1/user/access_token_info";    
  public static $SIGNUP         = "/v1/user/signup";
  public static $UNLINK         = "/v1/user/unlink";
  public static $LOGOUT         = "/v1/user/logout";
  public static $ME             = "/v1/user/me";
  public static $UPDATE_PROFILE = "/v1/user/update_profile";
  public static $USER_IDS       = "/v1/user/ids";
}

class Story_Path
{
  public static $PROFILE        = "/v1/api/story/profile";
  public static $ISSTORYUSER    = "/v1/api/story/isstoryuser";
  public static $MYSTORIES      = "/v1/api/story/mystories";
  public static $MYSTORY        = "/v1/api/story/mystory";
  public static $DELETE_MYSTORY = "/v1/api/story/delete/mystory";
  public static $POST_NOTE      = "/v1/api/story/post/note";
  public static $UPLOAD_MULTI   = "/v1/api/story/upload/multi";
  public static $POST_PHOTO     = "/v1/api/story/post/photo";
  public static $LINKINFO       = "/v1/api/story/linkinfo";
  public static $POST_LINK      = "/v1/api/story/post/link";
}

class Talk_Path
{
  public static $TALK_PROFILE= "/v1/api/talk/profile";
}

class Push_Notification_Path
{
  public static $REGISTER   = "/v1/push/register";
  public static $TOKENS     = "/v1/push/tokens";
  public static $DEREGISTER = "/v1/push/deregister";
  public static $SEND       = "/v1/push/send";
}


class Kakao_REST_API
{
  public static $OAUTH_HOST = "https://kauth.kakao.com";
  public static $API_HOST = "https://kapi.kakao.com";

  private static $admin_apis;

  private $access_token;
  private $admin_key;

  public function __construct($access_token = '') {
	//echo $access_token;
    if ($access_token) {
      $this->access_token = $access_token;
    }

    self::$admin_apis = array(
      User_Management_Path::$USER_IDS,
      Push_Notification_Path::$REGISTER,
      Push_Notification_Path::$TOKENS,
      Push_Notification_Path::$DEREGISTER,
      Push_Notification_Path::$SEND
    );
  }

  public function request($api_path, $params = '', $http_method = GET)
  {
    if ($api_path != Story_Path::$UPLOAD_MULTI && is_array($params)) { // except for uploading
      $params = http_build_query($params);
    }

    $requestUrl = ($api_path == '/oauth/token' ? self::$OAUTH_HOST : self::$API_HOST) . $api_path;

    if (($http_method == GET || $http_method == DELETE) && !empty($params)) {
      $requestUrl .= '?'.$params;
    }

    $opts = array(
      CURLOPT_URL => $requestUrl,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_SSLVERSION => 1,
    );

    if ($api_path != '/oauth/token')
    {

      if (in_array($api_path, self::$admin_apis)) {

        if (!$this->admin_key) {
          throw new Exception('admin key should not be null or empty.');
        }
        $headers = array('Authorization: KakaoAK ' . $this->admin_key);

      } else {
        if (!$this->access_token) {
			
          throw new Exception('access token should not be null or empty.');
		 
        }
        $headers = array('Authorization: Bearer ' . $this->access_token);
      }

      $opts[CURLOPT_HEADER] = false;
      $opts[CURLOPT_HTTPHEADER] = $headers;
    }

    if ($http_method == POST) {
      $opts[CURLOPT_POST] = true;
      if ($params) {
        $opts[CURLOPT_POSTFIELDS] = $params;
      }
    } else if ($http_method == DELETE) {
      $opts[CURLOPT_CUSTOMREQUEST] = DELETE;
    }

    $curl_session = curl_init();
    curl_setopt_array($curl_session, $opts);
    $return_data = curl_exec($curl_session);

    if (curl_errno($curl_session)) {
      throw new Exception(curl_error($curl_session));
    } else {
      // 디버깅 시에 주석을 풀고 응답 내용 확인할 때
     // print_r(curl_getinfo($curl_session));
      curl_close($curl_session);
	  $tmp_return = json_decode($return_data,true);
	  //echo $tmp_return["code"];
	  
      return $return_data;
	  
    }
  }

  public function set_access_token($access_token) {
    $this->access_token = $access_token;
  }

  public function set_admin_key($admin_key) {
    $this->admin_key = $admin_key;
  }
  
  public function get_access_token($c_id,$r_url,$code){
	$params = sprintf( 'grant_type=authorization_code&client_id=%s&redirect_uri=%s&code=%s', $c_id, $r_url, $code); 
	$opts = array( 
	CURLOPT_URL => self::$OAUTH_HOST.User_Management_Path::$TOKEN, 
	CURLOPT_SSL_VERIFYPEER => false, 
	CURLOPT_SSLVERSION => 1, // TLS
	CURLOPT_POST => true, 
	CURLOPT_POSTFIELDS => $params, 
	CURLOPT_RETURNTRANSFER => true, 
	CURLOPT_HEADER => false 
	); 
	
	$curlSession = curl_init(); 
	curl_setopt_array($curlSession, $opts); 
	$accessTokenJson = curl_exec($curlSession); 
	curl_close($curlSession); 
	$rec = json_decode($accessTokenJson,true);
	$this->set_access_token($rec["access_token"]);
/*
    $params = array();
    $params['grant_type']    = 'refresh_token';
    $params['client_id']     = $c_id;
    $params['refresh_token'] = $rec["refresh_token"];
    echo $this->create_or_refresh_access_token($params);
*/
	return $accessTokenJson; 
  }

  ///////////////////////////////////////////////////////////////
  // User Management
  ///////////////////////////////////////////////////////////////

  public function create_or_refresh_access_token($params) {
    return $this->request(User_Management_Path::$TOKEN, $params, POST);
  }

  public function signup() {
    return $this->request(User_Management_Path::$SIGNUP);
  }

  public function unlink() {
    return $this->request(User_Management_Path::$UNLINK);
  }

  public function logout() {
    return $this->request(User_Management_Path::$LOGOUT);
  }

  public function me() {
    return $this->request(User_Management_Path::$ME);
  }

  public function update_profile($params) {
    return $this->request(User_Management_Path::$UPDATE_PROFILE, $params, POST);
  }

  public function user_ids() {
    return $this->request(User_Management_Path::$USER_IDS);
  }
  
  public function token_info() {
    return $this->request(User_Management_Path::$TOKEN_INFO);
  }  

  ///////////////////////////////////////////////////////////////
  // Kakao Story
  ///////////////////////////////////////////////////////////////

  public function isstoryuser() {
    return $this->request(Story_Path::$ISSTORYUSER);
  }

  public function story_profile() {
    return $this->request(Story_Path::$PROFILE);
  }

  public function post_note($params) {
    return $this->request(Story_Path::$POST_NOTE, $params, POST);
  }

  public function post_link($url, $params) {
    $link_info_obj = $this->request(Story_Path::$LINKINFO, 'url='.$url, GET);
    if ($link_info_obj) {
      $params['link_info'] = $link_info_obj;
      return $this->request(Story_Path::$POST_LINK, $params, POST);
    } else {
      throw new Exception('failed to get link info');
    }
  }

  public function post_photo($file_params, $params)
  {
    $image_url_list_obj = $this->request(Story_Path::$UPLOAD_MULTI, $file_params, POST);
    if ($image_url_list_obj) {
      $params['image_url_list'] = $image_url_list_obj;
      return $this->request(Story_Path::$POST_PHOTO, $params, POST);
    } else {
      throw new Exception('failed to upload file(s).');
    }
  }

  public function get_mystories($last_id='') {
    $param = $last_id ? 'last_id='.$last_id : null;
    return $this->request(Story_Path::$MYSTORIES, $param, GET);
  }

  public function get_mystory($id) {
    return $this->request(Story_Path::$MYSTORY, 'id='.$id, GET);
  }

  public function delete_mystory($id) {
    return $this->request(Story_Path::$DELETE_MYSTORY, 'id='.$id, DELETE);
  }


  ///////////////////////////////////////////////////////////////
  // Kakao Talk
  ///////////////////////////////////////////////////////////////

  public function talk_profile() {
    return $this->request(Talk_Path::$TALK_PROFILE);
  }


  ///////////////////////////////////////////////////////////////
  // Push Notification
  ///////////////////////////////////////////////////////////////

  public function register_push($params) {
    return $this->request(Push_Notification_Path::$REGISTER, $params, POST);
  }

  public function get_push_tokens($params) {
    return $this->request(Push_Notification_Path::$TOKENS, $params, POST);
  }

  public function deregister_push($params) {
    return $this->request(Push_Notification_Path::$DEREGISTER, $params, POST);
  }

  public function send_push($params) {
    return $this->request(Push_Notification_Path::$SEND, $params, POST);
  }

}