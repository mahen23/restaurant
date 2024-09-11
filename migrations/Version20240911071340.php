<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240911071340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE food (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(10, 0) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, patron_id INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_F5299398DBD5322 (patron_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_food (order_id INT NOT NULL, food_id INT NOT NULL, INDEX IDX_99C913E08D9F6D38 (order_id), INDEX IDX_99C913E0BA8E87C4 (food_id), PRIMARY KEY(order_id, food_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patron (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398DBD5322 FOREIGN KEY (patron_id) REFERENCES patron (id)');
        $this->addSql('ALTER TABLE order_food ADD CONSTRAINT FK_99C913E08D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_food ADD CONSTRAINT FK_99C913E0BA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398DBD5322');
        $this->addSql('ALTER TABLE order_food DROP FOREIGN KEY FK_99C913E08D9F6D38');
        $this->addSql('ALTER TABLE order_food DROP FOREIGN KEY FK_99C913E0BA8E87C4');
        $this->addSql('DROP TABLE food');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_food');
        $this->addSql('DROP TABLE patron');
    }
}
