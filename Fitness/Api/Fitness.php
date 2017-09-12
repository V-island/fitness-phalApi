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
            'userRecord' => array(
                'session3rd' => array('name' => 'session3rd', 'type' => 'string', 'require' => true),
                'sign'       => array('name' => 'sign', 'type' => 'int', 'default' => 0, 'desc' => '连续签到次数'),
                'duration'   => array('name' => 'duration', 'type' => 'int', 'default' => 0, 'desc' => '锻炼时长'),
                'content'    => array('name' => 'content', 'type' => 'array', 'desc' => '锻炼内容', 'require' => true),
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
     * @return array  info  最新一条用户历史记录数据
     */
    public function getUserInfo() {
        $rs = array('code' => 200, 'info' => array(), 'msg' => T('The request was successful'));

        $openId = $this->checkSession($this->session3rd);
        if(is_array($openId)) {
            return $openId;
        }
        $domain = new Domain_Fitness();
        $userId = $domain->getUserId($openId);
        $info = $domain->getUserInfo($userId);
        if (empty($info)) {
            $rs['code'] = 0;
            $rs['msg'] = T('can not get user info');
            DI()->logger->debug('can not get user info', $this->session3rd);
            return $rs;
        }
        $rs['info'] = $info;
        return $rs;
    }

    /**
     * 写入用户锻炼数据
     */
    public function userRecord() {
        $rs = array('code' => 200, 'msg' => T('The request was successful'));

        $openId = $this->checkSession($this->session3rd);
        if(is_array($openId)) {
            return $openId;
        }
        $domain = new Domain_Fitness();
        $userId = $domain->getUserId($openId);
        $info = $domain->userRecord($userId, $this->sign, $this->duration, $this->content,);
        if (empty($info)) {
            $rs['code'] = 0;
            $rs['msg'] = T('Database write failed');
            return $rs;
        }
        return $rs;
    }
}
