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
    	USERNAME, 
    	EMAIL,
        PHONE,
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
        USERNAME => [
           'rules' => 'required|min_length[5]|max_length[32]|is_unique[users.username]',
           'errors' => [
                'required'   => 'Username harus di isi.',
                'min_length' => 'Username minimal 5 karakter.',
                'max_length' => 'Username tidak boleh lebih dari 32 karakter',
                'is_unique'  => 'Username sudah terdaftar di sistem.'
            ]
        ],
        EMAIL => [
            'rules'  => 'required|valid_email|is_unique[users.email]',
            'errors' => [
                'required'    => 'Email harus di isi.',
                'valid_email' => 'Format email salah. contoh : johndoe123@mail.com',
                'is_unique'   => 'Email sudah terdaftar di sistem.'
            ]
        ],
        PHONE => [
            'rules' => 'required|min_length[5]|max_length[20]|is_unique[users.phone]',
            'errors' => [
                'required'   => 'No. Telpon harus di isi.',
                'min_length' => 'No. Telpon minimal 5 karakter.',
                'max_length' => 'No. Telpon tidak boleh lebih dari 20 karakter',
                'is_unique'  => 'No. Telpon sudah terdaftar di sistem.'
            ]
        ]
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
        if(isset($data[USERNAME]))
        {
            $rules[USERNAME] = [
               'rules' => 'required|min_length[5]|max_length[32]|is_unique[users.username]',
               'errors' => [
                    'required'   => 'Username harus di isi.',
                    'min_length' => 'Username minimal 5 karakter.',
                    'max_length' => 'Username tidak boleh lebih dari 32 karakter',
                    'is_unique'  => 'Username sudah terdaftar di sistem.'
                ]
            ];
        }

        if(isset($data[EMAIL]))
        {
            $rules[EMAIL] = [
                'rules'  => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required'    => 'Email harus di isi.',
                    'valid_email' => 'Format email salah. contoh : johndoe123@mail.com',
                    'is_unique'   => 'Email sudah terdaftar di sistem.'
                ]
            ];
        }

        if(isset($data[PHONE]))
        {
            $rules[PHONE] = [
                'rules' => 'required|min_length[5]|max_length[20]|is_unique[users.phone]',
                'errors' => [
                    'required'   => 'No. Telpon harus di isi.',
                    'min_length' => 'No. Telpon minimal 5 karakter.',
                    'max_length' => 'No. Telpon tidak boleh lebih dari 20 karakter',
                    'is_unique'  => 'No. Telpon sudah terdaftar di sistem.'
                ]
            ];
        }
        $this->validationRules = $rules;
    }
}