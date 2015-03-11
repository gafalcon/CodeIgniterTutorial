<?php

class Note_model extends CRUD_model{

    protected $_table = 'note';
    protected $_primary_key = 'note_id';

    function __construct(){
        parent::__construct();
    }


}
