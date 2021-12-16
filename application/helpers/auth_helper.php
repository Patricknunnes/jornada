<?php 

function permission() {
	$ci = get_instance();
	$loggedUser = $ci->session->userdata("logged_user");

	if(!$loggedUser){
		$ci->session->set_flashdata("danger", "Você precisa estar logado para acessar esta página");
		redirect("index.php/login");
	}
	return $loggedUser;
}
