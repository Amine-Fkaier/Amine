<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211207095909 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ADD chef_id INT DEFAULT NULL, DROP labelle, DROP chef, CHANGE state state VARCHAR(255) NOT NULL, CHANGE list_members label VARCHAR(255) NOT NULL, CHANGE finish_date end_date DATE NOT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE150A48F1 FOREIGN KEY (chef_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EE150A48F1 ON project (chef_id)');
        $this->addSql('ALTER TABLE task ADD user_id INT DEFAULT NULL, ADD project_id INT DEFAULT NULL, ADD desription VARCHAR(255) NOT NULL, DROP labelle, DROP member, CHANGE state state VARCHAR(255) NOT NULL, CHANGE description label VARCHAR(255) NOT NULL, CHANGE finish_date end_date DATE NOT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB25A76ED395 ON task (user_id)');
        $this->addSql('CREATE INDEX IDX_527EDB25166D1F9C ON task (project_id)');
        $this->addSql('ALTER TABLE user ADD project_id INT DEFAULT NULL, ADD user_name VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, DROP first_name, DROP last_name, DROP cin, DROP tel, DROP mail, CHANGE role role VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649166D1F9C ON user (project_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE150A48F1');
        $this->addSql('DROP INDEX UNIQ_2FB3D0EE150A48F1 ON project');
        $this->addSql('ALTER TABLE project ADD labelle VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD chef VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP chef_id, CHANGE state state VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE end_date finish_date DATE NOT NULL, CHANGE label list_members VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25A76ED395');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25166D1F9C');
        $this->addSql('DROP INDEX UNIQ_527EDB25A76ED395 ON task');
        $this->addSql('DROP INDEX IDX_527EDB25166D1F9C ON task');
        $this->addSql('ALTER TABLE task ADD labelle VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD member VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP user_id, DROP project_id, DROP label, DROP desription, CHANGE state state VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE end_date finish_date DATE NOT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649166D1F9C');
        $this->addSql('DROP INDEX IDX_8D93D649166D1F9C ON user');
        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD last_name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD cin VARCHAR(8) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD tel VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD mail VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP project_id, DROP user_name, DROP email, DROP password, CHANGE role role VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
