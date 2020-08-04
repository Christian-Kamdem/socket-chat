<?php
function load_discussion_list($data){
	include 'helpers/bd.php';
	$bd = bd();	
	$box = array();
		$data->user_from = strip_tags($data->user_from);
		$data->user_to = strip_tags($data->user_to);
		 try{
			$request = $bd->prepare('SELECT DISTINCT user_to
									  FROM conversations 
									  WHERE user_from = ? OR user_to = ?');
	        $request->execute([$data->user_from,$data->user_from]);
			}catch(Exception $e){
				return json_encode(array('message' => 'Database connection error!','error'=>true));
			}	

			if($request->rowCount() < 1){
				return json_encode(array('message' => 'Not found','error'=>true));
			}else{
				while($infos = $request->fetch()){
					array_push($box,$infos['user_to']);
				}
				return json_encode(array('message' => $box,'error'=>false));
			}		
	}
?>