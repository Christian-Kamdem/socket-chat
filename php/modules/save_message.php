<?php
function save_message($data){
	include 'helpers/bd.php';
	$bd = bd();
					$data->user_from = strip_tags($data->user_from);
					$data->user_to = strip_tags($data->user_to);
					$data->sent_at = strip_tags($data->sent_at);
					$data->statut = strip_tags($data->statut);
                    $data->message = strip_tags($data->message);                 
                        try{
                        $req = $bd->prepare('INSERT INTO conversations(
                            user_from,
                            user_to,
                            sent_at,
                            statut,
                            message
                            ) 
                                    VALUES(:user_from, :user_to, :sent_at, :statut, :message)');
                        $req->execute(array(
                                                                             'user_from' => $data->user_from,
                                                                             'user_to' => $data->user_to,
                                                                             'sent_at' => $data->sent_at,
                                                                             'statut' => $data->statut,                                                                             
                                                                             'message' => $data->message


                        ));
                        return json_encode(array('error' => false,'message'=>'Data saved!'));
                    }catch(Exception $i){
                                  return json_encode(array('error' => true,'message' => 'Error when saving data!'));
                              }					 
			}
?>