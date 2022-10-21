<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221020154444 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE note (
            id UUID NOT NULL,
            name VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
            update_counter INT NOT NULL,
            PRIMARY KEY(id)
        )');
        $this->addSql('COMMENT ON COLUMN note.id IS \'(DC2Type:id)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE note');
    }
}
