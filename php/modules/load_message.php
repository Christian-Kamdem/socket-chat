<?php
function load_message($data){
	include 'helpers/bd.php';
	$bd = bd();	
	$messages = array();
		$data->user_from = strip_tags($data->user_from);
		$data->user_to = strip_tags($data->user_to);
		 try{
			$request = $bd->prepare('SELECT *
									  FROM conversations 
									  WHERE user_from = ? AND user_to = ?');
	        $request->execute([$data->user_from,$data->user_to]);
			}catch(Exception $e){
				return json_encode(array('message' => 'Database connection error!','error'=>true));
			}	

			if($request->rowCount() < 1){
				return json_encode(array('message' => 'Not found','error'=>true));
			}else{
				while($infos = $request->fetch()){
					$messages['id'] = $infos['id'];
					$messages['user_from'] = $infos['user_from'];
					$messages['user_to'] = $infos['user_to'];
					$messages['sent_at'] = $infos['sent_at'];
					$messages['statut'] = $infos['statut'];
					$messages['message'] = $infos['message'];
				}
				return json_encode(array('message' => $messages,'error'=>false));
			}		
	}
?>