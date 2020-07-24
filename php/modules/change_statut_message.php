<?php
function change_statut_message($data){
	include 'helpers/bd.php';
    $bd = bd();
	try{
        $req = $bd->prepare('UPDATE conversations SET statut = ? WHERE id = ?');
        $req->execute([$data->statut,$data->id_conversations]);
            return json_encode(array('error' => false,'message'=>'Data changed!'));
        }catch(Exception $i){
            return json_encode(array('error' => true,'message'=>'Data not changed!'));
        } 
    }
?>