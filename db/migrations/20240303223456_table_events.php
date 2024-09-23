<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TableEvents extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {

        $this->execute('DROP TABLE IF EXISTS events;');

        $products = $this->table('events');
        $products->addColumn('name','text')
              ->addColumn('color','string',['limit'=>40])
              ->addColumn('comments','text')
              ->addColumn('theme_fk','biginteger')
              ->addColumn('type_fk','biginteger')
              ->addColumn('date_event_initial', 'datetime', ['null' => false])
              ->addColumn('date_event_final', 'datetime', ['null' => false])
              ->addColumn('created_at', 'datetime', ['null' => false])
              ->addColumn('updated_at', 'datetime', ['null' => false])
              ->addColumn('status','datetime',['null'=>true])
              ->create(); 

    }
}
