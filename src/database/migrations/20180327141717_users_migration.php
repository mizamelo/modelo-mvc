<?php


use Phinx\Migration\AbstractMigration;

class UsersMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('Users');

        $table->addColumn('name', 'string', ['limit' => 50])
              ->addColumn('email', 'string', ['limit' => 100])
              ->addColumn('pass', 'string', ['limit' => 40])
              ->addColumn('situation', 'integer', ['limit' => 1, 'default' => 0])
              ->addColumn('group_id', 'integer')
              ->addColumn('company_id', 'integer')
              ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('delet', 'char', ['limit' => 1, 'default' => ''])
              ->addForeignKey('group_id', 'Groups', 'id')
              ->addForeignKey('company_id', 'Company', 'id')
              ->addIndex(['email'], ['unique' => true])
              ->create();
    }

}
