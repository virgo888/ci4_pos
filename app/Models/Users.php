<?php namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
	protected $DBGroup = 'default';
	protected $table      = T_USER;
    protected $primaryKey = ID;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
    	NAME, 
    	EMAIL,
        PASSWORD,
        TOKEN,
        ACTIVE,
        ENABLE
    ];

    protected $useTimestamps = true;

    protected $createdField  = CREATED_DATE;
    protected $updatedField  = UPDATED_DATE;
    protected $deletedField  = DELETED_DATE;

    protected $validationRules    = [
    	NAME => 'required|min_length[5]|max_length[32]',
    	EMAIL => 'required|valid_email|is_unique[users.email]',
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    /**
     * Set Validation Rules to Updates
     * 
     * @param array $data The input data
     */
    public function setUdpateRules($data)
    {
        $rules = [];

        // if fields are not set then is not required
        if(isset($data[NAME]))
        {
            $rules[NAME] = 'required|min_length[5]|max_length[32]';
        }

        if(isset($data[EMAIL]))
        {
            $rules[EMAIL] = 'required|valid_email|is_unique[users.email]';
        }
        $this->validationRules = $rules;
    }
}