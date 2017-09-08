<?php

class Domain_Fitness {
    /**
     * 小程序会话检测接口
     *
     * @desc 在调用登录接口后，判断用户是否已登录且在有效会话期间内
     */
    protected function checkSession($session3rd) {
        $cache = DI()->cache;
        if (empty($cache)) {
            return array('code' => -1, 'message' => T('The server cache is not set'));
        }
        $data = $cache->get($session3rd);
        if (empty($data)) {
            return array('code' => -2, 'message' => T('The login status has expired'));
        }

        return array('code' => 0, 'openid' => $data['openid']);
    }

    public function getUserInfo($session3rd) {
        $rs = array();
        $wx_check = $this->checkSession($session3rd);
        if ($wx_check['code'] < 0) {
            return $wx_check;
        }
        $modelUser = new Model_User();
        $userId = $modelUser->getByUserId($wx_check['openid']);
        if (empty($userId)) {
            $userId = $modelUser->insert(array(
                'wx_openid'       => $wx_check['openid'],
                'reg_time'        => $_SERVER['REQUEST_TIME'],
            ));
            return $userId;
        }
        return $userId;
    }

}
