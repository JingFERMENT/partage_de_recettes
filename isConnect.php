<?php 

if(!isset($_SESSION['loggedUser'])){
 echo 'If faudrait être authentifié avant de faire cette action';
 exit;
}