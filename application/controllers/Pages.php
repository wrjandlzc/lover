<?php
/**
 * Created by PhpStorm.
 * User: wangrj
 * Date: 2017/9/7
 * Time: 11:36
 */
class Pages extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $data['title'] = ucfirst($this->uri->segment(1, 0));
        $this->load->view('templates/header',$data);
        $this->load->view('templates/footer',$data);
    }

    public function view($page='home'){

       if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
            show_404();
       }
       $data['title'] = ucfirst("pages");
       $this->load->view('pages/'.$page,$data);
    }

    public function login(){
        //滑动验证码
        session_start();
        $num = $this->CreateRandomVerifyCode(1,6);
        echo str_split(substr(uniqid(), 7, 13), 1);die;
        echo $num;die;
        $this->picture($num,60,20);
        $this->load->view('pages/login');
    }

    //将数字显示到画布上上面
    public function picture($code,$w,$h){

        //将生成的验证码写入session，备验证时用
        $_SESSION["helloweba_num"] = $code;
        //创建图片，定义颜色值
        header("Content-type: image/PNG");
        $im = imagecreate($w, $h);
        $black = imagecolorallocate($im, 0, 0, 0);
        $gray  = imagecolorallocate($im, 200, 200, 200);
        $bgcolor = imagecolorallocate($im, 255, 255, 255);
        //填充背景
        imagefill($im, 0, 0, $gray);
        //画边框
        imagerectangle($im, 0, 0, $w-1, $h-1, $black);
        //随机绘制两条虚线，起干扰作用
        $style = array ($black,$black,$black,$black,$black,
            $gray,$gray,$gray,$gray,$gray
        );
        imagesetstyle($im, $style);
        $y1 = rand(0, $h);
        $y2 = rand(0, $h);
        $y3 = rand(0, $h);
        $y4 = rand(0, $h);
        imageline($im, 0, $y1, $w, $y3, IMG_COLOR_STYLED);
        imageline($im, 0, $y2, $w, $y4, IMG_COLOR_STYLED);
        //在画布上随机生成大量黑点，起干扰作用;
        for ($i = 0; $i < 80; $i++) {
            imagesetpixel($im, rand(0, $w), rand(0, $h), $black);
        }
        //将数字随机显示在画布上,字符的水平间距和位置都按一定波动范围随机生成
        $strx = rand(3, 8);
        for ($i = 0; $i < $code; $i++) {
            $strpos = rand(1, 6);
            imagestring($im, 5, $strx, $strpos, substr($code, $i, 1), $black);
            $strx += rand(8, 12);
        }
        imagepng($im);//输出图片
        imagedestroy($im);//释放图片所占内存
    }

    //生成随机数
    private function CreateRandomVerifyCode($code_type = 1, $code_length = 4) {
        if ($code_type == 1) {
            $chars = join("", range(0, 9));
        } elseif ($code_type == 2) {
            $chars = join("", array_merge(range('a', 'z'), range('A', 'Z')));
        } else {
            $chars = join("", array_merge(range(0, 9), range('a', 'z'), range('A', 'Z')));
        }
        if (strlen($chars) < $code_length) {
            exit("Error in VerifyImage(class): 字符串长度不够，CreateRandomVerifyCode Failed");
        }
        $chars = str_shuffle($chars);
        return substr($chars, 0, $code_length);
    }

    //生成订单号
    private function createFillNo(){
        return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
}