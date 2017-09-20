<?php
/**
 * Created by PhpStorm.
 * User: ztth
 * Date: 2017/9/7
 * Time: 15:15
 */

class News extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
//        $this->load->model('news_model');
        $this->load->helper("url_helper");
    }

    public function index(){
        $data['news']  = $this->news_model->get_news();
        $data['title'] = "news index";

        $this->load->view("templates/header",$data);
        $this->load->view("news/index",$data);
        $this->load->view("templates/footer",$data);
    }

    public function create(){
        $this->load->helper("form");
        $this->load->library("form_validation");

        $data['title'] = "create a news item";

        $this->form_validation->set_rules("title","Title",'required');
        $this->form_validation->set_rules("text","Text","required");

        if($this->form_validation->run() === false){
            $this->load->view("templates/header",$data);
            $this->load->view("news/create");
            $this->load->view("templates/footer");
        }else{
            $this->news_model->set_news();
            $this->load->view('news/success');
        }
    }

    public function picture(){
        $this->load->view('news/picture');
    }

}