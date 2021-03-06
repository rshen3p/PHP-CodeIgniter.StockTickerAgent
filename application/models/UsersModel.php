<?php

class UsersModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function getUsers(){
        $this->db->select('*');
        $this->db->from('users');

        $query = $this->db->get();
        return $query;
    }

    function addUser($username,$password,$role,$fileName){
        $data = array(
            'username'      => $username ,
            'password'      => $password ,
            'role'          => $role ,
            'avatar'        => $fileName ,
            'Player'    => $username
        );

        $this->db->insert('users', $data);
    }

    function updateAvatar($prevPlayerName, $usersData){
        $this->db->where('Player', $prevPlayerName);
        $this->db->update('users', $usersData);
    }

    function updateName($prevPlayerName, $usersData){
        $this->db->where('Player', $prevPlayerName);
        $this->db->update('users', $usersData);
    }

    function updateUser($prevPlayerName, $playersData){
        $this->db->where('Player', $prevPlayerName);
        $this->db->update('users', $playersData);
    }

    public function addHolding($request){
        $data = array(
            'token' => $request->token,
            'stock' => $request->stock,
            'player' => $this->session->userdata('username'),
            'quantity'=> $request->amount
        );
        $this->db->insert('holding',$data);

        $data = array(
            'DateTime' => $request->datetime,
            'Player' => $this->session->userdata('username'),
            'Stock' =>$request->stock,
            'Trans'=>'buy',
            'Quantity' => $request->amount
        );
        $this->db->insert('transactions',$data);
    }

}