<?php


use Phinx\Seed\AbstractSeed;

class Users extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'name'       => 'Aministrador',
                'email'      => 'admin@admin.com',
                'pass'       => md5('teste'),
                'group_id'   => 1,
                'company_id' => 1
            ],
            [
                'name'       => 'Usuário',
                'email'      => 'user@user.com',
                'pass'       => md5('teste'),
                'group_id'   => 2,
                'company_id' => 2
            ],
            [
                'name'       => 'Analista',
                'email'      => 'analista@analista.com',
                'pass'       => md5('teste'),
                'group_id'   => 3,
                'company_id' => 1
            ]    
        ];    
        
        $table = $this->table('Users');
        $table->insert($data)
              ->save();
    }
}
