<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190811130912 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE research (id INT AUTO_INCREMENT NOT NULL, title INT DEFAULT NULL, UNIQUE INDEX UNIQ_57EB50C22B36786B (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE research ADD CONSTRAINT FK_57EB50C22B36786B FOREIGN KEY (title) REFERENCES image (id)');
        $this->addSql('DROP TABLE super_image');
        $this->addSql('ALTER TABLE image ADD research INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F57EB50C2 FOREIGN KEY (research) REFERENCES research (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C53D045F57EB50C2 ON image (research)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F57EB50C2');
        $this->addSql('CREATE TABLE super_image (id INT AUTO_INCREMENT NOT NULL, picture_url VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, size INT NOT NULL, length INT NOT NULL, width INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE research');
        $this->addSql('DROP INDEX UNIQ_C53D045F57EB50C2 ON image');
        $this->addSql('ALTER TABLE image DROP research');
    }
}
