<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Muros extends CI_Controller {


	function __construct() {
		CI_Controller::__construct();

		$this -> load -> model('Usuario');
		$this -> load -> model('Muro');
		$this -> load -> library('Utilidades');
		$this -> utilidades -> comprobar_logueo();

	}

	function index($id = null) {
		$data = $this -> utilidades -> obtener_datos_plantilla();
		$data['mensaje'] = $this -> session -> flashdata('mensaje');
		$email = $this -> session -> userdata('usuario');
		$data['filas'] = $this -> Usuario -> obtener_datos($email);
		if ($id == null)
			$id = $this -> Usuario -> obtener_id();
		$data['envios'] = $this -> Muro -> obtener_datos_contenedor($id, $this -> Usuario -> obtener_id());
		foreach ($data['envios'] as $k => $v) {
			$data['envios'][$k]['comentarios'] = $this -> Muro -> obtener_comentarios($v['id_envio']);

		}
		/* Se recogen nombre y apellidos del propietario del muro */
		$propietario_muro = $this -> Usuario -> obtener($id);
		$data['id_propietario_muro'] = $id;
		$data['id_usuario_logueado'] = $this -> Usuario -> obtener_id();
		$data['propietario_muro'] = $propietario_muro['nombre'] . ' ' . $propietario_muro['apellidos'];
		if ($this -> session -> userdata('contador')) {
			$data['contador'] = $this -> session -> userdata('contador');
			$this -> session -> unset_userdata('contador');
		}
		$this -> template -> load('template', 'muros/index', $data);
	}

	function enviar() {
		$id_propietario = $this -> input -> post('id_propietario');
		$id_emisor_mensaje = $this -> input -> post('id_usuario_logueado');
		$texto = $this -> input -> post('texto');
		$this -> Muro -> hacer_envio($id_emisor_mensaje, $id_propietario, $texto);
		redirect("muros/index/$id_propietario");
	}

	function comentar() {

		if ($this -> input -> post('comentar')) {
			$contador = $this -> input -> post('contador');
			$id_envio = $this -> input -> post('id_envio');
			$id_propietario = $this -> input -> post('id_propietario');
			$id_usuario_logueado = $this -> Usuario -> obtener_id();
			$texto = $this -> input -> post('texto');
			$this -> Muro -> hacer_comentario($id_envio, $id_usuario_logueado, $texto);
			$this -> session -> set_userdata('contador', $contador);
			redirect("muros/index/$id_propietario");
		}
	}

	function borrar_envio() {
		$id_envio = $this -> input -> post('id_envio');
		$id_propietario_muro = $this -> input -> post('id_propietario_muro');
		if (!empty($id_envio)) {
			$res = $this -> Muro -> borrar_envio($id_envio);
			if ($res && $this -> db -> affected_rows() == 1) {
				redirect("muros/index/$id_propietario_muro");
			} else {
				$this -> session -> set_flashdata('mensaje', 'No se ha podido borrar el envío');
			}
		} else {
			$this -> session -> set_flashdata('mensaje', 'No se ha encontrado ningún envio');
		}
	}

	function borrar_comentario() {
		$id_envio = $this -> input -> post('id');
		$id_propietario_muro = $this -> input -> post('id_propietario_muro');
		if (!empty($id_envio)) {
			$res = $this -> Muro -> borrar_comentario($id_envio);
			if ($res && $this -> db -> affected_rows() == 1) {
				redirect("muros/index/$id_propietario_muro");
			} else {
				$this -> session -> set_flashdata('mensaje', 'No se ha podido borrar el envío');
			}
		} else {
			$this -> session -> set_flashdata('mensaje', 'No se ha encontrado ningún envio');
		}
	}

	function agregar_me_gusta($id_envio) {
		$this -> load -> model('Usuario');
		$id = $this -> session -> userdata('id');
		$res = $this -> Usuario -> ahora_me_gusta($id, $id_envio);
		if ($res) {
			redirect('muros/index');
		} else {
			$this -> session -> set_flashdata('mensaje', 'No se ha podido agregar a tus "Me Gusta"');
		}
	}

	function quitar_me_gusta($id_envio) {
		$this -> load -> model('Usuario');
		$id = $this -> session -> userdata('id');
		$res = $this -> Usuario -> ahora_no_me_gusta($id, $id_envio);
		if ($res) {
			redirect('muros/index');
		} else {
			$this -> session -> set_flashdata('mensaje', 'No se ha podido quitar de tus "Me Gusta"');
		}
	}

}
