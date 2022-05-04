<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504094445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->insert('bottom', ['name' => 'Classic']);
        $this->connection->insert('bottom', ['name' => 'Cheesy Crust']);
        $this->connection->insert('topping', ['name' => 'Hawaii']);
        $this->connection->insert('topping', ['name' => 'Hot & Spicy']);
        $this->connection->insert('branch', ['name' => 'Dominos', 'has_delivery' => 1, 'has_takeaway' => 0]);
        $this->connection->insert('branch', ['name' => 'New York Pizza', 'has_delivery' => 0, 'has_takeaway' => 1]);
        $this->connection->insert('order_status', ['name' => 'Bestelling ontvangen']);
        $this->connection->insert('order_status', ['name' => 'Pizza voorbereid']);
        $this->connection->insert('order_status', ['name' => 'In de oven']);
        $this->connection->insert('order_status', ['name' => 'Bezorger onderweg']);
        $this->connection->insert('order_status', ['name' => 'Afgeleverd']);
        $this->connection->insert('update_medium', ['name' => 'SMS']);
        $this->connection->insert('update_medium', ['name' => 'e-mail']);
        $this->connection->insert('update_medium', ['name' => 'whatsapp']);
    }

    public function down(Schema $schema): void
    {
        $this->connection->delete('bottom', ['name' => 'Classic']);
        $this->connection->delete('bottom', ['name' => 'Cheesy Crust']);
        $this->connection->delete('topping', ['name' => 'Hawaii']);
        $this->connection->delete('topping', ['name' => 'Hot & Spicy']);
        $this->connection->delete('branch', ['name' => 'Dominos']);
        $this->connection->delete('branch', ['name' => 'New York Pizza']);
        $this->connection->delete('order_status', ['name' => 'Bestelling ontvangen']);
        $this->connection->delete('order_status', ['name' => 'Pizza voorbereid']);
        $this->connection->delete('order_status', ['name' => 'In de oven']);
        $this->connection->delete('order_status', ['name' => 'Bezorger onderweg']);
        $this->connection->delete('order_status', ['name' => 'Afgeleverd']);
        $this->connection->delete('update_medium', ['name' => 'SMS']);
        $this->connection->delete('update_medium', ['name' => 'e-mail']);
        $this->connection->delete('update_medium', ['name' => 'whatsapp']);
    }
}
