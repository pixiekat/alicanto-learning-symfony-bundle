<?php

declare(strict_types=1);

namespace Pixiekat\AlicantoLearning;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240724021146 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add courses table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lms_courses (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetimetz_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lms_learning_path_courses (course_id INT NOT NULL, learning_path_id INT NOT NULL, INDEX IDX_9321A649591CC992 (course_id), INDEX IDX_9321A6491DCBEE98 (learning_path_id), PRIMARY KEY(course_id, learning_path_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lms_learning_path_courses ADD CONSTRAINT FK_9321A649591CC992 FOREIGN KEY (course_id) REFERENCES lms_courses (id)');
        $this->addSql('ALTER TABLE lms_learning_path_courses ADD CONSTRAINT FK_9321A6491DCBEE98 FOREIGN KEY (learning_path_id) REFERENCES lms_learning_paths (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lms_learning_path_courses DROP FOREIGN KEY FK_9321A649591CC992');
        $this->addSql('ALTER TABLE lms_learning_path_courses DROP FOREIGN KEY FK_9321A6491DCBEE98');
        $this->addSql('DROP TABLE lms_courses');
        $this->addSql('DROP TABLE lms_learning_path_courses');
    }
}
