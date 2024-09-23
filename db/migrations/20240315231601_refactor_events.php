<?php

declare(strict_types=1);

use Phinx\Db\Action\AddColumn;
use Phinx\Migration\AbstractMigration;

final class RefactorEvents extends AbstractMigration
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
        $event = $this->table('events');
        $event->addColumn('addressDetail','text')
              ->addColumn('city','string',['limit'=>100])
              ->addColumn('state','string',['limit'=>100])
              ->addColumn('country','string',['limit'=>100])
              ->addColumn('CEP','string',['limit'=>10])
              ->update(); 
    }
}


