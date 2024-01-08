<!-- 
    인증토큰 요청 샘플

    cf) [카페24 개발자 지원] 에서 이해를 돕기 위해 제공하는 예시 코드로 참고로만 활용하시고 구현 방법 / 개발 언어에 제약은 없습니다 
-->

<?

//인증토큰 발급 요청에 필요한 정보를 기재합니다
$auth_code          = '여기에 redirect_uri로 전달받은 인증코드를 기재합니다';
$redirect_uri       = '여기에 인증코드를 전달받은 redirect_uri를 기재합니다';
$mall_id            = '여기에 앱을 설치한 쇼핑몰 ID를 기재합니다';
$client_id          = '여기에 클라이언트 아이디를 기재합니다';
$client_secret_key  = '여기에 클라이언트 시크릿 키를 기재합니다';

//client_id와 client_secret_key는 base64 인코딩됩니다
$client_credentials = base64_encode($client_id.":".$client_secret_key)

//인증토큰 (access_token) 발급 요청 API 엔드포인트입니다
$target_url         = 'https://'.$mall_id.'cafe24api.com/api/v2/oauth/token';  

//호출시 필요한 header 정보를 준비합니다
$header = array(
    'Accept: application/json', 
    'Content-Type: application/x-www-form-urlencoded', 
    'Authorization: Basic '. $client_credentials
);

//호출시 필요한 body 정보를 준비합니다
$params = array(
    'grant_type'    => 'authorization_code',
    'code'          => $auth_code,
    'redirect_uri'  => $redirect_uri
);

//실제 호출부
$ch = curl_init();

curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_URL, $target_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$result = curl_exec($ch);
$result = json_decode($result, true);

print_r($result);

curl_close($ch);

?>
