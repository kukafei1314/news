<?PHP
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home_g extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		//$this->output->set_header("Content-Type: text/html; charset=utf-8");
		$this->load->model('Udata');
		$this->load->model('news_data');
	}
	
	function index(){
		
		//echo date("Y-m-d H:i:s");
		if($this->session->userdata('uid')){
			$this->load->model('news_data');
			$num = $this->news_data->num_all();
			
			$pagesize=5;

			$str = '';
			$data = $this->page($str, $pagesize, $num);
	
			$this->load->view('home_new',$data);
		}else{
			$this->load->view('login');
		}	
	}
	
	function ulogin(){
		$row = $this->Udata->select($this->input->post('username'));
		//var_dump($row);
		if($row){
			$upwd = $row[0]->pwd;
			if($upwd == $this->input->post('pwd')){
				$arr = array('uid'=>$row[0]->id,'uname'=>$row[0]->name);
				$this->session->set_userdata($arr);
				redirect('/home_g/index', 'refresh');
			}else{
				echo "<script> alert('密码错误！');</script>";}
		}else{
			echo"<script> alert('用户名不存在！');</script>";}
	}
	
	function logout(){
		$this->session->unset_userdata('uid');
		redirect('/home_g/index', 'refresh');
	}
	
	function reg(){
		$this->load->view('register');
	}
	
	function register(){
		$row = $this->Udata->select($this->input->post('username'));
		if(!$row){
			$arr = array(
						'id'    => '',
						'name'  => $this->input->post('username'),
						'pwd'   => $this->input->post('pwd'),
						'phone' => $this->input->post('phone'),
						'email' => $this->input->post('mail')
						);
			//var_dump($arr);
			$this->Udata->register($arr);
			echo "注册成功！";
			echo "<a href=\"/home_g/index\">登陆</a>";
		}else echo"<script> alert('用户名已存在！');</script>";
	}

	function delete(){
		//echo $this->input->get('id');
		$this->news_data->delete_new($this->input->get('id'));
		redirect('/home_g/index', 'refresh');
	}
	
	function add_news(){
		$this->load->view('add');	
	}
	
	function press_news(){
		date_default_timezone_set('PRC');
		$time = date("Y-m-d H:i:s");
		$arr = array(
					'id'      => '',
					'topic'   => $this->input->post('topic'),
					'content' => $this->input->post('content'),
					'author'  => $this->input->post('author'),
					'time'    => $time
					);
		$this->news_data->add_new($arr);
		redirect('/home_g/index', 'refresh');	
	}

	function edit_news(){
		$query = $this->news_data->select_new($this->input->get('id'));
		$arr['query']=$query;
		$arr['id']= $this->input->get('id');
		$this->load->view('edit',$arr);	
	}
	
	function repress_news(){
		date_default_timezone_set('PRC');
		$time = date("Y-m-d H:i:s");
		$id = $this->input->get('id');
		$arr = array(
					'id'      => $id,
					'topic'   => $this->input->post('topic'),
					'content' => $this->input->post('content'),
					'author'  => $this->input->post('author'),
					'time'    => $time
					);
		$this->news_data->update_new($id,$arr);
		redirect('c=home_g&m=index', 'refresh');
	}
	
	function news_detail(){
		$id = $this->input->get('id');
		$new = $this->news_data->select_new($id);
		$arr['new']=$new;
		$arr['id']= $id;
		$this->load->view('detail',$arr);	
	}
	
	function search_new(){
		if($this->input->post('sousuo') == '') {
			$str = $this->input->get('str',TRUE);
		}else $str = $this->input->post('sousuo');
		//echo $str;
		$num = $this->news_data->num_search($str);
		
		$pagesize=5;
		
		$arr = $this->page($str, $pagesize, $num);
		
		$this->load->view('home_new', $arr);
	}
	
	function page($str, $pagesize, $num){
		$p = $this->input->get('per_page',TRUE);
		if($p){
			$page = $p;	
		}else $page = 1;
		$offset = ($page-1)*$pagesize;
		
		$query = $this->news_data->search_limit($str,$pagesize, $offset);
		$data['news'] = $query;
		
		$this->load->library('pagination');
		$config['base_url'] = "?c=home_g&m=search_new&str=$str";
		$config['page_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $num;
		$config['per_page'] = $pagesize; 
		$config['num_links'] = 2;
		$config['prev_tag_open'] = '<span>';
		$config['prev_link'] = '上一页';
		$config['prev_tag_close'] = '</span>';
		$config['cur_tag_open'] = '<b>'; // 当前页开始样式
		$config['cur_tag_close'] = '</b>'; // 当前页结束样式
		$config['next_tag_open'] = '<span>';
		$config['next_link'] = '下一页';			
		$config['next_tag_close'] = '</span>';
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['first_tag_open'] = '<div>';
		$config['first_tag_close'] = '</div>';
		$config['last_tag_open'] = '<div>';
		$config['last_tag_close'] = '</div>';

		$this->pagination->initialize($config); 
		$data['key'] = $this->pagination->create_links();
		return $data;
	}

}
?>