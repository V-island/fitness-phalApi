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
     * 用户信息
     */
    public function getUserInfo() {
        $rs = array('code' => 0, 'info' => array(), 'msg' => '');

        $domain = new Domain_Fitness();
        $info = $domain->getUserInfo($this->session3rd);
        if (empty($info)) {
            $rs['code'] = 1;
            $rs['msg'] = T('can not get user info');
            DI()->logger->debug('can not get user info', $this->session3rd);
            return $rs;
        }
        $rs['info'] = $info;
        return $rs;
    }
}
