<?php

declare(strict_types=1);

namespace Pixiekat\AlicantoLearning;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240723222102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create learning path table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lms_learning_paths (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, objectives LONGTEXT DEFAULT NULL, visibility SMALLINT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetimetz_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE lms_learning_paths');
    }
}
