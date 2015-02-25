<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Laasti\Entities;

/**
 * Description of Pages
 *
 * @author Sonia
 */
class Members extends \Spot\Entity
{
    protected static $table = 'members';
    
    //TODO: Have a getter/setter generator
    public static function fields()
    {
        return [
            'id'          => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'status'      => ['type' => 'smallint', 'required' => true, 'default' => 0],
            'date_creation' => ['type' => 'integer', 'value' => time()],
            'date_modification' => ['type' => 'integer', 'value' => time()],
            'date_format_creation' => ['type' => 'datetime'],
            'date_format_modification' => ['type' => 'datetime'],
            'modif_user_id'    => ['type' => 'integer'],
        ];
    }
}
