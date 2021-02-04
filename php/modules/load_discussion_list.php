<?php
function load_discussion_list($data){
	include 'helpers/bd.php';
	$bd = bd();
	$box = array();
		$data->user_from = strip_tags($data->user_from);
		 try{
			$request = $bd->prepare('SELECT user_from,user_to
									  FROM conversations 
									  WHERE user_from = ? OR user_to = ?');
	        $request->execute([$data->user_from,$data->user_from]);
			}catch(Exception $e){
				return json_encode(array('message' => 'Database connection error!','error'=>true));
			}	

			if($request->rowCount() < 1){
				return json_encode(array('message' => 'Not found','error'=>false));
			}else{
				while($infos = $request->fetch()){
					if($data->user_from == $infos['user_to']){
						array_push($box,$infos['user_from']);
					}elseif($data->user_from == $infos['user_from']){
						array_push($box,$infos['user_to']);
					}
				}
				$box = array_unique($box);
				return json_encode(array('message' => $box,'error'=>false));
			}		
	}
?>