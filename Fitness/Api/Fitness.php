<?php
/**
 * Fitness信息类
 * @author dogstar 20170312
 */

class Api_Fitness extends PhalApi_Api {

    public function getRules()
    {
        return array(
            'getUserInfo' => array(
                'session3rd' => array('name' => 'session3rd', 'type' => 'string', 'require' => true),
            ),
        );
    }

    /**
     * 小程序会话检测接口
     *
     * @desc 在调用登录接口后，判断用户是否已登录且在有效会话期间内
     */
    protected function checkSession($session3rd) {
        $cache = DI()->cache;
        if (empty($cache)) {
            return array('code' => -1, 'msg' => T('The server cache is not set'));
        }
        $data = $cache->get($session3rd);
        if (empty($data)) {
            return array('code' => -2, 'msg' => T('The login status has expired'));
        }

        return $data['openid'];
    }

    /**
     * 用户信息
     * @return string title 标题
     */
    public function getUserInfo() {
        $rs = array('code' => 200, 'info' => array(), 'msg' => T('The request was successful'));

        $wx_check = $this->checkSession($this->session3rd);
        if(is_array($wx_check)) {
            return $wx_check;
        }
        $domain = new Domain_Fitness();
        $info = $domain->getUserInfo($wx_check);
        if (empty($info)) {
            $rs['code'] = 0;
            $rs['msg'] = T('can not get user info');
            DI()->logger->debug('can not get user info', $this->session3rd);
            return $rs;
        }
        if (is_string($info)) {
            $rs['code'] = 1;
            $rs['info'] = array('sign' => 0, 'duration' => 0, 'content' => null);
            $rs['msg'] = $info;
            return $rs;
        }
        $rs['info'] = $info;
        return $rs;
    }
}
