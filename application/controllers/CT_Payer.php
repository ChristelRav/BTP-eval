<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CT_Payer extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('MD_Paiement');
        $this->load->model('MD_Travaux_Client');
    }
    private function viewer($page,$data)
    {
        $v = array(
            'page'=>$page,
            'data'=>$data
        );
        $this->load->view('template/basepage',$v);
    }
    public function index(){
        if($_POST['montant']>$_POST['reste']){
            $data['error'] = 'Montant invalide';
            redirect('CT_Devis/payer?error=' . urlencode($data['error']).'&devis=' . urlencode($_POST['devis']).'&ttl='. urlencode($_POST['ttl']).'&reste='. urlencode($_POST['reste']));
        }else{
            $this->MD_Paiement->insert($_POST['devis'],$_POST['montant'],$_POST['dp']);
            redirect('CT_Devis/payer?devis=' . urlencode($_POST['devis']).'&ttl='. urlencode($_POST['ttl']).'&reste='. urlencode($_POST['reste']));    
        }
	}
}
?>