<?php
function load_message($data){
	include 'helpers/bd.php';
	$bd = bd();	
	$messages = array();
		$data->user_from = strip_tags($data->user_from);
		 try{
			$request = $bd->prepare('SELECT *
									  FROM conversations 
									  WHERE user_from = ?');
	        $request->execute([$data->user_from]);
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