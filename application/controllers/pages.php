<?php
class Pages extends CI_Controller {
    
    public function view($page = 'home'){
        if(! file_exists(APPPATH.'/views/pages/'.$page.'.php')){
            // Whoops, we don't have a page for that!
            echo APPPATH.'views/pages/'.$page.'.php';               
            show_404();
        }
        echo $_SERVER['SERVER_ADDR'];
        echo $_SERVER['SERVER_NAME'];
        echo $_SERVER['SERVER_SOFTWARE'];

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $this->load->library('calendar');
        $data_array = array(
            3  => 'http://example.com/news/article/2006/03/',
            7  => 'http://example.com/news/article/2006/07/',
            13 => 'http://example.com/news/article/2006/13/',
            26 => 'http://example.com/news/article/2006/26/'
        ); 

        $this->load->view('templates/header',$data);
        $data['calendar'] = $this->calendar->generate(2006,6,$data_array);
        $this->load->view('pages/'.$page,$data);
        $this->load->view('templates/footer',$data);
                  
    }
    
}
?>