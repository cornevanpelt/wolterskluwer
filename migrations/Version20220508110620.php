<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220508110620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->insert('user', ['name' => 'Corné']);
        $this->connection->insert('user_update_medium', ['user_id' => 1, 'update_medium_id' => 1]);
    }

    public function down(Schema $schema): void
    {
        $this->connection->delete('user', ['name' => 'Corné']);
        $this->connection->delete('user_update_medium', ['user_id' => 1]);
    }
}
