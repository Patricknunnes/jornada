<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(! function_exists('email_padrao')){
    function email_padrao( $emailRemetente, $nomeRemetente, $emailDestinatario, $nomeDestinatario,
                            $mensagem_html = "Contato Saúde Mental Idor", 
                            $titulo = "Contato Saúde Mental Idor"){

        $CI =& get_instance();
        $CI->load->library('email');

//        $config['protocol']    = 'smtp';
//        $config['smtp_host']    = EMAIL_SMTP;
//        $config['smtp_port']    = EMAIL_PORT;
//        $config['smtp_timeout'] = '7';
//        $config['smtp_user']    = EMAIL_USER;
//        $config['smtp_pass']    = EMAIL_PWD;
        $config['charset']    = 'utf-8';
//        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
//        $config['validation'] = TRUE; // bool whether to validate email or not      
//
        $CI->email->initialize($config);

        $mensagem = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" '
                . '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
                . '<html xmlns="http://www.w3.org/1999/xhtml">'
                . '<head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />'
                . '<title></title></head>'
                . '<body>';
        $mensagem .= $mensagem_html;
        $mensagem .= "</body></html>";

        $CI->email->from($emailRemetente, $nomeRemetente);
        $CI->email->to($emailDestinatario, $nomeDestinatario);

        $CI->email->subject($titulo);
        $CI->email->message($mensagem);

        $envio = $CI->email->send();

        if($envio){
            return true;
        } else {
            return false;	
        }

    }
}

